const alert = document.querySelectorAll('.alert');

if (alert) {
    window.setTimeout(() => {
        document.querySelectorAll('.button-close')[0].click()
        document.querySelectorAll('.button-close')[1].click()
    }, 8000)
}