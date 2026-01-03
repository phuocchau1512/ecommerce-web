<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
   public function index(Request $request)
    {
        $query = Product::query();

        /* ===== SEARCH ===== */
        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('origin', 'like', '%' . $keyword . '%');
            });
        }

        /* ===== FILTER CATEGORY ===== */
        if ($request->filled('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        /* ===== FILTER PRICE (variants) ===== */
        if ($request->filled('prices')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where(function ($qq) use ($request) {
                    foreach ($request->prices as $price) {
                        if (str_contains($price, '+')) {
                            $min = (int) str_replace('+', '', $price);
                            $qq->orWhere('price', '>=', $min);
                        } else {
                            [$min, $max] = explode('-', $price);
                            $qq->orWhereBetween('price', [(int)$min, (int)$max]);
                        }
                    }
                });
            });
        }

        /* ===== FILTER ORIGIN ===== */
        if ($request->filled('origins')) {
            $query->whereIn('origin', $request->origins);
        }

        /* ===== SORT ===== */
        $products = $query
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('shop', compact('products'));
    }


    public function details()
    {
        return view('details');
    }
}
