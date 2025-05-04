@extends('layouts.app')

@section('content')
<div class="container">

    <!-- ▼商品一覧タイトル -->
    <h2 class="product-list-title">
        @if($selectedCategory)
            {{ ucfirst($selectedCategory) }}の商品一覧
        @else
            商品一覧
        @endif
    </h2>

    <!-- ▼カテゴリボタン一覧 -->
    <div class="category-buttons">
        {{--すべて--}}
        <a href="{{ route('products.index') }}" class="category-button {{request('category') ? '':'active' }}">すべて</a>
        {{--カテゴリ別ボタン--}}
        @foreach($categories as $cat)
            <a href="{{ route('products.index', ['category' => $cat->category]) }}" 
               class="category-button {{ request('category') == $cat->category ? 'active' : '' }}">
                {{ ucfirst($cat->category) }}
            </a>
        @endforeach
    </div>

    <!-- ▼商品一覧 -->
    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card">
                <a href="{{ url('/products/' . $product->id) }}">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-price">¥{{ number_format($product->price) }}</div>
                </a>
            </div>
        @endforeach
    </div>

</div>
@endsection
