<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthManualController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', [HomeController::class, "index"])->name("home");

Route::get('/about', [AboutController::class, "index"])->name("about");

Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/{id_products}', [ProductController::class, 'show'])->name('product.detail');


Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update_all', [CartController::class, 'updateAll'])->name('cart.update_all');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/contact', [ContactController::class, "index"])->name("contact");

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout'); // Checkout page
Route::post('/checkout/confirm', [CheckoutController::class, 'confirmOrder'])->name('order.confirm'); // Confirm order page

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
});

Route::get('/login', [AuthManualController::class, 'index'])->name('login');
Route::post('/login', [AuthManualController::class, 'loginProses'])->name('loginProses');
Route::post('/logout', [AuthManualController::class, 'logout'])->name('logout');
