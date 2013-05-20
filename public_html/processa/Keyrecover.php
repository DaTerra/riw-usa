<?php


	include('../includes/Config.inc.php');

	include('../includes/phpmail/class.phpmailer.php');

	include('../includes/Funcoes.php');

	
	

	foreach ($_POST as $a => $b){

		$$a = $b;

	}


	if(!validaEmail($email)){
		header('Location: ../keyrecover/?msg='.urlencode('Please verify your e-mail.'));exit;
	}
	
	$dados = $DB->dados("SELECT * FROM tbuser INNER JOIN tbuser_keys ON tbuser.id_user=tbuser_keys.id_user WHERE tbuser.email='".$email."' LIMIT 1");
	
	if(!($dados['id_user']>0)){
		header('Location: ../keyrecover/?msg='.urlencode('The e-mail provided is not in the system. Please contact registration@riw-sv.com if any questions.'));exit;
	}
	/*echo '<pre>';
	print_r($dados);
	exit($email);
	*/

	$mail = new PHPMailer();
	$mail->IsHTML(true); 
	// Remetente de resposta
	$mail->SetFrom('info@riw-sv.com', 'RIW 2012');
	//E-mal do remetente
	$mail->From = 'registration@riw-sv.com';
	$mail->FromName = 'RIW 2012';
	// Email de destino
	$mail->AddAddress($dados['email']);
	$mail->Subject = 'RIW 2012 - Meeting login key';
	// Montando a mensagem a ser enviada
	$emailHtml = '<div style="width:700px;">
				<img src="http://www.riw-sv.com/img/email-header.gif" />
				<div style="margin-left:50px;"><br />
		Hello '.$dados['first_name'].' '.$dados['last_name'].', <br /><br />

		Your key has been request to access the meeting panel on riw-sv.com. <br /><br />

		<strong>Your key is:</strong> '.$dados['chave'].'<br /><br />

		Thank you
		</div></div>
	';
	
	$mail->Body = $emailHtml;
	$mail->AltBody = $mail->Body;
	//exit($emailHtml);
	$enviando = $mail->Send();

	header('Location: ../keyrecover/?msg='.urlencode('Your key has been sent to '.$dados['email']));exit;
?>