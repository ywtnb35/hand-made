<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $product = Product::first();

        if(!$user || !$product){
            echo "ユーザーまたは商品が見つかりません。\n";
            return;
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => 3000,
            'name' => 'テスト注文',
            'email' => 'test@example.com',
            'address' => '東京都テスト町1-2-3'
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'price' => 1500
        ]);
    }
}
