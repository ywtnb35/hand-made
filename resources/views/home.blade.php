@extends('layouts.app')

<!-- @section('title', 'ホームページ') -->

@section('content')
  <section class="collection-section">
    <div class="collection-grid">
      {{-- 食べ物・飲料--}}
      <a href="{{ route('products.index', ['category' => 'drink']) }}" class="collection-item">
        <img src="{{ asset('images/Drink.JPG') }}" alt="Drink">
        <div class="item-info">
          <h3>食べ物・飲料</h3>
        </div>
      </a>

      {{--木工品--}}
      <a href="{{ route('products.index',['category' => 'wood']) }}" class="collection-item">
        <img src="{{ asset('images/Woodwork.JPG') }}" alt="woodwork">
        <div class="item-info">
          <h3>木工品</h3>
        </div>
      </a>

      {{--印鑑--}}
      <a href="{{ route('products.index', ['category' => 'stamp']) }}" class="collection-item">
        <img src="{{ asset('images/Stamp.JPG') }}" alt="stamp">
        <div class="item-info">
          <h3>印鑑</h3>
        </div>
      </a>
    </div>
  </section>
@endsection
