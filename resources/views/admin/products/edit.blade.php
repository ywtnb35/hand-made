@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>商品編集</h1>

    <!--商品更新フォーム:putメソッド(post+@methodで疑似的に)-->
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')  <!--putメソッドを指定(HTMLはpostしか使えないため)-->

        <!--商品名入力-->
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
        </div>

        <!--価格入力-->
        <div class="form-group">
            <label for="price">価格</label>
            <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}">
        </div>

        <!--画像パス入力(表示用)※アップロードは未対応-->
        <div class="form-group">
            <label for="image">画像パス</label>
            <input type="text" name="image" class="form-control" value="{{ old('image', $product->image) }}">
        </div>

        <!--カテゴリ選択-->
        <div class="form-group">
            <label for="category">カテゴリ</label>
            <select name="category" class="form-control">
                <option value="drink" {{ $product->category == 'drink' ? 'selected' : '' }}>飲み物</option>
                <option value="wood" {{ $product->category == 'wood' ? 'selected' : '' }}>木工品</option>
                <option value="stamp" {{ $product->category == 'stamp' ? 'selected' : '' }}>印鑑</option>
            </select>
        </div>

        <!--更新ボタン-->
        <button type="submit" class="btn btn-warning">更新</button>
    </form>
</div>
@endsection
