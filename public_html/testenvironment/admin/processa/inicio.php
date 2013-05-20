<?
/******************************************************************
	Processa todos os módulos / Carlos Brito - Adiante Desenvovimento Web
*******************************************************************/
	include('../sistema/includes/top.php');

	foreach ($_POST as $a => $b){
		 $$a = @addslashes($b);
	}

	if(!validaEmail($ed_email)) $erro = 'E-mail Digitado invalido<br />';
	if(!empty($nome)){
		if(!strlen($nome)>4 ) $erro = 'O nome deve ser maior do que 4 letras <br />';
	}
	if(!empty($senha)){
		if(!strlen($senha)>=5 or !($senha==$senha1) ) $erro = 'Senha invalida.<br />';
		else $senha_status = true;
	}
	

	if(strlen($erro)>1){
		header('Location: ../sistema.php?m=inicio&a=dados&F='.urlencode($erro));exit;
	}


	$Dados = array('email'=>$ed_email, 'nome'=>$nome);
	
	if($senha_status){
		$Dados['senha'] = md5($senha);
	}


	//exit($id_usuario);
	$DB->insereArray(array('tabela'=>'TBAAUSUARIOS', 'id_tabela'=>'id_usuario'), $Dados, 'atualiza', $id_usuario);

	$_SESSION['adm_usuario'] = $DB->dados('SELECT * FROM TBAAUSUARIOS WHERE id_usuario='.(int)$id_usuario.' LIMIT 1');
	
	$mensagem = (strlen($mensagem)>1)? $mensagem:'Perfil atualizado.';
	

	header('Location: ../sistema.php?m=inicio&a=dados&S='.urlencode($mensagem));exit;
?>