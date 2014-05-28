/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$('#catEntrada').click(
        function(){
            
            var html = "";
            html += "<div class='container'><div class='row'><div class='col-md-10'>";
            html += "<form role='form' action='categorias.php' method='POST'>";
            html += "<div class='form-group'><label for='nombreCat'>Nombre</label>";
            html += "<input name='nomCat' type='text' class='form-control' id='nombreCat' placeholder='Nombre'></div>";
            html += "<div class='form-group'><input type='submit' class='btn btn-primary' name='enviar' value='Enviar datos'></div></form></div></div></div>";
            
            if(!$('#catEntrada').parent().hasClass('active')){
                $("#catFunc").hide().addClass('col-md-4').html(html).show(200);
                $('#catEntrada').parent().addClass('active');
                $('#catEditar').parent().removeClass('active');
                $('#catEliminar').parent().removeClass('active');
            }
});

$('#catEditar').click(
        function (){

            var html = "";
            html += "<div class='container'><div class='row'><div class='col-md-10'>";
            html += "<form role='form' action='categorias.php' method='POST'>";
            html += "<div class='form-group'><div class='row'><div class='col-md-3'><label for='idCat'>Id</label></div>";
            html += "<div class='col-md-9'><label for='nomCat'>Nombre</label></div></div>";
            html += "<div class='row'><div class='col-md-3'><input name='idCat' type='text' class='form-control' id='idCat' placeholder='Id'></div>";
            html += "<div class='col-md-9'><input name='nomCat' type='text' class='form-control' id='nomCat' placeholder='Nombre'></div></div></div>";
            html += "<div class='form-group'><input type='submit' class='btn btn-primary' name='editar' value='Editar'></div></form></div></div></div>";
            
            if(!$('#catEditar').parent().hasClass('active')){
                $("#catFunc").hide().addClass('col-md-4').html(html).show(200);
                $('#catEntrada').parent().removeClass('active');
                $('#catEditar').parent().addClass('active');
                $('#catEliminar').parent().removeClass('active');
            }           
 });

    
$('#catEliminar').click(
        function() {
            var html = "";
            html += "<div class='container'><div class='row'><div class='col-md-10'>";
            html += "<form role='form' action='categorias.php' method='POST'>";
            html += "<div class='form-group'><label for='idCat'>Id Categor&iacute;a</label>";
            html += "<input name='idCat' type='text' class='form-control' id='idCat' placeholder='Id Categor&iacute;a'></div>";
            html += "<div class='form-group'><input type='submit' class='btn btn-primary' name='eliminar' value='Eliminar'></div></form></div></div></div>";

            if (!$('#catEliminar').parent().hasClass('active')) {
                $("#catFunc").hide().addClass('col-md-4').html(html).show(200);
                $('#catEntrada').parent().removeClass('active');
                $('#catEditar').parent().removeClass('active');
                $('#catEliminar').parent().addClass('active');
            }
        });


$('#prodEntrada').click(
        function() {
            
            var html = "";
            html += "<div class='container'><div class='row'><div class='col-md-10'>";
            html += "<form role='form' action='productos.php' method='POST' enctype='multipart/form-data'><div class='form-group'>";
            html += "<label for='nombreProd'>Nombre</label><input name='nombre' type='text' class='form-control' id='nombreProd' placeholder='Nombre'></div>";
            html += "<div class='row'><div class='col-md-6'><div class='form-group'><label for='idCat'>Id Categor&iacute;a</label>";
            html += "<input name='idcategoria' type='text' class='form-control' id='nombreCat' placeholder='id Categor&iacute;a'></div></div>";
            html += "<div class='col-md-6'><div class='form-group'><label for='codigoProd'>C&oacute;digo</label>";
            html += "<input name='codigo' type='text' class='form-control' id='codigoProd' placeholder='C&oacute;digo'></div></div></div>";
            html += "<div class='row'><div class='col-md-6'><div class='form-group'><label for='precioProd'>Precio</label>";
            html += "<input name='precio' type='text' class='form-control' id='precioProd' placeholder='Precio'></div></div>";
            html += "<div class='col-md-6'><div class='form-group'><label for='existenciasProd'>Existencias</label>";
            html += "<input name='existencias' type='text' class='form-control' id='existenciaProd' placeholder='Existencias'></div></div></div>";
            html += "<div class='row'><div class='col-md-10'><div class='form-group'><label for='desc'>Descripci&oacute;n</label><textarea name='descripcion' class='form-control' rows='3'></textarea></div></div></div>";
            html += "<div class='row'><div class='col-md-10'><div class='form-group'><label for='img'>Imagen</label>";
            html += "<input name='img' type='file'  id='img'></div></div></div>";
            html += "<div class='form-group'><input name='enviar' type='submit' class='btn btn-primary' value='Enviar datos'></div></form></div></div></div>";
            
            if(!$('#prodEntrada').parent().hasClass('active')){
                $("#prodFunc").hide().addClass('col-md-4').html(html).show(200);
                $('#prodEntrada').parent().addClass('active');
                $('#prodEditar').parent().removeClass('active');
                $('#prodEliminar').parent().removeClass('active');
            }
            
}); 
        
