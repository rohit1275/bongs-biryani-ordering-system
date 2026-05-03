<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('pages.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        $order->load(['orderItems.product']);
        // Might not need a separate show view if we put it in accordion format, but good to have
        return view('pages.order_show', compact('order'));
    }

    public function activeTracking(): JsonResponse
    {
        if (Auth::user()?->role === 'admin') {
            return response()->json(['active' => false]);
        }

        $order = Order::query()
            ->where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'confirmed', 'preparing', 'out_for_delivery'])
            ->latest()
            ->first();

        if (!$order) {
            return response()->json(['active' => false]);
        }

        $eta = match ($order->status) {
            'pending', 'confirmed' => '35 mins',
            'preparing' => '25 mins',
            'out_for_delivery' => '10 mins',
            default => '35 mins',
        };

        return response()->json([
            'active' => true,
            'order_id' => $order->id,
            'status' => $order->status,
            'eta' => $eta,
            'track_url' => route('track.show', $order->id),
        ]);
    }

    public function submitRating(Request $request, Order $order): JsonResponse
    {
        if ((int) $order->user_id !== (int) Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($order->status !== 'delivered') {
            return response()->json(['message' => 'Rating is available after delivery only.'], 422);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        Rating::updateOrCreate(
            [
                'order_id' => $order->id,
                'user_id' => Auth::id(),
            ],
            [
                'rating' => $validated['rating'],
                'review' => $validated['review'] ?? null,
            ]
        );

        return response()->json(['success' => true, 'message' => 'Rating submitted']);
    }

    public function deliveredPendingRating(): JsonResponse
    {
        $order = Order::query()
            ->where('user_id', Auth::id())
            ->where('status', 'delivered')
            ->whereDoesntHave('rating')
            ->latest()
            ->first();

        if (!$order) {
            return response()->json(['pending' => false]);
        }

        return response()->json([
            'pending' => true,
            'order_id' => $order->id,
        ]);
    }
}
