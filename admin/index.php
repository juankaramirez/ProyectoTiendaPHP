<?php

session_start();
include_once 'devadmin.php';
if (!isset($_SESSION['usrnm'])) {
    header('location:../adminlogin.php');
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
                            <li><a href="categorias.php">Categor&iacute;as</a></li>
                            <li><a href="productos.php">Productos</a></li>
                            <li><a data-toggle="modal" href="#" data-target="#myModal">Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
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
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>