$('#prodEditar').click(
        function (){

            var html = "";
            html += "<div class='container'><div class='row'><div class='col-md-10'>";
            html += "<form role='form' action='productos.php' method='POST' enctype='multipart/form-data'><div class='row'><div class='col-md-3'><div class='form-group'>";
            html += "<label for='idProd'>Id</label><input name='idProd' type='text' class='form-control' id='idProd' placeholder='Id'></div></div>";
            html += "<div class='col-md-9'><div class='form-group'><label for='nombreProd'>Nombre</label><input name='nombre' type='text' class='form-control' id='nombreProd' placeholder='Nombre'></div></div></div>";
            html += "<div class='row'><div class='col-md-6'><div class='form-group'><label for='idCat'>Id Categor&iacute;a</label>";
            html += "<input name='idcategoria' type='text' class='form-control' id='nombreCat' placeholder='id Categor&iacute;a'></div></div>";
            html += "<div class='col-md-6'><div class='form-group'><label for='codigoProd'>C&oacute;digo</label>";
            html += "<input name='codigo' type='text' class='form-control' id='codigoProd' placeholder='C&oacute;digo'></div></div></div>";
            html += "<div class='row'><div class='col-md-6'><div class='form-group'><label for='precioProd'>Precio</label>";
            html += "<input name='precio' type='text' class='form-control' id='precioProd' placeholder='Precio'></div></div>";
            html += "<div class='col-md-6'><div class='form-group'><label for='existenciasProd'>Existencias</label>";
            html += "<input name='existencias' type='text' class='form-control' id='existenciaProd' placeholder='Existencias'></div></div></div>";
            html += "<div class='row'><div class='col-md-10'><div class='form-group'><label for='desc'>Descripci&oacute;n</label><textarea name='descripcion' class='form-control' rows='3'></textarea></div></div></div>";
            html += "<div class='row'><div class='col-md-10'><div class='form-group'><label for='img'>Imagen</label>";
            html += "<input name='img' type='file'  id='img'></div></div></div>";
            html += "<div class='form-group'><input name='editar' type='submit' class='btn btn-primary' value='Editar'></div></form></div></div></div>";
            
            if(!$('#prodEditar').parent().hasClass('active')){
                $("#prodFunc").hide().addClass('col-md-4').html(html).show(200);
                $('#prodEntrada').parent().removeClass('active'); 
                $('#prodEliminar').parent().removeClass('active'); 
                $('#prodEditar').parent().addClass('active');
            }            
 });
 
$('#prodEliminar').click(
        function (){

            var html = "";
            html += "<div class='container'><div class='row'><div class='col-md-10'>";
            html += "<form role='form' action='productos.php' method='POST'>";
            html += "<div class='form-group'><label for='idProd'>Id Producto</label>";
            html += "<input name='idProd' type='text' class='form-control' id='idProd' placeholder='Id Producto'></div>";
            html += "<div class='form-group'><input type='submit' class='btn btn-primary' name='eliminar' value='Eliminar'></div></form></div></div></div>";
            
            if(!$('#prodEliminar').parent().hasClass('active')){
                $("#prodFunc").hide().addClass('col-md-4').html(html).show(200);
                $('#prodEntrada').parent().removeClass('active'); 
                $('#prodEliminar').parent().addClass('active'); 
                $('#prodEditar').parent().removeClass('active');
            }
 });