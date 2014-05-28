<?php

include_once 'devuser.php';
session_start();


if (isset($_POST["enviar"])) {
       if (!$_POST["nombre"] == "" && !$_POST["apellido"] == "" &&
           !$_POST["email"] == "" && !$_POST["repemail"] == "" && !$_POST["password"] == "" && !$_POST["reppassword"] == "" && !$_POST["direccion"] == "" && !$_POST["telefono"] == "" && !$dbuser->obtenerUser($_POST["email"])) {
           
            if($_POST["email"] == $_POST["repemail"]) {
                 if ($_POST["password"] == $_POST["reppassword"]) {
                     $usuario_temp = new usuario(0, "", "", "", "", "","");
                     $usuario_temp->nombre = $_POST["nombre"];
                     $usuario_temp->apellido = $_POST["apellido"];
                     $usuario_temp->email = $_POST["email"];
                     $usuario_temp->password = $_POST["password"];
                     $usuario_temp->direccion = $_POST["direccion"];
                     $usuario_temp->telefono = $_POST["telefono"];
                     $dbuser->almacenarUsuario($usuario_temp);
                     $_SESSION['user']= $_POST["email"];
                     header('location:indexlogged.php');
                 } else {
                     echo '<script type="text/javascript"> alert("Las contraseñas no coinciden");</script>';
                 }
             }else {
                     echo '<script type="text/javascript"> alert("Las direcciones de email no coinciden");</script>';
             }    
       } elseif ($dbuser->obtenerUser($_POST["email"])){
           echo '<script type="text/javascript"> alert("El e-mail ingresado ya está registrado en la base de datos");</script>';
       } else {
           echo '<script type="text/javascript"> alert("Hay algun(os) campo(s) en blanco");</script>';
       }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="uikit/css/uikit.gradient.min.css" />
        <link rel="stylesheet" href="uikit/css/custom.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
    </head>
    <body>
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="uk-margin-bottom uk-margin-top">
                    <nav class="uk-navbar">
                        <ul class="uk-navbar-nav">
                            <li class="uk-active"><a href="index.php">MINI TIENDA ONLINE</a></li>
                        </ul>
                    </nav>
                </div>
            </div>



            <div class="uk-width-1-1">
                <div class="uk-push-3-10 uk-width-4-10">
                    <div class="uk-panel uk-panel-box">
                        <form id="registroform" class="uk-form uk-form-horizontal" action="register.php" method="POST">
                            <fieldset>
                                <div class="uk-width-1-1">
                                    <legend><h1>Registro</h1></legend>
                                </div>
                                <div class="uk-push-1-10">
                                    <div class="uk-form-row">
                                        <label class="uk-form-label" >Nombre</label>
                                        <div class="uk-form-controls">
                                            <input name="nombre" class="uk-form-width-medium" type="text"  placeholder="Nombre" >
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <label class="uk-form-label" for="apellido">Apellido</label>
                                        <div class="uk-form-controls">
                                            <input name="apellido" class="uk-form-width-medium" type="text"  placeholder="Apellido">
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <label class="uk-form-label" for="form-h-it">E-mail</label>
                                        <div class="uk-form-controls">
                                            <input name="email" class="uk-form-width-medium" type="email" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="uk-form-row">
                                        <label class="uk-form-label" for="repemail">Repita su E-mail</label>
                                        <div class="uk-form-controls">
                                            <input name="repemail" class="uk-form-width-medium" type="email" placeholder="Repita su Email">
                                        </div>
                                    </div>

                                    <div class="uk-form-row">
                                        <div class="uk-form-controls uk-form-controls-text">
                                            <label for="form-h-c">Recibir informaci&oacute;n</label> <input type="checkbox"> <br>
                                        </div>
                                    </div>
                                    
                                    <div class="uk-form-row">
                                        <label class="uk-form-label" for="direccion">Direcci&oacute;n</label>
                                        <div class="uk-form-controls">
                                            <input name="direccion" class="uk-form-width-medium" type="text" placeholder="Direcci&oacute;n">
                                        </div>
                                    </div>

                                    <div class="uk-form-row">
                                        <label class="uk-form-label" for="telefono">Tel&eacute;fono</label>
                                        <div class="uk-form-controls">
                                            <input name="telefono" class="uk-form-width-medium" type="text" placeholder="Tel&eacute;fono">
                                        </div>
                                    </div>

                                    <div class="uk-form-row">
                                        <label class="uk-form-label" for="password">Contrase&ntilde;a</label>
                                        <div class="uk-form-controls">
                                            <input name="password" class="uk-form-width-medium" type="password" placeholder="Contrase&ntilde;a">
                                        </div>
                                    </div>

                                    <div class="uk-form-row">
                                        <label class="uk-form-label" for="reppassword">Repita su contrase&ntilde;a</label>
                                        <div class="uk-form-controls">
                                            <input name="reppassword" class="uk-form-width-medium" type="password" placeholder="Repita su contrase&ntilde;a">
                                        </div>
                                    </div>

                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-grid uk-margin-top">
                                        <div class="uk-width-1-1" align="center">
                                            <button name="enviar" class="uk-button uk-button-large uk-button-primary" type="submit">Enviar datos</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="uikit/js/uikit.min.js"></script>
        <script type='text/javascript' src='uikit/js/custom.js'></script>
    </body>
</html>
