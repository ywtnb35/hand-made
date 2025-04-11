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