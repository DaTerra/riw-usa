<?php
	//print_r($_POST);exit;
	include('../includes/Config.inc.php');
	include('../includes/phpmail/class.phpmailer.php');
	include('../includes/Funcoes.php');





// Se o convidado negar um convite
	if($_GET['nega']>0){
		$id_user = (int)$_GET['nega'];
		$DB->insereArray( array('tabela'=>'tbuser', 'id_tabela'=>'id_user'), array('id_status'=>6), 'atualiza', $id_user);
		$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$id_user, 'action'=>'Negou o convite'), 'cadastra', $ID);
		$DB->insereArray( array('tabela'=>'tbuser_keys', 'id_tabela'=>'id_user'), array('usada'=>1), 'atualiza', $id_user);
		
		
			//# Mandando email para o Admin
			$dados = $DB->dados('SELECT * FROM tbuser WHERE id_user='.$id_user.' LIMIT 1');
			$mail = new PHPMailer();
			$mail->IsHTML(true); 
		
			// Remetente de resposta
			$mail->SetFrom('info@riw-sv.com', 'RIW 2012');
		
			//E-mal do remetente
			$mail->From = 'registration@riw-sv.com';
			$mail->FromName = 'RIW 2012';
			
			// Email de destino
			$mail->AddAddress(EMAILREGISTRATION);
			
			$mail->Subject = "RIW2012 - Invitation Refused";
			// Montando a mensagem a ser enviada
			$emailHtml = $dados['first_name']." from ".$dados['company']." refused the invitation";
			
			$mail->Body = $emailHtml;
			$mail->AltBody = $mail->Body;
			
			//exit($emailHtml);
			$enviando_admin = $mail->Send();
				
		
		
		header('Location: ../alert/?msg='.base64_encode("Thank you for letting us know that you can't make it. We hope you can come next year."));exit;
	}
