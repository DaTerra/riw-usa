<?
	include('../../includes/Config.inc.php');
	require('./includes/funcoes.adm.php');
	
	foreach ($_POST as $a => $b){
		$$a = $b;
	}
	
	if(strlen($login_email)<5){
		header('Location: ../mudarsenha.php?erro='.urlencode('Usu�rio ou e-mail inv�lido'));exit;
	}else{

		$usuario = $DB->dados("SELECT * FROM TBAAUSUARIOS WHERE login='".$login_email."' OR email='".$login_email."' LIMIT 1");
		
		if(!($usuario['id_usuario']>0)){
			header('Location: ../mudarsenha.php?erro='.urlencode('Usu�rio inexistente.'));exit;
		}
		if($usuario['status']==0){
			header('Location: ../mudarsenha.php?erro='.urlencode('Voc� est� suspenso do sistema. Maiores informa��es com o administrador.'));exit;
		}
		
		$chave = md5($usuario['email'].time());
		
		$dados_troca = array('id_usuario'=>$usuario['id_usuario'], 'chave'=>$chave, 'status'=>'a');

		$DB->insereArray(array('tabela'=>'TBAAUSUARIOS_MUDA_SENHA'), $dados_troca, 'cadastra', $ID);
	}


	$email_redefinicao = '
		Ol�, <strong>'.$usuario['nome'].'</strong>,<br />
		
		Foi feita uma solicita��o de redefini��o de senha para o <strong>Painel de controle</strong> do site '.SITENOME.' ('.DOMINIO.'), para confirmar, clique no link abaixo: <br />
		<br />
		<a href="http://'.DOMINIO.'/Painel/novasenha.php?chave='.$chave.'">Clique aqui para concluir a troca de senha</a>
		<br />
		<br />
		'.SITENOME.'
		
	';

	//Enviar email aqui
	
	
	
	//exit($email_redefinicao);
	header('Location: ../mensagem.php?suc='.urlencode("Foi enviado um link de redefini��o de senha para o e-mail:&nbsp;<b>$usuario[email]</b>, confirme-o em at� 1h para concluir o processo de redefini��o."));exit;
?>
