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
    
    function existeCategoria($data){
        $sql = 'SELECT * FROM categoria';
        foreach($this->conn->query($sql) as $key => $row){
            if($row['catId'] == $data){
                return true;
            }
            if($row['catNom'] == $data){
                return true;
            }
        }
        return false;
    }

    function adicionarCategoria(categoria $categoria) {
        $sql = "INSERT INTO categoria(catNom) VALUES(:nombre)";
        $res = $this->conn->prepare($sql);
        $res->execute(array("nombre" => $categoria->nombre));
    }
    
    function editarCategoria(categoria $categoria) {
        $sql = "UPDATE categoria SET catNom=:nombre WHERE catId = :id";
        $res = $this->conn->prepare($sql);
        $res->execute(array( "id" => $categoria->id, "nombre" => $categoria->nombre));
    }
    
    function eliminarCategoria($id) {
        $sql = "DELETE FROM categoria WHERE catId = :id";
        $res = $this->conn->prepare($sql);
        $res->execute(array("id" => $id));
    }

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
    
    function existeProducto($data){
        $sql = 'SELECT * FROM producto';
        foreach($this->conn->query($sql) as $key => $row){
            if($row['prodNom'] == $data){
                return true;
            }
            if($row['prodId'] == $data){
                return true;
            }
        }
        return false;
    }
    
    function adicionarProducto(producto $producto) {
        $sql = "INSERT INTO producto (catId,prodNom,prodCodigo,prodPrecio,prodExist)
               VALUES(:catId,:nombre,:codigo,:precio,:existencias)";
        $res = $this->conn->prepare($sql);
        $res->execute(array("catId" => $producto->catId, "nombre" => $producto->nombre,
                            "codigo" => $producto->codigo, "precio" => $producto->precio,
                            "existencias" => $producto->existencias));
    }
    
    function editarProducto(producto $producto) {
        $queryatt = "";
        $tmp["id"] = $producto->id;
        if (!$producto->catId == 0) {
            $queryatt = $queryatt . 'catId=:catId,';
            $tmp["catId"] = $producto->catId;
        }
        if (!$producto->nombre == "") {
            $queryatt = $queryatt . 'prodNom=:nombre,';
            $tmp["nombre"] = $producto->nombre;
        }
        if (!$producto->codigo == 0) {
            $queryatt = $queryatt . 'prodCodigo=:codigo,';
            $tmp["codigo"] = $producto->codigo;
        }
        if (!$producto->precio == 0) {
            $queryatt = $queryatt . 'prodPrecio=:precio,';
            $tmp["precio"] = $producto->precio;
        }
        if (!$producto->existencias == 0) {
            $queryatt = $queryatt . 'prodExist=:existencias,';
            $tmp["existencias"] = $producto->existencias;
        }
        $queryatt = rtrim($queryatt,",");
        $sql = "UPDATE producto SET {$queryatt} WHERE prodId = :id";
        $res = $this->conn->prepare($sql);
        $res->execute($tmp);
    }
    
    function eliminarProducto($id) {
        $sql = "DELETE FROM producto WHERE prodId = :id";
        $res = $this->conn->prepare($sql);
        $res->execute(array("id" => $id));
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
