<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view('pages.cart');
    }

    public function getItems()
    {
        if (Auth::check()) {
            $items = CartItem::with('product')->where('user_id', Auth::id())->get();
            return response()->json(['items' => $items, 'loggedIn' => true]);
        }
        return response()->json(['items' => [], 'loggedIn' => false]);
    }

    public function sync(Request $request)
    {
        if (!Auth::check()) return response()->json(['success' => false], 401);
        
        $localCart = $request->input('cart', []);
        
        foreach ($localCart as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $cartItem = CartItem::where('user_id', Auth::id())
                                    ->where('product_id', $product->id)
                                    ->first();
                if ($cartItem) {
                    $cartItem->quantity += $item['quantity'];
                    $cartItem->save();
                } else {
                    CartItem::create([
                        'user_id' => Auth::id(),
                        'product_id' => $product->id,
                        'quantity' => $item['quantity']
                    ]);
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Cart synced successfully.']);
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);
        
        if (!Auth::check()) return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);

        $cartItem = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => 1
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Added to cart']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if (!Auth::check()) return response()->json(['success' => false], 401);

        $cartItem = CartItem::where('user_id', Auth::id())->where('id', $request->item_id)->firstOrFail();
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $request->validate(['item_id' => 'required|exists:cart_items,id']);
        
        if (!Auth::check()) return response()->json(['success' => false], 401);

        CartItem::where('user_id', Auth::id())->where('id', $request->item_id)->delete();

        return response()->json(['success' => true, 'message' => 'Item removed']);
    }
}
