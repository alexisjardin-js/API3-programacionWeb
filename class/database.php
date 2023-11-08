<?php /* @autor Alexis Jardin */

//! DEFINIMOS LA CLASE BASE DE DATOS
class Database {
    private $gbd;

    //! DEFINIMOS FUNCIÓN PARA ESTABLECER CONEXIÓN DB
    function __construct($driver, $database, $host, $user, $pass) {
        $coneccion = $driver . ":dbname=" . $database . ";host=$host";
        $this -> gbd = new PDO($coneccion, $user, $pass);

        if (!$this -> gbd) throw new Exception("No se ha podido realizar la conexión.\n\n
        Revisar:\n\t- Parámetros de acceso;\n\t- Credenciales.");
    }

    // ********************** CONSULTAS SQL BÁSICAS **********************
    
    //! DEFINIMOS FUNCIÓN SELECT PARA EXTRAER DATOS DE LA BASE DE DATOS
    function select($tabla, array $columns = null, $join = null, $condicion = null, $arr_prepare = null, $order = null, $limit = null) {
        $columnSelection = '*';

        $sql = "SELECT " . $columnSelection . " FROM " . $tabla;

        if ($join != null) $sql .= " INNER JOIN " . $join;
        if ($condicion != null) $sql .= " WHERE " . $condicion;
        if ($order != null) $sql .= " ORDER BY " . $order;
        if ($limit != null) $sql .= " LIMIT " . $limit;
        
        $recurso = $this -> gbd -> prepare($sql);
        $recurso -> execute($arr_prepare);

        if ($recurso) return $recurso -> fetchAll(PDO::FETCH_ASSOC);
        else {
            echo '<pre>';
            print_r($this -> gbd -> errorInfo());
            echo '</pre>';

            throw new Exception('No se ha podido realizar la consulta.');
        }
    }
    
    //! DEFINIMOS FUNCIÓN DELETE PARA ELIMINAR DATOS DE LA BASE DE DATOS
    function delete($tabla, $condicion = null, $arr_prepare = null) {
        $sql = "DELETE FROM " . $tabla . " WHERE " . $condicion;

        $recurso = $this -> gbd -> prepare($sql);
        $recurso -> execute($arr_prepare);
        
        if ($recurso) return $recurso -> fetchAll(PDO::FETCH_ASSOC);
        else {
            echo '<pre>';
            print_r($this -> gbd -> errorInfo());
            echo '</pre>';

            throw new Exception('Error al remover los datos.');
        }
    }

    //! DEFINIMOS FUNCIÓN INSERT PARA AGREGAR NUEVOS DATOS A LA BASE DE DATOS
    function insert($tabla, $campos, $valores, $arr_prepare = null) {
        $sql = "INSERT INTO " . $tabla . "(" . $campos . ") VALUES ($valores)";

        $recurso = $this -> gbd -> prepare($sql);
        $recurso -> execute($arr_prepare);

        if ($recurso) {
            $this -> gbd -> lastInsertId();
            return $recurso -> fetchAll(PDO::FETCH_ASSOC);
        }
        else {
            echo '<pre>';
            print_r($this -> gbd -> errorInfo());
            echo '</pre>';

            throw new Exception('Error al insertar los datos.');
        }
    }

    //! DEFINIMOS FUNCIÓN UPDATE PARA MODIFICAR DATOS EXISTENTES EN LA BASE DE DATOS
    function update($tabla, $campo, $valor, $condicion, $arr_prepare = null) {
        $sql = "UPDATE " . $tabla . " SET " . $campo . ' = ' . $valor . " WHERE " . $condicion;

        $recurso = $this -> gbd -> prepare($sql);
        $recurso -> execute($arr_prepare);

        if ($recurso) {
            return $recurso -> fetchAll(PDO::FETCH_ASSOC);
        }
        else {
            echo '<pre>';
            print_r($this -> gbd -> errorInfo());
            echo '</pre>';

            throw new Exception('Error al actualizar los datos.');
        }
    }
}