<?php
// Slug del producto traido por url
$product_slug = $_GET['producto_slug'];

include "../app/ProductsController.php";
$productController = new ProductsController();
$productBySlug = $productController->getProductBySlug($product_slug);

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
            <div class="col py-3 px-5 mb-4">
                <section>
                    <!-- Cards-->
                    <div class="row">
                        <!-- Pregunta si existe la variable de products -->
                        <?php if (isset($productBySlug)) : ?>
                            <?php foreach ($productBySlug as $product) : ?>
                                <div class="row product_by_slug">
                                    <div class="col-3">
                                        <img src="<?= $product->cover ?>" class="card-img-top" alt="..." />
                                    </div>
                                    <div class="col text-product-slug">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title"><?= $product->name ?></h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p class="card-text"><?= $product->description ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p class="card-text">Brand id: <?= $product->brand_id ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p class="card-text">Features: <?= $product->features ?></p>
                                            </div>
                                        </div>
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


    <?php include '../layouts/scripts.template.php' ?>
</body>

</html>