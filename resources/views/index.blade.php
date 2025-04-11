@extends('layouts.app')

@section('content')
<div class="container">
    <div class="product-grid">

        <h2>
            @if(isset($category))
                {{ ucfirst($category) }}の商品一覧
            @else
                商品一覧
            @endif
        </h2>

        @foreach($products as $product)
            <div class="product-card"> 
                <a href="{{ url('/products/' . $product->id) }}">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="product-name product-name-list">{{ $product->name }}</div>
                </a>
                <div class="product-price">¥{{ number_format($product->price) }}</div>
            </div>
        @endforeach

    </div> 
</div> 
@endsection
