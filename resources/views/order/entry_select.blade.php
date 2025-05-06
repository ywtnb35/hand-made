@extends('layouts.app')

@section('content')
<div class="entry-select-container">
    <h2 class="entry-heading">ご購入方法の選択</h2>
    <div class="entry-buttons">
        <a href="{{ route('login') }}" class="entry-btn">ログインして購入</a>
        <a href="{{ route('order.form') }}" class="entry-btn">ゲストとして購入</a>
    </div>
</div>
@endsection
