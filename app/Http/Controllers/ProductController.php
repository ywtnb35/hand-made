<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    //商品一覧を表示する関数
    public function index(Request $request)
    {
        //クエリパラメータ(URLについてる?category=〇〇)からカテゴリを取得
        $category = $request->input('category');

        //商品一覧を取得
        if($category) {
            $products = Product::where('category',$category)->get();  //productsテーブルから[category]が指定値と一致する商品を取得
        } else {  
            $products = Product::all();  //カテゴリが未指定なら、productsテーブルからすべての商品を取得
        }

        //商品一覧に含まれるすべてのカテゴリ名を取得（セレクトボックス表示用）
        //→productsテーブルの[category]カラムから重複を除いて取得
        $categories = Product::select('category')->distinct()->get();

        return view('index' ,[            //index.blade.phpにデータを渡して表示
            'products' => $products,      //-products:表示する商品一覧
            'categories' => $categories,  //-categories:カテゴリ一覧
            'selectedCategory' => $category, //-selectedCategory:現在選択中のカテゴリ名
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

}
