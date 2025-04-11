@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>商品管理（一覧）</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品名</th>
                <th>価格</th>
                <th>操作</th>
            </tr>
        </thead>

        <tbody>
            {{-- 仮の入力データ --}}
            <tr>
                <td>1</td>
                <td>源水</td>
                <td>¥1,000</td>
                <td>
                    <button class="btn btn-sm btn-warning">編集</button>
                    <button class="btn btn-sm btn-danger">削除</button>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>イルカストラップ</td>
                <td>¥1,000</td>
                <td>
                    <button class="btn btn-sm btn-warning">編集</button>
                    <button class="btn btn-sm btn-danger">削除</button>
                </td>
            </tr>
            
            <tr>
                <td>3</td>
                <td>印鑑</td>
                <td>¥1,000</td>
                <td>
                    <button class="btn btn-sm btn-warning">編集</button>
                    <button class="btn btn-sm btn-danger">削除</button>
                </td>
            </tr>
            </tbody>
    </table>
</div>
@endsection
