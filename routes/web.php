<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CheckoutController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', [HomeController::class, 'about']);

Route::get('/blog', [HomeController::class, 'blog']);

Route::get('/cart', [HomeController::class, 'cart']);

Route::get('/checkout', [HomeController::class, 'checkout']);

Route::get('/contact', [HomeController::class, 'contact']);

Route::get('/services', [HomeController::class, 'services']);


Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');


Route::get('/products/{id}-{name}', [ProductController::class, 'show'])->name('products.show');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');



Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{key}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');



Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success']) ->name('checkout.success');



Route::get('/thankyou', [HomeController::class, 'thankyou']);

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'handleRegister'])->name('register.post');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin']);

// LOGOUT
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');