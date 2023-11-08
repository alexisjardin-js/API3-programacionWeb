<?php

include '../class/autoload.php';

if (isset($_POST['action']) && $_POST['action'] == 'guardar') {
    $nuevoProducto = new Productos();
    $nuevoProducto->nombre = $_POST['nombre_producto'];
    $nuevoProducto->descripcion = $_POST['descripcion_producto'];
    $nuevoProducto->precio = $_POST['precio_producto'];
    $nuevoProducto->categoria = $_POST['categoria_producto'];

    // PROCESAR LA IMAGEN
    if ($_FILES['imagen_producto']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['imagen_producto']['name'];
        $rutaTempArchivo = $_FILES['imagen_producto']['tmp_name'];
        $rutaDestino = '../../img/' . $nombreArchivo;

        if (move_uploaded_file($rutaTempArchivo, $rutaDestino)) {
            $nuevoProducto->imagen = $nombreArchivo;
        }
    }

    $nuevoProducto->guardar();

    header("Location: lista_productos.php");
    exit;

} elseif (isset($_GET['add'])) {
    include 'views/productos.html';
    die();
}

