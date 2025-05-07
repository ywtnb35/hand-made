@extends('layouts.app')

@section('content')
<div class="entry-select-container">
    <h2 class="entry-heading">ご購入方法の選択</h2>
    <div class="entry-buttons">
        @auth
            {{--ログイン済みの人はこのまま購入--}}
            <a href="{{ route('order.form') }}" class="entry-btn">このまま購入へ進む</a>
        @else
            {{--ゲストはログインかゲスト購入か選択--}}
            <a href="{{ route('login') }}" class="entry-btn">ログインして購入</a>
            <a href="{{ route('order.form') }}" class="entry-btn">ゲストとして購入</a>
        @endauth
    </div>
</div>
@endsection
