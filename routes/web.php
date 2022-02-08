<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/wishlist', [PagesController::class, 'wishlist'])->name('wishlist')->middleware('auth');
Route::get('/cart', [PagesController::class, 'cart'])->name('cart')->middleware('auth');
Route::get('/orders', [PagesController::class, 'orders'])->name('orders')->middleware('auth');
Route::get('/profile', [PagesController::class, 'orders'])->name('profile')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/products', [ProductsController::class, 'index'])->name('products');
// Route::get('/products/show', [ProductsController::class, 'show'])->name('showProduct');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');