// ================================

	foreach ($_POST as $a => $b){
	 $$a = @addslashes($b);
	}

	
	// Validando os campos necessarios
	$erro = '';
	if(!(strlen($first_name)>3)) $erro.= '- First Name';
	if(!(strlen($last_name)>3)) $erro.= '- Last Name';
	if(!(strlen($company)>3)) $erro.= '- Company';
	if(empty($title)) $erro.= '- Title';
	if(!validaEmail($email)) $erro.= '- E-mail';
	

	
	
	if(strlen($erro)>0){
		header('Location: ../alert/?msg='.base64_encode('Por favor, preencha os seguintes campos obrigatorios corretamente:'.$erro));exit;
	}	

	/*$veridica = $DB->dados('SELECT * FROM tbuser WHERE email="'.(string)$mail.'" LIMIT 1');
	if($veridica['id_user']>0){
		header('Location: ..'.$origem.'/?erro='.base64_encode('This E-mail is already registered. Please e-mail us at info@riw-sv.com if you have any questions.'));exit;
	}*/

	// events
	$events = '';
	foreach($_POST['id_event'] as $v){
		$events .=';'.$v;
	}
	$events .=';';
	// events
	$insdustry = '';
	foreach($_POST['id_typeindustry'] as $x){
		$insdustry1 .=';'.$x;
	}
	$insdustry1.=';';
	
	
	// interests/areas
	$interests = '';
	foreach($_POST['id_interest'] as $x){
		$interests .=';'.$x;
	}
	$interests.=';';
	
	$id_type = (strpos($insdustry1, ';12;')===false)?1:2;
	// Preparando os dados no array
	# duvidas: id_type, id_status																																																																								// String ids events	Jantar				alergia
	$Dados = array('id_status'=>3, 'id_type'=>$id_type,'first_name'=>$first_name, 'last_name'=>$last_name, 'company'=>$company, 'title'=>$title, 'email'=>$email, 'phone'=>$phone,
	 'city'=>$city, 'state'=>$state, 'country'=>$country, 'postal_code'=>$postal_code, 'public_profile'=>$public_profile, 'email_updates'=>$email_updates,
	  'networking'=>$networking, 'attending'=>$events, 'entree'=>$entree, 'allergy'=>$allergy, 'allergy_details'=>$allergy_details, 'industry'=>$insdustry1, 'interests'=>$interests, 'registration_code '=>$registration_code);
	
		//exit($id_user);

	$DB->insereArray( array('tabela'=>'tbuser', 'id_tabela'=>'id_user'), $Dados, 'atualiza', $id_user);
	
	
	// Se tiver indicações 
	$x = count($_POST['first_name1']);
	$a = $x;
	$string_name = '';
	$msgadmin = $last_name.''.$last_name. ' referral the following user(s):<br />';
	if(!empty($_POST['first_name1'][0])){
		for($y=0; $y<=($a-1); $y++){
			// monto os dados
			$Dados_indicao = array('id_status'=>2, 'id_indication'=>$id_user,'first_name'=>$_POST['first_name1'][$y], 'last_name'=>$_POST['last_name1'][$y], 'company'=>$_POST['company1'][$y], 'title'=>$_POST['title1'][$y], 'email'=>$_POST['email1'][$y], 'phone'=>$_POST['phone1'][$y],
				'city'=>$_POST['city1'][$y], 'state'=>$_POST['state1'][$y], 'country'=>$_POST['country1'][$y], 'postal_code'=>$_POST['postal_code1'][$y]);
			
			$nome = $_POST['first_name1'][$y];
			$DB->insereArray( array('tabela'=>'tbuser'), $Dados_indicao, 'cadastra', $ID);
			$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$DB->lastInsertedId(), 'action'=>"Foi indicado por $first_name $last_name para receber convite"), 'cadastra', $ID);
			$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$id_user, 'action'=>"Indicou $nome para receber convite "), 'cadastra', $ID);
			
	
			// preparado nomes para mandar email para o indicador
			
			$string_name .=$nome .' '.$_POST['last_name1'][$y].', ';
			
			/*	
			if($a==2){
				$string_name .=' and ';
			
			}
			if($a>2 and $y<=($a-1)){
				$string_name .=', ';
				
			}
			if($y==($a-2)){
				$string_name .=' and ';
			}
			*/
			
			//=================================================================
			
				$msgadmin .= '
							<p><strong>First Name: </strong>'.$_POST['first_name1'][$y].'</p>
							<p><strong>Last Name: </strong>'.$_POST['last_name1'][$y].'</p>
							<p><strong>Company: </strong>'.$_POST['company1'][$y].'</p>
							<br />
							';
			
			
			//=================================================================
			
			
			
			//=========================== Manda email para o indicado 
			unset($mail);
			$dados = $DB->dados('SELECT * FROM tbemails WHERE id_email=10 LIMIT 1');
			
			$mail = new PHPMailer();
			$mail->IsHTML(true); 
		
			// Remetente de resposta
			$mail->SetFrom('info@riw-sv.com', 'RIW 2012');
		
			//E-mal do remetente
			$mail->From = 'registration@riw-sv.com';
			$mail->FromName = 'RIW 2012';
			
			// Email de destino
			$mail->AddAddress($_POST['email1'][$y]);
			
			$mail->Subject = $dados['subject'];
			// Montando a mensagem a ser enviada
			$emailHtml = str_replace('{[FirstName][LastName]}',  $_POST['first_name1'][$y].' '.$_POST['last_name1'][$y],$dados['email']);
			$emailHtml = str_replace('{[indicador]}',  $first_name.' '.$last_name,$emailHtml);
			
			$mail->Body = $emailHtml;
			$mail->AltBody = $mail->Body;
		
			$enviando = $mail->Send();
			
			
		}
	}

	
	
	if(!empty($_POST['first_name1'][0])){
	
		//====================================================
			// Email referente as indicações, enviada para ADMIN
		//====================================================
			unset($mail);
			$mail = new PHPMailer();
			$mail->IsHTML(true); 
		
			// Remetente de resposta
			$mail->SetFrom('info@riw-sv.com', 'RIW 2012');
		
			//E-mal do remetente
			$mail->From = 'registration@riw-sv.com';
			$mail->FromName = 'RIW 2012';
			
			// Email de destino
			$mail->AddAddress(EMAILREGISTRATION);
			
			$mail->Subject = $last_name.' '.$last_name. ' referral the following user(s):';
			// Montando a mensagem a ser enviada
			$emailHtml = $msgadmin;
			
			$mail->Body = $emailHtml;
			$mail->AltBody = $mail->Body;
		
			$enviando = $mail->Send();
			
	
	
	
	//====================================================
		// Email referente a indicação enviada para INDICADOR
	//====================================================
	unset($mail);
	// Enviando os emails necessarios
	$dados = $DB->dados('SELECT * FROM tbemails WHERE id_email=9 LIMIT 1');
	
	$mail = new PHPMailer();
	$mail->IsHTML(true); 

	// Remetente de resposta
	$mail->SetFrom('info@riw-sv.com', 'RIW 2012');

	//E-mal do remetente
	$mail->From = 'registration@riw-sv.com';
	$mail->FromName = 'RIW 2012';
	
	// Email de destino
	$mail->AddAddress($email);
	
	$mail->Subject = $dados['subject'];
	// Montando a mensagem a ser enviada
	$emailHtml = str_replace('{[FirstName][LastName]}',  $first_name.' '.$last_name,$dados['email']);
	$emailHtml = str_replace('{[indicados]}', $string_name ,$emailHtml);
	
	$mail->Body = $emailHtml;
	$mail->AltBody = $mail->Body;

	$enviando = $mail->Send();
	
	}
	
	//================================================
		// Email de confirmação enviado para o convidado
	//================================================
	
	unset($mail);
	// Enviando os emails necessarios
	$dados = $DB->dados('SELECT * FROM tbemails WHERE id_email=8 LIMIT 1');
	
	$mail = new PHPMailer();
	$mail->IsHTML(true); 

	// Remetente de resposta
	$mail->SetFrom('info@riw-sv.com', 'RIW 2012');

	//E-mal do remetente
	$mail->From = 'registration@riw-sv.com';
	$mail->FromName = 'RIW 2012';
	
	// Email de destino
	$mail->AddAddress($email);
	
	$mail->Subject = $dados['subject'];
	// Montando a mensagem a ser enviada
	$emailHtml = str_replace('{[FirstName][LastName]}',  $first_name.' '.$last_name,$dados['email']);
	
	$mail->Body = $emailHtml;
	$mail->AltBody = $mail->Body;

	$enviando = $mail->Send();
	
	
	
	
	//==========================================================
	//# Mandando email para o Admin
	unset($mail);
	
	$mail = new PHPMailer();
	$mail->IsHTML(true); 

	// Remetente de resposta
	$mail->SetFrom('info@riw-sv.com', 'RIW 2012');

	//E-mal do remetente
	$mail->From = 'registration@riw-sv.com';
	$mail->FromName = 'RIW 2012';
	
	// Email de destino
	$mail->AddAddress(EMAILREGISTRATION);
	
	$mail->Subject = "RIW2012 - A guest confirmed the invitation.";
	// Montando a mensagem a ser enviada
	$emailHtml = "<strong>$first_name</strong> from COMPANY is going to RIW2012..";
	
	$mail->Body = $emailHtml;
	$mail->AltBody = $mail->Body;
	
	//exit($emailHtml);
	$enviando_admin = $mail->Send();
	
	
// ============================================	
	
	
	if(!$enviando){
		header('Location: ..'.$origem.'/?suc='.base64_encode('Erro ao mandar o email'));exit;
	}
	

	$DB->insereArray( array('tabela'=>'tbuser', 'id_tabela'=>'id_user'), array('id_status'=>5), 'atualiza', $id_user);
	$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$id_user, 'action'=>"$first_name accept invitation"), 'cadastra', $ID);
	$DB->insereArray( array('tabela'=>'tbuser_keys', 'id_tabela'=>'id_user'), array('usada'=>1), 'atualiza', $id_user);
	
	exit;
	header('Location: ../alert/?msg='.base64_encode("Congratulations. Your invitation has been confirmed. We are looking forward to see you!!"));exit;
?>