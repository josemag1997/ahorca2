
<?php session_start(); ?>


<html>
<head>
<meta charset="UTF-8">

</head>
<body>


<?php
		echo "<br>";
		

/**/$enlace = new mysqli('localhost', 'root','',  'ahorcado');//'app' nombre de la bd

    if ($enlace->connect_errno) {
        printf("Connect failed: %s\n", $enlace->connect_error);
        exit();
    }

  if (isset($_POST["bt_entrar"])) {


        $l=(object)$_POST;
        
        if ($usuario = $enlace->query( "SELECT * FROM iniciar WHERE usuario='$l->usuario' AND contrasena= '$l->contrasena'" )) {
             while ($persona = $usuario->fetch_object()) {
                echo "Dentro";
                //print_r($persona);
                $_SESSION['registrado'] = true;
                $_SESSION['nombre'] = $persona->nombre; 
                //print_r($_SESSION);


                if ($_SESSION['registrado'] == true) {
                    "<form action='juego.html¿ method='post'> 
                   <br><input type='submit' value='Entrar' name='bt_entrar' 
                 </form>";
                 header('Location:juego.html');
                exit();
                }
                
            }
                       
        }else {

            echo"Errormessage: %s\n", $enlace->error;
            
        }
    }


?>
