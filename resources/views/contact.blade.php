@extends('layouts.app')

@section('content')
<div class="contact-container">
    <h2>お問い合わせ</h2>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('contact.submit') }}">
        @csrf

        <label>お名前</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>お問い合わせ内容</label>
        <textarea name="message" rows="5" required>{{ old('message') }}</textarea>

        <button type="submit">送信する</button>
    </form>
</div>
@endsection
