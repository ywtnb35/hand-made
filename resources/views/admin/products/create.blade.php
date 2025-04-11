@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>商品登録</h1>

    <form>
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label for="price">価格</label>
            <input type="text" id="price" name="price" class="form-control">
        </div>

        <div class="form-group">
            <label for="image">画像パス</label>
            <input type="text" id="image" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-warning">登録</button>
    </form>
</div>
@endsection
