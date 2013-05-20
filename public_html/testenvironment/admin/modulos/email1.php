<?php
	include('../../includes/Config.inc.php');
	include('../../includes/phpmail/class.phpmailer.php');
	include('../../includes/Funcoes.php');

	$mail = new PHPMailer();
	$mail->IsHTML(true); 



	if(!empty($_GET['email'])){
		$id_email = ($_GET['email']=='invite')?2:4;
		$email =  $DB->dados('SELECT * FROM tbemails WHERE id_email='.(int)$id_email.' LIMIT 1');
		$dados = $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$_GET['id'].' LIMIT 1');
	}

	// Enviando email
	if($_POST['id_email']>0){	
		$Dados = $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$_POST['id_user'].' LIMIT 1');
		$key = upper(codigo(7));
		
		
		if($_POST['email_type']=='invite'){

			// Remetente de resposta
			$mail->SetFrom('info@riw-sv.com', 'RIW 2012');
			
			//E-mal do remetente
			$mail->From = 'registration@riw-sv.com';
			$mail->FromName = 'RIW 2012';
			
			// Email de destino
			$mail->AddAddress($Dados['email']);
			
			$mail->Subject = $_POST['subject'];
			// Montando a mensagem a ser enviada
			
			$emailHtml = str_replace('{[key]}', $key, $_POST['mensagem']);
			//exit($_POST['mensagem']);
			$mail->Body = $emailHtml;
			$mail->AltBody = $mail->Body;
			//exit($emailHtml);
			$enviando = $mail->Send();
			
			
			
			if($Dados['id_indication']>0){
				// Manda email para o indicador
				
				$indicador =  $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$Dados['id_indication'].' LIMIT 1');
				
				$dados_mail = $DB->dados('SELECT * FROM tbemails WHERE id_email=7 LIMIT 1');

				// 
				unset($mail); 
				
				$mail = new PHPMailer();
				$mail->IsHTML(true); 
				# Remetente de resposta
				$mail->SetFrom('info@riw-sv.com', 'RIW 2012');
				
				#E-mal do remetente
				$mail->From = 'registration@riw-sv.com';
				$mail->FromName = 'RIW 2012';
				
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
				
				$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$indicador['id_user'], 'action'=>'Email enviado referente a aceitação do convide de '.$Dados['first_name']), 'cadastra', $ID);
			
				if(!$enviando){
					exit('Erro ao enviar email para o indicador');
				}
			}
			
			
			
			if(!$enviando){
				exit('Erro ao enviar email 1');
			}
			
			$DB->insereArray( array('tabela'=>'tbuser_keys'), array('id_user'=>$Dados['id_user'], 'chave'=>$key, 'usada'=>0), 'cadastra', $ID);
			$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$Dados['id_user'], 'action'=>'Convite enviado'), 'cadastra', $ID);
			$DB->insereArray( array('tabela'=>'tbuser', 'id_tabela'=>'id_user'), array('id_status'=>1), 'atualiza', $Dados['id_user']);
			exit('The invitation has been sent!<br><button type="button" onclick="self.close()">Close</button>');
		
		}
		
		
		
		
		if($_POST['email_type']=='decline'){
			
			//exit('decline');
			// Remetente de resposta
			$mail->SetFrom('info@riw-sv.com', 'RIW 2012');
			
			//E-mal do remetente
			$mail->From = 'registration@riw-sv.com';
			$mail->FromName = 'RIW 2012';
			
			// Email de destino
			$mail->AddAddress($Dados['email']);
			
			$mail->Subject = $_POST['subject'];
			// Montando a mensagem a ser enviada
			
			$emailHtml = $_POST['mensagem'];
			//exit($_POST['mensagem']);
			$mail->Body = $emailHtml;
			$mail->AltBody = $mail->Body;
			//exit($emailHtml);
			$enviando = $mail->Send();
			
			
			
			if($Dados['id_indication']>0){
				// Manda email para o indicador
				
				$indicador =  $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$Dados['id_indication'].' LIMIT 1');
				
				$dados_mail = $DB->dados('SELECT * FROM tbemails WHERE id_email=6 LIMIT 3');

				// 
				unset($mail); 
				
				$mail = new PHPMailer();
				$mail->IsHTML(true); 
				# Remetente de resposta
				$mail->SetFrom('info@riw-sv.com', 'RIW 2012');
				
				#E-mal do remetente
				$mail->From = 'registration@riw-sv.com';
				$mail->FromName = 'RIW 2012';
				
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
				
				$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$indicador['id_user'], 'action'=>'Email enviado referente a aceitação do convide de '.$Dados['first_name']), 'cadastra', $ID);
			
				if(!$enviando){
					exit('Erro ao enviar email');
				}
			}
			
			
			
			
			if(!$enviando){
				exit('Erro ao enviar email');
			}

			$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$Dados['id_user'], 'action'=>'Convite negado'), 'cadastra', $ID);
			$DB->insereArray( array('tabela'=>'tbuser', 'id_tabela'=>'id_user'), array('id_status'=>1), 'atualiza', $Dados['id_user']);
			exit('Enviado com sucesso!<br><button type="button" onclick="self.close()">Close</button>');
		}
		
		
	}

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Edit Invitation</title>
<script type="text/javascript" src="../sistema/js/tiny_mce/tiny_mce_dev.js"></script>
<script type="text/javascript" src="../sistema/js/jquery-v1.7.1.js"></script>
<style type="text/css">
*{ padding:0; margin:0;}
body{ color:#333; font-size:12px;}
#geral{ margin:0 auto; width:500px; padding:20px;}
#header{ width:300px; float:left; line-height:180%; margin-bottom:10px;}
#header h1{ font-size:17px; margin-bottom:10px;}

.limpar{ clear:both;}

#corpo_email{}

</style>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
</head>

<body>
<form action="" method="post">
	<input type="hidden" name="id_email" value="<?=$id_email?>" />
	<input type="hidden" name="id_user" value="<?=$dados['id_user']?>" />
	<input type="hidden" name="subject" value="<?=$email['subject']?>" />
	<input type="hidden" name="email_type" value="<?=$_GET['email']?>" />

	<div id="geral">
    	<div id="header">
    		<h1>Edit Invitation</h1>
            <p><strong>Name:</strong><?=$dados['first_name']?></p>
            <p><strong>E-mail:</strong><?=$dados['email']?></p>
            <p><strong>Company:</strong><?=$dados['company']?></p>
            <p><strong>RE:</strong><?=$email['subject']?></p>
    	</div>
    	<button>Send ></button>
    
    	<div class="limpar"></div>
    
    	<div id="corpo_email">
			<textarea id="elm1" name="mensagem" rows="15" cols="80" style="width: 90%">	<?=str_replace('{[FirstName][LastName]}', $dados['first_name'].' '.$dados['last_name'],$email['email'])?></textarea>
        </div>
        
        <br />
        
        <button type="button" onclick="self.close()">< Cancel</button>
        
        
    </div>
</form>
</body>
</html>