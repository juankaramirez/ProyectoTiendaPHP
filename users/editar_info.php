<?php

include_once 'devuser.php';
session_start();


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
        <link rel="stylesheet" href="uikit/css/custom.css" />
        <title>Registro</title>
    </head>
    <body>
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="uk-margin-bottom">
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
                        <form id="registroform" class="uk-form uk-form-horizontal" action="editar_info.php" method="POST">
                            <fieldset>
                                <div class="uk-width-1-1">
                                    <legend><h1>Editar Informaci&oacute;n</h1></legend>
                                </div>
                                <div class="form-title">
                                    <h2 >Datos Personales</h2>
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
                                        <label class="uk-form-label" for="form-h-it">Nuevo e-mail</label>
                                        <div class="uk-form-controls">
                                            <input name="email" class="uk-form-width-medium" type="email" placeholder="Nuevo e-mail">
                                        </div>
                                    </div>

                                    <!--<div class="uk-form-row">
                                        <div class="uk-form-controls uk-form-controls-text">
                                            <label for="form-h-c">Recibir informaci&oacute;n</label> <input type="checkbox"> <br>
                                        </div>
                                    </div>-->
                                    
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
                                </div>
                                <br>
                                <div class="form-title ">
                                    <h2 >Seguridad</h2>
                                </div>
                                <div class="uk-push-1-10">
                                    
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
