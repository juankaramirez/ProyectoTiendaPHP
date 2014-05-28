<?php

include_once 'devuser.php';
include_once '../admin/devadmin.php';
session_start();
if(!isset($_SESSION['user'])) {
    if (isset($_POST["ingresar"])) {
        if (!$_POST["email"] == "" && !$_POST["password"] == "") {
            if ($dbuser->autenticacion($_POST["email"], $_POST["password"])) {
                $_SESSION['user'] = $_POST["email"];
                header('location:indexlogged.php');
            } else {
                echo '<script type="text/javascript"> alert("Acceso Denegado");</script>';
            }
        } else {
            echo '<script type="text/javascript"> alert("Hay campos en blanco");</script>';
        }
    }
    
}else{
    header('location:indexlogged.php');
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
                            <li><a href="#" data-uk-modal="{target:'#login'}">Ingresar</a></li>
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
                    </ul>
                </div>
               <!-- <div class="uk-panel uk-panel-box">
                    <h3 class="uk-panel-title">Secci&oacute;n</h3>
                    <ul class="uk-nav uk-nav-side">
                        <li><a href="#">sda</a></li>
                        <li><a href="#">sda</a></li>
                        <li><a href="#">sda</a></li>
                    </ul>
                </div>-->
            </div>

            <div class="uk-push-1-10 uk-width-4-10 uk-container-center" id="principal">
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
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                        <li><a href="#">Item</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        
        <div id="login" class="uk-modal">
            <div id="modal" class="uk-modal-dialog uk-modal-dialog-slide">
                <a class="uk-modal-close uk-close"></a>
                <div class="uk-width-medium-8-10 uk-container-center">
                    <form id="loginform"class="uk-form uk-form-horizontal" action="index.php" method="POST">
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
                
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="uikit/js/uikit.min.js"></script>
        <script type='text/javascript' src='uikit/js/jquery.min.js'></script>
        <script type='text/javascript' src='uikit/js/jquery.mobile.customized.min.js'></script>
        <script type='text/javascript' src='uikit/js/jquery.easing.1.3.js'></script> 
        <script type='text/javascript' src='uikit/js/camera.min.js'></script> 
        <script type='text/javascript' src='uikit/js/custom.js'></script>
    </body>
</html>