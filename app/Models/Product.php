<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model  //商品モデル:productsテーブルと自動的に紐づく
{
    protected $fillable = [  //一括代入を許可するカラムのリスト
        'name',  //商品名
        'price', //価格
        'image', //メイン画像
        'category', //商品カテゴリ
    ];

    public function images()  //商品と商品画像(ProductImage)のリレーション(1対多)
    {
        return $this->hasMany(ProductImage::class);  //ProductsIMageモデルとリレーション(1商品に複数画像)
    }
}
