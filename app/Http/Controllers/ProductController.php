<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('mainImage')->where('is_active', true)->get();
        return view('products.index', compact('products'));
    }

    // 追加：詳細表示
    public function show(Product $product)
    {
        // 画像を一緒にロード（必要なら）
        $product->load('mainImage');

        return view('products.show', compact('product'));
    }
}