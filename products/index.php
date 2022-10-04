<?php
include "../app/ProductsController.php";
$productController = new ProductsController();
$products = $productController->getProducts();

if (isset($_POST['add_product'])) {
    if (isset($_FILES['imagen']['name']) && isset($_FILES['imagen']['type']) && isset($_FILES['imagen']['size'])) {
        $nombre_imagen = $_FILES['imagen']['name'];
        $tipo_imagen = $_FILES['imagen']['type'];
        $tamanio_imagen = $_FILES['imagen']['size'];

        // Ruta de destino en el servidor
        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/public/javascript/images/';

        // Movemos la imagen del directorio temporal al directorio escogido
        move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $nombre_imagen);

        // Post to api
        // TODO: Traer info de los inputs (name, description, slug, etc)
        $nombre_producto = $_POST['product_name'];
        $descripcion_producto = $_POST['product_description'];
        $features_producto = $_POST['product_features'];
        $slug_producto = $_POST['product_slug'];
        $brand_id = $_POST['brand_id'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => $nombre_producto, 'slug' => $slug_producto, 'description' => $descripcion_producto, 'brand_id' => $brand_id, 'cover' => new CURLFILE($carpeta_destino . $nombre_imagen)),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token']
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    } else {
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<?php include '../layouts/head.template.php' ?>

<body>

    <?php include '../layouts/nav.template.php' ?>

    <!-- Main content -->
    <main class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include '../layouts/sidebar.template.php' ?>

            <!-- Cards -->

            <div class="col py-3">
                <section>
                    <div class="row p-5">
                        <div class="col">
                            <h1>Productos</h1>
                        </div>
                        <div class="col">
                            <!-- <button class="btn btn-primary">Añadir</button> -->
                            <span style="padding-right: 10px;">Añadir nuevo producto</span>

                            <button id="buton_agregar_modal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AñadirModal">
                                Añadir
                            </button>

                            <!-- Modal para añadir producto -->
                            <div class="modal fade" id="AñadirModal" tabindex="-1" aria-labelledby="AñadirModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="AñadirModalLabel">Añadir producto</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form enctype="multipart/form-data" method="post">
                                            <div class="modal-body">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Product name</span>
                                                    <input name="product_name" type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Description</span>
                                                    <input name="product_description" type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Features</span>
                                                    <input name="product_features" type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Slug</span>
                                                    <input name="product_slug" type="text" class="form-control" placeholder="product-name-simple_description">
                                                </div>
                                                <!-- Brand id por defecto siempre sera tendra el valor de 1 -->
                                                <input type="hidden" name="brand_id" value="1">

                                                <div class="drop-area">
                                                    <h2>Arrastra y suelta imágenes</h2>
                                                    <span>o</span>
                                                    <div class="button-files">Selecciona tus archivos</div>
                                                    <input type="file" id="input-file" hidden name="imagen">
                                                </div>
                                                <div id="preview"></div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="sumbit" class="btn btn-primary add_product_button" data-bs-dismiss="modal" name="add_product">Aceptar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cards-->
                    <div class="row">

                        <!-- Pregunta si existe la variable de products y si esta contiene algo -->
                        <?php if (isset($products) && count($products)) : ?>
                            <!-- Loop for each para cada producto -->
                            <?php foreach ($products as $product) : ?>

                                <div class="col-md-4 col-sm-12 mb-5">
                                    <div class="card" style="width: 18rem;">
                                        <img src="<?= $product->cover ?>" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $product->name ?></h5>
                                            <p class="card-text"><?= $product->description ?></p>

                                            <div class="buttons-card">

                                                <div class="row">
                                                    <!-- Editar Button -->
                                                    <div class="col-6 w-50">
                                                        <button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                            Editar
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="">
                                                                        <div class="modal-body">
                                                                            <div class="input-group mb-3">
                                                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                                                <input type="text" class="form-control" placeholder="Username">
                                                                            </div>
                                                                            <div class="input-group mb-3">
                                                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                                                <input type="text" class="form-control" placeholder="Username">
                                                                            </div>
                                                                            <div class="input-group mb-3">
                                                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                                                <input type="text" class="form-control" placeholder="Username">
                                                                            </div>
                                                                            <div class="input-group mb-3">
                                                                                <span class="input-group-text" id="basic-addon1">@</span>
                                                                                <input type="text" class="form-control" placeholder="Username">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Eliminar -->
                                                    <div class="col-6 w-50">
                                                        <!-- Aceptar Button -->
                                                        <button type="button" class="btn btn-danger  w-100" id="delete-button">
                                                            Eliminar
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <a href="details/product_<?=$product->slug?>" class="btn btn-primary text-center w-100 mt-2">Detalle</a>
                                                        <!-- <a href="details/" class="btn btn-primary text-center w-100 mt-2">Detalle</a> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!-- Sweet alert  -->
    <script type="text/javascript">
        const deleteButton = document.getElementById('delete-button');

        deleteButton.addEventListener('click', () => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <?php include '../layouts/scripts.template.php' ?>
</body>

</html>