@extends('layouts.app')

@section('content')


<div class="container">
    <h2>注文一覧（管理者）</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- PC・タブレット用テーブル表示 --}}
    <div class="table-wrapper">
        <table class="admin-orders-table">
            <thead>
                <tr>
                    <th>注文ID</th>
                    <th>注文番号</th>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>合計金額</th>
                    <th>注文日時</th>
                    <th>ステータス</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->user->name ?? 'ゲスト' }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ number_format($order->total_price) }}円</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td> 
                        @php
                            $statusLabel = match($order->status){
                                'pending' => '未発送',
                                'shipped' => '発送済み',
                                'cancelled' => 'キャンセル済み',
                                default => '不明',
                            };

                            $badgeClass = match($order->status) {
                                'pending' => 'badge-danger',
                                'shipped' => 'badge-success',
                                'cancelled' => 'badge-secondary',
                                default => 'badge-light',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $statusLabel }}</span><br>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-outline-primary mt-1">編集</a>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- スマホ用カード表示 --}}
    <div class="order-cards">
        @foreach ($orders as $order)
        <div class="order-card">
            <div><strong>注文ID：</strong>{{ $order->id }}</div>
            <div><strong>注文番号：</strong>{{ $order->order_number }}</div>
            <div><strong>ユーザー名：</strong>{{ $order->user->name ?? 'ゲスト' }}</div>
            <div><strong>メール：</strong>{{ $order->email }}</div>
            <div><strong>金額：</strong>{{ number_format($order->total_price) }}円</div>
            <div><strong>注文日時：</strong>{{ $order->created_at->format('Y-m-d H:i') }}</div>
            <div><strong>ステータス:</strong>
                @php 
                    $label = match($order->status){
                        'pending' => '未発送',
                        'shipped' => '発送済み',
                        'cancelled' => 'キャンセル済み',
                        default => '不明',
                    };
                @endphp
                {{ $label }}
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
