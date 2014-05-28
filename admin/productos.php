<?php
session_start();
include_once 'devadmin.php';
if (!isset($_SESSION['usrnm'])) {
    header('location:../adminlogin.php');
}

if (isset($_POST["enviar"])) {
       if (!$_POST["nombre"] == "" && !$_POST["idcategoria"] == "" &&
           !$_POST["codigo"] == "" && !$_POST["precio"] == "" && !$_POST["existencias"] == "" && !$dbadmin->existeProducto($_POST["nombre"])) {
                $prod_temp = new producto(0, 0, "", 0, 0, 0,"","","");
                $prod_temp->nombre = $_POST["nombre"];
                $prod_temp->catId = $_POST["idcategoria"];
                $prod_temp->codigo = $_POST["codigo"];
                $prod_temp->precio = $_POST["precio"];
                $prod_temp->existencias = $_POST["existencias"];
                $prod_temp->descripcion = $_POST["descripcion"];
                if(isset($_FILES["img"]["tmp_name"]) && isset($_FILES["img"]["name"])){
                    $prod_temp->urls=$_FILES["img"]["tmp_name"];
                    $prod_temp->urlt=$_FILES["img"]["name"];
                }
                $dbadmin->adicionarProducto($prod_temp);
    } elseif ($dbadmin->existeProducto($_POST["nombre"])){
           echo '<script type="text/javascript"> alert("El nombre del producto ingresado ya existe en la base de datos");</script>';
       } else {
           echo '<script type="text/javascript"> alert("Hay algun(os) campo(s) en blanco");</script>';
       }
}

if (isset($_POST["editar"])) {

    if ($dbadmin->existeProducto($_POST["idProd"]) && !$_POST["idProd"] == "" && (!$_POST["nombre"] == "" || !$_POST["idcategoria"] == "" ||
            !$_POST["codigo"] == "" || !$_POST["precio"] == "" || !$_POST["existencias"] == "" || !$_POST["descripcion"] == "" || isset($_FILES["img"]["tmp_name"]) && isset($_FILES["img"]["name"]))) {

        if (!$_POST["idcategoria"] == "") {
            if ($dbadmin->existeCategoria($_POST["idcategoria"])) {
                $prod_temp = new producto($_POST["idProd"], 0, "", 0, 0, 0,"","","");
                $prod_temp->nombre = $_POST["nombre"];
                $prod_temp->catId = $_POST["idcategoria"];
                $prod_temp->codigo = $_POST["codigo"];
                $prod_temp->precio = $_POST["precio"];
                $prod_temp->existencias = $_POST["existencias"];
                $prod_temp->descripcion = $_POST["descripcion"];
                if(isset($_FILES["img"]["tmp_name"]) && isset($_FILES["img"]["name"])){
                    $prod_temp->urls=$_FILES["img"]["tmp_name"];
                    $prod_temp->urlt=$_FILES["img"]["name"];
                }
                $dbadmin->editarProducto($prod_temp);
            } else {
                echo '<script type="text/javascript"> alert("La categoría ingresada no está en la base de datos");</script>';
            }
        } else {
            $prod_temp = new producto($_POST["idProd"], 0, "", 0, 0, 0,"","","");
                $prod_temp->nombre = $_POST["nombre"];
                $prod_temp->catId = $_POST["idcategoria"];
                $prod_temp->codigo = $_POST["codigo"];
                $prod_temp->precio = $_POST["precio"];
                $prod_temp->existencias = $_POST["existencias"];
                $prod_temp->descripcion = $_POST["descripcion"];
                if(isset($_FILES["img"])){
                    $prod_temp->urls=$_FILES["img"]["tmp_name"];
                    $prod_temp->urlt=$_FILES["img"]["name"];
                }
                $dbadmin->editarProducto($prod_temp);
        }
    } else if ($_POST["idProd"] == "") {

        echo '<script type="text/javascript"> alert("El campo Id Producto no puede estar en blanco");</script>';
        
    } else if (!$dbadmin->existeProducto($_POST["idProd"])) {

        echo '<script type="text/javascript"> alert("El producto ingresado no está en la base de datos");</script>';
    
    } else {

        echo '<script type="text/javascript"> alert("Todos los campos están en blanco");</script>';
    }
}

if (isset($_POST["eliminar"])) {
      
       if (!$_POST["idProd"]=="") {
            $prod_temp = $_POST["idProd"];
            $dbadmin->eliminarProducto($prod_temp);
            
       }elseif ($_POST["idProd"]==""){
           echo '<script type="text/javascript"> alert("El campo está en blanco");</script>';
       } else {
           echo '<script type="text/javascript"> alert("El producto ingresado no está en la base de datos");</script>';
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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                            <li><a href="categorias.php">Categor&iacute;as</a></li>
                            <li class="active"><a href="productos.php">Productos</a></li>
                            <li><a data-toggle="modal" href="#" data-target="#myModal">Salir</a></li>
                        </ul>
                        <br>

                        <div class="row">
                            <div class="col-md-3">
                                <ul class="nav nav-pills nav-stacked menu" id="menuedicion">
                                    <li><a id="prodEntrada" href="#">Nueva entrada</a></li>
                                    <li><a id="prodEditar" href="#">Editar</a></li>
                                    <li><a id="prodEliminar" href="#">Eliminar</a></li>
                                </ul>
                            </div>
                            <div id="prodFunc"></div>
                            <div class="col-md-5">
                                <h3>Productos existentes</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>catId</th>
                                            <th>Nom</th>
                                            <th>Codigo</th>
                                            <th>Precio</th>
                                            <th>Exist</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($dbadmin->obtenerTodoProducto() as $value) {
                                            echo "<tr>
                                                    <td>{$value->id}</td>
                                                    <td>{$value->catId}</td>
                                                    <td>{$value->nombre}</td>
                                                    <td>{$value->codigo}</td>
                                                    <td>{$value->precio}</td>
                                                    <td>{$value->existencias}</td>
                                                  </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <br>
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
