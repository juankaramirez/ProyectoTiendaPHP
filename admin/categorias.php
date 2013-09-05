<?php

include_once "lib.php";

if (isset($_POST["enviar"])) {

       if (!$_POST["nomCat"]=="" && !$db->existeCategoria($_POST["nomCat"])) {
            $cat_temp = new categoria(0, "");
            $cat_temp->nombre = $_POST["nomCat"];
            $db->adicionarCategoria($cat_temp);
       } elseif ($_POST["nomCat"]==""){
           echo '<script type="text/javascript"> alert("El campo está en blanco");</script>';
       } else {
           echo '<script type="text/javascript"> alert("La categoría ingresada ya existe en la base de datos");</script>';
       }
}

if (isset($_POST["editar"])) {
    //Para no guardar nombres vacios en la BD

    if (!$_POST["idCat"] == "" && !$_POST["nomCat"]=="" && $db->existeCategoria($_POST["idCat"])) {
        $cat_temp = $_POST["idCat"];
        $cat_nom_temp = $_POST["nomCat"];
        $db->editarCategoria($cat_temp, $cat_nom_temp);
    } else if ($_POST["idCat"] == "" || $_POST["nomCat"]=="" ) {
        echo '<script type="text/javascript"> alert("Hay algun(os) campo(s) en blanco");</script>';
    } else {
        echo '<script type="text/javascript"> alert("La categoría ingresada no está en la base de datos");</script>';
        
    }
}

if (isset($_POST["eliminar"])) {

       if (!$_POST["idCat"]=="" && $db->existeCategoria($_POST["idCat"])) {
            $cat_temp = $_POST["idCat"];
            $db->eliminarCategoria($cat_temp);
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
                        <h1>Registro</h1>
                    </div>

                    <div class="container" id="content">
                        <ul class="nav nav-pills" id="menu">
                            <li class="active"><a href="categorias.php">Categor&iacute;as</a></li>
                            <li><a href="productos.php">Productos</a></li>
                            <li><a href="../index.php">Atr&aacute;s</a></li>
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
                                        foreach ($db->obtenerTodoCategoria() as $value) {
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
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="../js/custom.js"></script>
    </body>
</html>
