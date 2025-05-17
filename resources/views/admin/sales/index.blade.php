@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/sales.css') }}">

<h2>売上レポート</h2>

<h3>月別売上</h3>
<table>
    <tr><th>月</th><th>売上合計</th></tr>
    @foreach($monthlySales as $sale)
        <tr>
            <td>{{ $sale->month }}</td>
            <td>¥{{ number_format($sale->total) }}</td>
        </tr>
    @endforeach
</table>

<h3>商品別売上</h3>
<table>
    <tr><th>商品名</th><th>販売数</th><th>売上合計</th></tr>
    @foreach($productSales as $sale)
        <tr>
            <td>{{ $sale->product->name ?? '不明な商品' }}</td>
            <td>{{ $sale->total_quantity }}</td>
            <td>¥{{ number_format($sale->total_price) }}</td>
        </tr>
    @endforeach
</table>
@endsection
