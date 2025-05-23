@extends('layouts.app')

@section('content')
<div class="container">
    <h2>注文ステータス編集</h2>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="status" class="form-label">ステータス</label>
            <select name="status" id="status" class="form-select">
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>未発送</option>
                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>発送済み</option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>キャンセル済み</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
