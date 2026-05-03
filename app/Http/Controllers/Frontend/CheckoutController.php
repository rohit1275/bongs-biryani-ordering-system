<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }
        $orderType = session('order_type', 'delivery');
        $tableNo = session('table_no', '');

        return view('pages.checkout', compact('cartItems', 'orderType', 'tableNo'));
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        
        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code.']);
        }

        if ($coupon->expiry_date && $coupon->expiry_date < now()) {
            return response()->json(['success' => false, 'message' => 'This coupon has expired.']);
        }

        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
            return response()->json(['success' => false, 'message' => 'This coupon usage limit has been reached.']);
        }

        return response()->json([
            'success' => true, 
            'type' => $coupon->type,
            'value' => $coupon->value,
            'message' => 'Coupon applied successfully!'
        ]);
    }

    public function store(Request $request)
    {
        $orderType = session('order_type', 'delivery');

        $rules = [
            'shipping_name' => 'required|string|max:255',
            'coupon_code' => 'nullable|string',
            'payment_method' => 'required|in:cod,upi,card,counter',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
        ];

        if ($orderType === 'delivery') {
            $rules['shipping_phone'] = 'required|string|max:20';
            $rules['shipping_address'] = 'required|string|max:500';
            $rules['shipping_city'] = 'required|string|max:100';
            $rules['shipping_pincode'] = 'required|string|max:20';
        } else if ($orderType === 'takeaway') {
            $rules['shipping_phone'] = 'required|string|max:20';
            $rules['shipping_address'] = 'nullable|string|max:500';
            $rules['shipping_city'] = 'nullable|string|max:100';
            $rules['shipping_pincode'] = 'nullable|string|max:20';
        } else if ($orderType === 'dine_in') {
            $rules['shipping_phone'] = 'nullable|string|max:20';
            $rules['shipping_address'] = 'nullable|string|max:500';
            $rules['shipping_city'] = 'nullable|string|max:100';
            $rules['shipping_pincode'] = 'nullable|string|max:20';
            $rules['table_no'] = 'required|string|max:50';
        }

        $request->validate($rules);

        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty');
        }

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->product->price * $item->quantity;
        }

        $total = $subtotal;
        $appliedCoupon = null;

        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();
            if ($coupon && (!$coupon->expiry_date || $coupon->expiry_date >= now()) && (!$coupon->usage_limit || $coupon->used_count < $coupon->usage_limit)) {
                $appliedCoupon = $coupon;
                if ($coupon->type === 'fixed') {
                    $total = max(0, $subtotal - $coupon->value);
                } elseif ($coupon->type === 'percentage') {
                    $total = max(0, $subtotal - ($subtotal * ($coupon->value / 100)));
                }
            }
        }

        if (in_array($request->payment_method, ['card', 'upi'])) {
            try {
                $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                $receiptId = (string) Str::uuid();
                $razorpayOrder = $api->order->create([
                    'receipt'         => $receiptId,
                    'amount'          => $total * 100, // amount in paise
                    'currency'        => 'INR',
                ]);

                session()->put('razorpay_pending_order_' . $razorpayOrder['id'], [
                    'order_type' => $orderType,
                    'table_no' => $request->table_no ?? session('table_no'),
                    'total_amount' => $total,
                    'payment_method' => $request->payment_method,
                    'shipping_name' => $request->shipping_name,
                    'shipping_phone' => $request->shipping_phone,
                    'shipping_address' => $request->shipping_address,
                    'shipping_city' => $request->shipping_city,
                    'shipping_pincode' => $request->shipping_pincode,
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                    'coupon_code' => $appliedCoupon ? $appliedCoupon->code : null,
                ]);

                return response()->json([
                    'success' => true,
                    'requires_razorpay' => true,
                    'razorpay_order_id' => $razorpayOrder['id'],
                    'amount' => $total * 100,
                    'key' => config('services.razorpay.key')
                ]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Failed to initialize payment gateway. ' . $e->getMessage()], 500);
            }
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_type' => $orderType,
                'table_no' => $request->table_no ?? session('table_no'),
                'total_amount' => $total,
                'status' => 'confirmed',
                'payment_status' => 'pending',
                'payment_method' => $request->payment_method,
                'razorpay_order_id' => null,
                'razorpay_payment_id' => null,
                'shipping_name' => $request->shipping_name,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_pincode' => $request->shipping_pincode,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            if ($appliedCoupon) {
                $appliedCoupon->increment('used_count');
            }

            // Clear Cart
            CartItem::where('user_id', Auth::id())->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'requires_razorpay' => false,
                'redirect' => route('track.show', ['id' => $order->id]),
                'message' => 'Order placed successfully!',
                'order_id' => $order->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Could not process order.'], 500);
        }
    }
}
