<?php 

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function show($id, $name)
    {
        $product = Product::with('variants')->findOrFail($id);

        // nếu tên trên URL sai → redirect về đúng tên
        if (Str::slug($product->name) !== $name) {
            return redirect()->route('products.show', [
                'id' => $product->id,
                'name' => Str::slug($product->name)
            ]);
        }

        $product = Product::with(['variants', 'reviews.user'])->findOrFail($id);
        $products = Product::with('variants')->get();


        return view('details', compact('product'));
    }
}
