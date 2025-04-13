<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //一覧表示
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }

    //作成画面の表示
    public function create()
    {
        return view('admin.products.create');
    }

    //商品の保存
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image'=> 'required|string',
            'category' => 'required',
        ]);

        //保存処理
        Product::create($request->only(['name', 'price', 'image', 'category']));

        //一覧にリダイレクト
        return redirect()->route('admin.products.index')->with('success','商品を登録しました。');

    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success','商品を削除しました。');
    }

    //編集画面表示
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit',compact('product'));
    }

    //編集の保存
    public function update(Request $request, $id)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'image' => 'required|string',
        'category' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name','price','image','category']));

        return redirect()->route('admin.products.index')->with('success','商品を更新しました。');
    }
}
