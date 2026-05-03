<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TrackingController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $orderId = trim((string) $request->query('order_id', ''));
        if ($orderId !== '') {
            if (!Auth::check()) {
                return redirect()
                    ->route('login')
                    ->with('error', 'Please login to track your order');
            }

            return redirect()->route('track.show', ['id' => $orderId]);
        }

        return view('pages.tracking', [
            'order' => null,
            'initialOrderData' => null,
            'searchedOrderId' => null,
            'orderNotFound' => false,
            'requiresLogin' => !Auth::check(),
            'restaurant' => $this->restaurantCoordinates(),
        ]);
    }

    public function show(string $id): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Please login to track your order');
        }

        $order = $this->findOrder($id);
        if (!$order) {
            return view('pages.tracking', [
                'order' => null,
                'initialOrderData' => null,
                'searchedOrderId' => $id,
                'orderNotFound' => true,
                'requiresLogin' => false,
                'restaurant' => $this->restaurantCoordinates(),
            ]);
        }

        if (!$this->canAccessOrder($order)) {
            abort(403, 'Unauthorized access');
        }

        $order->load(['orderItems.product', 'user']);

        return view('pages.tracking', [
            'order' => $order,
            'initialOrderData' => $this->transformOrder($order),
            'searchedOrderId' => $id,
            'orderNotFound' => false,
            'requiresLogin' => false,
            'restaurant' => $this->restaurantCoordinates(),
        ]);
    }

    public function status(string $id): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'Please login to track your order.',
            ], 401);
        }

        $order = $this->findOrder($id);

        if (!$order) {
            return response()->json([
                'message' => 'Order not found.',
            ], 404);
        }

        if (!$this->canAccessOrder($order)) {
            return response()->json([
                'message' => 'Unauthorized access',
            ], 403);
        }

        $order->loadMissing(['orderItems.product']);

        return response()->json($this->transformOrder($order));
    }

    private function findOrder(string $id): ?Order
    {
        return Order::query()
            ->whereKey($id)
            ->orWhere('id', $id)
            ->first();
    }

    private function transformOrder(Order $order): array
    {
        $normalizedStatus = $this->normalizeStatus($order->status);

        return [
            'id' => $order->id,
            'order_type' => $order->order_type,
            'status' => $normalizedStatus,
            'status_label' => $this->statusLabel($normalizedStatus),
            'total_amount' => (float) $order->total_amount,
            'formatted_total_amount' => number_format((float) $order->total_amount, 2),
            'shipping_address' => $order->shipping_address,
            'lat' => $order->lat !== null ? (float) $order->lat : null,
            'lng' => $order->lng !== null ? (float) $order->lng : null,
            'created_at' => optional($order->created_at)->format('M d, Y h:i A'),
            'updated_at' => optional($order->updated_at)->toIso8601String(),
            'estimated_delivery_time' => $this->estimatedDeliveryTime($normalizedStatus),
            'delivery_partner' => 'Ravi Kumar',
            'delivery_partner_phone' => '+91 98765 43210',
            'items' => $order->orderItems->map(function ($item) {
                return [
                    'name' => $item->product->name ?? 'Item unavailable',
                    'quantity' => $item->quantity,
                    'price' => (float) $item->price,
                    'formatted_price' => number_format((float) $item->price, 2),
                    'line_total' => number_format((float) ($item->quantity * $item->price), 2),
                ];
            })->values()->all(),
        ];
    }

    private function normalizeStatus(?string $status): string
    {
        return match ($status) {
            'confirmed', 'pending', 'placed', null => 'placed',
            'preparing' => 'preparing',
            'out_for_delivery' => 'out_for_delivery',
            'delivered' => 'delivered',
            default => 'placed',
        };
    }

    private function statusLabel(string $status): string
    {
        return match ($status) {
            'placed' => 'Order Placed',
            'preparing' => 'Preparing',
            'out_for_delivery' => 'Out for Delivery',
            'delivered' => 'Delivered',
            default => 'Order Placed',
        };
    }

    private function estimatedDeliveryTime(string $status): string
    {
        return match ($status) {
            'placed' => '35-40 mins',
            'preparing' => '20-25 mins',
            'out_for_delivery' => '10-15 mins',
            'delivered' => 'Delivered',
            default => '35-40 mins',
        };
    }

    private function restaurantCoordinates(): array
    {
        $lat = config('services.google_maps.restaurant_lat');
        $lng = config('services.google_maps.restaurant_lng');

        return [
            'lat' => (float) ($lat ?? 28.496206),
            'lng' => (float) ($lng ?? 77.088177),
            'name' => config('app.name', 'Bongs Biryani') . ' Kitchen',
        ];
    }

    private function canAccessOrder(Order $order): bool
    {
        $user = Auth::user();
        if (!$user) {
            return false;
        }

        if (($user->role ?? null) === 'admin') {
            return true;
        }

        return (int) $order->user_id === (int) $user->id;
    }
}
