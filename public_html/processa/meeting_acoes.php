<?php


	include('../includes/Config.inc.php');

	include('../includes/phpmail/class.phpmailer.php');

	include('../includes/Funcoes.php');

	
	

	foreach ($_GET as $a => $b){

		$$a = $b;

	}



	$decline = false;
	if($acao=='decline'){
		$decline = true;
		$DB->consulta('UPDATE tbmeeting_convites SET status=2, status_edit=6, id_table=0, ordem=1 WHERE id_convite='.(int)$reg);
		//header('Location: ../meetings-dashboard');exit;
	}
	
	if($acao=='mydecline'){
		$decline = true;
		$DB->consulta('UPDATE tbmeeting_convites SET status=2, status_edit=4, id_table=0, ordem=1 WHERE id_convite='.(int)$reg);
		//header('Location: ../meetings-dashboard');exit;

	}
	if($acao=='sentdecline'){
		$decline = true;
		$DB->consulta('UPDATE tbmeeting_convites SET status=2, status_edit=5, id_table=0, ordem=1 WHERE id_convite='.(int)$reg);
		//header('Location: ../meetings-dashboard');exit;

	}
	
	
	
	
	
	if($decline){
		
	
	
	$convidado = $DB->dados('SELECT * FROM tbuser INNER JOIN tbuser_keys ON tbuser.id_user=tbuser_keys.id_user WHERE tbuser.id_user='.(int)$_GET['con'].' LIMIT 1');
	$solicitante = $DB->dados('SELECT * FROM tbuser INNER JOIN tbuser_keys ON tbuser.id_user=tbuser_keys.id_user WHERE tbuser.id_user='.(int)$_GET['sol'].' LIMIT 1');
		
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
	$mail->Subject = 'Not available for meeting';
	// Montando a mensagem a ser enviada
	$emailHtml = '<div style="width:700px;">
				<img src="http://www.riw-sv.com/img/email-header.gif" />
				<div style="margin-left:50px;"><br />
				 	Dear '.$solicitante['first_name'].' '.$solicitante['last_name'].'
					<br/><br/>
					. '.$convidado['first_name'].' '.$convidado['last_name'].' is not available at the requested meeting time. <br/><br/>For details please visit your <a href="http://riw-sv.com/meetings">Meeting Dashboard</a>					
					
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

		
		
		
		header('Location: ../meetings-dashboard');exit;
	}
	
	
	
	
	
	
	
	

	if($acao=='acept'){
		
		$dados = $DB->dados('SELECT * FROM tbmeeting_convites WHERE id_convite='.(int)$reg);

		$mesas = $DB->consulta('SELECT * FROM tbmeeting_table ORDER BY RAND()');

		while($linha = $DB->lista($mesas)){
			
			$verifica = $DB->dados('SELECT * FROM tbmeeting_convites WHERE id_table='.(int)$linha['id_table'].' AND id_instante='.(int)$dados['id_instante']);
			
			if(!($verifica['id_convite']>0)){
				
				$id_mesa = $linha['id_table'];
				continue;
				
			}
			
		}
		
		//$id_mesa = 0;
		if(!($id_mesa>0)){
			header('Location: ../instantes?msg='.urlencode('All the tables are full for this time. Please try another time.'));exit;
		}
		
		$DB->consulta('UPDATE tbmeeting_convites SET status=1, id_table='.$id_mesa.', ordem=4 WHERE id_convite='.(int)$reg);
		








	// Envia email para o convidado
	$convite = $DB->dados('SELECT * FROM tbmeeting_convites 
							INNER JOIN tbmeeting_instantes ON tbmeeting_convites.id_instante=tbmeeting_instantes.id_instante
							INNER JOIN tbmeeting_day ON tbmeeting_instantes.id_day=tbmeeting_day.id_day
							tbmeeting_convites.id_convite='.(int)$reg.' LIMIT 1');
							
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
	$mail->Subject = 'ACCEPTED Meeting at the Russian Innovation Week 2012';
	// Montando a mensagem a ser enviada
	$emailHtml = '<div style="width:700px;">
				<img src="http://www.riw-sv.com/img/email-header.gif" />
				<div style="margin-left:50px;"><br />
				
					Dear '.$convidado['first_name'].' '.$convidado['last_name'].', 
					<br/><br/>
					You are confirmed to meet '.$solicitante['first_name'].' '.$solicitante['last_name'].','.$convite['day'].' '.$convite['instante'].' on '.$convite['table'].' at the Russian Innovation Week 2012. For details please visit your <a href="http://riw-sv.com/meetings">Meeting Dashboard</a>
			
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
	$mail->Subject = 'ACCEPTED Meeting at the Russian Innovation Week 2012';
	// Montando a mensagem a ser enviada
	$emailHtml = '<div style="width:700px;">
				<img src="http://www.riw-sv.com/img/email-header.gif" />
				<div style="margin-left:50px;"><br />
				 	Dear '.$solicitante['first_name'].' '.$solicitante['last_name'].',
					<br/><br/>
					You are confirmed to meet '.$convidado['first_name'].' '.$convidado['last_name'].' Thr '.$convite['day'].' on '.$convite['table'].' at the Russian Innovation Week 2012. For details please visit your <a href="http://riw-sv.com/meetings">Meeting Dashboard</a>					
					
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

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		header('Location: ../meetings-dashboard');exit;
	}



	//exit;
	$Dados = array('id_convidado'=>$id_convidado, 'id_solicitante'=>$id_solicitante, 'id_instante'=>$id_instante, 'id_table'=>$id_table);
	$DB->insereArray( array('tabela'=>'tbmeeting_convites'), $Dados, 'cadastra', $id_user);
	
	//print_r($Dados);exit(':p');
	header('Location: ../meetings-dashboard');exit;
?>