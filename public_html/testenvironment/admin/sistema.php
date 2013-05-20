<?php
	include('../includes/Config.inc.php');
	require('./sistema/includes/funcoes.adm.php');
	
	if($_SESSION['adm_usuario']['id_usuario'] > 0){	}
	else{
		header('Location: autentica.php?erro='.urlencode('Please provide an username and password.'));exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<?
	$head = $DB->dados('SELECT * FROM TBAAMENU WHERE modulo="'.$_GET['m'].'" LIMIT 1');
	if($head['id_menu']>0){
		$title = $head['menu'];
	}else{
		$title = 'RIW 2012 CRM/CMS';	
	}
?>

    	<title><?=$title?></title>
        <link rel="stylesheet" href="./sistema/css/geral.css" />
        <link rel="stylesheet" href="./sistema/css/sistema.css" />
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        <!-- jQuery-->
        <script type="text/javascript" src="./sistema/js/jquery-v1.7.1.js"></script>
        <!-- Funções -->
        <script type="text/javascript" src="./sistema/js/mascaras.js"></script>
        <script type="text/javascript" src="./sistema/js/funcoes.js"></script>
        <script type="text/javascript" src="./sistema/js/jquery.delay.js"></script>
        <!-- Tiny MCE -->
		<script type="text/javascript" src="./sistema/js/tiny_mce/tiny_mce_dev.js"></script>
        <!-- Colorpicker -->
		<link rel="stylesheet" href="./sistema/js/colorpicker/css/colorpicker.css" type="text/css" />
		<script type="text/javascript" src="./sistema/js/colorpicker/js/colorpicker.js"></script>
        <script type="text/javascript" src="./sistema/js/colorpicker/js/eye.js"></script>
        <script type="text/javascript" src="./sistema/js/colorpicker/js/utils.js"></script>
		<!-- -->
		<script type="text/javascript" src="./sistema/js/data/js/jquery-ui-1.8.4.custom.min.js"></script>
        
        
        <script language="JavaScript" type="text/javascript">
   function mascaraData(campoData){
              var data = campoData.value;
              if (data.length == 2){
                  data = data + '/';
                  document.forms[0].data.value = data;
      return true;              
              }
              if (data.length == 5){
                  data = data + '/';
                  document.forms[0].data.value = data;
                  return true;
              }
         }
</script>

<script type="text/javascript">
	$(function(){

		//hover states on the static widgets
		$('#dialog_link, ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); }, 
			function() { $(this).removeClass('ui-state-hover'); }
		);
	});
</script>
        
</head>
<body>

<div id="geral">

	<div id="topo">
    	<div id="topo1">
        	<h1><a href="?m=inicio">Administração</a></h1>
        </div>
    	
        <div id="topo2">
        	<span>...</span>
            <br />
            <small>...</small>
        </div>
        
        <div id="topo3">
        	<ul>
            	<li id="topo_ver">
                	<a target="_blank" href="http://<?=DOMINIO?>">Back to Website</a>
                </li>
                <li>|</li>
            	<li id="topo_sair">
                	<a href="./sistema/logoff.php">Log Off</a>
                </li>
            </ul>
        </div>
        
    </div>
    
    
    <!-- menu -->
    <div id="menu">
    	<ul>
        	<li   class="menu_principal">
            	<a <? if($_GET['m']=='inicio' or empty($_GET['m'])) echo 'id="menu_ativo"';?> class="menu_link" href="?m=inicio">Home</a>
                <span class="sepadador">&nbsp;</span>
            </li>
		<?
        
                $SQL = 'SELECT * FROM TBAAMENU WHERE id_pai=0 ORDER BY posicao ASC';
                $menu = $DB->consulta($SQL);
                while($linha = $DB->lista($menu)){
					
				//$menu_pai = $linha['id_menu'];	
        ?>
            <li class="menu_principal" onmouseover="menu('sub_<?=$linha['id_menu']?>')" onmouseout="fecha('sub_<?=$linha['id_menu']?>')">
            	<a <? if( !empty($_GET['m']) and $_GET['m']==$linha['modulo']) echo 'id="menu_ativo"';?> class="menu_link" href="#"><?=$linha['menu']?></a>
                <span class="sepadador">&nbsp;</span>
                
                <?
                	$SQL_sub = 'SELECT * FROM TBAAMENU WHERE id_pai='.(int)$linha['id_menu'];
                	$sub = $DB->consulta($SQL_sub);
					if($DB->nun_linhas($sub)>0){
				?>
                <ul id="sub_<?=$linha['id_menu']?>" class="sub1" style="display:none">
                	<? while($linha1 = $DB->lista($sub)){?>
                    <li><a href="?m=<?=$linha1['modulo']?>&a=<?=$linha1['acao']?>"><?=$linha1['menu']?></a></li>
                    <? }?>
                </ul>
                <? }?>
            </li>
		<? }?>

        </ul>
    </div>

	<div class="limpar"></div>
	<div id="contudo">
    	<div style="padding:15px; border:1px solid #ccc; border-radius:10px;">
    	<? include('url.php');?>
        <div class="limpar"></div>
    	</div>
    </div>




</div><!-- fim do geral-->

<div class="limpar"></div>
<div id="rodape">
	<div id="rodape_conteudo">
    	<p>Copyright 2012 - All rights reserved</p>
        <span>Version 1.0 - DaTerra Web Dev</span>
    </div>
</div>

</body>
</html>