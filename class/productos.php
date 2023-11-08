<?php /* @autor Alexis Jardin */

define("DRIVER", 'mysql');
define("DB", 'miproyecto');
define("HOST", '127.0.0.1');
define("USER", 'root');
define("PASS", '');
define("TABLE", 'productos');

//! DEFINIMOS LA CLASE PRODUCTOS
class Productos {

    protected $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $categoria;
    public $imagen;
    private $exists = false;

    //! DEFINIMOS EL CONSTRUCTOR PARA LA CREACIÓN DE OBJETOS
    function __construct($id = null) {
        $db = new Database(DRIVER, DB, HOST, USER, PASS);
        $respuesta = $db -> select(TABLE, null, null, "id=?", array($id));
    

        if(isset($respuesta[0]['id'])) {
            $this -> id = $respuesta[0]['id'];
            $this -> nombre = $respuesta[0]['nombre_producto'];
            $this -> descripcion = $respuesta[0]['descripcion_producto'];
            $this -> precio = $respuesta[0]['precio_producto'];
            $this -> categoria = $respuesta[0]['categoria_producto'];
            $this -> imagen = $respuesta[0]['imagen_producto'];
            $this -> exists = true;
        }
        else return false;
    }
    
    //! DEFINIMOS LA FUNCIÓN PARA GUARDAR O ACTUALIZAR UN PRODUCTO EN LA BASE DE DATOS
    public function guardar() {
        if ($this -> exists) return $this -> actualizar_producto();
        else return $this -> insertar_producto();
    }
    
    //! DEFINIMOS LA FUNCIÓN PARA BORRAR UN PRODUCTO EN LA BASE DE DATOS
    public function eliminar() {
        $db = new Database(DRIVER, DB, HOST, USER, PASS);
        return $db -> delete(TABLE, "id = " . $this -> id);
    }

    //! DEFINIMOS LA FUNCIÓN PARA INSERTAR UN PRODUCTO EN LA BASE DE DATOS
    private function insertar_producto() {
        $db = new Database(DRIVER, DB, HOST, USER, PASS);
        $respuesta = $db -> insert(TABLE,
        "nombre_producto, descripcion_producto, precio_producto, categoria_producto, imagen_producto","?, ?, ?, ?, ?",array($this -> nombre, $this -> descripcion, $this -> precio, $this -> categoria, $this -> imagen));
        
        if ($respuesta) {
            $this -> id = $respuesta;
            $this -> exists = true;
            return true;
        }
        else return false;
    }
    
    //! DEFINIMOS LA FUNCIÓN PARA ACTUALIZAR UN PRODUCTO EN LA BASE DE DATOS
    private function actualizar_producto() {
        $db = new Database(DRIVER, DB, HOST, USER, PASS);
        return $db -> update(TABLE,
        "nombre_producto, descripcion_producto, precio_producto, categoria_producto, imagen_producto","?","?","?","?","?",array($this -> nombre, $this -> descripcion, $this -> precio, $this -> categoria, $this -> imagen));
    }
    
    //! DEFINIMOS LA FUNCIÓN PARA SELECCIONAR LA TABLA PRODUCTOS
    //static public function product_select() {
        //$db = new Database(DRIVER, DB, HOST, USER, PASS);
        
       
     
       //return $db -> select("productos");
    //}
    //! DEFINIMOS LA FUNCIÓN PARA SELECCIONAR LA TABLA PRODUCTOS
    static public function seleccionar_productosTB() {
        $db = new Database(DRIVER, DB, HOST, USER, PASS);
        $join = 'categorias ON categorias.id = productos.categoria_producto';
        $columns = array(
            "productos.id",
            "productos.nombre_producto",
            "productos.descripcion_producto",
            "productos.precio_producto",
            "productos.imagen_producto",
            "categorias.nombre_categoria",
        );
        return $db -> select(TABLE, $columns, $join);
    }


}