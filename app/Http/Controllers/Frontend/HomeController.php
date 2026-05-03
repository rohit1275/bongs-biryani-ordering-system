<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        // Assuming "featured" relies on some rule, we'll just take random available
        $featuredProducts = Product::with('category')->where('is_available', true)->inRandomOrder()->take(8)->get();
        
        $newLaunches = Product::with('category')->where('is_available', true)->latest()->take(4)->get();

        return view('pages.home', compact('categories', 'featuredProducts', 'newLaunches'));
    }

    public function track()
    {
        return view('pages.track');
    }

    public function location()
    {
        return view('pages.location');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        return redirect()->route('contact')->with('success', 'Message sent successfully ✅');
    }
}
