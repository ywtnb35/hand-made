<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // カートに商品を追加する処理
    public function add(Request $request)
    {        
        $productId = $request->input('product_id');       // フォームから送られた商品IDを取得
        $quantity = $request->input('quantity', 1);       // 数量を取得（初期値は1）

        $product = Product::findOrFail($productId);       // 指定された商品が存在するか確認（なければ404）

        $cart = session()->get('cart', []);               // 現在のカート情報をセッションから取得（なければ空配列）

        if (isset($cart[$productId])) {
            // すでに商品がカートにある → 数量を加算
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // 商品がカートにない → 新しく項目を追加
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


    //カートの中身を表示する処理
    public function show()
    {
        //セッションに保存されているカート情報を取得(なければ空の配列)
        $cart = session()->get('cart',[]);

        //合計金額(小計)を算出:各商品の価格:数量を合計
        $subtotal = collect($cart)->reduce(function ($sum,$item) {
            return $sum + ($item['price'] * $item['quantity']);
        },0);

        //cart.blade.phpに商品一覧と合計金額のデータを渡す
        return view('cart',['products' => $cart,'subtotal' => $subtotal]);
    }


    //商品の数量を増減する処理
    public function update(Request $request)
    {
        $productId = $request->input('product_id');  //どの商品を変更するかを取得
        $action = $request->input('action');  //'increase' or 'decrease'

        $cart = session()->get('cart',[]);  //現在のカートを取得。空なら[]

        //指定商品がカート内にある場合
        if(isset($cart[$productId])) {
            if($action === 'increase') {  //数量を1つ増やす
                $cart[$productId]['quantity']++;
            } elseif ($action === 'decrease' && $cart[$productId]['quantity'] > 1) {  //数量を1つ減らす(1未満にはしない)
                $cart[$productId]['quantity']--;
            }
        }

        session(['cart' => $cart]);  //セッションに保存

        return redirect()->route('cart.show')->with('success','数量を変更しました。');
    }

   
    //カートから商品を削除
    public function remove(Request $request)
    {
        $productId = $request->input('product_id'); //削除対象の商品IDを取得
        $cart = session()->get('cart',[]); //現在のカートを取得

        //カート内にその商品が存在していれば削除
        if(isset($cart[$productId])) {
            unset($cart[$productId]);   //該当商品を配列から削除
            session(['cart' => $cart]);  //カートをセッションに再保存
        }

        return redirect()->route('cart.show')->with('success','商品をカートから削除しました。');
    }
}
