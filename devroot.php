<?php

class databaseLogin {

    private $conn = null;

    function __construct() {
        $this->conn = new PDO('sqlite:db/EsquemaTienda.sqlite');
    }
    
    function autenticacion($usrnm,$pswrd) {
        $sql = 'SELECT adminPass FROM admin WHERE adminUsername = :usrnm';
        $res = $this->conn->prepare($sql);
        $res->execute(array('usrnm' => $usrnm));
        $tmp = $res->fetchAll();
        if (is_array($tmp)) {
            foreach($tmp as $row){
                if($row['adminPass']==$pswrd) {
                    return true;
                }
            }
        } else {
            return false;
        }
    }
    
    
}

$dblog = new databaseLogin();

?>
