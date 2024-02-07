function previewImage() {
    const image = document.querySelector('#pict');
    const imgPreview = document.querySelector('.img-preview');
    const imgUpdatePrev = document.querySelector('.img-update-prev');

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFEvent) {
        if (imgUpdatePrev) {
            imgUpdatePrev.classList.remove('d-none');
        }
        imgPreview.src = oFEvent.target.result;
    }
}