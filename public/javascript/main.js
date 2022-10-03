const dropArea = document.querySelector('.drop-area');
const dragText = dropArea.querySelector('h2');
const button = dropArea.querySelector('.button-files');
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
    files = e.dataTransfer.files;
    showFile(files);
    dropArea.classList.remove('active');
    dragText.textContent = "Arrasta y suelta una imagen";
});

function showFile(file) {
    if (file.length > 0) {
        processFile(file);
    } else {
        // Cambiar alerta por una de sweet alert\
        alert('Subir solo una imagen por favor');
    }
}

function processFile(file) {
    const docType = file[0].type;
    const validExtension = ['image/jpeg', 'image/jpg' , 'image/png', 'image/gif'];

    // Si es un archivo valido
    if (validExtension.includes(docType)){
        const fileReader = new FileReader();

        fileReader.addEventListener('load', e => {
            const fileUrl = fileReader.result;
            const image = `
                <div class="file-container">
                    <img src="${fileUrl}" alt="${file[0].name}" width="50"/>
                    <div class="status">
                        <span>${file[0].name}</span>
                        <span class="status-text">
                            Loading...
                        </span>
                    </div>
                </div>
            `;
            const html = document.querySelector("#preview").innerHTML;
            document.querySelector("#preview").innerHTML = image + html;
        });

        fileReader.readAsDataURL(file[0]);
        uploadFile(file[0]);

    } else {
        // Es un formato no permitido
        // TODO: Sweet alert con formato no permitido
    }
}

function uploadFile(file) {
    console.log("Fuap")
}