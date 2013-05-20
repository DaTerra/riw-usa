<?php


	include('../includes/Config.inc.php');

	include('../includes/phpmail/class.phpmailer.php');

	include('../includes/Funcoes.php');

	
	

	foreach ($_POST as $a => $b){

		$$a = $b;

	}
	
	
	if($id_instante1>0){
		$id_instante = $id_instante1;
	}elseif($id_instante2>0){
		$id_instante = $id_instante2;
	}
	
	if(!($id_instante>0)){
		header('Location: ../instantes?msg='.urlencode('Please select a time for your meeting').'&con='.(int)$id_convidado);exit;
	}
	
	$mesas = $DB->consulta('SELECT * FROM tbmeeting_table');
	$instante_mesa = $DB->consulta('SELECT * FROM tbmeeting_convites WHERE status=1 AND tbmeeting_convites.id_instante='.(int)$id_instante);
	
	
	if(!($DB->nun_linhas($mesas)>=$DB->nun_linhas($instante_mesa))){
		header('Location: ../instantes?msg='.urlencode('Unfortunately there aren\'t tables available for this time anymore. Click here to suggest another time. '));exit;
	}
	

	$Dados = array('id_convidado'=>$id_convidado, 'id_solicitante'=>$id_solicitante, 'id_instante'=>$id_instante);
	if($id_registro>0){

		$Dados['status'] = 3;
		$Dados['ordem'] = 3;

		$DB->consulta('DELETE FROM tbmeeting_convites WHERE id_convite='.(int)$id_registro.' LIMIT 1');
		$DB->insereArray( array('tabela'=>'tbmeeting_convites'), $Dados, 'cadastra', $id_user);
		
		$solicitante = $DB->dados('SELECT * FROM tbuser INNER JOIN tbuser_keys ON tbuser.id_user=tbuser_keys.id_user WHERE tbuser.id_user='.$id_solicitante.' LIMIT 1');
		
		
		
		
		
		
	// Envia email para o convidado
	$convidado = $DB->dados('SELECT * FROM tbuser INNER JOIN tbuser_keys ON tbuser.id_user=tbuser_keys.id_user WHERE tbuser.id_user='.$id_convidado.' LIMIT 1');
	$solicitante = $DB->dados('SELECT * FROM tbuser INNER JOIN tbuser_keys ON tbuser.id_user=tbuser_keys.id_user WHERE tbuser.id_user='.$id_solicitante.' LIMIT 1');
	//$solicitante = $DB->dados('SELECT * FROM tbuser WHERE id_user='.$id_solicitante.' LIMIT 1');
	
	$mail = new PHPMailer();
	$mail->IsHTML(true); 
	// Remetente de resposta
	$mail->SetFrom('info@riw-sv.com', 'RIW 2012');
	//E-mal do remetente
	$mail->From = 'registration@riw-sv.com';
	$mail->FromName = 'RIW 2012';
	// Email de destino
	$mail->AddAddress($convidado['email']);
	$mail->Subject = 'New Meeting Reschedule Proposal';
	// Montando a mensagem a ser enviada
	$emailHtml = '<div style="width:700px;">
				<img src="http://www.riw-sv.com/img/email-header.gif" />
				<div style="margin-left:50px;"><br />
				
				Dear '.$convidado['first_name'].' '.$convidado['last_name'].',<br/><br/> '.$solicitante['first_name'].' '.$solicitante['last_name'].' sent you a meeting request. <br /><br />
				To reply please visit your <a href="http://riw-sv.com/meetings">Meeting Dashboard</a>
				<br />
				<br />
				Your private key is: '.$convidado['chave'].'
	
		<br />
		<br />
		Thank you
		</div></div>
	
	
	';
	
	$mail->Body = $emailHtml;
	$mail->AltBody = $mail->Body;
	//exit($emailHtml);
	$enviando = $mail->Send();



	// Mandando email para o solicitante
	unset($mail);
	$mail = new PHPMailer();
	$mail->IsHTML(true); 
	// Remetente de resposta
	$mail->SetFrom('info@riw-sv.com', 'RIW 2012');
	//E-mal do remetente
	$mail->From = 'registration@riw-sv.com';
	$mail->FromName = 'RIW 2012';
	// Email de destino
	$mail->AddAddress($solicitante['email']);
	$mail->Subject = 'Meeting Reschedule Sent';
	// Montando a mensagem a ser enviada
	$emailHtml = '<div style="width:700px;">
				<img src="http://www.riw-sv.com/img/email-header.gif" />
				<div style="margin-left:50px;"><br />
					Dear '.$solicitante['first_name'].' '.$solicitante['last_name'].',<br/><br/> You sent a meeting request to '.$convidado['first_name'].' '.$convidado['last_name'].'. 
					
					You\'ll be notified when  '.$convidado['first_name'].' '.$convidado['last_name'].' replies. For details please visit your <a href="http://riw-sv.com/meetings">Meeting Dashboard</a>
					<br />
					<br />
					Your private key is: '.$solicitante['chave'].'
					<br />
					<br />
					Thank you
				</div></div>
	';
	
	$mail->Body = $emailHtml;
	$mail->AltBody = $mail->Body;
	//exit($emailHtml);
	$enviando = $mail->Send();
		
		
		
		
		header('Location: ../meetings-dashboard?msg='.urlencode('Meeting proposal with '.$convidado['first_name'].' '.$convidado['last_name'].' has been sent.'));exit;
	}
	
	$Dados['ordem'] = 2;
	$DB->insereArray( array('tabela'=>'tbmeeting_convites'), $Dados, 'cadastra', $id_user);


	// Envia email para o convidado
	$convidado = $DB->dados('SELECT * FROM tbuser INNER JOIN tbuser_keys ON tbuser.id_user=tbuser_keys.id_user WHERE tbuser.id_user='.$id_convidado.' LIMIT 1');
	$solicitante = $DB->dados('SELECT * FROM tbuser INNER JOIN tbuser_keys ON tbuser.id_user=tbuser_keys.id_user WHERE tbuser.id_user='.$id_solicitante.' LIMIT 1');
	//$solicitante = $DB->dados('SELECT * FROM tbuser WHERE id_user='.$id_solicitante.' LIMIT 1');
	
	$mail = new PHPMailer();
	$mail->IsHTML(true); 
	// Remetente de resposta
	$mail->SetFrom('info@riw-sv.com', 'RIW 2012');
	//E-mal do remetente
	$mail->From = 'registration@riw-sv.com';
	$mail->FromName = 'RIW 2012';
	// Email de destino
	$mail->AddAddress($convidado['email']);
	$mail->Subject = 'New Meeting Request - Russian Innovation Week 2012.';
	// Montando a mensagem a ser enviada
	$emailHtml = '<div style="width:700px;">
				<img src="http://www.riw-sv.com/img/email-header.gif" />
				<div style="margin-left:50px;"><br />
				
				Dear '.$convidado['first_name'].' '.$convidado['last_name'].',<br/><br/> '.$solicitante['first_name'].' '.$solicitante['last_name'].' sent you a meeting request. <br /><br />
				To reply please visit your <a href="http://riw-sv.com/meetings">Meeting Dashboard</a>
				<br />
				<br />
				Your private key is: '.$convidado['chave'].'
	
		<br />
		<br />
		Thank you
		</div></div>
	
	
	';
	
	$mail->Body = $emailHtml;
	$mail->AltBody = $mail->Body;
	//exit($emailHtml);
	$enviando = $mail->Send();



	// Mandando email para o solicitante
	unset($mail);
	$mail = new PHPMailer();
	$mail->IsHTML(true); 
	// Remetente de resposta
	$mail->SetFrom('info@riw-sv.com', 'RIW 2012');
	//E-mal do remetente
	$mail->From = 'registration@riw-sv.com';
	$mail->FromName = 'RIW 2012';
	// Email de destino
	$mail->AddAddress($solicitante['email']);
	$mail->Subject = 'Meeting Request Sent - Russian Innovation Week 2012.';
	// Montando a mensagem a ser enviada
	$emailHtml = '<div style="width:700px;">
				<img src="http://www.riw-sv.com/img/email-header.gif" />
				<div style="margin-left:50px;"><br />
					Dear '.$solicitante['first_name'].' '.$solicitante['last_name'].',<br/><br/> You sent a meeting request to '.$convidado['first_name'].' '.$convidado['last_name'].'. 
					
					You will be notified when '.$convidado['first_name'].' '.$convidado['last_name'].' replies. For details please visit your <a href="http://riw-sv.com/meetings">Meeting Dashboard</a>
					<br />
					<br />
					Your private key is: '.$solicitante['chave'].'
					<br />
					<br />
					Thank you
				</div></div>
	';
	
	$mail->Body = $emailHtml;
	$mail->AltBody = $mail->Body;
	//exit($emailHtml);
	$enviando = $mail->Send();


	//print_r($Dados);exit(':p');
	header('Location: ../meetings-dashboard?msg='.urlencode('SENT to '.$convidado['first_name'].' '.$convidado['last_name'].', '.$convidado['title'].', '.$convidado['company'].', a meeting Request at the Russian Innovation Week 2012'));exit;
?>