<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class HomeController extends Controller
{
    

public function index()
{
    $products = Product::with('variants')
    ->inRandomOrder()
    ->take(3)
    ->get();

    return view('home', compact('products'));
}



public function about() {
    return view('about');
}

public function blog() {
    return view('blog');
}

public function contact() {
    return view('contact');
}

public function cart() {
    return view('cart');
}

public function checkout() {
    return view('checkout');
}

public function services() {
    return view('services');
}

public function shop() {
    return view('shop');
}


public function thankyou() {
    return view('thankyou');
}



}
