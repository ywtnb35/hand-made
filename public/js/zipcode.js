document.addEventListener('DOMContentLoaded', function () {
    const zipInput = document.getElementById('zipcode');
    const addressInput = document.getElementById('address');

    if (zipInput) {
        zipInput.addEventListener('blur', function () {
            const zipcode = this.value.replace('-', '').trim();
            if (!zipcode.match(/^\d{7}$/)) return;

            fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${zipcode}`)
                .then(response => response.json())
                .then(data => {
                    if (data.results) {
                        const result = data.results[0];
                        addressInput.value = result.address1 + result.address2 + result.address3;
                    } else {
                        alert('住所が見つかりませんでした');
                    }
                })
                .catch(() => {
                    alert('住所の取得に失敗しました');
                });
        });
    }
});
