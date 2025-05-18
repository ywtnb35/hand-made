<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Middleware\AdminMiddleware;

// ▼ トップページ
Route::get('/', function () {
    return view('home');
})->name('home');

// ▼ Breezeのダッシュボード（未使用化）
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// ▼ 認証ユーザー（一般ユーザー）専用ルート
Route::middleware('auth')->group(function () {
    // マイページ
    Route::get('/mypage', [UserController::class, 'mypage'])->name('user.mypage');

    // お気に入り
    Route::post('/favorite/{product}', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/favorite/{product}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

    // 注文履歴
    Route::get('/orders/history', [OrderHistoryController::class, 'index'])->name('orders.history');
});

// ▼ 商品ページ（共通公開）
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// ▼ カート関連
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// ▼ 注文関連
Route::get('/order/entry', fn() => view('order.entry_select'))->name('order.entry');
Route::get('/order/form', [OrderController::class, 'form'])->name('order.form');
Route::post('/order/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
Route::get('/order/back', [OrderController::class, 'backToForm'])->name('order.back');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/complete/{order_id}', [OrderController::class, 'complete'])->name('order.complete');

// ▼ お問い合わせフォーム（共通）
Route::get('/contact', [ContactController::class, 'form'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ▼ 管理者専用ルート（全体に admin ミドルウェアを適用）
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {

    // 商品管理
    Route::prefix('products')->group(function () {
        Route::get('/', [AdminProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [AdminProductController::class, 'create'])->name('admin.products.create');
        Route::post('/store', [AdminProductController::class, 'store'])->name('admin.products.store');
        Route::get('/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/{id}/update', [AdminProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/{id}/delete', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    });

    // 注文管理
    Route::prefix('orders')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::get('{id}/edit', [AdminOrderController::class, 'edit'])->name('admin.orders.edit');
        Route::put('{id}/update', [AdminOrderController::class, 'update'])->name('admin.orders.update');
    });

    // 売上・お問い合わせ
    Route::get('/sales', [SalesController::class, 'index'])->name('admin.sales.index');
    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
});

// ▼ Breezeで生成された認証ルート（ログイン・登録など）
require __DIR__ . '/auth.php';
