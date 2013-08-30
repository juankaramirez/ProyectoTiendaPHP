<?php
class producto {

    var $id = 0;
    var $catId = 0;
    var $nombre = "";
    var $codigo = 0;
    var $precio = 0;
    var $existencias = 0;
    
    function __construct($id, $catId, $nombre, $codigo, $precio, $existencias) {
        $this->id = $id;
        $this->catId = $catId;
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->precio = $precio;
        $this->existencias = $existencias;
    }

}

class categoria {

    var $id = 0;
    var $nombre = "";

    function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

}

class database {

    private $conn = null;

    function __construct() {
        $this->conn = new PDO('sqlite:../db/EsquemaTienda.sqlite');
    }
    
    function existeCategoria($nombre){
        $sql = 'SELECT * FROM categoria';
        $cond = false;
        foreach($this->conn->query($sql) as $key => $row){
            if($row['catNom'] == $nombre){
                $cond = true;
            }
        }
        return $cond;
    }

    function adicionarCategoria(categoria $categoria) {
        $sql = "INSERT INTO categoria(catNom) VALUES(:nombre)";
        $res = $this->conn->prepare($sql);
        $res->execute(array("nombre" => $categoria->nombre));
    }
    
    /*function modificarCategoria($id,$nombre) {
        $sql = "UPDATE categoria SET nombre=:nombre WHERE id = :id";
        $res = $this->conn->prepare($sql);
        $res->execute(array( "id" => $id, "nombre" => $nombre));
    }*/

    function obtenerTodoCategoria() {
        $sql = "SELECT * FROM categoria";
        $tmp = array();
        foreach ($this->conn->query($sql) as $key => $value) {
            array_push($tmp, new categoria($value["catId"], $value["catNom"]));
        }
        return $tmp;
    }

    function obtenerCategoria($id) {
        $sql = 'SELECT * FROM categoria where catId = :id';
        $res = $this->conn->prepare($sql);
        $res->execute(array('id' => $id));
        //$tmp = $this->conn->query($sql);
        $tmp = $res->fetchAll();
        if (is_array($tmp)) {
            foreach($tmp as $row){
                $categoria = new categoria($row["catId"], $row["catNom"]);
            }
            return $categoria;
        } else {
            return false;
        }
    }
    
    function existeProducto($nombre){
        $sql = 'SELECT * FROM categoria';
        $cond = false;
        foreach($this->conn->query($sql) as $key => $row){
            if($row['catNom'] == $nombre){
                $cond = true;
            }
        }
        return $cond;
    }
    
    function adicionarProducto(producto $producto) {
        $sql = "INSERT INTO producto (catId,prodNom,prodCodigo,prodPrecio,prodExist)
               VALUES(:catId,:nombre,:codigo,:precio,:existencias)";
        $res = $this->conn->prepare($sql);
        $res->execute(array("catId" => $producto->catId, "nombre" => $producto->nombre,
                            "codigo" => $producto->codigo, "precio" => $producto->precio,
                            "existencias" => $producto->existencias));
    }
    
    
    function obtenerTodoProducto() {
        $sql = "SELECT * FROM producto";
        $tmp = array();
        foreach ($this->conn->query($sql) as $key => $value) {
            array_push($tmp, new producto($value["prodId"], $value["catId"],
                                           $value["prodNom"], $value["prodCodigo"],
                                           $value["prodPrecio"], $value["prodExist"]));
        }
        return $tmp;
    }
}

$db = new database();

?>
