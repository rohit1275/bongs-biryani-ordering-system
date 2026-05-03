<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $category = Category::query()->create([
            'name' => 'Signature Biryani',
            'slug' => 'signature-biryani',
        ]);

        Product::query()->create([
            'category_id' => $category->id,
            'name' => 'Kolkata Chicken Biryani',
            'description' => 'Fragrant biryani for the homepage.',
            'price' => 349,
            'is_available' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
