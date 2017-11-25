<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">

<title>Login</title>

                <link rel="stylesheet" type="text/css" href="css/Menu2.css">

<header>
    <div id="subheader">
      <div id="logotipo"><p><a ref="">Ahorcado</a></p></div>
      <nav>
        <ul>
          <li> <a href="index.html"> Inicio </a></li>
          <li> <a href="Instrucciones1.html"> Instrucciones </a></li>
          <li> <a href="mensaje.html"> Jugar </a></li>
          <li><a href="index2.html #popup">Login</a></li>
          <li> <a href="Registro.php"> Registro </a></li>



        </ul>
      </nav>
    </div>
  </header>
<br>
<br>
<br>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" conect="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minium-scale=1">
    <link rel="stylesheet" type="text/css" href="css/VentanaL.css">
	</head>

		<body>

			<input type="checkbox" id="cerrar">
			<label for="cerrar" id="btn-cerrar">X</label>
			<div class="modal">
				<div class="contenido">

		</body>





</head>
<body>
	<form action="ventanaL.php" method="post">

				<input type="text" placeholder="&#128272; Usuario" name="usuario">
				<input type="password" placeholder="&#128273; Contraseña" name="contrasena">
				<input type="submit" value="Ingresar" name="bt_Ingresar">
		</form>
	</body>
</html>



<?php session_start(); 
		echo "<br>";
		

/**/$enlace = new mysqli('localhost', 'root','',  'ahorcado');//'app' nombre de la bd

    if ($enlace->connect_errno) {
        printf("Connect failed: %s\n", $enlace->connect_error);
        exit();
    }

  if (isset($_POST["bt_Ingresar"])) {


        $l=(object)$_POST;
        
        if ($usuario = $enlace->query( "SELECT * FROM iniciar WHERE usuario='$l->usuario' AND contrasena= '$l->contrasena'" )) {
             while ($persona = $usuario->fetch_object()) {
             
                $_SESSION['registrado'] = true;
                $_SESSION['nombre'] = $persona->nombre; 
               


                if ($_SESSION['registrado'] == true) {
                    "<form action='juego.php¿ method='post'> 
                   <br><input type='submit' value='ingresar' name='bt_Ingresar' 
                 </form>";
                 header('Location:juego.php');
                exit();
                }
                
            }
                       
        }else {

            echo"Errormessage: %s\n", $enlace->error;
            
        }
    }


?>