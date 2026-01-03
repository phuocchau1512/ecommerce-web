<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $variant = ProductVariant::findOrFail($request->variant_id);
        $qty = (int) $request->quantity;

       
        if ($variant->stock <= 0) {
            return back()->with('error', 'Sản phẩm đã hết hàng');
        }

       
        if ($qty > $variant->stock) {
            return back()->with('error', 'Số lượng vượt quá tồn kho');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:product_variants,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $variant = ProductVariant::with('product')->findOrFail($request->variant_id);

        $cart = session()->get('cart', []);

        $key = $variant->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->quantity;
        } else {
            $cart[$key] = [
                'product_id' => $variant->product->id,
                'name'       => $variant->product->name,
                'variant'    => $variant->variant_name,
                'price'      => $variant->price,
                'quantity'   => $request->quantity,
                'image'      => $variant->image ?? $variant->product->image
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function remove($key)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }


    public function index()
    {
        $cart = session('cart', []);
        return view('cart', compact('cart'));
    }
}
