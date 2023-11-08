<?php

include '../class/autoload.php';

if (isset($_POST['action']) && $_POST['action'] == 'guardar') {
    $nuevaCategoria = new Categorias();
    $nuevaCategoria -> nombre = $_POST['nombre_categoria'];
    $nuevaCategoria -> guardar();
}
else if (isset($_GET['add'])) {
    include 'views/categorias.html';
    die();
}

header("Location: lista_categorias.php");
exit;
