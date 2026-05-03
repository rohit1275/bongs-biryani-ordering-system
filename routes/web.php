<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MenuController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\Frontend\TrackingController;
use App\Http\Controllers\Frontend\RazorpayController;

use App\Http\Controllers\Frontend\OrderModeController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/order-mode', [OrderModeController::class, 'index'])->name('order-mode');
Route::post('/order-mode', [OrderModeController::class, 'select'])->name('order-mode.select');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/track', [TrackingController::class, 'index'])->name('track');
Route::get('/track/{id}', [TrackingController::class, 'show'])->name('track.show');
Route::get('/order-status/{id}', [TrackingController::class, 'status'])->name('orders.status');
Route::get('/location', [HomeController::class, 'location'])->name('location');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/api/cart', [CartController::class, 'getItems']);
Route::post('/api/cart/sync', [CartController::class, 'sync']);
Route::post('/api/cart/add', [CartController::class, 'add']);
Route::post('/api/cart/update', [CartController::class, 'update']);
Route::post('/api/cart/remove', [CartController::class, 'remove']);

// Checkout & User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/coupon', [CheckoutController::class, 'applyCoupon']);
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    
    Route::get('/orders', [FrontendOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [FrontendOrderController::class, 'show'])->name('orders.show');
    Route::get('/api/orders/active-tracking', [FrontendOrderController::class, 'activeTracking'])->name('orders.active-tracking');
    Route::get('/api/orders/delivered-pending-rating', [FrontendOrderController::class, 'deliveredPendingRating'])->name('orders.delivered-pending-rating');
    Route::post('/orders/{order}/rating', [FrontendOrderController::class, 'submitRating'])->name('orders.rating');

    Route::post('/razorpay/create-order', [RazorpayController::class, 'createRazorpayOrder']);
    Route::post('/razorpay/verify', [RazorpayController::class, 'verifyPayment']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('coupons', CouponController::class);
    Route::get('orders/export', [AdminOrderController::class, 'export'])->name('orders.export');
    Route::get('orders/{order}/slip', [AdminOrderController::class, 'slip'])->name('orders.slip');
    Route::resource('orders', AdminOrderController::class);
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('users/{user}/toggle-block', [UserController::class, 'toggleBlock'])->name('users.toggle-block');
});

require __DIR__.'/auth.php';
