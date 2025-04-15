<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //商品一覧を表示する関数
    public function index(Request $request)
    {
        //クエリパラメータからカテゴリを取得
        $category = $request->input('category');

        //カテゴリが指定されていればフィルタ、なければ全件
        if($category) {
            $products = Product::where('category',$category)->get();
        } else {
            $products = Product::all();
        }

        //全カテゴリー一覧もビューに渡す（セレクトボックス用）
        $categories = Product::select('category')->distinct()->get();

        return view('index' ,[
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $category,
        ]);

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
        $categories = Product::select('category')->distinct()->get();
        
        return view('index', [
            'products' => $products,
            'category' => $category,
            'selectedCategory' => $category,
            'categories' => $categories,
        ]);
    }
}
