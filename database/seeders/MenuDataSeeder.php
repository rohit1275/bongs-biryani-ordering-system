<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class MenuDataSeeder extends Seeder
{
    public function run()
    {
        $categoriesData = [
            'Rice (Kolkata Style)' => [
                'image' => 'https://images.unsplash.com/photo-1626779836952-511afad1c521?w=800&q=80',
                'items' => [
                    ['name' => 'Veg Fried Rice', 'price' => 99],
                    ['name' => 'Egg Fried Rice', 'price' => 119],
                    ['name' => 'Paneer Fried Rice', 'price' => 129],
                    ['name' => 'Veg Mixed Fried Rice', 'price' => 149],
                    ['name' => 'Schezwan Fried Rice', 'price' => 109],
                    ['name' => 'Egg Chicken Fried Rice', 'price' => 149],
                    ['name' => 'Mixed Fried Rice', 'price' => 179],
                    ['name' => 'Singapore Fried Rice', 'price' => 109],
                ]
            ],
            'Noodles (Kolkata Style)' => [
                'image' => 'https://images.unsplash.com/photo-1612929633738-8fe44f7ec841?w=800&q=80',
                'items' => [
                    ['name' => 'Veg Chowmein', 'price' => 89],
                    ['name' => 'Egg Chowmein', 'price' => 99],
                    ['name' => 'Paneer Chowmein', 'price' => 129],
                    ['name' => 'Egg Chicken Chowmein', 'price' => 159],
                    ['name' => 'Schezwan Chowmein', 'price' => 99],
                    ['name' => 'Singapore Chowmein', 'price' => 129],
                    ['name' => 'Chicken Chowmein', 'price' => 149],
                    ['name' => 'Mixed Chowmein', 'price' => 159],
                ]
            ],
            'Combo' => [
                'image' => 'https://images.unsplash.com/photo-1615557960916-5f4791effe9d?w=800&q=80',
                'items' => [
                    ['name' => 'Moglai Paratha + Chicken Kasa + Coke', 'price' => 250],
                    ['name' => 'Lachha Paratha + Chicken Kasa + Coke', 'price' => 200],
                    ['name' => 'Lachha Paratha + Mutton Kasa + Coke', 'price' => 260],
                    ['name' => 'Egg Fried Rice + Chilli Chicken + Coke', 'price' => 229],
                    ['name' => 'Veg Fried Rice + Chilli Paneer + Coke', 'price' => 175],
                    ['name' => 'Veg Fried Rice + Chilli Chicken + Coke', 'price' => 220],
                    ['name' => 'Veg Chowmein + Chilli Paneer + Coke', 'price' => 175],
                    ['name' => 'Egg Chowmein + Chilli Chicken + Coke', 'price' => 229],
                    ['name' => 'Veg Chowmein + Chilli Chicken + Coke', 'price' => 220],
                ]
            ],
            'Lunch' => [
                'image' => 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=800&q=80',
                'items' => [
                    ['name' => 'Rice + Egg Curry', 'price' => 149],
                    ['name' => 'Rice + Chicken Curry', 'price' => 199],
                    ['name' => 'Rice + Fish Curry', 'price' => 249],
                    ['name' => 'Rice + Mutton Curry', 'price' => 349],
                    ['name' => 'Veg Rice + Dal Fry + Mixed Veg', 'price' => 149],
                ]
            ],
            'Biryani' => [
                'image' => 'https://images.unsplash.com/photo-1631515243349-e0cb75fb8d3a?w=800&q=80',
                'items' => [
                    ['name' => 'Veg Biryani', 'price' => 199],
                    ['name' => 'Paneer Biryani', 'price' => 249],
                    ['name' => 'Egg Biryani', 'price' => 199],
                    ['name' => 'Chicken Biryani', 'price' => 299],
                    ['name' => 'Mutton Biryani', 'price' => 399],
                    ['name' => 'Special Chicken Biryani', 'price' => 399],
                    ['name' => 'Special Mutton Biryani', 'price' => 499],
                ]
            ],
            'Veg Starters' => [
                'image' => 'https://images.unsplash.com/photo-1606491956689-2ea866880c84?w=800&q=80',
                'items' => [
                    ['name' => 'Paneer Pakoda', 'price' => 249],
                    ['name' => 'Mushroom Pakoda', 'price' => 249],
                    ['name' => 'Paneer Chilli', 'price' => 249],
                    ['name' => 'Mushroom Chilli', 'price' => 249],
                    ['name' => 'Mushroom Paper Dry', 'price' => 249],
                    ['name' => 'Mushroom 65 Pakoda', 'price' => 249],
                    ['name' => 'Paneer 65 Pakoda', 'price' => 249],
                    ['name' => 'French Fries', 'price' => 120],
                    ['name' => 'Peanut Masala', 'price' => 120],
                    ['name' => 'Dry Chana', 'price' => 120],
                    ['name' => 'Masala Papad', 'price' => 99],
                ]
            ],
            'Rolls' => [
                'image' => 'https://images.unsplash.com/photo-1626804475297-4160adefaf35?w=800&q=80',
                'items' => [
                    ['name' => 'Veg Roll', 'price' => 80],
                    ['name' => 'Paneer Roll', 'price' => 90],
                    ['name' => 'Paneer Chilli Roll', 'price' => 130],
                    ['name' => 'Egg Roll', 'price' => 90],
                    ['name' => 'Egg Chicken Roll', 'price' => 130],
                    ['name' => 'Chicken Roll', 'price' => 120],
                    ['name' => 'Chilli Chicken Roll', 'price' => 150],
                    ['name' => 'Chicken 65 Roll', 'price' => 150],
                    ['name' => 'Chicken Crispy Roll', 'price' => 150],
                    ['name' => 'Mutton Keema Roll', 'price' => 150],
                    ['name' => 'Egg Mutton Roll', 'price' => 170],
                ]
            ],
            'Non-Veg Starters' => [
                'image' => 'https://images.unsplash.com/photo-1610057099443-fde8c4d50f91?w=800&q=80',
                'items' => [
                    ['name' => 'Chicken Popcorn', 'price' => 199],
                    ['name' => 'Fish Finger', 'price' => 300],
                    ['name' => 'Chicken Pakoda', 'price' => 229],
                    ['name' => 'Egg Pakoda', 'price' => 149],
                    ['name' => 'Egg Chilli', 'price' => 189],
                    ['name' => 'Chilli Chicken Dry', 'price' => 249],
                    ['name' => 'Chilli Chicken Gravy', 'price' => 249],
                    ['name' => 'Chicken 65', 'price' => 249],
                    ['name' => 'Chicken Leg Piece', 'price' => 399],
                    ['name' => 'Chicken Salt & Pepper', 'price' => 249],
                    ['name' => 'Crispy Chicken', 'price' => 249],
                    ['name' => 'Lemon Chicken', 'price' => 249],
                    ['name' => 'Prawn Pakoda', 'price' => 399],
                    ['name' => 'Prawn Chilli', 'price' => 399],
                    ['name' => 'Fish Fry', 'price' => 299],
                    ['name' => 'Fish Chilli', 'price' => 299],
                    ['name' => 'Pomfret Fish Fry', 'price' => 299],
                    ['name' => 'Chicken Lollipop', 'price' => 299],
                ]
            ]
        ];

        // Make sure the image directory exists
        Storage::disk('public')->makeDirectory('products');

        foreach ($categoriesData as $catName => $catDetails) {
            
            // Create or get category
            $category = Category::firstOrCreate([
                'name' => $catName,
                'slug' => Str::slug($catName)
            ]);

            // Save the category image directly to local storage so that all products in this category can use it.
            $filename = 'products/' . Str::slug($catName) . '.jpg';
            
            // Only try downloading if it doesn't exist
            if (!Storage::disk('public')->exists($filename)) {
                try {
                    // Try to download using Http Facade to handle redirects properly
                    $response = Http::timeout(15)->get($catDetails['image']);
                    if ($response->successful()) {
                        Storage::disk('public')->put($filename, $response->body());
                    } else {
                        throw new \Exception('Failed to download');
                    }
                } catch (\Exception $e) {
                    // Fallback to storing the raw URL if downloading fails
                    $filename = $catDetails['image'];
                }
            }

            // Add products
            foreach ($catDetails['items'] as $item) {
                Product::updateOrCreate([
                    'name' => $item['name']
                ],[
                    'category_id' => $category->id,
                    'price' => $item['price'],
                    'description' => 'Delicious ' . $item['name'] . ' served with special spices and love.',
                    'image' => $filename,
                    'is_available' => true
                ]);
            }
        }
    }
}
