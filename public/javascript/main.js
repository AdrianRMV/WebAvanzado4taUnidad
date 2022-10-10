// Drag and drop (CREAR PRODUCTO)
const dropArea = document.querySelector('.drop-area');
const dragText = dropArea.querySelector('h2');
const button = dropArea.querySelector('.button-files');
const input = dropArea.querySelector('#input-file');
const buttonIndex = document.querySelector('#buton_agregar_modal');
let files;

button.addEventListener('click', (e) => {
    if (dropArea.classList.contains('hidden')) {
        dropArea.classList.remove('hidden');
    }
});
button.addEventListener('click', (e) => {
    input.click();
});

input.addEventListener('change', (e) => {
    files = input.files;
    dropArea.classList.add('active');
    showFile(files);
    dropArea.classList.remove('active');
});

dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('active');
    dragText.textContent = 'Suelta para subir la imagen';
});

dropArea.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dropArea.classList.remove('active');
    dragText.textContent = 'Arrasta y suelta una imagen';
});

dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    files = e.dataTransfer.files;
    showFile(files);
    dropArea.classList.remove('active');
    dropArea.classList.add('hidden');
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
    const validExtension = [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif',
    ];

    // Si es un archivo valido
    if (validExtension.includes(docType)) {
        const fileReader = new FileReader();

        fileReader.addEventListener('load', (e) => {
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
            const html = document.querySelector('#preview').innerHTML;
            document.querySelector('#preview').innerHTML = image + html;
        });

        fileReader.readAsDataURL(file[0]);
        uploadFile(file[0]);
    } else {
        // Es un formato no permitido
        // TODO: Sweet alert con formato no permitido
    }
}

async function uploadFile(file) {
    const formData = new FormData();
    formData.append('file', file);

    try {
        const response = await fetch('http://localhost:3000/upload', {
            method: 'POST',
            body: formData,
        });
        // console.log(file)
        const responseText = await response.text();
        console.log(responseText);
        document.querySelector(
            '.status-text'
        ).innerHTML = `<span class="success">Archivo subido correctamente...</span>`;
    } catch (error) {
        console.log(error);
        document.querySelector(
            '.status-text'
        ).innerHTML = `<span class="failure">No se pudo subir...</span>`;
    }
}

function deleteProduct(id) {
    Swal.fire({
        title: 'Are you sure u want to delete this product?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData();
            formData.append('id', id);
            formData.append('action', 'delete');

            axios
                .post('../../app/ProductsController.php', formData)
                .then((resp) => {
                    if (resp.data) {
                        Swal.fire(
                            'Deleted!',
                            'Your product has been deleted.',
                            'success'
                        );
                    } else {
                        swal('Error', {
                            icon: 'error',
                        });
                    }
                })
                .catch((error) => console.log(error));
        }
    });
}

function updateProduct(target) {

    let product = JSON.parse(target.dataset.product);
    
    $('#i_name').val(product.name);
    $('#i_slug').val(product.slug);
    $('#i_desc').val(product.description);
    $('#i_features').val(product.features);
    $('#i_brandId').val(product.brand_id);
    $('#id_product').val(product.id);
    $('#action').val('update');
}
