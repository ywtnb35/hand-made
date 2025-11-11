<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    //注文フォームを表示する処理
    public function form()
    {
        $cart = session('cart',[]);
        
        //カートが空なら商品一覧へリダイレクト
        if (empty($cart)) {
            return redirect()->route('products.index')->with('warning' , 'カートに商品がありません。');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        session(['cart_total' => $total]);

        return view('order.form'); 
    }

    //注文確認画面を表示するメソッド(フォームを送信した後)
    public function confirm(Request $request)
    {
        $cart = session('cart',[]);

        if (empty($cart)) {
            return redirect()->route('order.form')->with('warning','カートに商品がありません。');
        }

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

        if (!$input || empty($cart)) {
            return redirect()->route('order.form')->with('error','カートが空です。');
        }

        //ここで在庫チェック
        foreach ($cart as $productId => $item) {
            $product = \App\Models\Product::find($productId);

            if (!$product || $product->stock < $item['quantity']) {
            return redirect()->route('order.form')->with('error', "{$product->name} の在庫が足りません。");
        }
        }
        //注文情報をorders テーブルに登録
        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null, //ログインしていればユーザーIDを保存
            'order_number' => strtoupper(uniqid('ORD-')),
            'name' => $input['name'],   //フォームからの名前
            'email' => $input['email'],  //メール
            'zipcode' => $input['zipcode'],
            'address' => $input['address'],  //住所
            'address_detail' => $input['address_detail'],
            'total_price' => $total,  //セッションに入っていた合計金額
            'status' => '未発送',
        ]);


        //セッションからカート情報を取り出して、注文商品の明細を登録
        foreach ($cart as $productId => $item) {
            $product = \App\Models\Product::find($productId);

            $product->decrement('stock' ,$item['quantity']);

            $order->items()->create([       //items()はOrderモデルのリレーションを通じてOrderItemを作成
                'product_id' => $productId,  //商品ID
                'quantity' => $item['quantity'],  //数量
                'price' => $item['price'],  //単価
            ]);
        }

        //カート情報と合計金額をセッションから削除
        session()->forget(['cart','cart_total','order_input']);

        //注文完了ページへリダイレクト
        return redirect()->route('order.complete',['order_id' => $order->id]);
    }

    //入力内容修正のリンク
    public function backToForm()
    {
        //セッションに保存していた入力内容をold()に復元する
        if(session()-> has('order_input')) {
            session()->flashInput(session('order_input'));
        }
        return redirect()->route('order.form');
    }

    //注文完了ページ
    public function complete($order_id)
    {
        return view('order.complete',[
            'order' => $order,
        ]);
    }



    //注文キャンセル
    public function cancel($id)
    {
        //該当の注文をIDから取得(存在しない場合は404エラー)
        $order = Order::findOrFail($id);

        //ログイン中のユーザーとこの注文を作成したユーザーが一致するか確認
        if(Auth::id() !== $order->user_id){
            abort(403,'この注文をキャンセルする権限がありません');
        }

        //すでに処理が進んだ注文（発送済み)はキャンセルできない
        //pending（未処理）状態以外はキャンセル不可
        if($order->status !== 'pending'){
            return redirect()->route('orders.history')->with('error','この注文はキャンセルできません。');
        }

        //キャンセル処理の実行
        //ステータスを'cancelled'に変更して保存
        $order->status = 'cancelled';
        $order->save();

        //キャンセル後は注文履歴ページにリダイレクト
        return redirect()->route('orders.history')->with('success','注文をキャンセルしました。');
    }

}
