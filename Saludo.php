<?php
// La cabezara  que indica que la respuesta va ser en formato json
header("Content-Type: application/json");

//Confirma que se proporciona la peticion con nombre
if (isset($_GET['nombre'])) {
    //variabe que almacena el nombre dado
    $nombre = $_GET['nombre'];
    //variable que almazena el saludo con el nombre personalizado
    $saludo = "¡Hola " . $nombre . "!";
    
    // Arreglo asociativo para poder mostrar la respuesta json
    $response = array('mensaje' => $saludo);

    // codifica la respeuesta y la envia
    echo json_encode($response);
} else {
    // Si no se proporciona un nombre en la consulta, mostrar un mensaje de error en JSON
    $errorResponse = array('error' => 'Por favor, proporciona un nombre en la consulta.');
    echo json_encode($errorResponse);
}
?>
