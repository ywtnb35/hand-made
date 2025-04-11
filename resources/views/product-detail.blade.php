@extends('layouts.app')

@section('content')

<div class="product-detail-container">
    <div class="breadcrumbs">ホーム / ショップ / {{ $product->name }}</div>

    <div class="product-detail">
        <!-- 左側：画像 -->
        <div class="product-images">
            <img class="main-image" src="{{ asset('images/' .$product->image) }}" alt="{{ $product->name }}">
            <div class="thumbnail-group">
                <img class="thumbnail" src="{{ asset('images/' .$product->image) }}" alt="{{ $product->name }} サブ画像１">
                <img class="thumbnail" src="{{ asset('images/' .$product->image) }}" alt="{{ $product->name }} サブ画像２">
            </div>
        </div>

        <!-- 右側：商品情報 -->
        <div class="product-info">
            <div class="product-name">商品名: {{ $product->name }}</div>
            <div class="product-price">¥{{ number_format($product->price) }}</div>

            <div class="product-quantity">
                <label>数量</label>
                <div class="quantity-box">
                    <button type="button" id="quantity-minus">-</button>
                    <span id="quantity-display">1</span>
                    <button type="button" id="quantity-plus">+</button>
                </div>
            </div>

            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" id="hidden-quantity" value="1">

                <button type="submit" class="add-to-cart">カートに追加する</button>
            </form>

            <div class="product-description">
                <h3>商品詳細</h3>
                <p>{{ $product->description}}</p>
            </div>

            <div class="accordion">
                <h3>返品と返金について ＋</h3>
                <h3>配送について ＋</h3>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/quantity.js') }}"></script>

@endsection
