<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  //ログイン中のユーザー情報取得に使用


class OrderHistoryController extends Controller
{
    public function index()
    {
        //ログイン中ユーザーに紐づく注文データを取得
        //'orderItems.product'は各注文の中の詳細も一緒に取得
        //latest()は新しい注文から順に並べる
        $orders = Auth::user()->orders()->with('orderItems.product')->latest()->get();

        //取得した注文データをビューに渡す
        return view('order.history',compact('orders'));
    }
}
