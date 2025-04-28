let quantity = 1;

document.addEventListener('DOMContentLoaded', () => {
    const display = document.getElementById('quantity-display');
    const hiddenInput = document.getElementById('hidden-quantity');

    function updateQuantity(change) {
        quantity = Math.max(1, quantity + change);
        display.textContent = quantity;
        hiddenInput.value = quantity;
    }

    const plusBtn = document.getElementById('quantity-plus');
    const minusBtn = document.getElementById('quantity-minus');

    if (plusBtn && minusBtn) {
        plusBtn.addEventListener('click', () => updateQuantity(1));
        minusBtn.addEventListener('click',() => updateQuantity(-1));
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('main-image');
    const thumbnails = document.querySelectorAll('.thumbnail');

    // 最初のサムネイルをactiveにする
    if (thumbnails.length > 0) {
        thumbnails[0].classList.add('active-thumbnail');
    }

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            // メイン画像を切り替える
            mainImage.src = this.src;

            // メイン画像にフェード効果を付ける
            mainImage.classList.remove('fade');
            void mainImage.offsetWidth; // リセット
            mainImage.classList.add('fade');

            // 全サムネイルのactiveクラスを外す
            thumbnails.forEach(t => t.classList.remove('active-thumbnail'));
            // クリックしたサムネイルだけactiveクラスを付ける
            this.classList.add('active-thumbnail');
        });
    });
});
