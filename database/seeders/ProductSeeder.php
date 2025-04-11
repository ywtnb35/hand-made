<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Product::truncate();

        Product::insert([
            [
                'name' => '桜の木工品',
                'description' => '春を感じる手作り木工品',
                'price' => 1500,
                'image' => 'Woodwork.JPG',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'イルカストラップ',
                'description' => '御蔵島のイルカモチーフのストラップ',
                'price' => 1000,
                'image' => 'Stamp.JPG',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '柘植の箸',
                'description' => '柘植の箸',
                'price' =>2000,
                'image'=>'Drink.JPG',
                'created_at'=> now(),
                'updated_at'=> now()
            ]

        ]);
    }
}
