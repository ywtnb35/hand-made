<footer class="site-footer">
    <div class="footer-grid">
        <div>
            <ul>
                <li><a href="{{ route('products.index') }}">ショップ</a></li>
                <li><a href="{{ route('products.index', ['category' => 'drink']) }}">食べ物・飲料</a></li>
                <li><a href="{{ route('products.index', ['category' => 'wood']) }}">木工品</a></li>
                <li><a href="{{ route('products.index', ['category' => 'stamp']) }}">印鑑</a></li>
            </ul>
        </div>
        
        <div>
            <h4>利用規約</h4>
            <ul>
                <li>配送・返品について</li>
                <li>利用規約</li>
                <li>お支払方法</li>
                <li>特定商品取引法に基づく表記</li>
                <li>プライバシーポリシー</li>
                <li>Cookieポリシー</li>
                <li>FAQ</li>
            </ul>
        </div>

        <div>
            <h4>アクセス</h4>
            <p>〒100-1301</P>
            <p>東京都御蔵島村</p>
            <p>info@mysite.co.jp</p>
            <p>Tel: 12-3456-7890</p>
        </div>
    </div>

    <p class="copyright">&copy;2025 yuka </p>
</footer>
