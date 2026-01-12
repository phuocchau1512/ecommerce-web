<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    // =============================
    // PRODUCT LIST
    // =============================
    public function index(Request $request)
    {
        $products = Product::with('category')          // load category (động, không gắn cứng)
        ->withCount('variants')                    // đếm số biến thể
        ->when($request->search, function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
            ->orWhereHas('category', function ($qc) use ($request) {
                $qc->where('name', 'like', '%' . $request->search . '%');
            });
        })
        ->latest()
        ->paginate(10);

        
    $categories = Category::with('children')
        ->whereNull('parent_id')
        ->get();
    return view('admin.products', compact('products', 'categories'));

    }

    // =============================
    // ADD PRODUCT
    // =============================


    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|min:3',
            'category_id'    => 'required',

            // product image
            'product_image'  => 'nullable|image|max:2048',

            // variant đầu tiên
            'variant_name'   => 'required|min:2',
            'price'          => 'required|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'variant_image'  => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            /* =====================
            1. CREATE PRODUCT
            ===================== */
            $productData = [
                'category_id' => $request->category_id,
                'name'        => $request->name,
                'material'    => $request->material,
                'size'        => $request->size,
                'color'       => $request->color,
                'origin'      => $request->origin,
                'description' => $request->description,
            ];

            // ✅ lưu ảnh product
            if ($request->hasFile('product_image')) {
                $productData['image'] =
                    $request->file('product_image')->store('products', 'public');
            }

            $product = Product::create($productData);

            /* =====================
            2. CREATE FIRST VARIANT
            ===================== */
            $variantData = [
                'product_id'   => $product->id,
                'variant_name' => $request->variant_name,
                'price'        => $request->price,
                'stock'        => $request->stock,
            ];

            // ✅ lưu ảnh variant
            if ($request->hasFile('variant_image')) {
                $variantData['image'] =
                    $request->file('variant_image')->store('variants', 'public');
            }

            ProductVariant::create($variantData);

            DB::commit();

            return redirect()
                ->route('admin.adproducts.index')
                ->with('success', 'Đã thêm sản phẩm + loại sản phẩm');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }



    // =============================
    // UPDATE PRODUCT
    // =============================
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|min:3',
        ]);

        $product->update($request->only([
            'category_id',
            'name',
            'material',
            'size',
            'color',
            'origin',
            'description',
        ]));

        return redirect()
            ->route('admin.adproducts.index')
            ->with('success', 'Cập nhật sản phẩm thành công');
    }
   
    public function storeVariant(Request $request, $productId)
    {
        $request->validate([
            'variant_name' => 'required|min:2',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'image'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['variant_name', 'price', 'stock']);
        $data['product_id'] = $productId;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('variants', 'public');
        }

        ProductVariant::create($data);

        return redirect()
            ->route('admin.adproducts.variants', $productId)
            ->with('success', 'Đã thêm loại sản phẩm');
    }

    public function updateVariant(Request $request, $id)
    {
        $variant = ProductVariant::findOrFail($id);

        $request->validate([
            'variant_name' => 'required|min:2',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'image'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['variant_name', 'price', 'stock']);

        if ($request->hasFile('image')) {
            if ($variant->image) {
                Storage::disk('public')->delete($variant->image);
            }
            $data['image'] = $request->file('image')->store('variants', 'public');
        }

        $variant->update($data);

        return redirect()
            ->route('admin.adproducts.variants', $variant->product_id)
            ->with('success', 'Đã cập nhật loại sản phẩm');
    }

    public function destroyVariant($id)
    {
        $variant = ProductVariant::findOrFail($id);

        if ($variant->image) {
            Storage::disk('public')->delete($variant->image);
        }

        $productId = $variant->product_id;
        $variant->delete();

        return redirect()
            ->route('admin.adproducts.variants', $productId)
            ->with('success', 'Đã xóa loại sản phẩm');
    }

    // =============================
    // DELETE PRODUCT
    // =============================
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()
            ->route('admin.adproducts.index')
            ->with('success', 'Đã xóa sản phẩm');
    }

    // =============================
    // VARIANTS PAGE
    // =============================
    public function variants($id)
    {
        $product = Product::with('variants')->findOrFail($id);
        return view('admin.variants', compact('product'));
    }
}
