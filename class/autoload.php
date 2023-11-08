<?php /* @autor Alexis Jardin */

//! DEFINIMOS LA CLASE AUTOLOAD 
class Autoload {

    static public function loadClass($class) {
        $classArr = array();
        $from = __DIR__.DIRECTORY_SEPARATOR;

        $classArr['Database'] = $from . "database.php";
        $classArr['Categorias'] = $from . "categorias.php";
        $classArr['Productos'] = $from . "productos.php";

        if (isset($classArr[$class])) {
            if (file_exists($classArr[$class])) include $classArr[$class];
            else throw new Exception("La clase ".$classArr[$class]." es inexistente.");
        }
    }
}

spl_autoload_register('Autoload::loadClass');