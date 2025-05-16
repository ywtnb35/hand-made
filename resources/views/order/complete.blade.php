@extends('layouts.app')

@section('content')
<div class="order-complete-container">
    <h1>ご注文ありがとうございました！</h1>

    @if (isset($order_id))
        <p class="order-number">注文番号：<strong>#{{ $order_id }}</strong></p>
    @endif
    
    <p>ご注文内容を確認の上、発送いたします。</p>
    <a href="{{ route('products.index') }}" class="back-to-shop">商品一覧に戻る</a>
</div>
@endsection
