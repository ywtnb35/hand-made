@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<div class="mypage-container">
    <h2>マイページ</h2>
    <p><strong>お名前：</strong>{{ $user->name }}</p>
    <p><strong>メールアドレス：</strong>{{ $user->email }}</p>
    <p><strong>登録日：</strong>{{ $user->created_at->format('Y年m月d日') }}</p>
    <h3>お気に入り商品</h3>

    @if($favorites->isEmpty())
        <p>お気に入りは登録されていません。</p>
    @else
        <div class="favorite-list">
            @foreach($favorites as $product)
                <div class="favorite-item">

                    {{--商品名--}}
                    <p class="favorite-name">{{ $product->name }}</p>

                    {{-- 商品画像（存在する場合のみ） --}}
                    @if ($product->productImages->isNotEmpty())
                        @php
                            $filename = $product->productImages->first()->filename;
                        @endphp
                        <p>画像数：{{ $product->productImages->const()}}</p>
                        <img src="{{ asset('images/' . $filename) }}" alt="{{ $product->name }}" class="favorite-img">

                    @endif

                    {{-- お気に入り解除ボタン --}}
                    <form method="POST" action="{{ route('favorite.destroy', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="unfavorite-btn">♥ お気に入り解除</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('orders.history') }}">注文履歴を見る</a>
</div>
@endsection
