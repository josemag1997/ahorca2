<link rel="stylesheet" type="text/css" href="css/estilo.css">
<?php 
//EMPIEZA EL JUEGO ELIGE palabras Y PONE CONTADORES A 0
function empezar(){

	$_SESSION['palabras']=elegirtitulo();

	for ($i=0; $i <strlen($_SESSION['palabras'])-2 ; $i++) { 

		if ($_SESSION['palabras'][$i]===' ') {
			$cifrado[$i]='&nbsp;';
		}else{
			$cifrado[$i]=' _ ';
		}
	}
	$_SESSION['cifrado']=$cifrado;

	$_SESSION['fallos']=' ';
	$_SESSION['yajugada']=':';
	$_SESSION['errores']=0;
	$_SESSION['aciertos']=0;

	$_SESSION['ahorcado']=[ '<b style="color: black">A</b>',
							'<b style="color: black">H</b>',
							'<b style="color: black">O</b>',
							'<b style="color: black">R</b>',
							'<b style="color: black">C</b>',
							'<b style="color: black">A</b>',
							'<b style="color: black">D</b>',
							'<b style="color: black">O</b>',
	]; 

	//habilita el input
	$_SESSION['deshabilitar']='';
	//saber cuantas letras hay
	$_SESSION['posiciones']=array_count_values($_SESSION['cifrado']);
}
//COMPRUEBA EL CARACTER INTRODUSIDO
function jugar($letra){
	$valor; $estado=false;$valida=true;

	if (ctype_alpha($letra)==false && utf8_encode($letra)) {
		echo "No has metido ninguna letra.";
		$valida=false;
	}elseif (yajugada($letra)) {
		$valor=0;
	}else{
		for ($i=0; $i <count($_SESSION{'cifrado'}) ; $i++) { 
			if ($_SESSION['palabras'][$i]==$letra || $_SESSION['palabras'][$i]==strtoupper($letra)) {
				$_SESSION['cifrado'][$i]=$letra;
				$_SESSION['aciertos']+=1;
				$estado=true;
			}else{
				$valor=2;
			}
		}
		//compruebo la letra.
		if ($estado==false) {$_SESSION['errores']+=1; $_SESSION['fallos'].=$letra;}
		if ($estado==true) {$valor=1;}
		if ($_SESSION['errores']==strlen('ahorcado')) {$valor=3;}
		if ($_SESSION['aciertos']==$_SESSION['posiciones'][' _ ']) {$valor=4;}
	}
	if ($valida) {
		sacarResultado($valor,$letra);
	}
}

//devuelve el resultado de la letra
function sacarResultado($valor, $letra){
	switch ($valor) {
		case '0':
			echo "<b>La letra </b>".$letra."<b>  ya se ha dicho.</b>";
			//echo $imagen;
			break;
		case '1':
			echo "has acertado la letra ".$letra."! ";
			//echo $imagen;
			break;
		case '2':
			echo "La letra ".$letra." no esta.";
			//echo $imagen;
			ahorcar();
			break;
		case '3':

			//echo "<script language= javascript type= text/javascript src='js/alert.js'></script>";
		    echo '<script type="text/javascript"> perder() </script>';	
		    echo "<h3>La palabra era: </h3>"."<h2>".$_SESSION['palabras']."</h2>";	
			//	
			echo "<a href='juego.php'>volver a jugar</a>";	

			echo '<script type="text/javascript"> stop() </script>';
			

			//require 'modal.html';
			
			ahorcar();
			break;
		case '4':
			echo "<a href='juego.php'>volver a jugar</a>";
			//require 'ganaste.html';
			//$_SESSION['deshabilitar']='disabled';
		    	echo '<script type="text/javascript"> gnast() </script>';
		    	echo '<script type="text/javascript"> stop() </script>';

		    	

			break;
	}
}


//DEVUELVE UN TITULO AL AAZAR DEL FICHERO PELIS.TXT
function elegirtitulo(){
	$palabrass=file_get_contents('palabras.txt');
	$cont=-1;
	//Separa la cadena por letra mayuscula.
	for ($i=0; $i <strlen($palabrass); $i++) { 
		if (ctype_upper($palabrass[$i])) {
			$cont++;
			$palabras[$cont]='';
			//print_r($palabrass);
		}
		$palabras[$cont].=$palabrass[$i];
	}
	$pos=rand(0,count($palabras)-1);
	return $palabras[$pos];
}

//comprueba si una letra ya se ha jugado
function yajugada($letra){
	$estado=false;
	if (strpos($_SESSION['yajugada'], $letra)) {
		$estado=true;
	}else{
		$_SESSION['yajugada'].=$letra;
	}
	return $estado;
}


//coloca roja cada letra del titulo con cada fallo cometido
function ahorcar(){
	for ($i=0; $i <$_SESSION['errores'] ; $i++) { 
		$posicion_coincidencia = strpos($_SESSION['ahorcado'][$i], 'black');
		if($posicion_coincidencia){
			$_SESSION['ahorcado'][$i]=str_replace('black', 'red', $_SESSION['ahorcado'][$i]);
		}
	}
}
?>
