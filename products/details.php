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
            <div class="col py-3">
                <section>

                    <!-- Cards-->
                    <div class="row">
                        <!-- Pregunta si existe la variable de products y si esta contiene algo -->
                        <?php if (isset($productBySlug)) : ?>
                            <?php foreach ($productBySlug as $product) : ?>
                                <div class="row">
                                    <div class="col-5">
                                        <img src="<?= $product->cover ?>" class="card-img-top" alt="..." />
                                    </div>
                                    <div class="col-7">
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