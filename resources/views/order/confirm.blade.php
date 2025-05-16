@extends('layouts.app')

@section('content')
<div class="order-confirm-container">
    <h2 class="order-title">ご注文内容の確認</h2>

    @if (!session()->has('order_input'))
        <p>セッションが切れています。最初からやり直してください。</p>
        <a href="{{ route('order.form') }}">入力フォームへ戻る</a>
    @else
        @php
            $input = session('order_input');
        @endphp

        <div class="confirm-box">
            <p><strong>お名前：</strong>{{ $input['name'] }}</p>
            <p><strong>メール：</strong>{{ $input['email'] }}</p>
            <p><strong>郵便番号：</strong>{{ $input['zipcode'] }}</p>
            <p><strong>住所：</strong>{{ $input['address'] }} {{ $input['address_detail'] }}</p>
        </div>

        <h3 class="order-subtitle">注文内容</h3>
        <ul class="order-cart-list">
            @foreach (session('cart', []) as $item)
                <li>
                    {{ $item['name'] }} - ¥{{ number_format($item['price']) }} × {{ $item['quantity'] }} =
                    <strong>¥{{ number_format($item['price'] * $item['quantity']) }}</strong>
                </li>
            @endforeach
        </ul>

        <p class="order-total">合計：<strong>¥{{ number_format(session('cart_total', 0)) }}</strong></p>

        <div class="confirm-button-group">
            <a href="{{ route('cart.show') }}" class="btn btn-outline-primary">
                カート内容を修正する
            </a>

            <a href="{{ route('order.back') }}" class="btn btn-secondary">
                入力内容を修正する
            </a>
        </div>


        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">この内容で注文を確定する</button>
        </form>
    @endif
</div>
@endsection


