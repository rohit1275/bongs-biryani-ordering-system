<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Eager load all categories with their available products
        // Ordered by latest for fresh data
        $categories = Category::with(['products' => function($query) {
            $query->where('is_available', true)->latest();
        }])->get();

        // Pass simple boolean to indicate if any products exist globally
        $hasProducts = $categories->pluck('products')->flatten()->isNotEmpty();

        return view('pages.menu', compact('categories', 'hasProducts'));
    }
}
