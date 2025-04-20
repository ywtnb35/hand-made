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
            @auth
                <!--ログイン中の時-->
                <form method="POST" action="{{ route('login')}}" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">ログイン</button>
                </form>
            @endauth
            
            @guest
                <!--未ログインの時-->
                <div class="login-dropdown-wrapper">
                    <span class="login-toggle">ログイン</span>
                    <div class="login-dropdown">
                        <a href="{{ route('login') }}">ログイン</a>
                        <a href="{{ route('register') }}">新規登録</a>
                    </div>
                </div>
            @endguest

            <a href="{{ route('cart.show') }}">
                  |  カート({{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }})
            </a>
        </div>
    </div>
</header>
