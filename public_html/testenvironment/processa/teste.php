<?php

	//print_r($_POST);exit;

	include('../includes/Config.inc.php');

	include('../includes/phpmail/class.phpmailer.php');

	include('../includes/Funcoes.php');

	$mail = new PHPMailer();

	$mail->IsHTML(true); 


	$mail->From = 'registration@riw-sv.com';

	$mail->FromName = 'RIW 2012';

	

	// Email de destino

	$mail->AddAddress('carlos@adianteweb.com.br');

	

	$mail->Subject = 'RIW 2012 - New invite request';

	// Montando a mensagem a ser enviada

	$emailHtml = '<div style="width:700px; min-height:100px;">
					<img src="http://www.riw-sv.com/img/email-header.gif" />
					oioiiooi   
				</div>  
	';

	$mail->Body = $emailHtml;

	$mail->AltBody = $mail->Body;

	
	$enviando_admin = $mail->Send();

?>