<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name'        => '桜の木工品',
                'description' => '春を感じる手作り木工品',
                'price'       => 1500,
                'image'       => 'Woodwork.JPG',
                'category'    => '木工',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'イルカストラップ',
                'description' => '御蔵島のイルカモチーフのストラップ',
                'price'       => 1000,
                'image'       => 'Stamp.JPG',
                'category'    => '木工',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => '柘植の箸',
                'description' => '柘植の箸',
                'price'       => 2000,
                'image'       => 'Drink.JPG',
                'category'    => '木工',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
