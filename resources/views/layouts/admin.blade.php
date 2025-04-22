<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=456">
</head>
<body>
    <div class="admin-wrapper">
        <!-- ヘッダー -->
        <header class="admin-header">
            <h1 class="admin-title">管理メニュー</h1>
            <nav class="admin-nav">
                <a href="{{ route('admin.products.index') }}">商品一覧</a>
                <a href="{{ route('admin.products.create') }}">商品登録</a>
            </nav>
        </header>

        <!-- メイン -->
        <main class="admin-main">
            @yield('content')
        </main>
    </div>
</body>
</html>
