<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_tracking_page_renders_order_details(): void
    {
        $order = $this->createOrder('preparing');
        $this->actingAs($order->user);

        $response = $this->get(route('track.show', $order->id));

        $response->assertOk();
        $response->assertSee('Google Maps Tracking');
        $response->assertSee((string) $order->id);
        $response->assertSee('Chicken Dum Biryani');
    }

    public function test_tracking_status_endpoint_returns_latest_order_status(): void
    {
        $order = $this->createOrder('out_for_delivery');
        $this->actingAs($order->user);

        $response = $this->getJson(route('orders.status', $order->id));

        $response->assertOk()->assertJson([
            'id' => $order->id,
            'status' => 'out_for_delivery',
            'status_label' => 'Out for Delivery',
            'shipping_address' => '42 Biryani Lane, Gurugram',
            'delivery_partner' => 'Ravi Kumar',
        ]);
    }

    public function test_tracking_page_shows_not_found_state_for_unknown_order(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('track.show', 999999));

        $response->assertOk();
        $response->assertSee('Order not found');
    }

    public function test_tracking_page_renders_map_when_order_has_no_coordinates(): void
    {
        $order = $this->createOrder('preparing');
        $order->forceFill(['lat' => null, 'lng' => null])->save();
        $this->actingAs($order->user);

        $response = $this->get(route('track.show', $order->id));

        $response->assertOk();
        $response->assertSee('id="map"', false);
    }

    public function test_guest_is_redirected_to_login_for_track_page(): void
    {
        $order = $this->createOrder('preparing');

        $response = $this->get(route('track.show', $order->id));

        $response->assertRedirect(route('login'));
    }

    public function test_user_cannot_access_another_users_order_tracking(): void
    {
        $order = $this->createOrder('preparing');
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('track.show', $order->id));

        $response->assertForbidden();
    }

    private function createOrder(string $status): Order
    {
        $user = User::factory()->create();

        $category = Category::query()->create([
            'name' => 'Biryani',
            'slug' => 'biryani',
        ]);

        $product = Product::query()->create([
            'category_id' => $category->id,
            'name' => 'Chicken Dum Biryani',
            'description' => 'Slow-cooked Kolkata style biryani.',
            'price' => 299,
            'is_available' => true,
        ]);

        $order = Order::query()->create([
            'user_id' => $user->id,
            'total_amount' => 598,
            'status' => $status,
            'shipping_address' => '42 Biryani Lane, Gurugram',
            'lat' => 28.5027012,
            'lng' => 77.0921034,
        ]);

        OrderItem::query()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'price' => 299,
        ]);

        return $order;
    }
}
