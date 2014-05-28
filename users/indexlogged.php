<?php

include_once 'devuser.php';
include_once '../admin/devadmin.php';
session_start();
if(!isset($_SESSION['user'])) {
    header('location:index.php');
}

if (isset($_POST["enviar"])) {
    $usuario_temp = new usuario(0, "", "", "", "", "", "");
    $change = false;
    $changeem = false;
    
    if (!$_POST["nombre"] == "") {
        $usuario_temp->nombre = $_POST["nombre"];
        $change = true;
    }
    if (!$_POST["apellido"] == "") {
        $usuario_temp->apellido = $_POST["apellido"];
        $change = true;
    }
    if (!$_POST["email"] == "") {
        if (!$dbuser->obtenerUser($_POST["email"])) {
            $usuario_temp->email = $_POST["email"];
            $change = true;
            $changeem = true;
        } else {
            echo '<script type="text/javascript"> alert("El nuevo e-mail ya está registrado en la base de datos");</script>';
        }
    }

    if (!$_POST["password"] == "" && !$_POST["reppassword"] == "") {
        if ($_POST["password"] == $_POST["reppassword"]) {
            $usuario_temp->password = $_POST["password"];
            $change = true;
        } else {
            echo '<script type="text/javascript"> alert("Las contraseñas no coinciden");</script>';
        }
    }

    if (!$_POST["direccion"] == "") {
        $usuario_temp->direccion = $_POST["direccion"];
        $change = true;
    }

    if (!$_POST["telefono"] == "") {
        $usuario_temp->telefono = $_POST["telefono"];
        $change = true;
    }
    if ($change) {
        if($changeem){
            $_SESSION["user"] = $dbuser->editarUsuario($usuario_temp,$_SESSION["user"]);
        }else{
            $dbuser->editarUsuario($usuario_temp,$_SESSION["user"]);
        }
        header('location:indexlogged.php');
    } else {
        echo '<script type="text/javascript"> alert("Hay campos en blanco");</script>';
    }
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
                            <li class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                                <a href="#">Bienvenido: 
                                    <?php $data = $dbuser->obtenerUser($_SESSION['user']);if ($data) echo $data; ?>
                                </a>
                                <div class="uk-dropdown" style="">
                                    <ul class="uk-nav uk-nav-dropdown">
                                        <li class="uk-nav-header">Opciones</li>
                                        <li><a href="editar_info.php">Editar informaci&oacute;n</a></li>
                                        <li><a href="canasta.php">Canasta</a></li>
                                        <li class="uk-nav-divider"></li>
                                        <li><a href="#" data-uk-modal="{target:'#logout'}">Salir</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="uk-navbar-content uk-navbar-center uk-hidden-small">
                        <input type="text" placeholder="Buscar" class="uk-form-width-large" id="buscar">
                    </div>
                </nav>
                </div>
            </div>

            <div class="uk-width-2-10">
                <div class="uk-panel uk-panel-box uk-panel-header">
                    <h3 class="uk-panel-title">Categor&iacute;as</h3>
                    <ul class="uk-nav uk-nav-side">
                        <?php
                                foreach ($dbadmin->obtenerTodoCategoria() as $value) {
                                    echo "<li><a href='productos_categoria.php?cat=" . urlencode($value->id) . "'>" . $value->nombre . "</a></li>";
                                }
                        ?>
                        <li><a href="#"></a></li>
                    </ul>
                </div>
                <div class="uk-panel uk-panel-box">
                    <h3 class="uk-panel-title">Secci&oacute;n</h3>
                    <ul class="uk-nav uk-nav-side">
                        <li><a href="#">sda</a></li>
                        <li><a href="#">sda</a></li>
                        <li><a href="#">sda</a></li>
                    </ul>
                </div>
            </div>

            <div class="uk-push-1-10 uk-width-4-10" id="principal">
                <div class="camera_wrap camera_azure_skin" id="slider">
                    <div data-src="images/img1.jpg">
                        <div class="camera_caption fadeFromBottom">
                            Realiza tus compras de manera facil y segura
                        </div>
                    </div>
                    <div data-src="images/img2.jpg">
                        <div class="camera_caption fadeFromBottom">
                            Encuentra todos los productos que necesites
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="uk-push-2-10 uk-width-2-10">
                 <div class="uk-panel uk-panel-box">
                    <h3 class="uk-panel-title">Secci&oacute;n</h3>
                    <ul class="uk-nav uk-nav-side">
                        <li><a href="#">sda</a></li>
                        <li><a href="#">sda</a></li>
                        <li><a href="#">sda</a></li>
                    </ul>
                </div>
                
                <div class="uk-panel uk-panel-box uk-panel-header">
                    <h3 class="uk-panel-title">M&aacute;s buscados</h3>
                    <ul class="uk-nav">
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                    </ul>
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
                                <div class="uk-form-row">
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