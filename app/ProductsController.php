<?php

include_once "config.php";

if (isset($_POST["action"])) {
    switch ($_POST['action']) {
        case 'create':
            if (isset($_FILES['imagen']['name']) && isset($_FILES['imagen']['type']) && isset($_FILES['imagen']['size'])) {
                $nombre_imagen = $_FILES['imagen']['name'];
                $tipo_imagen = $_FILES['imagen']['type'];
                $tamanio_imagen = $_FILES['imagen']['size'];

                // Ruta de destino en el servidor
                $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/public/javascript/images/';

                // Movemos la imagen del directorio temporal al directorio escogido
                move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $nombre_imagen);

                $nombre_producto = strip_tags($_POST['product_name']);
                $descripcion_producto = strip_tags($_POST['product_description']);
                $features_producto = strip_tags($_POST['product_features']);
                $slug_producto = strip_tags($_POST['product_slug']);
                $slug_producto = preg_replace('/[^A-Za-z0-9-]+/', '-', $name);
                $slug_producto = strtolower($slug_producto);

                $brand_id = strip_tags($_POST['brand_id']);
                $productsController = new ProductsController();
                $productsController->createProduct($nombre_producto, $descripcion_producto, $features_producto, $slug_producto, $brand_id, $carpeta_destino, $nombre_imagen);
            }

            break;

        case 'update':
            $nombre_producto = strip_tags($_POST['product_name']);
            $descripcion_producto = strip_tags($_POST['product_description']);
            $slug_producto = strip_tags($_POST['product_slug']);
            $features_producto = strip_tags($_POST['product_features']);
            $brand_id = strip_tags($_POST['brand_id']);
            $id = strip_tags($_POST['id']);

            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $name);
            $slug = strtolower($slug);

            $productsController = new ProductsController();
            $productsController->updateProduct($name, $slug, $description, $features, $brand_id, $id);

            break;

        case 'delete':
            $id = strip_tags($_POST['id']);
            $productsController = new ProductsController();
            echo json_encode($productsController->deleteProductById($id));

            break;
    }
}

class ProductsController
{
    public function getProducts()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token']
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);

        if (isset($response->code) && $response->code > 0) {

            return $response->data;
        } else {

            return array();
        }
    }

    public function getProductBySlug($slug)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/categories/' . $slug,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token']
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);

        if (isset($response->code) && $response->code > 0) return $response->data->products;
        else return array();
    }

    public function deleteProductById($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token']
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        if (isset($response->code) && $response->code > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function createProduct($nombre, $slug, $description, $features, $brand_id, $carpeta_destino, $nombre_imagen)
    {
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
            CURLOPT_POSTFIELDS => array('name' => $nombre, 'slug' => $slug, 'description' => $description, 'features' => $features, 'brand_id' => $brand_id, 'cover' => new CURLFILE($carpeta_destino . $nombre_imagen)),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token']
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response);

        if (isset($response->code) && $response->code > 0) {
            header("Location:" . BASE_PATH . "products?" . $response->message);
        } else {
            header("Location:" . BASE_PATH . "products?" . $response->message);
        }
    }

    public function updateProduct($name, $slug, $description, $features, $brand_id, $id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => 'name=' . $name . '&slug=' . $slug . '&description=' . $description . '&features=' . $features . '&brand_id=' . $brand_id . '&id=' . $id,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token'],
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        if (isset($response->code) && $response->code > 0) {
            header("Location:" . BASE_PATH . "products?success");
        } else {
            header("Location:" . BASE_PATH . "products?error");
        }
    }
}
