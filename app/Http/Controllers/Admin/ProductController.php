<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //一覧表示(管理画面用)
    public function index()
    {
        $products = Product::all();  //すべての商品を取得
        return view('admin.products.index',compact('products'));  //ビューにデータを渡して表示
    }


    //新規商品作成フォームの表示
    public function create()
    {
        return view('admin.products.create');
    }


    //商品の保存
    public function store(Request $request)
    {
        //入力値のバリデーション（画像は複数対応)
        $request->validate([
            'name' => 'required|string|max:255', //商品名:必須&文字制限
            'price' => 'required|numeric',  //価格:必須＆数値
            'category' => 'required',   //カテゴリ:必須
            'images.*'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',  //画像:形式とサイズ制限
        ]);

        //保存処理 まずは商品本体情報だけ保存。画像はまだ。
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'image' => null,
        ]);

        //画像がアップロードされていれば処理を実行
        if($request->hasFile('images')){
            foreach($request->file('images') as $index => $imageFile){   //アップロードされた画像を一枚ずつ処理
                //保存用のファイル名を自動生成
                $filename = uniqid() . '.' . $imageFile->getClientOriginalExtension();

                $savePath = $imageFile->storeAs('products', $filename, 'public');  //storage/public/productsに画像保存

                $product->images()->create([   //画像をproduct_imagesテーブルに保存
                    'filename' => 'products/' . $filename,
                ]);

                if($index === 0) {   //最初の１枚を代表画像としてproductsテーブルに設定
                    $product->update(['image' => 'products/' . $filename,]);
                }
            }
        }

        //一覧にリダイレクト
        return redirect()->route('admin.products.index')->with('success','商品を登録しました。');

    }

    //商品削除
    public function destroy($id)
    {
        $product = Product::findOrFail($id);  //対象商品取得
        $product->delete();  //削除

        return redirect()->route('admin.products.index')->with('success','商品を削除しました。');
    }

    //編集画面表示
    public function edit($id)
    {
        $product = Product::findOrFail($id);  //編集対象を取得
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

        //商品を取得して更新
        $product = Product::findOrFail($id);
        $product->update($request->only(['name','price','image','category']));

        return redirect()->route('admin.products.index')->with('success','商品を更新しました。');
    }
}
