<?
	include('../includes/Config.inc.php');

	if(!empty($_SESSION['adm_usuario']['id_usuario'])>0){
		header("Location: sistema.php");exit;
	}else{
		header("Location: autentica.php");exit;	
	}
	
?>