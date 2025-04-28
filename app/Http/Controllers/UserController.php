<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //マイページ表示処理
    public function mypage()
    {
        //マイページ表示処理
        $user = Auth::user();  

        //ユーザーのお気に入り商品一覧を取得
        $favorites = $user->favorites()->with('productImages')->get();

        //ビューに変数を渡す
        return view('user.mypage',compact('user','favorites'));
    }
}
