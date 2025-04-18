@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>商品管理（一覧）</h1>

    {{-- 登録完了メッセージ --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品名</th>
                <th>価格</th>
                <th>画像</th>
                <th>カテゴリ</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>¥{{ number_format($product->price) }}</td>
                <td>
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 80px;">
                </td>
                <td>{{ ucfirst($product->category) }}</td>
                <td>
                    <a href="{{ url('/admin/products/' . $product->id . '/edit') }}" class="btn btn-sm btn-warning">編集</a>
                    <form action="{{ url('/admin/products/' . $product->id . '/delete') }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('削除してもよろしいですか？')">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
