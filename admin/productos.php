<?php
include_once 'lib.php';

if (isset($_POST["enviar"])) {
    
        //Para no guardar nombres vacios en la BD
       if (!$_POST["nombre"] == "" && !$_POST["idcategoria"] == "" &&
           !$_POST["codigo"] == "" && !$_POST["precio"] == "" && !$_POST["existencias"] == "") {
           echo "sas";
                
                $prod_temp = new producto(0, 0, "", 0, 0, 0);
                $prod_temp->nombre = $_POST["nombre"];
                $prod_temp->catId = $_POST["idcategoria"];
                $prod_temp->codigo = $_POST["codigo"];
                $prod_temp->precio = $_POST["precio"];
                $prod_temp->existencias = $_POST["existencias"];
                echo $prod_temp->nombre;
                $db->adicionarProducto($prod_temp);
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
        <title>Info</title>
    </head>
    <body>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="jumbotron">
                        <h1>Registro</h1>
                        <!--<p class="help-block">Enter your info and log in.</p>-->
                    </div>
                     <div class="container" id="content">
                        
                    </div>

                    <div class="container" id="content">
                        <ul class="nav nav-pills" id="menu">
                            <li><a href="categorias.php">Categor&iacute;as</a></li>
                            <li class="active"><a href="productos.php">Productos</a></li>
                            <li><a href="index.php">Atr&aacute;s</a></li>
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
                            <div class="col-md-4" id="prodEnt"></div>
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
