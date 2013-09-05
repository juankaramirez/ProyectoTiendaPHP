<?php
include_once 'lib.php';

if (isset($_POST["enviar"])) {
    
       if (!$_POST["nombre"] == "" && !$_POST["idcategoria"] == "" &&
           !$_POST["codigo"] == "" && !$_POST["precio"] == "" && !$_POST["existencias"] == "" && !$db->existeProducto($_POST["nombre"])) {
                
                $prod_temp = new producto(0, 0, "", 0, 0, 0);
                $prod_temp->nombre = $_POST["nombre"];
                $prod_temp->catId = $_POST["idcategoria"];
                $prod_temp->codigo = $_POST["codigo"];
                $prod_temp->precio = $_POST["precio"];
                $prod_temp->existencias = $_POST["existencias"];
                $db->adicionarProducto($prod_temp);
    } elseif ($db->existeProducto($_POST["nombre"])){
           echo '<script type="text/javascript"> alert("El nombre del producto ingresado ya existe en la base de datos");</script>';
       } else {
           echo '<script type="text/javascript"> alert("Hay algun(os) campo(s) en blanco");</script>';
       }
}

if (isset($_POST["editar"])) {

    if ($db->existeProducto($_POST["idProd"]) && !$_POST["idProd"] == "" && (!$_POST["nombre"] == "" || !$_POST["idcategoria"] == "" ||
            !$_POST["codigo"] == "" || !$_POST["precio"] == "" || !$_POST["existencias"] == "")) {

        if (!$_POST["idcategoria"] == "") {
            if ($db->existeCategoria($_POST["idcategoria"])) {
                $prod_temp = new producto($_POST["idProd"], $_POST["idcategoria"], $_POST["nombre"], $_POST["codigo"], $_POST["precio"], $_POST["existencias"]);
                $db->editarProducto($prod_temp);
            } else {
                echo '<script type="text/javascript"> alert("La categoría ingresada no está en la base de datos");</script>';
            }
        } else {

            $prod_temp = new producto($_POST["idProd"], $_POST["idcategoria"], $_POST["nombre"], $_POST["codigo"], $_POST["precio"], $_POST["existencias"]);
            $db->editarProducto($prod_temp);
        }
        
    
    } else if ($_POST["idProd"] == "") {

        echo '<script type="text/javascript"> alert("El campo Id Producto no puede estar en blanco");</script>';
        
    } else if (!$db->existeProducto($_POST["idProd"])) {

        echo '<script type="text/javascript"> alert("El producto ingresado no está en la base de datos");</script>';
    
    } else {

        echo '<script type="text/javascript"> alert("Todos los campos están en blanco");</script>';
    }
}

if (isset($_POST["eliminar"])) {
      
       if (!$_POST["idProd"]=="") {
            $prod_temp = $_POST["idProd"];
            $db->eliminarProducto($prod_temp);
            
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
                        
                    </div>

                    <div class="container" id="content">
                        <ul class="nav nav-pills" id="menu">
                            <li><a href="categorias.php">Categor&iacute;as</a></li>
                            <li class="active"><a href="productos.php">Productos</a></li>
                            <li><a href="../index.php">Atr&aacute;s</a></li>
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
                                            <th>prodId</th>
                                            <th>catId</th>
                                            <th>prodNom</th>
                                            <th>prodCodigo</th>
                                            <th>prodPrecio</th>
                                            <th>prodExist</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($db->obtenerTodoProducto() as $value) {
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
