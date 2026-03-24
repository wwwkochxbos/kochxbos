<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::active()->orderBy('sort_order')->paginate(24);
        return view('shop.index', compact('products'));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('shop.show', compact('product'));
    }
}
