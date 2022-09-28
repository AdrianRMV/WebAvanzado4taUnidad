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
                        <div class="col">Products</div>
                        <div class="col">
                            <button class="btn btn-primary">Añadir</button>
                        </div>
                    </div>

                    <!-- Cards-->
                    <div class="row">

                        <?php for ($i = 0; $i < 12; $i++) : ?>
                            <div class="col-md-4 col-sm-12 mb-5">
                                <div class="card" style="width: 18rem;">
                                    <img src="/public/imgs/huevo.jpg" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

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
                                                                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                                                        </div>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">@</span>
                                                                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                                                        </div>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">@</span>
                                                                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                                                        </div>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">@</span>
                                                                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
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
                                                    <a href="" class="btn btn-primary text-center w-100 mt-2">Detalle</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
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