@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<div class="mypage-container">
    <h2>マイページ</h2>
    <p><strong>お名前：</strong>{{ $user->name }}</p>
    <p><strong>メールアドレス：</strong>{{ $user->email }}</p>
    <p><strong>登録日：</strong>{{ $user->created_at->format('Y年m月d日') }}</p>

    <a href="{{ route('orders.history') }}">注文履歴を見る</a>
</div>
@endsection
