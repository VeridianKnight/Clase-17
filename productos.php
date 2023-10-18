<?php
header("Content-Type: text/html");

// Creo un arry de productos random para demostrar el uso
$productos = [
    [
        "nombre" => "Producto 1",
        "descripcion" => "Descripción del Producto 1",
        "precio" => 10.99
    ],
    [
        "nombre" => "Producto 2",
        "descripcion" => "Descripción del Producto 2",
        "precio" => 19.99
    ],
    [
        "nombre" => "Producto 3",
        "descripcion" => "Descripción del Producto 3",
        "precio" => 15.49
    ],
    [
        "nombre" => "Producto 4",
        "descripcion" => "Descripción del Producto 4",
        "precio" => 7.99
    ],
    [
        "nombre" => "Producto 5",
        "descripcion" => "Descripción del Producto 5",
        "precio" => 25.99
    ]
];

//muestra en pantalla los productos
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //creo una tabla mara mostrarlos un poco mas estetico
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Lista de Productos</title>
    </head>
    <body>
        <h1>Lista de Productos</h1>
        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
            </tr>';
    
    foreach ($productos as $producto) {
        echo '<tr>';
        echo '<td>' . $producto['nombre'] . '</td>';
        echo '<td>' . $producto['descripcion'] . '</td>';
        echo '<td>' . $producto['precio'] . '</td>';
        echo '</tr>';
    }
    
    echo '</table>
    </body>
    </html>';
} else {
    // Si la solicitud no es GET, muestra un  mensaje de error
    $errorResponse = array('error' => 'Esta API solo admite solicitudes GET para ver la lista de productos.');
    echo json_encode($errorResponse);
}
?>
