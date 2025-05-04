@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
<div class="admin-main">
    <h1>商品登録</h1>

    <!--バリデーションエラーメッセージ-->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)]
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!--商品登録フォーム:post送信、画像アップロード用にenctypeを指定-->
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!--商品名-->
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <!--価格入力-->
        <div class="form-group">
            <label for="price">価格</label>
            <input type="text" id="price" name="price" class="form-control" value="{{ old('price') }}">
        </div>

        <!--複数画像のアップロード-->
        <div class="form-group">
            <label for="image">画像</label>
            <input type="file" name="images[]" id="images" class="form-control" multiple>
            <!--name="images[]"で複数ファイル、multipleで複数選択可-->
        </div>

        <!--商品詳細-->
        <div class="form-group">
            <label for="description">商品紹介</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>

        <!--カテゴリ選択(セレクトボックス)-->
        <div class="form-group">
            <label for="category">カテゴリ</label>
            <select id="category" name="category" class="form-control">
                <option value="">→選択してください←</option>
                <option value="drink">飲み物</option>
                <option value="wood">木工品</option>
                <option value="stamp">印鑑</option>
            </select>
        </div>

    <!--登録ボタン-->
    <button type="submit" class="btn btn-warning">登録</button>
    </form>

</div>
@endsection
