<?php

	include('../../includes/Config.inc.php');

	include('../../includes/phpmail/class.phpmailer.php');

	include('../../includes/Funcoes.php');



	$mail = new PHPMailer();

	$mail->IsHTML(true); 



	if(!empty($_GET['email'])){
		if($_GET['email']=='invite' or $_GET['email']=='decline'){
			$id_email = ($_GET['email']=='invite')?2:4;
		}else{
			$id_email = $_GET['email'];
		}
		
		$email =  $DB->dados('SELECT * FROM tbemails WHERE id_email='.(int)$id_email.' LIMIT 1');

		$dados = $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$_GET['id'].' LIMIT 1');

	}


	// Enviando email
	if($_POST['id_email']>0){	

		$Dados = $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$_POST['id_user'].' LIMIT 1');
		
		$key = upper(codigo(7));

		if($_POST['email_type']=='outro'){
			
			// Remetente de resposta
			$mail->SetFrom('info@riw-sv.com', 'RIW 2012');

			//E-mal do remetente
			$mail->From = 'registration@riw-sv.com';

			$mail->FromName = 'RIW 2012';

			// Email de destino
			$mail->AddAddress($Dados['email']);

			$mail->Subject = $_POST['subject'];

			// Montando a mensagem a ser enviada



			$mail->Body = $emailHtml;

			$mail->AltBody = $mail->Body;

			
			$emailHtml = '<div style="width:700px;">
			<img src="http://www.riw-sv.com/img/email-header-2013.gif" />
			<div style="margin-left:50px;">';
			$emailHtml .= str_replace('{[key]}', $key, $_POST['mensagem']);
			$emailHtml .= '</div></div>';	
			
		//	exit($emailHtml);
			$mail->Body = $emailHtml;
			$enviando = $mail->Send();
			
			
			
			$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$Dados['id_user'], 'action'=>'E-mail '.$dados_mail['identifica'].' has been sent'), 'cadastra', $ID);

			echo '<script type="text/javascript">opener.location.href=opener.location.href;</script>';

			exit('The invitation has been sent!<br><button type="button" onclick="self.close()">Close</button>');

			
			
			
			
		}
		if($_POST['email_type']=='invite'){
			
			//print_r($Dados);exit;

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


			$mail->Body = $emailHtml;

			$mail->AltBody = $mail->Body;

			//exit($emailHtml);

			$enviando = $mail->Send();
			//exit;	
			//echo $emailHtml;
			if($Dados['id_indication']>0){

				// Manda email para o indicador

				//exit('indicador');

				$indicador =  $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$Dados['id_indication'].' LIMIT 1');

				$dados_mail = $DB->dados('SELECT * FROM tbemails WHERE id_email=7 LIMIT 1');

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

				
				//exit($emailHtml);
				$mail->Body = $emailHtml;

				$mail->AltBody = $mail->Body;

				

				$enviando = $mail->Send();			

				

				$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$indicador['id_user'], 'action'=>'Email sent about referral: '.$Dados['first_name']), 'cadastra', $ID);

			

				if(!$enviando){

					//exit('Erro ao enviar email para o indicador');

				}

			}

			

			

			

			if(!$enviando){

				//exit('Erro ao enviar email 1');

			}

			

			$DB->insereArray( array('tabela'=>'tbuser_keys'), array('id_user'=>$Dados['id_user'], 'chave'=>$key, 'usada'=>0), 'cadastra', $ID);

			$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$Dados['id_user'], 'action'=>'Invitation Sent'), 'cadastra', $ID);

			$DB->insereArray( array('tabela'=>'tbuser', 'id_tabela'=>'id_user'), array('id_status'=>1), 'atualiza', $Dados['id_user']);

			echo '<script type="text/javascript">opener.location.href=opener.location.href;</script>';

			exit('The invitation has been sent!<br><button type="button" onclick="self.close()">Close</button>');

		

		}

		

		

		

		

		if($_POST['email_type']=='decline'){

			

		//	exit('decline');

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

				//exit('tem indicador');
				// Manda email para o indicador

				

				$indicador =  $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$Dados['id_indication'].' LIMIT 1');

				

				$dados_mail = $DB->dados('SELECT * FROM tbemails WHERE id_email=6 LIMIT 1');



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


				$corpo_mensagem = str_replace('{[indicator]}', $indicador['first_name'].' '.$indicador['last_name'],$dados_mail['email']);

				$corpo_mensagem = str_replace('{[FirstName][LastName]}', $Dados['first_name'].' '.$Dados['last_name'],$corpo_mensagem);

				$emailHtml = $corpo_mensagem;

				$mail->Body = $emailHtml;

				$mail->AltBody = $mail->Body;

				

				$enviando = $mail->Send();			

				

				$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$indicador['id_user'], 'action'=>'Invitation denied for'.$Dados['first_name']), 'cadastra', $ID);

				if(!$enviando){

					//exit('Erro ao enviar email');

				}

			}


			if(!$enviando){

				//exit('Erro ao enviar email');

			}


			$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$Dados['id_user'], 'action'=>'Invitation denied'), 'cadastra', $ID);

			$DB->insereArray( array('tabela'=>'tbuser', 'id_tabela'=>'id_user'), array('id_status'=>4), 'atualiza', $Dados['id_user']);

			echo '<script type="text/javascript">opener.location.href=opener.location.href;</script>';

			exit('The invitation has been sent!<br><button type="button" onclick="self.close()">Close</button>');

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

