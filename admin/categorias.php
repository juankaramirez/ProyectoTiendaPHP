<?php
include_once "lib.php";

if (isset($_POST["enviar"])) {
        //Para no guardar nombres vacios en la BD
    
       if (!$_POST["categoria"]=="" && !$db->existeCategoria($_POST["categoria"])) {
           echo "si";
            $cat_temp = new categoria(0, "");
            $cat_temp->nombre = $_POST["categoria"];
            $db->adicionarCategoria($cat_temp);
       }
}
?>
<!DOCTYPE htmls>
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
                        <ul class="nav nav-pills" id="menu">
                            <li class="active"><a href="categorias.php">Categor&iacute;as</a></li>
                            <li><a href="productos.php">Productos</a></li>
                            <li><a href="index.php">Atr&aacute;s</a></li>
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
                            <div class="col-md-4" id="catEnt">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($db->obtenerTodoCategoria() as $value) {
                                            echo "<tr>
                                            <td>{$value->nombre}</td>
                                            <td><a href='#'>Eliminar</a></td>
                                            </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-5">
                                <h3>Categorias existentes</h3>
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
