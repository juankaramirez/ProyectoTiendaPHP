<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap-3.0.0/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <title>Info</title>
    </head>
    <body>
        
        <div class="jumbotron">
            <h1>Welcome&excl;</h1>
            <p class="help-block">Enter your info and log in.</p>
        </div>
        
            
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <form role="form">
                        <div class="form-group">
                            <label for="inputUsername">Username</label>
                            <input type="username" class="form-control" id="inputUsername" placeholder="Enter your username">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control" id="inputPassword" placeholder="Enter your password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember account
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="container">
        <?php
            $conn = new PDO('sqlite:db/StoreSchema.sqlite');
            $sql = 'SELECT * FROM admin';
            
            print "<table class=\"table\" <thead><tr><th>adminId</th><th>username</th></tr></thead><tbody";
            foreach ($conn->query($sql) as $row){
                print "<tr><td>".$row['adminId']."</td><td>".$row['username']."</td></tr>";
            }
            
            print "</tbody></table>";
            
            $sql = 'SELECT * FROM cliente';
                    
            foreach ($conn->query($sql) as $row){
                print $row['clienteNom']." ".$row['clienteAp']."<br>";
            }
            
            print "<br>";
            
            $sql = 'SELECT * FROM cliente WHERE clienteDir = :cliented';
            $cons = $conn->prepare($sql);
            $cons->execute(array('cliented'=>'Narnia'));
            $res = $cons->fetchAll();
            //if(is_array($res)){
            foreach ($res as $row){
                echo "Nombre: ".$row["clienteNom"]." ".$row["clienteAp"].'<br>';
            }
            //echo "YEAH";
            //}
        ?>
        </div>  
    </body>
</html>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
