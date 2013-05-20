<?php


	include('../includes/Config.inc.php');

	include('../includes/phpmail/class.phpmailer.php');

	include('../includes/Funcoes.php');

	
	
	foreach ($_POST as $a => $b){

		$$a = $b;

	}


	if(empty($email) or empty($key)){	
		header('Location: ../meetings/?erro='.urlencode('Please verify your email and/or key.'));exit;
	}else{
		$login = $DB->dados("SELECT * FROM tbuser 
							INNER JOIN tbuser_keys ON tbuser.id_user=tbuser_keys.id_user
							WHERE tbuser.email='".$email."' AND tbuser.id_status=5 AND tbuser_keys.chave ='".(string)$key."' LIMIT 1");
		

			if($login['id_user']>0){	
				$_SESSION['site_agenda'] = $login;
			}else{
				header('Location: ../meetings/?erro='.urlencode('Wrong login info. Please verify you E-mail and/or key.'));exit;
			}

	}

	header('Location: ../meetings-dashboard?msg='.urlencode('Welcome '.$login['first_name'].' '.$login['last_name']));exit;
?>