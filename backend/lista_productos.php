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
    <main>
        <h1 class= "subt">Listado de Productos</h1>

        <!-- CREATE TABLE RENDER -->
        <div class="tabla-container">
            <table class= "tabla">
                <!-- TABLE HEAD -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Categoría</th>
                    </tr>
                </thead>
                <!-- TABLE BODY -->
                <tbody>
                    <?php
                    $rutaCarpetaImagenes = '../assets/img/'; // Ruta de la carpeta de imágenes
                    foreach ($listaProductos as $producto) {
                        $nombreImagen = $producto['imagen_producto']; // Nombre de la imagen desde la base de datos
                        $rutaCompletaImagen = $rutaCarpetaImagenes . $nombreImagen; // Ruta completa de la imagen

                        echo '<tr>';
                        echo '<td>' . $producto['id'] . '</td>';
                        echo '<td>' . $producto['nombre_producto'] . '</td>';
                        echo '<td>' . $producto['descripcion_producto'] . '</td>';
                        echo '<td>' . $producto['precio_producto'] . '</td>';
                        echo '<td><img src="' . $rutaCompletaImagen . '" alt="Imagen del producto"></td>';
                        echo '<td>' . $producto['categoria_producto'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <a href="views/productos.html?agregar">Agregar Producto</a>
    </main>

    <!-- PIÉ DE PÁGINA -->
    <footer>
        <!-- AUTOR -->
        <span class="author">Alexis Jardin</span>
    </footer>
</body>

</html>
