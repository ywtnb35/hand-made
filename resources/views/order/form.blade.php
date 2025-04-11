@extends('layouts.app')

@section('content')
<div class="order-form-container">
    <h2 class="order-title">ご注文情報の入力</h2>

    @if ($errors->any())
        <div class="order-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('order.store') }}" method="POST" class="order-form">
        @csrf

        <div class="form-group">
            <label for="name">お名前</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="address">住所</label>
            <textarea id="address" name="address" rows="4" required>{{ old('address') }}</textarea>
        </div>

        <h3 class="order-subtitle">注文内容</h3>
        @if (session('cart') && count(session('cart')) > 0)
            <ul class="order-cart-list">
                @foreach (session('cart') as $item)
                    <li>
                        {{ $item['name'] }}：
                        ¥{{ number_format($item['price']) }} × {{ $item['quantity'] }}
                        = <strong>¥{{ number_format($item['price'] * $item['quantity']) }}</strong>
                    </li>
                @endforeach
            </ul>
            <p class="order-total">合計金額：<strong>¥{{ number_format(session('cart_total')) }}</strong></p>
        @else
            <p>カートが空です。</p>
        @endif

        <button type="submit" class="order-submit-btn">注文を確定する</button>
    </form>
</div>
@endsection
