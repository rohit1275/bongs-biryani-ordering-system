<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Admin
        User::firstOrCreate(['email' => 'admin@bongs.com'], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // User
        User::firstOrCreate(['email' => 'user@example.com'], [
            'name' => 'John Doe',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $biryaniCat = Category::firstOrCreate(['slug' => 'biryani'], ['name' => 'Biryani']);
        $rollsCat = Category::firstOrCreate(['slug' => 'rolls'], ['name' => 'Rolls']);
        $startersCat = Category::firstOrCreate(['slug' => 'starters'], ['name' => 'Starters']);
        
        $products = [
            [
                'category_id' => $biryaniCat->id,
                'name' => 'Chicken Biryani',
                'description' => 'Aromatic basmati rice cooked with tender chicken and authentic spices.',
                'price' => 250,
                'is_available' => true,
            ],
            [
                'category_id' => $biryaniCat->id,
                'name' => 'Mutton Biryani',
                'description' => 'Rich and flavorful mutton biryani with Kolkata style potato.',
                'price' => 350,
                'is_available' => true,
            ],
            [
                'category_id' => $rollsCat->id,
                'name' => 'Double Egg Chicken Roll',
                'description' => 'Classic street style roll packed with juicy chicken and double egg.',
                'price' => 120,
                'is_available' => true,
            ],
            [
                'category_id' => $startersCat->id,
                'name' => 'Chilli Chicken',
                'description' => 'Crispy boneless chicken tossed in spicy soya sauce.',
                'price' => 200,
                'is_available' => true,
            ],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(['name' => $p['name']], $p);
        }
    }
}
