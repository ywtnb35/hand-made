<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class FavoriteController extends Controller
{
    //お気に入り追加
    public function store($productId)
    {
        $user = Auth::user();

        if(!$user->favorites()->where('product_id',$productId)->exists()){
            $user->favorites()->attach($productId);
        }

        return back();
    }

    //お気に入り削除
    public function destroy($productId)
    {
        $user = Auth::user();
        $user->favorites()->detach($productId);

        return back();
    }
}
