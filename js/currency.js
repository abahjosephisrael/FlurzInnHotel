function formatToDefaultCurrency(amount) {
    return new Intl.NumberFormat('en-NG', { style: 'currency', currency: 'NGN' }).format(amount);
}


function formatAllCurrency() {
    let currencyElements = document.getElementsByClassName("currency");
    for (let i = 0; i < currencyElements.length; i++) {
        let amount = currencyElements[i].textContent.trim();
        amount = parseFloat(amount);
        if (!isNaN(amount)) {
            currencyElements[i].textContent = formatToDefaultCurrency(amount);
        }
    }
};

window.onload = formatAllCurrency();