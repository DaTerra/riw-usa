<?php
	//print_r($_POST);exit;
	include('../includes/Config.inc.php');
	include('../includes/phpmail/class.phpmailer.php');
	include('../includes/Funcoes.php');
	
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
		header('Location: ..'.$origem.'/?erro='.base64_encode('Por favor, preencha os seguintes campos obrigatorios corretamente:'.$erro));exit;
	}	


	// events
	$events = '';
	foreach($_POST['id_event'] as $v){
		$events .=';'.$v;
	}
	$events .=';';
	// events
	$insdustry = '';
	foreach(@$_POST['id_typeindustry'] as $x){
		$insdustry1 .=';'.$x;
	}
	$insdustry1.=';';
	// interests/areas
	$interests = '';
	foreach(@$_POST['id_interest'] as $x){
		$interests .=';'.$x;
	}
	$interests.=';';
	
	$id_type = (strpos($insdustry1, ';12;')===false)?1:2;
	// Preparando os dados no array
	# duvidas: id_type, id_status																																																																								// String ids events	Jantar				alergia
	$Dados = array('id_status'=>3, 'id_type'=>$id_type,'first_name'=>$first_name, 'last_name'=>$last_name, 'company'=>$company, 'title'=>$title, 'email'=>$email, 'phone'=>$phone,
	 'city'=>$city, 'state'=>$state, 'country'=>$country, 'postal_code'=>$postal_code, 'public_profile'=>$public_profile, 'email_updates'=>$email_updates,
	  'networking'=>$networking, 'attending'=>$events, 'entree'=>$entree, 'allergy'=>$allergy, 'allergy_details'=>$allergy_details, 'industry'=>$insdustry1, 'interests'=>$interests, 'registration_code '=>$registration_code);
	
	$DB->insereArray( array('tabela'=>'tbuser'), $Dados, 'cadastra', $ID);
	
	// Enviando os emails necessarios
	$dados = $DB->dados('SELECT * FROM tbemails WHERE id_email=1 LIMIT 1');
	
	/*$mail = new PHPMailer();
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
	$emailHtml = str_replace('[{First Name}]', $first_name,$dados['email']);
	
	$mail->Body = $emailHtml;
	$mail->AltBody = $mail->Body;

	$enviando = $mail->Send();
	
	*/
	
	
	//$subject = "Please validate your email";
	//$message   = "Validation info, blah blah. 2nd msg";
	$Header = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$Header .= 'From: RIW 2012 <registration@riw-sv.com >' . "\r\n";
	$body = str_replace('[{First Name}]', $first_name,$dados['email']);
	$enviando = mail($email, $dados['subject'], $body, $Header);
	
	
	if(!$enviando){
		header('Location: ..'.$origem.'/?suc='.base64_encode('Erro ao mandar o email'));exit;
	}
	
	header('Location: ..'.$origem.'/?suc='.base64_encode('Enviado com sucesso!'));exit;
	
?>