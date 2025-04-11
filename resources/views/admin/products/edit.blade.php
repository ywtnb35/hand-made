@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>商品編集</h1>

    <form>
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name" class="form-control" value="源水">
        </div>

        <div class="form-group">
            <label for="price">価格</label>
            <input type="text" id="price" name="price" class="form-control" value="1000">
        </div>

        <div class="form-group">
            <label for="image">画像パス</label>
            <input type="text" id="image" name="image" class="form-control" value="images/Drink.JPG">
        </div>

        <button type="submit" class="btn btn-warning">更新</button>
    </form>
</div>
@endsection
