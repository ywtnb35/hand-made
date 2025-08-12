@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

@php use Illuminate\Support\Facades\Storage; @endphp

<div class="edit-page">

  {{-- フラッシュメッセージ --}}
  @if (session('success'))
    <div class="alert success">{{ session('success') }}</div>
  @endif
  @if ($errors->any())
    <div class="alert error">
      <ul>
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  {{-- 基本情報の更新 --}}
  <section class="card">
    <h1>商品編集</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="form-grid">
      @csrf
      @method('PUT')

      <label class="field">
        <span>商品名</span>
        <input type="text" name="name" value="{{ old('name', $product->name) }}">
      </label>

      <label class="field">
        <span>価格</span>
        <input type="text" name="price" value="{{ old('price', $product->price) }}">
      </label>

      <label class="field">
        <span>代表画像パス</span>
        <input type="text" name="image" value="{{ old('image', $product->image) }}">
        <small class="hint">※ 下の「画像の管理」で入替もできます。</small>
      </label>

      <label class="field">
        <span>在庫数</span>
        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}">
      </label>

      <label class="field">
        <span>公開設定</span>
        <select name="is_published">
          <option value="1" {{ old('is_published', $product->is_published ?? 1)==1 ? 'selected' : '' }}>公開</option>
          <option value="0" {{ old('is_published', $product->is_published ?? 1)==0 ? 'selected' : '' }}>非公開</option>
        </select>
      </label>

      <label class="field">
        <span>カテゴリ</span>
        <select name="category">
          <option value="drink" {{ $product->category=='drink' ? 'selected' : '' }}>飲み物</option>
          <option value="wood"  {{ $product->category=='wood'  ? 'selected' : '' }}>木工品</option>
          <option value="stamp" {{ $product->category=='stamp' ? 'selected' : '' }}>印鑑</option>
        </select>
      </label>

      <div class="actions">
        <button type="submit" class="btn primary">更新</button>
      </div>
    </form>
  </section>

  {{-- 画像の管理 --}}
  <section class="card">
    <h2>画像の管理</h2>

    {{-- 現在の代表画像プレビュー（壊れてたら最初の追加画像にフォールバック） --}}
    @php
      $primary = $product->image;
      $primaryUrl = ($primary && Storage::disk('public')->exists($primary))
        ? Storage::url($primary)
        : (optional($product->images->first(), fn($img)=>Storage::url($img->filename)) ?? asset('images/no_image.png'));
    @endphp

    <div class="preview-row">
      <div>
        <div class="label">現在の代表画像</div>
        <img src="{{ $primaryUrl }}" class="thumb-lg" alt="代表画像">
        <div class="path">{{ $product->image ?: '（未設定）' }}</div>
      </div>

      <div>
        <div class="label">登録済みの追加画像</div>
        <div class="thumb-grid">
          @forelse($product->images as $img)
            <figure>
              <img src="{{ Storage::url($img->filename) }}" class="thumb" alt="">
              <figcaption class="path">{{ $img->filename }}</figcaption>
            </figure>
          @empty
            <div class="muted">追加画像はまだありません。</div>
          @endforelse
        </div>
      </div>
    </div>

    {{-- 画像を追加（既存は削除しない） --}}
    <div class="block">
      <h3>画像を追加（既存は変更しません）</h3>
      <form action="{{ route('admin.products.images.add', $product) }}" method="POST" enctype="multipart/form-data" class="inline-form">
        @csrf
        <input type="file" name="images[]" accept="image/*" multiple required>
        <label class="check">
          <input type="checkbox" name="set_primary" value="1">
          今回の先頭を代表画像にする
        </label>
        <button type="submit" class="btn">追加する</button>
      </form>

      <div class="new-previews"></div>
    </div>

    {{-- 画像を入れ替え（全削除→新規のみ追加） --}}
    <div class="block danger">
      <h3>画像を入れ替え（既存を全削除 → 新規のみ追加）</h3>
      <form action="{{ route('admin.products.images.replace', $product) }}" method="POST" enctype="multipart/form-data" class="inline-form">
        @csrf
        <input type="file" name="images[]" accept="image/*" multiple required>
        <button type="submit" class="btn danger">入れ替える</button>
      </form>
      <small class="hint">※ いま登録されている画像はすべて削除され、選んだ画像だけが登録されます（先頭が代表画像になります）。</small>
    </div>
  </section>
</div>

{{-- 選択した新規画像の簡易プレビュー --}}
<script>
(function(){
  const input = document.querySelector('form[action$="images/add"] input[type="file"][name="images[]"]');
  const wrap  = document.querySelector('.new-previews');
  if(!input || !wrap) return;
  input.addEventListener('change', (e) => {
    wrap.innerHTML = '';
    wrap.className = 'new-previews grid';
    [...e.target.files].forEach(file => {
      const url = URL.createObjectURL(file);
      const img = new Image();
      img.src = url;
      img.className = 'thumb';
      wrap.appendChild(img);
    });
  });
})();
</script>
@endsection
