<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    //注文一覧を表示
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at','desc')->get(); //ユーザー情報も含めて取得

        return view('admin.orders.index',compact('orders'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit',compact('order'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success','ステータスを更新しました。');
    }

}
