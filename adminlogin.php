<?php
include_once "devroot.php";
session_start();
if(!isset($_SESSION['usrnm'])) {
    if (isset($_POST["enviar"])) {
        if (!$_POST["username"] == "" && !$_POST["password"] == "") {
            if ($dblog->autenticacion($_POST["username"], $_POST["password"])) {
                $_SESSION['usrnm'] = $_POST["username"];
                header('location:admin/index.php');
            } else {
                echo '<script type="text/javascript"> alert("Acceso Denegado");</script>';
            }
        } else {
            echo '<script type="text/javascript"> alert("Hay campos en blanco");</script>';
        }
    }
}else{
    header('location:admin/index.php');
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/custom.css" rel="stylesheet" media="screen">
        <title>Tienda PHP - Backend</title>
    </head>
    <body>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="jumbotron">
                        <h1>Acceso Backend</h1>
                    </div>
                    <div class="container" id="content">
                        <ul class="nav nav-pills" id="menu">
                            <li><a href="../index.php">Atr&aacute;s</a></li>
                        </ul>
                        <div class="row">
                            <div class="col-md-offset-1" >
                                <form class="form-horizontal" role="form" action='adminlogin.php' method='POST'>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                                        <div class="col-lg-5">
                                            <input name="username" type="text" class="form-control" id="inputEmail1" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                        <div class="col-lg-5">
                                            <input name="password" type="password" class="form-control" id="inputPassword1" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-md-4">
                                            <input name="enviar" type="submit" class="btn btn-primary" value="Ingresar">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
