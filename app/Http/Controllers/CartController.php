<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // セッションキー
    private const KEY = 'cart.items';

    /** 一覧 */
    public function index(Request $request)
    {
        $cart = (array) $request->session()->get(self::KEY, []);

        // 商品情報をまとめて取得
        $products = Product::whereIn('id', array_keys($cart))->with('mainImage')->get()->keyBy('id');

        $lines = [];
        $total = 0;

        foreach ($cart as $productId => $qty) {
            if (!isset($products[$productId])) continue;
            $p = $products[$productId];

            $lineTotal = $p->price * $qty;
            $total += $lineTotal;

            $lines[] = [
                'id'       => $p->id,
                'name'     => $p->name,
                'price'    => $p->price,
                'qty'      => $qty,
                'lineTotal'=> $lineTotal,
                'image'    => optional($p->mainImage)->path,
            ];
        }

        return view('cart.index', [
            'lines' => $lines,
            'total' => $total,
        ]);
    }

    /** 追加 */
    public function add(Product $product, Request $request)
    {
        $qty  = max(1, (int) $request->input('qty', 1)); // 1以上
        $cart = (array) $request->session()->get(self::KEY, []);
        $pid  = (string) $product->id;

        $cart[$pid] = (int) (($cart[$pid] ?? 0) + $qty);

        $request->session()->put(self::KEY, $cart);

        return back()->with('status', 'カートに追加しました！');
    }

    /** 更新（数量） */
    public function update(Product $product, Request $request)
    {
        $qty  = max(0, (int) $request->input('qty', 0));
        $cart = (array) $request->session()->get(self::KEY, []);
        $pid  = (string) $product->id;

        if ($qty <= 0) {
            unset($cart[$pid]);
        } else {
            $cart[$pid] = $qty;
        }

        $request->session()->put(self::KEY, $cart);

        return redirect()->route('cart.index')->with('status', '数量を更新しました！');
    }

    /** 削除 */
    public function remove(Product $product, Request $request)
    {
        $cart = (array) $request->session()->get(self::KEY, []);

    // 両方のキー型（string / int）を潰す
    $pidStr = (string) $product->id;
    $pidInt = (int) $product->id;

    if (array_key_exists($pidStr, $cart)) {
        unset($cart[$pidStr]);
    }
    if (array_key_exists($pidInt, $cart)) {
        unset($cart[$pidInt]);
    }

    $request->session()->put(self::KEY, $cart);

    return redirect()->route('cart.index')->with('status', '削除しました。');
    }
}