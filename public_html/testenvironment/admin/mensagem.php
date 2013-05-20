<?
	include('../includes/Config.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
    	<title><?=SITENOME?> > Login Painel</title>
        <link rel="stylesheet" href="./sistema/css/geral.css" />
        <link rel="stylesheet" href="./sistema/css/login.css" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        <!-- jQuery-->
        <script type="text/javascript" src="./sistema/js/jquery-v1.7.1.js"></script>
        <!-- Metas -->
        <meta name="author" content="Carlos Humberto - Adiante Soluções Web" />
        <meta name="description" content="Painel de Controle" />
</head>
<body>

<div id="geral">
	
    <h1><a title="Painel de Controle Adiante Soluções Web" href="javascript:location.reload(true)">Logo Adiante</a></h1>
    <br />
    
	<div id="box_alertas" style="display:none">
    	<? if(!empty($_GET['erro'])){?>
		<div id="painel_login_erro" class="login_alertas">
			<span><b>Erro:&nbsp;</b><?=urldecode($_GET['erro'])?></span>
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
    <span id="voltar_site"><a title="Está perdido?" href="http://<?=DOMINIO?>/Painel">Login</a></span>
</div>
</body>
</html>