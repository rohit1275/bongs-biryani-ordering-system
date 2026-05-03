<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Exception;

class RazorpayController extends Controller
{
    public function createRazorpayOrder(Request $request)
    {
        return response()->json(['success' => false, 'message' => 'Deprecated endpoint.'], 400);
    }

    public function verifyPayment(Request $request)
    {
        $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        $payload = session()->get('razorpay_pending_order_' . $request->razorpay_order_id);
        if (!$payload) {
            return response()->json(['success' => false, 'message' => 'Checkout session expired or invalid. Please try again.'], 400);
        }

        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            DB::beginTransaction();

            $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
            if ($cartItems->isEmpty()) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Cart is empty. Payment was successful, please contact support.'], 400);
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_type' => $payload['order_type'],
                'table_no' => $payload['table_no'],
                'total_amount' => $payload['total_amount'],
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'payment_method' => $payload['payment_method'],
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'shipping_name' => $payload['shipping_name'],
                'shipping_phone' => $payload['shipping_phone'],
                'shipping_address' => $payload['shipping_address'],
                'shipping_city' => $payload['shipping_city'],
                'shipping_pincode' => $payload['shipping_pincode'],
                'lat' => $payload['lat'],
                'lng' => $payload['lng'],
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            if ($payload['coupon_code']) {
                Coupon::where('code', $payload['coupon_code'])->increment('used_count');
            }

            CartItem::where('user_id', Auth::id())->delete();
            session()->forget('razorpay_pending_order_' . $request->razorpay_order_id);

            DB::commit();

            return response()->json(['success' => true, 'redirect' => route('track.show', $order->id)]);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Razorpay Signature Verification Failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Payment verification failed.'], 400);
        }
    }
}
