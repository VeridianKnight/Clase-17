<?php
// Cabezera que especifica el formato json
header("Content-Type: application/json");

// Checkea por los parametros requeridos en la peticion
if (isset($_GET['cantidad']) && isset($_GET['moneda_origen']) && isset($_GET['moneda_destino'])) {
    // variable que contiene los parametros de cantidad y nombre de la moneda
    $cantidad = floatval($_GET['cantidad']);
    // Puse en mayuscula los nombre de las monedas para que el codigo funcione sin importar como lo escribio el usuario
    $moneda_origen = strtoupper($_GET['moneda_origen']);
    $moneda_destino = strtoupper($_GET['moneda_destino']);

    // los porcentages para la convercion
    $tasa_usd_a_eur = 0.8417;
    $tasa_eur_a_usd = 1.1886;

    // Manejador para la convercion
    if ($moneda_origen === "USD" && $moneda_destino === "EUR") {
        $resultado = $cantidad * $tasa_usd_a_eur;
    } elseif ($moneda_origen === "EUR" && $moneda_destino === "USD") {
        $resultado = $cantidad * $tasa_eur_a_usd;
    } else {
        echo "Las monedas proporcionadas no son válidas. Utilice USD o EUR.";
        exit();
    }

    //  respuesta mostrando la convercion
    $response = array(
        'cantidad' => $cantidad,
        'moneda_origen' => $moneda_origen,
        'moneda_destino' => $moneda_destino,
        'resultado' => number_format($resultado, 2)
    );

    echo json_encode($response);
} else {
    echo "Por favor, proporcione la cantidad, la moneda de origen y la moneda de destino en la consulta, por ejemplo: ";
    echo "localhost/...(resto del enlace).../cantidad.php/conversion?cantidad=100&moneda_origen=USD&moneda_destino=EUR";
}
?>
