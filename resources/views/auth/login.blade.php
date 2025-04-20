@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('login') }}">
    @csrf


<!--ログインフォーム-->
    <div class="login-box">
        @csrf
    <!-- Email Address -->
    <div>
        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email" required autofocus autocomplete="username">
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password">パスワード</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">
    </div>

    <!-- Remember Me -->
    <div class="mt-4">
        <label for="remember_me">
            <input type="checkbox" name="remember" id="remember_me">
            ログイン状態を保持
        </label>
    </div>
    <!--ログインボタンとパスワードリセット-->
    <div class="form-actions">
        @if(Route::has('password.request'))
            <a class="forgot-link" href="{{ route('password.request') }}">
                パスワードをお忘れですか？
            </a>
        @endif
    <!-- Submit -->
        <button type="submit" class="btn-login">ログイン</button>
    </div>
</form>

@endsection
