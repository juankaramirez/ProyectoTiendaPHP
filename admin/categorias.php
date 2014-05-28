<?php

session_start();
include_once 'devadmin.php';
if (!isset($_SESSION['usrnm'])) {
    header('location:../adminlogin.php');
}


if (isset($_POST["enviar"])) {

       if (!$_POST["nomCat"]=="" && !$dbadmin->existeCategoria($_POST["nomCat"])) {
            $cat_temp = new categoria(0, "");
            $cat_temp->nombre = $_POST["nomCat"];
            $dbadmin->adicionarCategoria($cat_temp);
       } elseif ($_POST["nomCat"]==""){
           echo '<script type="text/javascript"> alert("El campo está en blanco");</script>';
       } else {
           echo '<script type="text/javascript"> alert("La categoría ingresada ya existe en la base de datos");</script>';
       }
}

if (isset($_POST["editar"])) {
    //Para no guardar nombres vacios en la BD

    if (!$_POST["idCat"] == "" && !$_POST["nomCat"]=="" && $dbadmin->existeCategoria($_POST["idCat"])) {
        $cat_temp = $_POST["idCat"];
        $cat_nom_temp = $_POST["nomCat"];
        $dbadmin->editarCategoria($cat_temp, $cat_nom_temp);
    } else if ($_POST["idCat"] == "" || $_POST["nomCat"]=="" ) {
        echo '<script type="text/javascript"> alert("Hay algun(os) campo(s) en blanco");</script>';
    } else {
        echo '<script type="text/javascript"> alert("La categoría ingresada no está en la base de datos");</script>';
        
    }
}

if (isset($_POST["eliminar"])) {

       if (!$_POST["idCat"]=="" && $dbadmin->existeCategoria($_POST["idCat"])) {
            $cat_temp = $_POST["idCat"];
            $dbadmin->eliminarCategoria($cat_temp);
       } elseif ($_POST["idCat"]==""){
           echo '<script type="text/javascript"> alert("El campo está en blanco");</script>';
       } else {
           echo '<script type="text/javascript"> alert("La categoría ingresada no está en la base de datos");</script>';
       }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../css/custom.css" rel="stylesheet" media="screen">
        <title>Backend</title>
    </head>
    <body>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="jumbotron">
                        <h1>Registro <small>Bienvenido: <?php $data = $dbadmin->obtenerAdmin($_SESSION['usrnm']); if($data)echo $data; ?></small></h1>
                    </div>

                    <div class="container" id="content">
                        <ul class="nav nav-pills" id="menu">
                            <li class="active"><a href="categorias.php">Categor&iacute;as</a></li>
                            <li><a href="productos.php">Productos</a></li>
                            <li><a data-toggle="modal" href="#" data-target="#myModal">Salir</a></li>
                        </ul>
                        <br>
                        
                        <div class="row">
                            <div class="col-md-3">
                                <ul class="nav nav-pills nav-stacked menu" id="menuedicion">
                                    <li><a id="catEntrada" href="#">Nueva entrada</a></li>
                                    <li><a id="catEditar" href="#">Editar</a></li>
                                    <li><a id="catEliminar" href="#">Eliminar</a></li>
                                </ul>
                            </div>
                            <div id="catFunc"></div>
                            <div class="col-md-5">
                                <h3>Categor&iacute;as existentes</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>catId</th>
                                            <th>catNom</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($dbadmin->obtenerTodoCategoria() as $value) {
                                            echo "<tr>
                                            <td>{$value->id}</td>
                                            <td>{$value->nombre}</td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h1 class="modal-title">Salir</h1>
                    </div>
                    <div class="modal-body">
                        <div class="container" align="center">

                            <h3>Est&aacute; seguro?</h3>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <form class="form-inline" role="form" action="adminlogout.php" method="POST">
                            <div class="form-group">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                                <input name="salir" type="submit" class="btn btn-primary" value="Salir">
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/custom.js"></script>
        
    </body>
</html>
