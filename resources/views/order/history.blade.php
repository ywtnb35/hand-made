@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endpush

@section('content')
<div class="order-history-container">
    <h2>注文履歴</h2>

    @forelse ($orders as $order)
        <div class="order-box">
            <div class="order-header">

                @php
                    $statusLabel = match($order->status) {
                        'pending' => '未発送',
                        'shipped' => '発送済み',
                        'cancelled' => 'キャンセル済み',
                        default => '不明',
                    };

                    $statusClass = match($order->status) {
                        'pending' => 'status-pending',
                        'shipped' => 'status-shipped',
                        'cancelled' => 'status-cancelled',
                        default => '',
                    };
                @endphp

                <span class="status {{ $statusClass }}">{{ $statusLabel }}</span>

                <div class="order-meta">
                    <p>注文日：{{ $order->created_at->format('Y.m.d') }}</p>
                    <p>注文番号：{{ $order->id }}</p>
                </div>
            </div>

            <div class="order-items">
                @foreach ($order->orderItems as $item)
                    <div class="item-row">
                        <div class="item-img">
                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}">
                        </div>
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

                @if ($order->status === 'pending')
                    <form action="{{ route('orders.cancel',$order->id) }}" method="POST" onsubmit="return confirm('本当にこの注文をキャンセルしますか？');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="cancel-btn">注文をキャンセルする</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p>注文履歴がありません。</p>
    @endforelse
</div>
@endsection
