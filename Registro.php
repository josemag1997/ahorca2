   
<?php

/**/$enlace = new mysqli('localhost', 'root','',  'ahorcado');//'app' nombre de la bd

    if ($enlace->connect_errno) {
        printf("Connect failed: %s\n", $enlace->connect_error);
        exit();
    }


  if (isset($_POST["bt_guardar"])) {
        $r =(object)$_POST;
        //insertar
        $campos = "nombre, apellido, nombre_usu, contrasena, confirmar_contrasena"; //son los valores que esan en bd
        $valores = "'$r->nombre','$r->apellido','$r->nombre_usu', '$r->contrasena', '$r->confirmar_contrasena'"  ; 

        if (!$enlace->query( "INSERT INTO   registro ($campos) values ($valores)" )) {
            
            
            echo"Errormessage: %s\n", $enlace->error;    
            
            
        }else{ 
        echo "<b>Insertado";
        }
    }

?>
  

 </body>
</html>