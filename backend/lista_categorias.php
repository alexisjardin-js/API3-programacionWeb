<?php
include '../class/autoload.php';
$listaCategorias = Categorias::seleccionar_categoriaTB();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Listado de Categorías</title>
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
        <h1 class="subt" >Listado de Categorías</h1>
        <div class="tabla">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($listaCategorias as $categoria) { ?>
                    <tr>
                        <td>
                            <?php echo $categoria['id'] ?>
                        </td>
                        <td>
                            <?php echo $categoria['nombre_categoria'] ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <a href="views/categorias.html?agregar">Agregar Categoría</a>
    </main>
    <footer>
        <span class="author">Alexis Jardin</span>
    </footer>
</body>

</html>