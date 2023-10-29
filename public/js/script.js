var id = null
var url = '/home/delete/'
const myModal = document.querySelector('.modal')
const deleteForm = document.querySelector('form')
// const deleteButtons = document.querySelectorAll('#deleteButton')
function closeModal() {
    myModal.style.display = "none"
}
function openModal(idData) {
    id = idData
    myModal.style.display = "flex"
    deleteForm.setAttribute("action", url + id)
    // console.log(url + id)
    alert(deleteForm.getAttribute("action"))
}
// deleteButtons.forEach(element => {
//     element.addEventListener('click', (e) => {
//         e.preventDefault()
//         myModal.style.display = "flex"
//     })
// });

const cancelButton = document.querySelector('.cancel')
const confirmButton = document.querySelector('.confirm')

cancelButton.addEventListener('click', (e) => {
    // e.preventDefault()
    // alert('mantapbos')
    closeModal();
})

// confirmButton.addEventListener('click', (e) => {
//     // e.preventDefault()
//     // window.location.href = ``;
//     closeModal();
// })



