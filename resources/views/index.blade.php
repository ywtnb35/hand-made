@extends('layouts.app')

@section('content')
<div class="container">

    <!--セレクトボックス：カテゴリ絞り込み-->
    <form method="GET" action="{{ route('products.index') }}">
        <select name="category" onchange="this.form.submit()"> <!--カテゴリが選ばれたときに自動送信される-->
        <option value="">すべてのカテゴリ</option>
        
        <!--コントローラーから渡されたカテゴリ一覧をループ-->
        @foreach ($categories as $cat)
            <option value="{{ $cat->category }}"
            @if($selectedCategory === $cat->category) selected @endif>  <!--現在選択中のカテゴリと一致していればselectedをつける-->
                {{ ucfirst($cat->category) }}  <!--カテゴリ名の先頭を大文字にして表示-->
            </option>
        @endforeach
</select>

    </form>


    <!--商品一覧-->
    <div class="product-grid">
        <h2>
            @if(isset($category))  <!--選択中のカテゴリがあるかで見出しを切り替え-->
                {{ ucfirst($category) }}の商品一覧
            @else
                商品一覧
            @endif
        </h2>

        @foreach($products as $product)  <!--商品一覧を１つずつループ表示-->
            <div class="product-card"> 
                <a href="{{ url('/products/' . $product->id) }}">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="product-name product-name-list">{{ $product->name }}</div>
                </a>
                <div class="product-price">¥{{ number_format($product->price) }}</div>
            </div>
        @endforeach

    </div> 
</div> 
@endsection
