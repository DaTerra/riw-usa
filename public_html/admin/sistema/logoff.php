<?
	include('../../includes/Config.inc.php');
	
	// Destruindo a sess�o
	unset($_SESSION['adm_usuario']);
	
	
	header('Location: ../autentica.php?suc='.urlencode('You have been disconnected.'));exit;
?>
