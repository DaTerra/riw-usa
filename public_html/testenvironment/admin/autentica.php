<?
	include('../includes/Config.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
    	<title><?=SITENOME?></title>
        <link rel="stylesheet" href="./sistema/css/geral.css" />
        <link rel="stylesheet" href="./sistema/css/login.css" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        
        <!-- jQuery-->
        <script type="text/javascript" src="./sistema/js/jquery-v1.7.1.js"></script>
        <!-- Metas -->
        <meta name="author" content="Carlos Humberto - Adiante Soluções Web" />
        <meta name="description" content="Control Panel" />
</head>
<body>

<div id="geral">
	
    <h1><a title="Russian Innovation Week 2012 Control Panel" href="javascript:location.reload(true)">logo</a></h1>
    <br />
	<div id="box_alertas" style="display:none">
    	<? if(!empty($_GET['erro'])){?>
		<div id="painel_login_erro" class="login_alertas">
			<span><b>!!:&nbsp;</b><?=urldecode($_GET['erro'])?></span>
		</div>
        <? }elseif(!empty($_GET['suc'])){?>
		<div id="painel_login_suc" class="login_alertas">
			<span><b>Ok:&nbsp;</b><?=urldecode($_GET['suc'])?></span>
		</div>
        <? }?>
	</div>
	<script type="text/javascript">
		$('#box_alertas').show(500);
    </script>
	<br />
    <div id="login">
        <form name="login" method="post" action="./sistema/login.php">
            <div><label for="usuario">User:</label><p><input id="usuario" type="text" name="usuario" /></p></div>
            <div><label for="senha">Password:</label><p><input id="senha" type="password" name="senha" /></p></div>
          <!-- <a title="Criar uma nova senha" href="http://<?=DOMINIO?>/Painel/mudarsenha.php">Login Trouble?</a>-->
            <button title="Login to Control Panel" type="submit">LogIn</button>
        </form>
	<div class="limpar"></div>
    </div>
    
    <span id="voltar_site"><a title="Got Lost" href="http://<?=DOMINIO?>">Go back to the RIW website</a></span>
</div>


</body>
</html>