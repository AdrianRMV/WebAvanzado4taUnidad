const dropArea = document.querySelector('.drop-area');
const dragText = dropArea.querySelector('h2');
const button = dropArea.querySelector('button');
const input = dropArea.querySelector('#input-file');
let files;

button.addEventListener('click', (e) => {
    input.click();
});

input.addEventListener('change', (e) => {
    files = this.files;
    dropArea.classList.add('active');
    showFile(file);
    dropArea.classList.remove('active');
});

dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('active');
    dragText.textContent = "Suelta para subir la imagen";
});

dropArea.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dropArea.classList.remove('active');
    dragText.textContent = "Arrasta y suelta una imagen";
    

});
dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.classList.remove('active');
    dragText.textContent = "Arrasta y suelta una imagen";
});

function showFile(file) {
    if (file.length === undefined) {
        processFile(file);
    } else {
        // Cambiar alerta por una de sweet alert\
        alert('Subir solo una imagen por favor');
    }
}

function processFile(file) {}
