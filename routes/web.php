<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;

// トップページ
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 認証後ダッシュボード
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// プロフィール関連（Laravel Breeze用）
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 商品表示
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show']);

// カート操作
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');

// 注文処理
Route::get('/oder/form' , [OrderController::class,'form'])->name('order.form');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/complete', function () {
    return view('order.complete');
})->name('order.complete');


// 管理画面（ダミービュー呼び出し）
Route::get('/admin/products', function () {
    return view('admin.products.index');
});

Route::get('/admin/products/create', function () {
    return view('admin.products.create');
});

Route::get('/admin/products/{id}/edit', function ($id) {
    return view('admin.products.edit', ['id' => $id]);
});

// 認証関連ルート（Breezeで生成されたもの）
require __DIR__.'/auth.php';
