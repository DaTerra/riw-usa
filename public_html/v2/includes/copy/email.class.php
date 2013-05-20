<?php 
	
	include('phpmailer/class.phpmailer.php'); 
	
	function Email($assunto) {
		$mail = new PHPmailer(true);
	
		$nome="Bazar de Vantagens"; # Nome
		#$email="contato@bazardevantagens.com.br"; # E-mail
		$email="ailytorezani@impactaweb.com.br"; # E-mail
		$senha=""; # Senha
	
		// Configurações do SMTP
		#$mail->IsSMTP();
		#$mail->SMTPDebug  = 2;
		#$mail->SMTPAuth   = true;
		#$mail->SMTPSecure = "ssl";
		#$mail->Host       = "smtp.gmail.com";
		#$mail->Port       = 465;
		#$mail->AddReplyTo($email,$nome);
		$mail->SetFrom($email,$nome);
		$mail->Subject = $assunto;
		$mail->IsHTML();
		#$mail->Username = $email;
		#$mail->Password = $senha;
	
		return $mail;
	}
	
	function htmlEmail($id,$dados=array()){
		global $mysql;
		list($assunto,$html) = $mysql->dados("SELECT assunto,conteudo FROM tbemails WHERE id_email=".(int)$id);
		foreach ((array)$dados as $a=>$b) {
			$assunto = str_replace("{".$a."}",$b,$assunto);
			$html = str_replace("{".$a."}",$b,$html);
		}
		return array($assunto,$html);
		
	}
	

?>