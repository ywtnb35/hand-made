@extends('layouts.app')

<!-- @section('title', 'ホームページ') -->

@section('content')
  <section class="collection-section">
    <div class="collection-grid">
      <div class="collection-item">
        <img src="{{ asset('images/Drink.JPG') }}" alt="Drink">
        <div class="item-info">
          <h3>食べ物・飲料</h3>
          <a href="{{ route('category.show', ['category' => 'drink']) }}">すべて表示</a>
        </div>
      </div>
      <div class="collection-item">
        <img src="{{ asset('images/Woodwork.JPG') }}" alt="woodwork">
        <div class="item-info">
          <h3>木工品</h3>
          <a href="{{ route('category.show', ['category' => 'wood']) }}">すべて表示</a>
        </div>
      </div>
      <div class="collection-item">
        <img src="{{ asset('images/Stamp.JPG') }}" alt="stamp">
        <div class="item-info">
          <h3>印鑑</h3>
          <a href="{{ route('category.show', ['category' => 'stamp']) }}">すべて表示</a>
        </div>
      </div>
    </div>
  </section>
@endsection
