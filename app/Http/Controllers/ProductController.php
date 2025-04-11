<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //商品一覧を表示する関数
    public function index()
    {
        //データベースからすべての商品を取得
        $products = Product::all();

        //取得した商品をビューに渡して表示
        return view('index',compact('products'));
    }

    //商品詳細を表示する
    public function show($id)
    {
        //指定されたIDの商品をデータベースから探す
        $product = Product::findOrFail($id);

        //見つかった商品を'prosuct-detail'ビューに渡す
        return view('product-detail',compact('product'));
    }

    public function category($category)
    {
        $products = Product::where('category',$category)->get();
        return view('index', [
            'products' => $products,
            'category' => $category,
        ]);
    }
}
