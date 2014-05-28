<?php


class usuario {

    var $id = 0;
    var $nombre = "";
    var $apellido = "";
    var $email = "";
    var $password = "";
    var $direccion = "";
    var $telefono = "";
    
    function __construct($id, $nombre, $apellido, $email, $password, $direccion, $telefono) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->password = $password;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
    }
}

class databaseUser {

    private $conn = null;

    function __construct() {
        $this->conn = new PDO('sqlite:../db/EsquemaTienda.sqlite');
    }
    
    function autenticacion($email,$pswrd) {
        $sql = 'SELECT usuPass FROM usuario WHERE usuEmail = :email';
        $res = $this->conn->prepare($sql);
        $res->execute(array('email' => $email));
        $tmp = $res->fetchAll();
        if (is_array($tmp)) {
            foreach($tmp as $row){
                if($row['usuPass']==$pswrd) {
                    return true;
                }
            }
        } else {
            return false;
        }
    }
    
    function obtenerUser($email){
        $sql = 'SELECT usuNom FROM usuario WHERE usuEmail=:email';
        $res = $this->conn->prepare($sql);
        $res->execute(array("email" => $email));
        $tmp = $res->fetchAll();
        foreach($tmp as $key => $row){
            return $row['usuNom'];
        }
        return false;
    }
    
    
    
    function almacenarUsuario(usuario $usuario) {       
        $sql = "INSERT INTO usuario (usuNom,usuAp,usuEmail,usuPass,usuDir,usuTel)
               VALUES(:nombre,:apellido,:email,:password,:direccion,:telefono)";
        $res = $this->conn->prepare($sql);
        $res->execute(array("nombre" => $usuario->nombre, "apellido" => $usuario->apellido,
                            "email" => $usuario->email, "password" => $usuario->password,
                            "direccion" => $usuario->direccion, "telefono" => $usuario->telefono));
    }
    
    function editarUsuario(usuario $usuario,$em) {
        $queryatt = "";
        
        if (!$usuario->nombre == "") {
            $queryatt = $queryatt . 'usuNom=:nombre,';
            $tmp["nombre"] = $usuario->nombre;
        }
        
        if (!$usuario->apellido == "") {
            $queryatt = $queryatt . 'usuAp:apellido,';
            $tmp["apellido"] = $usuario->nombre;
        }
        if (!$usuario->email == "") {
            $queryatt = $queryatt . 'usuEmail=:email,';
            $tmp["email"] = $usuario->email;
        }
        if (!$usuario->password == 0) {
            $queryatt = $queryatt . 'usuPass=:password,';
            $tmp["password"] = $usuario->password;
        }
        if (!$usuario->direccion == 0) {
            $queryatt = $queryatt . 'usuDir=:direccion,';
            $tmp["direccion"] = $usuario->direccion;
        }
        
        if (!$usuario->telefono == "") {
            $queryatt = $queryatt . 'usuTel=:telefono,';
            $tmp["telefono"] = $usuario->telefono;
        }
        $tmp["em"] = $em;
        $queryatt = rtrim($queryatt,",");
        $sql = "UPDATE usuario SET {$queryatt} WHERE usuEmail=:em";
        $res = $this->conn->prepare($sql);
        $res->execute($tmp);
        return $usuario->email;
    }
}

$dbuser = new databaseUser();
?>