</head>



<body>

<form action="" method="post" name="invitation">

	<input type="hidden" name="id_email" value="<?=$id_email?>" />

	<input type="hidden" name="id_user" value="<?=$dados['id_user']?>" />

	<input type="hidden" name="subject" value="<?=$email['subject']?>" />

	<?
    	if($_GET['email']=='invite' or $_GET['email']=='decline'){
			$tipo_email = $_GET['email'];
		}else{
			$tipo_email = 'outro';
			echo "<input type=\"hidden\" name=\"email_type\" value=\"$email[identifica]\" />";
		}
	
	?>
	<input type="hidden" name="email_type" value="<?=$tipo_email?>" />



	<div id="geral">

    	<div id="header">

    		<h1>Edit Invitation</h1>

            <p><strong>Name:</strong><?=$dados['first_name']?></p>

            <p><strong>E-mail:</strong><?=$dados['email']?></p>

            <p><strong>Company:</strong><?=$dados['company']?></p>

            <p><strong>RE:</strong><?=$email['subject']?></p>

    	</div>

    	<button onclick="envia()">Send ></button>

    

    	<div class="limpar"></div>

    

    	<div id="corpo_email">

			<textarea id="elm1" name="mensagem" rows="15" cols="80" style="width: 90%">	<?=str_replace('{[FirstName][LastName]}', $dados['first_name'].' '.$dados['last_name'],$email['email'])?></textarea>

        </div>

            <script type="text/javascript">
        var milestone1 = {
                // General options
                mode : "exact",
                language : "en",
                elements : "mensagem",
                theme : "advanced",
                plugins : 'advlink,advimage,tabfocus,advlist,searchreplace,advhr',
                tabfocus_elements: ':prev,:next',
                object_resizing: false,
                apply_source_formatting: 1,
        		document_base_url : 'http://www.google.com/',

                // Theme options
                theme: 'advanced',
                browser_preferred_colors: false,
        
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",                theme_advanced_toolbar_name1 : "Command",
                theme_advanced_toolbar_name2 : "Format",
                theme_advanced_toolbar_align : "left",
                theme_advanced_toolbar_location : "top"
        };
        tinyMCE.init(milestone1);
    </script>

        <br />

        

        <button type="button" onclick="self.close()">< Cancel</button>

        

    </div>

    

	<script type="text/javascript">  

    // função usada para carregar o código  

    function envia() {  

		f=document.invitation;

		f.submit();

		//opener.location.href=opener.location.href; 

		//window.close(); 

    }  

    </script>      

</form>

</body>

</html>