<?php

include_once 'devuser.php';
include_once '../admin/devadmin.php';
session_start();
if (!isset($_SESSION['user'])) {
    if (isset($_POST["ingresar"])) {
        if (!$_POST["email"] == "" && !$_POST["password"] == "") {
            if ($dbuser->autenticacion($_POST["email"], $_POST["password"])) {
                $_SESSION['user'] = $_POST["email"];
                header('location:productos_categoria.php?cat=' . $_GET['cat']);
            } else {
                echo '<script type="text/javascript"> alert("Acceso Denegado");</script>';
            }
        } else {
            echo '<script type="text/javascript"> alert("Hay campos en blanco");</script>';
        }
    }
} 

if (isset($_POST["addCanasta"])) {
    $dbadmin->agregarCanasta($_POST["usuId"], $_POST["prodId"]);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="uikit/css/uikit.gradient.min.css" />
        <link rel='stylesheet' id='camera-css'  href='uikit/css/camera.css' type='text/css' media='all'> 
        <link rel="stylesheet" href="uikit/css/custom.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mini Tienda Online</title>
    </head>
    <body>

        <div class="uk-grid">

            <div class="uk-width-1-1">
                <div class="uk-margin-bottom">
                    <nav class="uk-navbar">
                        <ul class="uk-navbar-nav">
                            <li class="uk-active"><a href="index.php">MINI TIENDA ONLINE</a></li>
                        </ul>


                        <div class="uk-navbar-flip">

                            <ul class="uk-navbar-nav">

<?php
if (!isset($_SESSION['user'])) {
    echo "<li><a href='#' data-uk-modal='{target:\"#login\"}'>Ingresar</a></li>";
} else {
    echo "<li class='uk-button-dropdown' data-uk-dropdown=\"{mode:'click'}\"> <a href='#'>Bienvenido: ";
    $data = $dbuser->obtenerUser($_SESSION['user']);
    if ($data)
        echo $data;
    echo "</a><div class='uk-dropdown' ><ul class='uk-nav uk-nav-dropdown'><li class='uk-nav-header'>Opciones</li>";
    echo "<li><a href='editar_info.php'>Editar informaci&oacute;n</a></li><li class='uk-nav-divider'></li>";
    echo "<li><a href='canasta.php'>Canasta</a></li><li class='uk-nav-divider'></li>";
    echo "<li><a href='#' data-uk-modal='{target:\"#logout\"}'>Salir</a></li></ul></div></li>";
}
?>

                            </ul>
                        </div>                       
                    </nav>
                    <!--<hr class="uk-grid-divider">-->
                </div>
            </div>

            <div class="uk-width-1-1">
                <div class="uk-width-1-1 uk-margin-bottom">
                    <a href="indexlogged.php" class="uk-icon-button uk-icon-arrow-left"></a>
                    <a href="#" class="uk-icon-button uk-icon-th-list" data-uk-offcanvas="{target:'#offcanvas-3'}"></a>
                    <h1 href="#"><?php echo $dbadmin->obtenerCategoria($_GET['cat'])->nombre; ?></h1>
                    <div id="offcanvas-3" class="uk-offcanvas">

                        <div class="uk-offcanvas-bar">

                            <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav="">
                                <li id="" class="uk-nav-header">Categor&iacute;as</li>
                                <?php
                                foreach ($dbadmin->obtenerTodoCategoria() as $value) {
                                    echo "<li><a href='productos_categoria.php?cat=" . urlencode($value->id) . "'>" . $value->nombre . "</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-push-1-10 uk-width-6-10 uk-container-center" id="principal">
                <?php
                foreach ($dbadmin->obtenerProductosPorCategoria($_GET['cat']) as $value) {
                    echo "<div class='uk-grid uk-panel-box marg '><div class='uk-width-medium-3-10'><div class='uk-thumbnail uk-thumbnail-mini'>";
                    echo "<img src='../images/" . $value->urlt . "' alt=''><div class='uk-thumbnail-caption'>";
                    echo $value->nombre . "</div></div></div><div class='uk-width-medium-7-10'><div class='uk-grid' id='thproducto'>";
                    echo "<div class='uk-width-medium-1-1'><div class='uk-text-break'>" . $value->descripcion . "</div></div>";
                    echo "<div class='uk-width-medium-5-10 uk-container-center uk-margin-top'>Precio: $" . $value->precio . "</div><div class='uk-width-medium-5-10 uk-margin-top'>En Stock: " . $value->existencias . "</div>";
                    if (!isset($_SESSION['user'])) {
                        echo "<div class='uk-push-3-10 uk-width-medium-1-1 uk-container-center uk-margin-top'><form class = 'uk-form' ><fieldset><div class='uk-form-row uk-maring-top'><button class='uk-button uk-button-primary' data-uk-modal='{target:\"#login\"}' type='button'>Comprar</button></div></fieldset></form></div></div></div></div>";
                    } else {
                        echo "<div class='uk-push-2-10 uk-width-medium-1-1 uk-container-center uk-margin-top'><form class = 'uk-form' role='form' action='" . $_SERVER['REQUEST_URI'] . "' method='POST'><fieldset><input value='" . $_SESSION['user'] . "' style='visibility:hidden;' name='usuId' type='text' id='usuId' ><input value='" . $value->id . "' style='visibility:hidden;' name='prodId' type='text' id='prodId' ><div class='uk-form-row uk-maring-top'><button class='uk-button uk-button-primary' type='submit' name='addCanasta'>A&ntilde;adir a la canasta</button></div></fieldset></form></div></div></div></div>";
                    }
                }
                ?>

            </div>


            <div class="uk-push-1-10 uk-width-3-10">


                <div class="uk-panel uk-panel-box uk-panel-header">
                    <h3 class="uk-panel-title">M&aacute;s buscados</h3>
                    <ul class="uk-nav">
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                    </ul>
                </div>
            </div>
        </div >


        <div id="login" class="uk-modal">
            <div id="modal" class="uk-modal-dialog uk-modal-dialog-slide">
                <a class="uk-modal-close uk-close"></a>
                <div class="uk-width-medium-8-10 uk-container-center">
                    <form id="loginform"class="uk-form uk-form-horizontal" action="productos_categoria.php?cat=<?php echo $_GET['cat'] ?>" method="POST">
                        <fieldset>
                            <legend><h1>Login</h1></legend>
                            <div class="uk-form-row">
                                <label class="uk-form-label" for="email">E-mail</label>
                                <div class="uk-form-controls" ><input name="email" class="uk-width-6-6" type="text" placeholder="Digite su e-mail" id="email"></div>
                            </div>
                            <div class="uk-form-row">
                                <label class="uk-form-label" for="pass">Contrase&ntilde;a</label>
                                <div class="uk-form-controls" ><input name="password" class="uk-width-6-6" type="password" placeholder="Digite su contrase&ntilde;a" id="pass"></div>
                            </div>
                            <div class="uk-form-row">
                                <div class="uk-grid">
                                    <div class="uk-width-4-6">
                                        <button name="ingresar" class="uk-button uk-button-large uk-button-primary" type="submit">Ingresar</button>
                                    </div>
                                    <div class="uk-width-2-6 uk-hidden-small uk-margin-top">
                                        <a href="register.php">Nuevo usuario?</a>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

        <div id="logout" class="uk-modal">
            <div id="modal" class="uk-modal-dialog uk-modal-dialog-slide">
                <a class="uk-modal-close uk-close"></a>
                <div class="uk-width-medium-8-10 uk-container-center">
                    <div class="uk-grid">
                        <div class="uk-width-1-1">
                            <h1>Salir</h1>
                            <hr class="uk-grid-divider">   
                        </div>

                        <div class="uk-width-1-1" align="center">
                            <h3>Est&aacute; seguro?</h3>
                            <hr class="uk-grid-divider">
                        </div>
                        <div class="uk-width-1-1">
                            <form class="uk-form" action="userlogout.php" method="POST">
                                <fieldset>
                                    <div class="uk-form-row  ">
                                        <div class="uk-grid">
                                            <div class="uk-push-4-6 uk-width-1-6  uk-hidden-small">
                                                <button name="salir" class="uk-button uk-button-large uk-button-primary" type="submit">Salir</button>
                                            </div>
                                            <div class="uk-width-1-6 uk-hidden-small">
                                                <button class="uk-button uk-button-large uk-button-primary uk-modal-close" type="submit">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="uikit/js/uikit.min.js"></script>
        <script type='text/javascript' src='uikit/js/jquery.min.js'></script>
        <script type='text/javascript' src='uikit/js/jquery.mobile.customized.min.js'></script>
        <script type='text/javascript' src='uikit/js/jquery.easing.1.3.js'></script> 
        <script type='text/javascript' src='uikit/js/camera.min.js'></script> 
        <script type='text/javascript' src='uikit/js/custom.js'></script>
    </body>
</html>