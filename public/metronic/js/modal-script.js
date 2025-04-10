let modalOpened = false

function openModal(id) {
    if(modalOpened == false) {
        console.log(id);
        document.getElementById(id).style.display = 'block';
        modalOpened = true;
    }
}

function closeModal(id) {
    document.getElementById(id).style.display = 'none';
    modalOpened = false;
}
