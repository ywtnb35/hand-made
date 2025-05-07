@extends('layouts.app')

@section('content')
<div class="order-form-container">
    <h2 class="order-title">ご注文情報の入力</h2>

    @if ($errors->any())
        <div class="order-error">
            <ul>
                <!--すべてのエラーメッセージをループ表示-->
                @foreach ($errors->all() as $error)
                    <li>⚠ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!--注文情報を送信するフォーム(post)-->
    <form action="{{ route('order.store') }}" method="POST" class="order-form">
        @csrf

        <!--名前入力-->
        <div class="form-group">
            <label for="name">お名前</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <!--メールアドレス-->
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <!-- 郵便番号入力 -->
        <div class="form-group">
            <label for="zipcode">郵便番号</label>
            <input type="text" name="zipcode" id="zipcode" required pattern="\d{7}" placeholder="例: 1000001">
        </div>

        <!-- 住所入力（自動補完される） -->
        <div class="form-group">
            <label for="address">市区町村</label>
            <input type="text" name="address" id="address" required>
        </div>

        <!--番地-->
        <div class="form-group">
            <label for="address_detail">番地</label>
            <input type="text" name="address_detail" id="address_detail" required>
        </div>


        <!--カートの内容を確認表示-->
        <h3 class="order-subtitle">注文内容</h3>
        @if (session('cart') && count(session('cart')) > 0)
            <ul class="order-cart-list">
                <!--カート内のすべての商品を表示-->
                @foreach (session('cart') as $item)
                    <li>
                        {{ $item['name'] }}：
                        ¥{{ number_format($item['price']) }} × {{ $item['quantity'] }}
                        = <strong>¥{{ number_format($item['price'] * $item['quantity']) }}</strong>
                    </li>
                @endforeach
            </ul>

            <!--合計金額の表示-->
            <p class="order-total">合計金額：<strong>¥{{ number_format(session('cart_total')) }}</strong></p>
        @else
            <p>カートが空です。</p>
        @endif

        <!--注文確定ボタン-->
        <button type="submit" class="order-submit-btn">注文を確定する</button>
    </form>
</div>
@endsection
