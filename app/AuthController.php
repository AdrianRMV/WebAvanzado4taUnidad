<?php
// Valores que se mandan por POST
if (isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case "access":
            // Limpiamos los parametros
            $email = strip_tags($_POST["email"]);
            $password = strip_tags($_POST["password"]);

            $authController = new AuthController();
            $authController -> login($email, $password);
            break;
    }
} else {
    echo "Error";
}

class AuthController
{
    public function login($email, $password)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('email' => $email, 'password' => $password),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        // Convertir la respuesta de texto plano a JSON
        $response = json_decode($response);


        if (isset($response->code) && $response->code > 0) {
            session_start();
            $_SESSION['id'] = $response->data->id;
            $_SESSION['nombre'] = $response->data->nombre;
            $_SESSION['lastname'] = $response->data->lastname;
            $_SESSION['avatar'] = $response->data->avatar;
            $_SESSION['role'] = $response->data->role;
            $_SESSION['token'] = $response->data->token;
            header("Location:../products?success");
        } else {
            header("Location:../?error");
            $error = "Usuario o contraseña incorrectas";
        }
    }
}
