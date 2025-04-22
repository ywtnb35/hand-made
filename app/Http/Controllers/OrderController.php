<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    //注文処理
    public function store(Request $request)
    {
        $request->validate([  //フォームから送られたデータのバリデーション
            'name' => 'required',  
            'email' => 'required|email',
            'address' => 'required',
        ]);

        $total = session('cart_total') ?? 0;  //セッションから合計金額を取得(なければ0)

        //Orderモデルをつかって ordersテーブルに注文データを登録
        $order = Order::create([
            'name' => $request->name,   //フォームからの名前
            'email' => $request->email,  //メール
            'address' => $request->address,  //住所
            'total_price' => $total,  //セッションに入っていた合計金額
        ]);

        //セッションからカート情報を取り出して、注文商品の明細を登録
        foreach(session('cart', []) as $productId => $item) {
            $order->items()->create([       //items()はOrderモデルのリレーションを通じてOrderItemを作成
                'product_id' => $productId,  //商品ID
                'quantity' => $item['quantity'],  //数量
                'price' => $item['price'],  //単価
            ]);
        }

        //カート情報と合計金額をセッションから削除
        session()->forget(['cart','cart_total']);

        //注文完了ページへリダイレクト
        return redirect()->route('order.complete');
    }

    //注文フォームを表示する処理
    public function form()
    {
        return view('order.form'); 
    }

}
