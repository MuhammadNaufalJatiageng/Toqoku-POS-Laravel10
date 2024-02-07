const btn = document.querySelector('.btn-destroy');
const destroyForm = document.querySelector('#destroy-form');

btn.addEventListener('click', (e) => {
    e.preventDefault();
    destroyForm.submit();
});