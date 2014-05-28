<?php

//Prueba
class producto {

    var $id = 0;
    var $catId = 0;
    var $nombre = "";
    var $codigo = 0;
    var $precio = 0;
    var $existencias = 0;
    var $descripcion = "";
    var $urls = "";
    var $urlt = "";

    function __construct($id, $catId, $nombre, $codigo, $precio, $existencias, $descripcion, $urls, $urlt) {
        $this->id = $id;
        $this->catId = $catId;
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->precio = $precio;
        $this->existencias = $existencias;
        $this->descripcion = $descripcion;
        $this->urls = $urls;
        $this->urlt = $urlt;
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

class admin {

    var $id = 0;
    var $username = "";
    var $password = "";
    var $nombre = "";
    var $apellido = "";

    function __construct($id, $username, $password, $nombre, $apellido) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

}

class databaseAdmin {

    private $conn = null;

    function __construct() {
        $this->conn = new PDO('sqlite:../db/EsquemaTienda.sqlite');
    }

    function obtenerAdmin($usrnm) {
        $sql = 'SELECT adminNom FROM admin WHERE adminUsername=:usrnm';
        $res = $this->conn->prepare($sql);
        $res->execute(array("usrnm" => $usrnm));
        $tmp = $res->fetchAll();
        foreach ($tmp as $key => $row) {
            return $row['adminNom'];
        }
        return false;
    }

    function existeCategoria($data) {
        $sql = 'SELECT * FROM categoria';
        foreach ($this->conn->query($sql) as $key => $row) {
            if ($row['catId'] == $data) {
                return true;
            }
            if ($row['catNom'] == $data) {
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
        $res->execute(array("id" => $categoria->id, "nombre" => $categoria->nombre));
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
            foreach ($tmp as $row) {
                $categoria = new categoria($row["catId"], $row["catNom"]);
            }
            return $categoria;
        } else {
            return false;
        }
    }

    function existeProducto($data) {
        $sql = 'SELECT * FROM producto';
        foreach ($this->conn->query($sql) as $key => $row) {
            if ($row['prodNom'] == $data) {
                return true;
            }
            if ($row['prodId'] == $data) {
                return true;
            }
        }
        return false;
    }

    function adicionarProducto(producto $producto) {
        $folder = "../images/";
        $url = "&_default_image.jpg";
        if (!$producto->urls == "" && !$producto->urlt == "") {
            move_uploaded_file($producto->urls, $folder . $producto->urlt);
            $url = $producto->urlt;
        }

        $sql = "INSERT INTO producto (catId,prodNom,prodCodigo,prodPrecio,prodExist,url,prodDesc)
               VALUES(:catId,:nombre,:codigo,:precio,:existencias,:url,:descripcion)";
        $res = $this->conn->prepare($sql);
        $res->execute(array("catId" => $producto->catId, "nombre" => $producto->nombre,
            "codigo" => $producto->codigo, "precio" => $producto->precio,
            "existencias" => $producto->existencias, "url" => $url,
            "descripcion" => $producto->descripcion));
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
        if (!$producto->urls == "" && !$producto->urlt == "") {
            $queryatt = $queryatt . 'url=:url,';
            $folder = "../images/";
            move_uploaded_file($producto->urls, $folder . $producto->urlt);
            $tmp["url"] = $producto->urlt;
        }
        if (!$producto->descripcion == "") {
            $queryatt = $queryatt . 'prodDesc=:descripcion,';
            $tmp["descripcion"] = $producto->descripcion;
        }

        $queryatt = rtrim($queryatt, ",");
        $sql = "UPDATE producto SET {$queryatt} WHERE prodId = :id";
        $res = $this->conn->prepare($sql);
        $res->execute($tmp);
    }

    function eliminarProducto($id) {
        $sql = "DELETE FROM producto WHERE prodId = :id";
        $res = $this->conn->prepare($sql);
        $res->execute(array("id" => $id));
    }

    function obtenerProducto($idProd) {
        $sql = 'SELECT * FROM producto where prodId = :id';
        $res = $this->conn->prepare($sql);
        $res->execute(array('id' => $idProd));
        $tmp = $res->fetchAll();
        if (is_array($tmp)) {
            foreach ($tmp as $row) {
                $producto = new producto($id, $row["catId"], $row["nombre"], $row["codigo"], $row["precio"], $row["existencias"], "", "", "");
            }
            return $producto;
        } else {
            return false;
        }
    }

    function obtenerProductosCanasta($idU) {
        $sql = 'SELECT * FROM canasta WHERE idUsuario=:id';
        $res = $this->conn->prepare($sql);
        $res->execute(array("id"=>$idU));
        $tmp = $res->fetchAll();
        $productos= array();
        if (is_array($tmp)) {
            foreach ($tmp as $row) {
                $sql = "SELECT * FROM producto WHERE prodId=" . $row['idProducto'];
                $res1 = $this->conn->prepare($sql);
                $res1->execute(array());
                $tmp1 = $res1->fetchAll();
                foreach ($tmp1 as $value) {
                    array_push($productos, new producto($value["prodId"], $value["catId"], $value["prodNom"], $value["prodCodigo"], $value["prodPrecio"], $value["prodExist"],$value["prodDesc"] ,"", $value["url"]));
                }
            }
            return $productos;
        } else {
            return false;
        }
    }

    function obtenerProductosPorCategoria($id) {
        $sql = "SELECT * FROM producto WHERE catId = :id";
        $res = $this->conn->prepare($sql);
        $res->execute(array("id" => $id));
        $tmp = $res->fetchAll();
        $arraytemp = array();
        foreach ($tmp as $key => $value) {
            array_push($arraytemp, new producto($value["prodId"], $value["catId"], $value["prodNom"], $value["prodCodigo"], $value["prodPrecio"], $value["prodExist"], $value["prodDesc"], "", $value["url"]));
        }

        return $arraytemp;
    }

    function obtenerTodoProducto() {
        $sql = "SELECT * FROM producto";
        $tmp = array();
        foreach ($this->conn->query($sql) as $key => $value) {
            array_push($tmp, new producto($value["prodId"], $value["catId"], $value["prodNom"], $value["prodCodigo"], $value["prodPrecio"], $value["prodExist"], "", $value["url"], $value["prodDesc"]));
        }
        return $tmp;
    }

    function agregarCanasta($userid, $prodid) {
        $sql = "INSERT INTO canasta(idProducto,idUsuario,fecha) VALUES(:idP,:idU,:fecha)";
        $res = $this->conn->prepare($sql);
        $fecha = new DateTime();
        $res->execute(array("idP" => $prodid, "idU" => $userid, "fecha" => $fecha->format("Y-m-d H:i:s")));
    }
    
    function resetCanasta() {
        $sql = "DELETE FROM canasta";
        $res = $this->conn->prepare($sql);
        $res->execute();
        $sql = "VACUUM";
        $res = $this->conn->prepare($sql);
        $res->execute();
    }
    
    function comprar() {
       
    }

}

$dbadmin = new databaseAdmin();
?>

