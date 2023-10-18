<?php
header("Content-Type: application/json");

// Función para guardar el registro en un archivo JSON
function guardarRegistro($usuario, $contrasena) {
    // En caso de que exista el archivo json esto obtiene su contenido en el array $registros
    $registros = [];
    if (file_exists('registros.json')) {
        $json = file_get_contents('registros.json');
        $registros = json_decode($json, true);
    }

    // Esto agrega nuevos elementos al registor
    $registros[] = ['usuario' => $usuario, 'contrasena' => $contrasena];

    // Convierte el array de registros a JSON y guardar en el archivo
    $json = json_encode($registros, JSON_PRETTY_PRINT);
    if (file_put_contents('registros.json', $json) !== false) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Confirma si se dio el nombre de usuario en la peticion
    if (isset($_GET['usuario']) && isset($_GET['contrasena'])) {
        //variables que contiene el nombre de usuario y contraseña dado
        $usuario = $_GET['usuario'];
        $contrasena = $_GET['contrasena'];

        // Aca se usa la funcipn que guarda la informacion.
        $registroExitoso = guardarRegistro($usuario, $contrasena);

        if ($registroExitoso) {
            $response = array('mensaje' => "Registro exitoso para el usuario: " . $usuario);
            echo json_encode($response);
        } else {
            $errorResponse = array('error' => 'Error al registrar el usuario.');
            echo json_encode($errorResponse);
        }
    } else {
        // Si no se proporcionaron el nombre de usuario y la contraseña, mostrar un mensaje de error
        $errorResponse = array('error' => 'Por favor, proporcione un nombre de usuario y una contraseña en la solicitud.');
        echo json_encode($errorResponse);
    }
} else {
    // Si la solicitud no es GET, mostrar un mensaje de error
    $errorResponse = array('error' => 'Esta API solo admite solicitudes GET para el registro.');
    echo json_encode($errorResponse);
}
?>