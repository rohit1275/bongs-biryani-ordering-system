<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $totalOrdersToday = Order::whereDate('created_at', $today)->count();
        $totalRevenueToday = Order::whereDate('created_at', $today)
                                  ->where('status', '!=', 'pending')
                                  ->sum('total_amount');
        
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'delivered')->count();

        $deliveryOrders = Order::where('order_type', 'delivery')->count();
        $takeawayOrders = Order::where('order_type', 'takeaway')->count();
        $dineInOrders = Order::where('order_type', 'dine_in')->count();

        $totalUsers = User::where('role', 'user')->count();
        
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        
        $topProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard.index', compact(
            'totalOrdersToday', 'totalRevenueToday', 'pendingOrders', 'completedOrders',
            'deliveryOrders', 'takeawayOrders', 'dineInOrders', 'totalUsers',
            'recentOrders', 'topProducts'
        ));
    }
}
