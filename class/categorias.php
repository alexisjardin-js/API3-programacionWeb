<?php /* @autor Alexis Jardin */

define("DRIVER", 'mysql');
define("DB", 'miproyecto');
define("HOST", '127.0.0.1');
define("USER", 'root');
define("PASS", '');
define("TABLE", 'categorias');

//! DEFINIMOS LA CLASE CATEGORIAS
class Categorias {

    protected $id;
    public $nombre;
    private $exists = false;
    
    //! DEFINIMOS EL CONSTRUCTOR PARA LA CREACIÓN DE OBJETOS
    function __construct($id = null) {
            $db = new Database(DRIVER, DB, HOST, USER, PASS);
            $respuesta = $db -> select(TABLE, null, null, "id=?", array($id));

            if (isset($respuesta[0]['id'])) {
                $this -> id = $respuesta[0]['id'];
                $this -> nombre = $respuesta[0]['nombre_categoria'];
                $this -> exists = true;
            }
        else return false;
    }

    //! DEFINIMOS LA FUNCIÓN PARA GUARDAR O ACTUALIZAR UNA CATEGORIA EN LA BASE DE DATOS
    public function guardar() {
        if ($this -> exists) return $this -> actualziar_categoria();
        else return $this -> insertar_categoria();
    }
    
    //! DEFINIMOS LA FUNCIÓN PARA BORRAR UNA CATEGORIA EN LA BASE DE DATOS
    public function eliminar() {
        $db = new Database(DRIVER, DB, HOST, USER, PASS);
        return $db -> delete(TABLE, "id = " . $this -> id);
    }
    
    //! DEFINIMOS LA FUNCIÓN PARA INSERTAR UNA CATEGORIA EN LA BASE DE DATOS
    private function insertar_categoria() {
        $db = new Database(DRIVER, DB, HOST, USER, PASS);
        $respuesta = $db -> insert(TABLE, "nombre_categoria","?", array($this -> nombre));

        if ($respuesta) {
            $this -> id = $respuesta;
            $this -> exists = true;
            return true;
        }
        else return false;
    }

    //! DEFINIMOS LA FUNCIÓN PARA ACTUALIZAR UNA CATEGORIA EN LA BASE DE DATOS
    private function actualziar_categoria() {
        $db = new Database(DRIVER, DB, HOST, USER, PASS);
        return $db -> update(TABLE, "nombre_categoria","?", array($this -> nombre));

    }

    //! DEFINIMOS LA FUNCIÓN PARA SELECCIONAR LA TABLA CATEGORIAS
    static public function seleccionar_categoriaTB() {
        $db = new Database(DRIVER, DB, HOST, USER, PASS);
        return $db -> select(TABLE);
    }
}