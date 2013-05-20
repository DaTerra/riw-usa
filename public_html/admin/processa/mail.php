<?php

	include('../../includes/Config.inc.php');

	include('../../includes/phpmail/class.phpmailer.php');

	include('../../includes/Funcoes.php');

	

	//echo count($_POST['selected']);exit;

	foreach($_POST['selected'] as $v){

	//exit($v);

		unset($mail);

		$mail = new PHPMailer();

		$mail->IsHTML(true); 

		$Dados = $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$v.' LIMIT 1');

		

		//  Emails de aceitação

		if($_POST['email_action']=='intite'){	

			$key = upper(codigo(7));

			// Enviando email de aceitação para um INVITED

			if($Dados['id_status']=='3' or $Dados['id_status']=='8' or $Dados['id_status']=='10'){

				//exit;

				$dados_mail = $DB->dados('SELECT * FROM tbemails WHERE id_email=2 LIMIT 1');



				// Remetente de resposta

				$mail->SetFrom('info@riw-sv.com', 'RIW 2013');

				

				//E-mal do remetente

				$mail->From = 'registration@riw-sv.com';

				$mail->FromName = 'RIW 2013';

				

				// Email de destino

				$mail->AddAddress($Dados['email']);

				

				$mail->Subject = $dados_mail['subject'];

				// Montando a mensagem a ser enviada

				

				$corpo_mensagem = str_replace('{[FirstName][LastName]}', $Dados['first_name'].' '.$Dados['last_name'],$dados_mail['email']);

				$corpo_mensagem = str_replace('{[key]}', $key,$corpo_mensagem);

				

				$emailHtml = $corpo_mensagem;

				

				$mail->Body = $emailHtml;

				$mail->AltBody = $mail->Body;

				$enviando = $mail->Send();

				

				if(!$enviando){

					//header('Location: ../sistema.php?m=invitation&a=lista&F='.urlencode('Falha ao enviar'));exit;

				}

				
				$DB->insereArray( array('tabela'=>'tbuser_keys'), array('id_user'=>$v, 'chave'=>$key, 'usada'=>0), 'cadastra', $ID);

				$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$v, 'action'=>'Invitation Sent'), 'cadastra', $ID);

				$DB->insereArray( array('tabela'=>'tbuser', 'id_tabela'=>'id_user'), array('id_status'=>1), 'atualiza', $v);

				//exit;

				//header('Location: ../sistema.php?m=invitation&a=lista&S='.urlencode('The e-mail has been sent'));exit;
			}

		

			// Enviando email de aceitação apra um REFFERAL

			if($Dados['id_status']=='2'){

				

				unset($mail);

				$mail = new PHPMailer();

				$mail->IsHTML(true); 

				

				$indicador =  $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$Dados['id_indication'].' LIMIT 1');

				

				$dados_mail = $DB->dados('SELECT * FROM tbemails WHERE id_email=3 LIMIT 1');



				// Manda email que o indicado

				

				# Remetente de resposta

				$mail->SetFrom('info@riw-sv.com', 'RIW 2013');

				

				#E-mal do remetente

				$mail->From = 'registration@riw-sv.com';

				$mail->FromName = 'RIW 2013';

				

				# Email de destino

				$mail->AddAddress($Dados['email']);

				

				$mail->Subject = $dados_mail['subject'];

				# Montando a mensagem a ser enviada			

				

				$corpo_mensagem = str_replace('{[FirstName][LastName]}', $Dados['first_name'].' '.$Dados['last_name'],$dados_mail['email']);

				$corpo_mensagem = str_replace('{[Nome do Referee]}', $indicador['first_name'],$corpo_mensagem);

				$corpo_mensagem = str_replace('{[key]}', $key,$corpo_mensagem);

				$emailHtml = $corpo_mensagem;

				

				//exit($emailHtml);

				$mail->Body = $emailHtml;

				$mail->AltBody = $mail->Body;

				

				$enviando = $mail->Send();			

				

				

				// Manda email para o indicador

				

				$indicador =  $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$Dados['id_indication'].' LIMIT 1');

				

				$dados_mail = $DB->dados('SELECT * FROM tbemails WHERE id_email=7 LIMIT 1');



				// 

				unset($mail); 

				$mail = new PHPMailer();

				$mail->IsHTML(true); 

				# Remetente de resposta

				$mail->SetFrom('info@riw-sv.com', 'RIW 2013');

				

				#E-mal do remetente

				$mail->From = 'registration@riw-sv.com';

				$mail->FromName = 'RIW 2013';

				

				# Email de destino

				$mail->AddAddress($indicador['email']);

				

				$mail->Subject = $dados_mail['subject'];

				# Montando a mensagem a ser enviada			

				

				$corpo_mensagem = str_replace('{[FirstName][LastName]}', $indicador['first_name'],$dados_mail['email']);

				$corpo_mensagem = str_replace('{[Nome do Referee]}', $Dados['first_name'].' '.$Dados['last_name'],$corpo_mensagem);

				$emailHtml = $corpo_mensagem;

				

				$mail->Body = $emailHtml;

				$mail->AltBody = $mail->Body;

				

				$enviando = $mail->Send();			

				

				

				if(!$enviando){

					//exit('Erro ao enviar email');

				}

				

				

				$DB->insereArray( array('tabela'=>'tbuser_keys'), array('id_user'=>$v, 'chave'=>$key, 'usada'=>0), 'cadastra', $ID);

				$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$v, 'action'=>'Invitation Sent'), 'cadastra', $ID);

				$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$indicador['id_user'], 'action'=>'Email sent about the invitation of: '.$Dados['first_name']), 'cadastra', $ID);

				$DB->insereArray( array('tabela'=>'tbuser', 'id_tabela'=>'id_user'), array('id_status'=>1), 'atualiza', $v);

				//header('Location: ../sistema.php?m=invitation&a=lista&S='.urlencode('The e-mail has been sent'));exit;

				

			}

			//header('Location: ../sistema.php?m=invitation&a=lista&S='.urlencode('The e-mail has been sent'));exit;

		}elseif($_POST['email_action']=='decline'){	

		// Emails de negação



			// Enviando email de negação para INVITED

			if($Dados['id_status']=='3' or $Dados['id_status']=='8'){

				

				$dados_mail = $DB->dados('SELECT * FROM tbemails WHERE id_email=4 LIMIT 1');

				

				// Remetente de resposta

				$mail->SetFrom('info@riw-sv.com', 'RIW 2013');

				

				//E-mal do remetente

				$mail->From = 'registration@riw-sv.com';

				$mail->FromName = 'RIW 2013';

				

				// Email de destino

				$mail->AddAddress($Dados['email']);

				

				$mail->Subject = $dados_mail['subject'];

				// Montando a mensagem a ser enviada

				$emailHtml = str_replace('{[FirstName][LastName]}', $Dados['first_name'].' '.$Dados['last_name'],$dados_mail['email']);

				

				$mail->Body = $emailHtml;

				$mail->AltBody = $mail->Body;

				

				$enviando = $mail->Send();

				

				if(!$enviando){

					//exit('Erro ao enviar email');

				}

				

				

				$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$v, 'action'=>'Deny Email has been sent.'), 'cadastra', $ID);

				$DB->insereArray( array('tabela'=>'tbuser', 'id_tabela'=>'id_user'), array('id_status'=>4), 'atualiza', $v);

				//header('Location: ../sistema.php?m=invitation&a=lista&S='.urlencode('The e-mail has been sent'));exit;

							

			}

			

			// Enviando email de negação para REFFERAL

			if($Dados['id_status']=='2'){

				unset($mail);

				$mail = new PHPMailer();

				$mail->IsHTML(true);

				 

				$indicador =  $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$Dados['id_indication'].' LIMIT 1');

				

				$dados_mail = $DB->dados('SELECT * FROM tbemails WHERE id_email=5 LIMIT 3');

				

				// Manda email que o indicado

				

				# Remetente de resposta

				$mail->SetFrom('info@riw-sv.com', 'RIW 2013');

				

				#E-mal do remetente

				$mail->From = 'registration@riw-sv.com';

				$mail->FromName = 'RIW 2013';

				

				# Email de destino

				$mail->AddAddress($Dados['email']);

				

				$mail->Subject = $dados_mail['subject'];

				# Montando a mensagem a ser enviada			

				

				$corpo_mensagem = str_replace('{[FirstName][LastName]}', $Dados['first_name'].' '.$Dados['last_name'],$dados_mail['email']);

				$corpo_mensagem = str_replace('([Nome do Referee])', $indicador['first_name'],$corpo_mensagem);

				

				$emailHtml = $corpo_mensagem;

				//exit($emailHtml);

				$mail->Body = $emailHtml;

				$mail->AltBody = $mail->Body;

				

				$enviando = $mail->Send();			

				

				

				// Manda email para o indicador

				unset($mail); 

				$mail = new PHPMailer();

				$mail->IsHTML(true); 



				$dados_mail = $DB->dados('SELECT * FROM tbemails WHERE id_email=6 LIMIT 3');

				

				// Manda email que o indicado

				

				# Remetente de resposta

				$mail->SetFrom('info@riw-sv.com', 'RIW 2013');

				

				#E-mal do remetente

				$mail->From = 'registration@riw-sv.com';

				$mail->FromName = 'RIW 2013';

				

				# Email de destino

				$mail->AddAddress($indicador['email']);

				

				$mail->Subject = $dados_mail['subject'];

				# Montando a mensagem a ser enviada			

				

				$corpo_mensagem = str_replace('{[FirstName][LastName]}', $Dados['first_name'].' '.$Dados['last_name'],$dados_mail['email']);

				$corpo_mensagem = str_replace('([Nome do Referee])', $indicador['first_name'],$corpo_mensagem);

				//exit($corpo_mensagem);

				$emailHtml = $corpo_mensagem;

				

				$mail->Body = $emailHtml;

				$mail->AltBody = $mail->Body;

				

				$enviando = $mail->Send();

				

				if(!$enviando){

					//exit('Erro ao enviar email');

				}

				$DB->insereArray( array('tabela'=>'tbuser', 'id_tabela'=>'id_user'), array('id_status'=>4), 'atualiza', $v);

				$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$v, 'action'=>'Deny Email sent.'), 'cadastra', $ID);

				$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$indicador['id_user'], 'action'=>'E-mail sent about the referral of:'.$Dados['first_name']), 'cadastra', $ID);

				//header('Location: ../sistema.php?m=invitation&a=lista&S='.urlencode('The e-mail has been sent'));exit;

			}

	}else{
		
				$key = upper(codigo(7));
				$dados_mail = $DB->dados('SELECT * FROM tbemails WHERE id_email='.(int)$_POST['email_action'].' LIMIT 1');

				// Remetente de resposta

				$mail->SetFrom('info@riw-sv.com', 'RIW 2013');

				

				//E-mal do remetente

				$mail->From = 'registration@riw-sv.com';

				$mail->FromName = 'RIW 2013';

				

				// Email de destino

				$mail->AddAddress($Dados['email']);

				$mail->Subject = $dados_mail['subject'];

				// Montando a mensagem a ser enviada
				//$emailHtml = $dados_mail['email'];

				
				
				$emailHtml = '<div style="width:700px;">
				<img src="http://www.riw-sv.com/img/email-header-2013.gif" />
				<div style="margin-left:50px;">';
				$emailHtml .= str_replace('{[FirstName][LastName]}', $Dados['first_name'].' '.$Dados['last_name'],$dados_mail['email']);
				$emailHtml = str_replace('{[key]}', $key, $emailHtml);
				$emailHtml .= '</div></div>';	
				

				$mail->Body = $emailHtml;

				$mail->AltBody = $mail->Body;


				//exit($emailHtml);
				$enviando = $mail->Send();
				
				$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$Dados['id_user'], 'action'=>'E-mail '.$dados_mail['identifica'].' has been sent'), 'cadastra', $ID);
				$DB->insereArray( array('tabela'=>'tbuser_keys'), array('id_user'=>$Dados['id_user'], 'chave'=>$key, 'usada'=>0), 'cadastra', $ID);
	}

	
}

header('Location: ../sistema.php?m=invitation&a=lista&S='.urlencode('The e-mail has been sent'));exit;

?>