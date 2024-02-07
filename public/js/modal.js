const myModal = document.getElementById('modalcreate')
const myInput = document.getElementById('deskripsi')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})