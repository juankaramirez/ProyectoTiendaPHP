/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$("#catEntrada").click(
        function() {
            $("#catEntrada").parent().addClass("active");
            var html = "";
            html += "<div class='container'><div class='row'><div class='col-md-10'>";
            html += "<form role='form' action='categorias.php' method='POST'>";
            html += "<div class='form-group'><label for='nombreCat'>Nombre</label>";
            html += "<input name='categoria' type='text' class='form-control' id='nombreProd' placeholder='Nombre'></div>";
            html += "<input type='submit' class='btn btn-primary' name='enviar' value='Enviar datos'></form></div></div></div>";
            $("#catEnt").html(html);
        });

$("#prodEntrada").click(
        function() {
            $("#prodEntrada").parent().addClass("active");
            var html = "";
            html += "<div class='container'><div class='row'><div class='col-md-10'>";
            html += "<form role='form' action='productos.php' method='POST'><div class='form-group'>";
            html += "<label for='nombreProd'>Nombre</label><input name='nombre' type='text' class='form-control' id='nombreProd' placeholder='Nombre'></div>";
            html += "<div class='row'><div class='col-md-6'><div class='form-group'><label for='idCat'>Id Categor&iacute;a</label>";
            html += "<input name='idcategoria' type='text' class='form-control' id='nombreCat' placeholder='id Categor&iacute;a'></div></div>";
            html += "<div class='col-md-6'><div class='form-group'><label for='codigoProd'>C&oacute;digo</label>";
            html += "<input name='codigo' type='text' class='form-control' id='codigoProd' placeholder='C&oacute;digo'></div></div></div>";
            html += "<div class='row'><div class='col-md-6'><div class='form-group'><label for='precioProd'>Precio</label>";
            html += "<input name='precio' type='text' class='form-control' id='precioProd' placeholder='Precio'></div></div>";
            html += "<div class='col-md-6'><div class='form-group'><label for='existenciasProd'>Existencias</label>";
            html += "<input name='existencias' type='text' class='form-control' id='existenciaProd' placeholder='Existencias'></div></div></div>";
            html += "<input name='enviar' type='submit' class='btn btn-primary' value='Enviar datos'></form></div></div></div>";
            html += ""
            $("#prodEnt").html(html);
        }); 