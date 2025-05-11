<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    //注文フォームを表示する処理
    public function form()
    {
        $cart = session('cart',[]);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        session(['cart_total' => $total]);

        return view('order.form'); 
    }

    //注文確認画面を表示するメソッド
    public function confirm(Request $request)
    {
        //バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'zipcode' => 'required|digits:7',
            'address' => 'required|string',
            'address_detail' => 'required|string',
        ]);

        //バリデーション済みのデータをセッションに一時保存
        session(['order_input' => $validated]);

        //確認画面を表示
        return view('order.confirm');
    }


    //注文確定してデータベースに保存するメソッド

    public function store(Request $request)
    {
        //セッションから注文者情報・カート・合計金額を取得
            $input = session('order_input'); 
            $cart = session('cart',[]);
            $total = session('cart_total',0);

        if (!$input) {
            return redirect()->route('order.form')->with('error','もう一度、ご注文の確認を行ってください。');
        }

        //注文情報をorders テーブルに登録
        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null, //ログインしていればユーザーIDを保存
            'name' => $input['name'],   //フォームからの名前
            'email' => $input['email'],  //メール
            'zipcode' => $input['zipcode'],
            'address' => $input['address'],  //住所
            'address_detail' => $input['address_detail'],
            'total_price' => $total,  //セッションに入っていた合計金額
        ]);


        //セッションからカート情報を取り出して、注文商品の明細を登録
        foreach ($cart as $productId => $item) {
            $order->items()->create([       //items()はOrderモデルのリレーションを通じてOrderItemを作成
                'product_id' => $productId,  //商品ID
                'quantity' => $item['quantity'],  //数量
                'price' => $item['price'],  //単価
            ]);
        }

        //カート情報と合計金額をセッションから削除
        session()->forget(['cart','cart_total','order_input']);

        //注文完了ページへリダイレクト
        return redirect()->route('order.complete');
    }
}
