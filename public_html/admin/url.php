<?php
	$modulo = $_GET['m'];

	if(!empty($modulo)){
		if(file_exists('./modulos/'.$modulo.'.php')){
			include('./modulos/'.$modulo.'.php');	
		}
		else{
			include('./modulos/inicio.php');
		}
	}else{
		include('./modulos/inicio.php');
	}
?>