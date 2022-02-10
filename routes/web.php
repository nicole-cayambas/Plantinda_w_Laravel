<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardProductsController;

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist')->middleware('auth');
Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware('auth');
Route::get('/orders', [PagesController::class, 'orders'])->name('orders')->middleware('auth');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('updateProfile')->middleware('auth');
Route::get('/profile/edit/address', [ProfileController::class, 'editAddress'])->name('editAddress')->middleware('auth');
Route::post('/profile/edit/address', [ProfileController::class, 'updateAddress'])->name('updateAddress')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::post('/sendOrder/{id}', [SendOrderController::class, 'store'])->name('sendOrder')->middleware('auth');
Route::get('/cart/product/{id}', [CartController::class, 'destroy'])->name('deleteCartItem')->middleware('auth');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkoutPage')->middleware('auth');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout')->middleware('auth');


Route::get('/search', [ProductsController::class, 'search'])->name('search');
Route::get('/products/{id}', [ProductsController::class, 'show'])->name('showProduct');
Route::get('/filter', [ProductsController::class, 'applyFilter'])->name('applyFilter');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/dashboard/orders', [DashboardController::class, 'orders'])->name('dashboard.orders')->middleware('auth');
Route::get('/dashboard/earnings', [DashboardController::class, 'earnings'])->name('dashboard.earnings')->middleware('auth');
Route::get('/dashboard/products', [DashboardProductsController::class, 'index'])->name('dashboard.products')->middleware('auth');
Route::get('/dashboard/store', [DashboardController::class, 'store'])->name('dashboard.store')->middleware('auth');

Route::delete('/dashboard/products/{product}', [DashboardProductsController::class, 'destroy'])->name('deleteProduct');