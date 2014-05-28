<?php

session_start();

class prod {

    var $nombre = "";
    var $codigo = 0;
    var $precio = 0;
    var $existencias = 0;
    var $catNombre = "";
    var $url = "";

    function __construct($nombre, $codigo, $precio, $existencias, $catNombre, $url) {
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->precio = $precio;
        $this->existencias = $existencias;
        $this->catNombre = $catNombre;
        $this->url = $url;
    }

}

$buscar = $_POST['b'];

if (!empty($buscar)) {
    buscar($buscar);
} else {
    $html = "<div  style='display: block; margin-bottom: 61px; height: 379px;'>";
    $html = $html . "<h2>Aquí puedes encontrar los articulos que desees...</h2></div>";
    /* $html = "<div class='camera_wrap camera_azure_skin' id='slider'><div data-src='images/img1.jpg'>";
      $html .= "<div class='camera_caption fadeFromBottom'>Realiza tus compras de manera facil y segura</div></div>";
      $html .= "<div data-src='images/img2.jpg'><div class='camera_caption fadeFromBottom'>Encuentra todos los productos que necesites";
      $html .= "</div></div></div>"; */
    echo $html;
}

function buscar($nombre) {
    
    $conn = new PDO('sqlite:../db/EsquemaTienda.sqlite');
    $sql = "SELECT * FROM producto WHERE prodNom LIKE '{$nombre}%' OR prodNom LIKE '%\ {$nombre}%' ESCAPE '\'";
    $res_prod = $conn->prepare($sql);
    $res_prod->execute();
    $tmp_prod = $res_prod->fetchAll();

    
    $sql = "SELECT * FROM categoria WHERE catNom LIKE '{$nombre}%' OR catNom LIKE '%\ {$nombre}%' ESCAPE '\' OR catNom LIKE '%\/{$nombre}%' ESCAPE '\'";
    $res_cat = $conn->prepare($sql);
    $res_cat->execute();
    $tmp_cat = $res_cat->fetchAll();

    $contar1 = sizeof($tmp_cat);
    $contar2 = sizeof($tmp_prod);
    if ($contar1 == 0 && $contar2 == 0) {
        echo "<h2>No se han encontrado resultados para '" . $nombre . "'</h2>";
    } else {
        foreach ($tmp_cat as $value) {
            echo "<div class='uk-grid uk-panel-box uk-margin-bottom '><a href='productos_categoria.php?cat=" . urlencode($value['catId']) . "'><div class='uk-grid' id='thproducto'>";
            echo "<div id='catbusq' class='uk-width-medium-1-1 uk-container-center'><span style='font-family:Roboto-bold;'>Categor&iacute;a: </span> {$value['catNom']}</div>";
            echo "</div></a></div>";
        }
        
        foreach ($tmp_prod as $value) {
            echo "<div class='uk-grid uk-panel-box'><div class='uk-width-medium-3-10'><div class='uk-thumbnail uk-thumbnail-mini'>";
            echo "<img src='../images/" . $value["url"] . "' alt=''><div class='uk-thumbnail-caption'>";
            echo $value["prodNom"] . "</div></div></div><div class='uk-width-medium-7-10'><div class='uk-grid' id='thproducto'>";
            echo "<div class='uk-width-medium-1-1'><div class='uk-text-break'>" . $value["prodDesc"] . "</div></div>";
            echo "<div class='uk-width-medium-5-10 uk-container-center uk-margin-top'>Precio: $" . $value["prodPrecio"] . "</div><div class='uk-width-medium-5-10 uk-margin-top'>En Stock: " . $value["prodExist"] . "</div>";
            if (!isset($_SESSION['user'])) {
              echo "<div class='uk-push-3-10 uk-width-medium-1-1 uk-container-center uk-margin-top'><form class = 'uk-form' ><fieldset><div class='uk-form-row uk-margin-top'><button class='uk-button uk-button-primary' data-uk-modal='{target:\"#login\"}' type='button'>Comprar</button></div></fieldset></form></div></div></div></div>";
              } else {
              echo "<div class='uk-push-2-10 uk-width-medium-1-1 uk-container-center uk-margin-top'><form class = 'uk-form'><fieldset><div class='uk-form-row uk-margin-top'><button class='uk-button uk-button-primary' data-uk-modal='{target:\"#login\"}' type='button'>A&ntilde;adir a la canasta</button></div></fieldset></form></div></div></div></div>";

              } 
        }
    }
}

?>
