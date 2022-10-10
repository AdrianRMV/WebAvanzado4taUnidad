<?php
include "../app/config.php";
include "../app/ProductsController.php";

$productController = new ProductsController();
$products = $productController->getProducts();

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

                                        <!-- FORM -->
                                        <form enctype="multipart/form-data" method="post" action="../app/ProductsController.php">
                                            <div class="modal-body">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Product name</span>
                                                    <input id="i_name" name="product_name" type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Description</span>
                                                    <input id="i_desc" name="product_description" type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Features</span>
                                                    <input id="i_features" name="product_features" type="text" class="form-control">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Slug</span>
                                                    <input id="i_slug" name="product_slug" type="text" class="form-control" placeholder="product-name-simple_description">
                                                </div>
                                                <!-- Brand id por defecto siempre sera tendra el valor de 1 -->
                                                <input id="i_brandId" type="hidden" name="brand_id" value="1">

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
                                                <input type="hidden" id="action" name="action" value="create">
                                                <input type="hidden" id="id_product" name="id">
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
                                                        <button id="btn-editar" data-product='<?=json_encode($product)?>' onclick="updateProduct(this)" type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#AñadirModal">
                                                            Editar
                                                        </button>
                                                    </div>

                                                    <!-- Eliminar -->
                                                    <div class="col-6 w-50">
                                                        <button type="button" onclick="deleteProduct(<?= $product->id ?>)" class="btn btn-danger w-100 delete-button id_<?= $product->id ?>">
                                                            Eliminar
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <a href="details/product_<?= $product->slug ?>" class="btn btn-primary text-center w-100 mt-2">Detalle</a>
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

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php include '../layouts/scripts.template.php' ?>
</body>

</html>