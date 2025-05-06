@extends('layouts.app')

@section('content')

<div class="cart-container">
    <h2>ショッピングカート</h2>

    <div class="cart-content">
        <!-- 商品一覧（左側） -->
        <section class="cart-items">
            <!--セッションに保存されたカート内商品を１つずつ表示-->
            @forelse($products as $productId => $product)  
                <div class="cart-item">

                    <!--商品画像-->
                    <img src="{{ asset('storage/'.$product['image']) }}" alt="{{ $product['name'] }}">

                    <!--商品情報-->
                    <div class="item-details">
                        <p class="item-name">{{ $product['name'] }}</p>
                        <p class="item-price">¥{{ number_format( $product['price']) }}</p>
                        
                        <!--数量コントロールフォーム-->
                        <div class="quantity-control">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <!--対象の商品IDをhiddenで送信-->
                                <input type="hidden" name="product_id" value="{{ $productId }}"> 
                                <button type="submit" name="action" value="decrease">-</button>
                                <!--現在の数量を表示-->
                                <span>{{ $product['quantity'] }}</span>
                                <button type="submit" name="action" value="increase">+</button>
                            </form>
                        </div>
                    </div>

                    <!--小計-->
                    <div class="item-subtotal">¥{{ number_format($product['price'] * $product['quantity']) }}</div>
                    
                    <!--商品削除フォーム-->
                    <form action="{{ route('cart.remove') }}" method="POST" style="display:inline;">
                        @csrf
                        <!--削除対象のIDをhiddenで送信-->
                        <input type="hidden" name="product_id" value="{{ $productId }}">
                        <button type="submit" class="remove">🗑 削除</button>
                    </form>
                </div>
            <!--カートに商品が一件もない場合の表示-->
            @empty
                <p>カートに商品がありません</p>
            @endforelse

        </section>

        <!-- 注文サマリー（右側） -->
        <aside class="order-summary">
            <h2>注文内容</h2>
            <div class="summary-row">
                <span>小計</span>
                <!--コントローラー側から渡された合計金額を表示-->
                <span>¥{{ number_format($subtotal) }}</span>   
            </div>

            <div class="summary-row">
                <span>配送料</span><span>無料</span>    
            </div>

            <div class="summary-row">
                <span>日本東京都</span>
            </div>


            <form action="{{ route('order.entry') }}" method="GET">
                <button type="submit" class="checkout-btn">レジへ進む</button>
                <p class="secure">🔒 安全なお支払い</p>
            </form>
        </aside>
    </div>
</div>

@endsection
