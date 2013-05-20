<? 
	# Cabeçalho

	include("../header.php");	
	include('../includes/phpmail/class.phpmailer.php');
	//print_r($urlSite);


	// Post -> $var

	foreach ($_POST as $campo => $valor) $$campo = $valor; 



	// Testes

	$erro=false;

	if (strlen($contact_first_name) < 4) $erro=true;

	if (ValidaEmail($contact_email)==false) $erro=true;



	// Se houver erro, SAI

	if ($erro==true) { header('Location: ../registration?ok=0',true); exit; } 

	

	// Corpo da mensagem a ser enviada

	$corpo_msg = '<html>

						<head>

							<style type="text/css"> 

								body { font-family:\'Trebuchet MS\'; font-size:11px; }

							</style>

						</head>

						<body>
							<h4>:: Contact Form ::</h4>
							Name: '.$contact_first_name.''.$contact_last_name.'<br />
							Company: '.$contact_company_name.'<br />	
							Title: '.$contact_title_name.'<br />
							E-mail: '.$contact_email.'<br />
							Phone: '.$contact_phone.'<br />
							City: '.$contact_city.'<br />
							State: '.$contact_state.'<br />
							Country: '.$contact_country.'<br />
							Postal Code: '.$contact_postal_code.'<br />
							Registration Code: '.$registration_code.'<br/>
							Public Perfil:'.$public_perfil;'
						</body>

				   </html>';



	$cabecalho = "FROM:".$_POST["contact_first_name"]. "<".$_POST["contact_email"].">\ncontent-type: text/html; charset=iso-8859-1\nContent-Transfer-Encoding: quoted-printable\nX-priority: 1\n";
	$assunto = "RIW 2012 - Invite Request from ".strtoupper($_POST["contact_first_name"]." ".$_POST["contact_last_name"])." from ".strtoupper($_POST["contact_company_name"]);


	// Verificando se tem erro
	
	$mail = new PHPMailer();
	$mail->IsHTML(true); 

	// Remetente de resposta
	//$mail->SetFrom(CONF_EMAIL, 'RIW 2012');

	//E-mal do remetente
	$mail->From = $contact_email;
	$mail->FromName = $contact_first_name;
	
	// Email de destino
	$mail->AddAddress(CONF_EMAIL);
	
	$mail->Subject = $assunto;

	$mail->Body = $corpo_msg;
	$mail->AltBody = $mail->Body;


	$enviando = $mail->Send();
	
	
			
	if(!$enviando){
	
		//exit('Problema');
	}
	
	
//	exit;
	// Retorna

	header('Location: ../registration?ok=1',true);

?>