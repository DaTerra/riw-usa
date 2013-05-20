<?php

	//print_r($_POST);exit;
	include('../includes/Config.inc.php');
	include('../includes/phpmail/class.phpmailer.php');
	include('../includes/Funcoes.php');

	foreach ($_POST as $a => $b){
	 $$a = @addslashes($b);
	}

	$origem = '/registration';

	// Validando os campos necessarios

	$erro = '';

	if(!(strlen($first_name)>3)) $erro.= '- First Name <br />';
	if(!(strlen($last_name)>3)) $erro.= '- Last Name <br />';
	if(!(strlen($company)>3)) $erro.= '- Company <br />';
	if(!(strlen($title)>1)) $erro.= '- Title <br />';
	/*if(!(count($id_event)>0)) $erro.= '- Choose at least one event; <br />';
	if(!(count($id_typeindustry)>0)) $erro.= '- Select you industry; <br />';
	if(!(count($id_interest)>0)) $erro.= '- Check at least one area of your interest; <br />';*/
	
	if(strlen($erro)>0){

		header('Location: ..'.$origem.'/?erro='.urlencode('<strong>Please fill in the mandatory fields.:</strong><br />'.$erro));exit;

	}	


	$veridica = $DB->dados('SELECT * FROM tbuser WHERE email="'.(string)$email.'" LIMIT 1');
	if($veridica['id_user']>0){
		header('Location: ..'.$origem.'/?erro='.urlencode('This E-mail is already registered. Please e-mail us at info@riw-sv.com if you have any questions.'));exit;
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

	$Dados = array('id_status'=>3, 'id_type'=>$id_type,'first_name'=>$first_name, 'last_name'=>$last_name, 'company'=>$company, 'title'=>$title, 'email'=>$email, 'phone'=>$phone,

	 'city'=>$city, 'state'=>$state, 'country'=>$country, 'postal_code'=>$postal_code, 'public_profile'=>$public_profile, 'email_updates'=>$email_updates,

	  'networking'=>$networking, 'attending'=>$events, 'entree'=>$entree, 'allergy'=>$allergy, 'allergy_details'=>$allergy_details, 'industry'=>$insdustry1, 'interests'=>$interests, 'registration_code '=>$registration_code);

	

	$DB->insereArray( array('tabela'=>'tbuser'), $Dados, 'cadastra', $ID);

	

	$id_user = $DB->lastInsertedId();



	// Enviando os emails necessarios

	$dados = $DB->dados('SELECT * FROM tbemails WHERE id_email=1 LIMIT 1');

	

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

	$emailHtml = str_replace('{[FirstName][LastName]}', $first_name.' '.$last_name,$dados['email']);

	

	$mail->Body = $emailHtml;

	$mail->AltBody = $mail->Body;

	

	//exit($emailHtml);

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

	

	$mail->Subject = 'RIW 2012 - New invite request';

	// Montando a mensagem a ser enviada

	$emailHtml = "

				<p><strong>First Name:</strong>$first_name</p>

				<p><strong>Last Name:</strong>$last_name</p>

				<p><strong>Company:</strong>$company</p>

				<p><strong>Title:</strong>$title</p>

				<p><strong>E-mail:</strong>$email</p>

	";

	

	$mail->Body = $emailHtml;

	$mail->AltBody = $mail->Body;

	

	//exit($emailHtml);

	$enviando_admin = $mail->Send();

	

	

	// ============================================	

	

	

	if(!$enviando){

		//header('Location: ..'.$origem.'/?suc='.base64_encode('Erro ao mandar o email'));exit;

	}

	

	

	$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$id_user, 'action'=>"$first_name has request and invitation"), 'cadastra', $ID);

	

	header('Location: ..'.$origem.'/?suc='.urlencode('Thank you. Your request has been sent!'));exit;

	

?>