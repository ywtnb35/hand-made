@extends('layouts.app')

@section('content')

<div class="product-detail-container">
    <div class="breadcrumbs">ホーム / ショップ / {{ $product->name }}</div> <!--現在のページ位置を表示-->

    <div class="product-detail">
        <!-- 左側：画像 -->
        <div class="product-images">
            <!--メイン画像-->
            <img class="main-image" id="main-image" src="{{ asset('storage/' .$product->image) }}" alt="{{ $product->name }}">
            <!--サムネイル画像表示:ProductsControllerからリレーションで取得-->
            <div class="thumbnail-group">
                @foreach ($product->images as $image)
                    <img class="thumbnail" src="{{ asset('storage/' . $image->filename) }}" alt="{{ $product->name }}"  サムネイル>
                @endforeach
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
                @auth
                    @if (Auth::user()->favorites->contains($product->id))
                        <!-- 解除ボタン -->
                        <form method="POST" action="{{ route('favorite.destroy', $product->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">♥ お気に入り解除</button>
                        </form>
                    @else
                        <!-- 追加ボタン -->
                        <form method="POST" action="{{ route('favorite.store', $product->id) }}">
                            @csrf
                            <button type="submit">♡ お気に入り</button>
                        </form>
                    @endif
            @endauth

            </div>

            <!--カートに追加するフォームpost送信-->
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
