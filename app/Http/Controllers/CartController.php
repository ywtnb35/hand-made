<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // カートに商品を追加する処理
    public function add(Request $request)
    {        
        $productId = $request->input('product_id');       // 商品IDを取得
        $quantity = $request->input('quantity', 1);       // 数量（なければ1）

        $product = Product::findOrFail($productId);       // 商品をDBから取得（なければ404）

        $cart = session()->get('cart', []);               // 現在のカートを取得（なければ空配列）

        if (isset($cart[$productId])) {
            // すでに商品がカートにある → 数量だけ加算
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // 商品がカートにない → 新しく追加
            $cart[$productId] = [
                'id' => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image,
                'quantity' => $quantity,
            ];
        }

        session(['cart' => $cart]); // カートをセッションに保存

        return redirect()->route('cart.show')->with('success', 'カートに追加しました');
    }

    public function show()
    {
        //セッションに保存されているカート情報を取得(なければ空の配列)
        $cart = session()->get('cart',[]);

        $subtotal = collect($cart)->reduce(function ($sum,$item) {
            return $sum + ($item['price'] * $item['quantity']);
        },0);

        //cart.blade.phpにカートのデータを渡す
        return view('cart',['products' => $cart,'subtotal' => $subtotal]);
    }

    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $action = $request->input('action');

        $cart = session()->get('cart',[]);

        if(isset($cart[$productId])) {
            if($action === 'increase') {
                $cart[$productId]['quantity']++;
            } elseif ($action === 'decrease' && $cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            }
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.show')->with('success','数量を変更しました。');
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session()->get('cart',[]);

        if(isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.show')->with('success','商品をカートから削除しました。');
    }
}
