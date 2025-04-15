@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>商品登録</h1>

    <!--エラーメッセージ-->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)]
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="price">価格</label>
            <input type="text" id="price" name="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="form-group">
            <label for="image">画像</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="category">カテゴリ</label>
            <select id="category" name="category" class="form-control">
                <option value="">→選択してください←</option>
                <option value="drink">飲み物</option>
                <option value="wood">木工品</option>
                <option value="stamp">印鑑</option>
            </select>
        </div>

    <button type="submit" class="btn btn-warning">登録</button>
    </form>

</div>
@endsection
