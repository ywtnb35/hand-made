<header class="site-header">
    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="images/logo7.png" class="logo" alt="ロゴ">
        </div>

    <div class="nav-wrapper">
        <nav class="main-nav">
            <a href="{{ route('home') }}">ホーム</a>
            <a href="{{ route('products.index') }}">ショップ</a>
            <a href="#">About</a>
            <a href="#">お問い合わせ</a>
        </nav>

        <div class="user-icons">
            <a href="{{ route('cart.show') }}">
                ログイン  |  カート({{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }})
            </a>
        </div>
    </div>
</header>
