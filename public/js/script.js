var id = 0
const myModal = document.querySelector('.modal')
// const deleteButtons = document.querySelectorAll('#deleteButton')
function closeModal() {
    myModal.style.display = "none"
}
function openModal(idParam) {
    // id = idParam
    alert(idParam)
    // myModal.style.display = "flex"
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

confirmButton.addEventListener('click', (e) => {
    // e.preventDefault()
    window.location.href = `${url}?key1=value1&key2=value2`;
    closeModal();
})



