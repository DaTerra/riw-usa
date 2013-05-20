
<? if($_GET['a']=='dados'){?>

<div id="modulo_dados">

	<?
    	echo alertas($_GET);

	?>
	<h3>Meus dados</h3>
	<?
		$dados = $DB->dados('SELECT * FROM TBAAUSUARIOS WHERE id_usuario='.(int)$_SESSION['adm_usuario']['id_usuario'].' LIMIT 1');
	?>
	<form action="./processa/inicio.php" method="post">
    <input type="hidden" name="id_usuario" value="<?=$dados['id_usuario']?>" />
        <div><label>Login</label><input type="text" name="login" value="<?=$dados['login']?>" disabled="disabled" /><span>(Não é possivel alterar)</span></div>
        <div><label for="mudar_nome">Nome</label><input id="mudar_nome" type="text" name="nome" value="<?=$dados['nome']?>" /></div>
        <div><label for="mudar_email">E-mail</label><input id="mudar_email" type="text" name="ed_email" value="<?=$dados['email']?>" /><span>(Obrigatório)<span></div>
        
        <p>Senha</p>
        <br />
        <div><label for="mudar_senha">Senha</label><input id="mudar_senha" style="width:150px;" type="password" name="senha" /><span>(Seha maior que 5 digitos)<span></div>
        <div><label for="mudar_senha_1">Repita a senha</label><input id="mudar_senha_1" style="width:150px;" type="password" name="senha1" /><span>(Repita a mesma senha do campo "Senha")</span></div>
    
    	<button type="submit">Salvar</button>
    </form>
</div>
	

<? }else{?>
<div id="modulo_padrao">
    <img src="./sistema/img/icone_panel_home.png" alt="Painel de Controle" />
    <p>Welcometo the <strong>RIW 2012 CRM/CMS</strong> tool! <br />
	</p>
</div>
<? }?>