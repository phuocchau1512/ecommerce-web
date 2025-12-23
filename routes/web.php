<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', [HomeController::class, 'about']);

Route::get('/blog', [HomeController::class, 'blog']);

Route::get('/cart', [HomeController::class, 'cart']);

Route::get('/checkout', [HomeController::class, 'checkout']);

Route::get('/contact', [HomeController::class, 'contact']);

Route::get('/services', [HomeController::class, 'services']);

Route::get('/shop', [HomeController::class, 'shop']);

Route::get('/thankyou', [HomeController::class, 'thankyou']);

Route::get('/register', [HomeController::class, 'register']);