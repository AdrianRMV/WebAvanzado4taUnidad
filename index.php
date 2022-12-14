<?php 
    include '/app/config.php'
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Panel</title>
        <link rel="stylesheet" href="./public/sass/main.css" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
            crossorigin="anonymous"
        />
    </head>
    <body>
        <div class="container shadow-sm p-3 mb-5 bg-body rounded">
            <section>
                <div class="row">
                    <div class="col-md-7">
                        <img
                            src="/public/imgs/62.jpg"
                            alt=""
                            style="width: 100%"
                        />
                    </div>
                    <div
                        class="col-md-5 p-20 d-flex align-items-center justify-content-center"
                    >
                    
                    <form method="post" action="app/AuthController.php">
                            <h1 class="text-center">Login</h1>
                            <br><br>
                            <div class="mb-3">
                                <label
                                    for="exampleInputEmail1"
                                    class="form-label"
                                    >Email address</label
                                >
                                <input
                                    type="email"
                                    class="form-control"
                                    id="exampleInputEmail1"
                                    aria-describedby="emailHelp"
                                    name="email"
                                    required
                                />
                                <div id="emailHelp" class="form-text">
                                    We'll never share your email with anyone
                                    else.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label
                                    for="exampleInputPassword1"
                                    class="form-label"
                                    >Password</label
                                >
                                <input
                                    type="password"
                                    class="form-control"
                                    id="exampleInputPassword1"
                                    name="password"
                                    required
                                />
                            </div>
                            <div class="mb-3 form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="exampleCheck1"
                                />
                                <label
                                    class="form-check-label"
                                    for="exampleCheck1"
                                    >Check me out</label
                                >
                            </div>
                            <button type="submit" class="btn btn-success">
                                Entrar
                            </button>
                            <input type="hidden" name="action" value="access">
                            <input type="hidden" id="super_token" value="<?= $_SESSION['super_token'] ?>">

                        </form>
                    </div>
                </div>
            </section>
        </div>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
