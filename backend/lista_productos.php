<?php 
include '../class/autoload.php';
$listaProductos = Productos::seleccionar_productosTB();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Listado de Productos</title>
    <link rel="stylesheet" href="../assets/css/estilos.css" />
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <ul class="nav-links">
                    <li><a href="./lista_productos.php">Home</a></li>
                    <li><a href="./lista_categorias.php">Lista de Categorias</a></li>
                    <li><a href="./lista_productos.php">Lista de Productos</a></li>
                    <li><a href="./views/categorias.html">Registrar Nueva Categoria</a></li>
                    <li><a href="./views/productos.html">Registrar Nuevo Producto</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <h1 class= "subt">Listado de Productos</h1>
        <div class="tabla-container">
            <table class= "tabla">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Categoría</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rutaCarpetaImagenes = '../assets/img/'; // Ruta de la carpeta de imágenes
                    foreach ($listaProductos as $producto) {
                        $nombreImagen = $producto['imagen_producto']; // Nombre de la imagen desde la base de datos
                        $rutaCompletaImagen = $rutaCarpetaImagenes . $nombreImagen; // Ruta completa de la imagen

                        echo '<tr>';
                        echo '<td>' . $producto['nombre_producto'] . '</td>';
                        echo '<td>' . $producto['descripcion_producto'] . '</td>';
                        echo '<td><img src="' . $rutaCompletaImagen . '" alt="Imagen del producto"></td>';
                        echo '<td>' . $producto['nombre_producto'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <a href="views/productos.html?agregar">Agregar Producto</a>
    </main>
    <footer>
        <span class="author">Alexis Jardin</span>
    </footer>
</body>

</html>
