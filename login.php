<?php
header("Content-Type: application/json");

// Verifica los datos de inicio de sesion dado los datos guardados en el json
//para probar la convinacion usuario=miusuario&contrasena=micontrasena y usuario=miusuario2&contrasena=micontrasena2 ya estan guardados dentro del archivo
function verificarInicioSesion($usuario, $contrasena) {
    // Lee el contenido del json
    $registros = [];
    if (file_exists('registros.json')) {
        $json = file_get_contents('registros.json');
        $registros = json_decode($json, true);
    }

    // verifica que la convinacion contraseña usuario esten en el json
    foreach ($registros as $registro) {
        if ($registro['usuario'] === $usuario && $registro['contrasena'] === $contrasena) {
            return true;
        }
    }

    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // confirma si se dieron los datos necesarios para la peticion
    if (isset($_GET['usuario']) && isset($_GET['contrasena'])) {
        // Variables que contienen el nombre de usuario y contraseña dado
        $usuario = $_GET['usuario'];
        $contrasena = $_GET['contrasena'];

        // Aca se usa la función que verifica el inicio de sesiónsesion
        $inicioSesionExitoso = verificarInicioSesion($usuario, $contrasena);

        if ($inicioSesionExitoso) {
            $response = array('mensaje' => 'Inicio de sesion exitoso para el usuario ' . $usuario . '');
            echo json_encode($response);
        } else {
            $errorResponse = array('error' => 'Inicio de sesión fallido. Verifica las credenciales.');
            echo json_encode($errorResponse);
        }
    } else {
        // Si no se proporcionaron el nombre de usuario y la contraseña, muestra este mensaje de error
        $errorResponse = array('error' => 'Por favor, proporciona un nombre de usuario y una contraseña en la solicitud.');
        echo json_encode($errorResponse);
    }
} else {
    // Si la solicitud no es GET, muestra este mensaje de error
    $errorResponse = array('error' => 'Esta API solo admite solicitudes GET para el inicio de sesión.');
    echo json_encode($errorResponse);
}
?>
