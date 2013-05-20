<?php
	include('../../includes/Config.inc.php');
	include('../../includes/phpmail/class.phpmailer.php');
	include('../../includes/Funcoes.php');
	
	foreach($_POST['selected'] as $v){
		$DB->consulta('DELETE FROM tbinformation WHERE id_info='.(int)$v);
		$DB->consulta('DELETE FROM tbinformation_videos WHERE id_info='.(int)$v);
		$DB->consulta('DELETE FROM tbinfo_presentation WHERE id_info='.(int)$v);
	}
	
	
	header('Location: ../sistema.php?m=submit&a=lista&S='.urlencode('Deleted.'));exit;
?>