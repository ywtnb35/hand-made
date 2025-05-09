@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endpush

@section('content')
<div class="order-history-container">

    <h2>注文履歴</h2>
    <!--注文データがあれば表示-->
    @forelse ($orders as $order)
        <div class="order-box">
            <div class="order-header">
                <span class="status">配送完了</span>
                <div class="order-meta">
                    <p>注文日：{{ $order->created_at->format('Y.m.d') }}</p>
                    <p>注文番号：{{ $order->id }}</p>
                </div>
                <button class="order-btn">注文詳細・各種手続き</button>
            </div>

            <!--注文内の商品一覧-->
            <div class="order-items">
                @foreach ($order->orderItems as $item)
                    <div class="item-row">

                        <!--商品画像-->
                        <div class="item-img">
                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}">
                        </div>

                        <!--商品名・価格・数量などの情報-->
                        <div class="item-info">
                            <p class="product-name">{{ $item->product->name }}</p>
                            <p class="price">¥{{ number_format($item->price) }} 税込 / 数量：{{ $item->quantity }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="order-footer">
                <p>支払い方法：クレジット（一括）</p>
                <p class="total">支払い金額：¥{{ number_format($order->total_price) }}</p>
            </div>
        </div>
    <!--注文が１件もなかった場合-->
    @empty
        <p>注文履歴がありません。</p>
    @endforelse

</div>
@endsection
