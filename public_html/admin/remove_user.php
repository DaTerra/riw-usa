<?php
	include('../../includes/Config.inc.php');
	include('../../includes/phpmail/class.phpmailer.php');
	include('../../includes/Funcoes.php');
	
	foreach($_POST['selected'] as $v){
		$DB->consulta('DELETE FROM tbuser WHERE id_user='.(int)$v);
		$DB->consulta('DELETE FROM tbhistory WHERE id_user='.(int)$v);
		$DB->consulta('DELETE FROM tbuser_keys WHERE id_user='.(int)$v);
	}
	
	
	header('Location: ../sistema.php?m=invitation&a=lista&S='.urlencode('The contact(s) has/have been deleted.'));exit;
?>