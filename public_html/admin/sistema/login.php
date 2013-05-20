<?
	require('../../includes/Config.inc.php');
	require('./includes/funcoes.adm.php');
	
	foreach ($_POST as $a => $b){
		$$a = $b;
	}

	if(empty($usuario) or empty($senha)){	
		header('Location: ../autentica.php?erro='.urlencode('Please provide an username and password'));exit;
	}else{
	
		$login = $DB->dados("SELECT *, DATE_FORMAT(ultimo_login, '%d/%m/%Y às %H:%i') as data FROM TBAAUSUARIOS WHERE login='".$usuario."' AND senha ='".md5($senha)."' LIMIT 1");

			if($login['id_usuario']>0){	
				$_SESSION['adm_usuario'] = $login;
				$DB->consulta('UPDATE TBAAUSUARIOS SET ultimo_login=now()') or die(mysql_error());
			}else{
				header('Location: ../autentica.php?erro='.urlencode('Wrong username and/or password.'));exit;
		}
	}
	
	
	header('Location: ../sistema.php');exit;
?>




