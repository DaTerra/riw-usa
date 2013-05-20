<?php
// Configurando Módulo
$Modulo = array(
	'titulo'=>'E-mails',
	'tabela'=>'tbemails',
	'modulo'=>'email-gerent',
	'pasta'=>'',
	'acao'=>$_GET['a'],
	'id_tabela'=>'id_email',
	'icone'=>'email.png',
);


// Configurando os a listagem de registos
// Listamdp registros
if($_GET['a']=='lista' or empty($_GET['a'])){
?>

<div id="modulo_cabecalho">
	<img src="./sistema/img/icones_sistema/<?=$Modulo['icone']?>" alt="ìcone do módulo" />
    <h2><?=$Modulo['titulo']?></h2>
    <ul>
        <li><a class="adm_bts" href="?m=<?=$Modulo['modulo']?>&amp;a=cadastra">Insert</a></li>
        <li><a class="adm_bts" onclick="remove()">Delete</a></li>
    </ul>
</div>

<form method="post" name="invitation">
    <?
    
		$informacoes = '';
		if($_GET['id']>0){
			$info['valorID'] = $_GET['id'];
		}
		// Informações do módulo (tabela, destino, pasta de arquivo, etc)
		while($linha = each($Modulo)){
			$informacoes.=$linha['key'].'=>'.$linha['value'].',';
		}

	?>
    
    
    <input name="id" type="hidden" value="<?=$Dados[$Modulo['id_tabela']]?>" />
    <input type="hidden" name="info" value="<?=$informacoes?>'" />	

<?
	echo alertas($_GET);
?>

<table class="list">
	
	
	
	
<?	
	$SQL = 'SELECT * FROM '.$Modulo['tabela'].' WHERE flag_dinamico=1';
	//$SQL = 'SELECT * FROM '.$Modulo['tabela'].' INNER JOIN tbemails_type ON tbemails.id_typeemail=tbemails_type.id_typeemail  WHERE 1';
	$lista = $DB->consulta(sql_paginacao($SQL, $pagina=$_GET['pg'],$qtd_registro=50));
	
?>
<div class="limpar"></div>
    <thead>
    	<tr>
            <td style="text-align: center;" width="1"><input onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" type="checkbox"></td>
        	<td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=first_name&amp;order=<?=$order?><?=$url_busca?>" <? if($_GET['campo']=='first_name' or empty($_GET['campo'])) echo' class="'.$class_order.'"';?>>ID email</a></td>
        	<td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=last_name&amp;order=<?=$order?>" <? if($_GET['campo']=='last_name') echo' class="'.$class_order.'"';?>>Subject</a></td>
        </tr>
    </thead>
    <tbody>
        </tr>
        <? 
			if($DB->nun_linhas($lista)>0){
				while($linha = $DB->lista($lista)){
		?>
        <tr>
			<td style="text-align: center;"><input <? if($linha['id_typeemail']==1) echo 'disabled="disabled"';?>  name="selected[]" value="<?=$linha[$Modulo['id_tabela']]?>" type="checkbox"></td>
            <td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;a=edita&amp;id=<?=$linha[$Modulo['id_tabela']]?>"><?=$linha['identifica']?></a></td>        
            <td class="left"><?=$linha['subject']?></td>        
        </tr>
        <? }}else{?>
        <tr><td class="center" colspan="8">No results!</td></tr>
        <? }?>
    </tbody>
</table>


<script type="text/javascript">
	
	f=document.invitation;
	function remove(){
		if(jQuery("input[@name='selected[]']:checked").length > 0){
			if(confirm('Are you sure you want to delete the selected contact(s)?')){
				f.action="./processa/<?=$Modulo['modulo']?>.php?acao=apagaVarios";
				f.submit();
			}
			return false;
		}
	}
</script>


</form>
<?	
	//echo lista_registros($Acoes, $Registros, sql_paginacao($SQL, $_GET['pg'],20), $Modulo);
	echo sistema_paginacao2($Modulo, $pg=$_GET['pg'], $_SERVER['REQUEST_URI'], $DB);
	
// Criando os campos
}elseif($_GET['a']=='cadastra' or $_GET['a']=='edita'){
	
		/*$SQL = 'SELECT * FROM '.$Modulo['tabela'].' 
		INNER JOIN tbemails_type ON '.$Modulo['tabela'].'.id_typeemail=tbemails_type.id_typeemail
		WHERE '.$Modulo['tabela'].'.'.$Modulo['id_tabela'].'='.(int)$_GET['id'].' LIMIT 1';*/
		
		$SQL = 'SELECT * FROM '.$Modulo['tabela'].' 
		WHERE '.$Modulo['tabela'].'.'.$Modulo['id_tabela'].'='.(int)$_GET['id'].' LIMIT 1';
	
	//echo $SQL;
	$Dados = $DB->dados($SQL);
	
	//$Dados['status'] = ($Dados[$Modulo['id_tabela']]>0)?$Dados['status']:1;
	
	echo alertas($_GET);
	
?>
<form action="./processa/<?=$Modulo['modulo']?>.php" method="post" enctype="multipart/form-data">

<div id="modulo_cabecalho">
	<img src="./sistema/img/icones_sistema/<?=$Modulo['icone']?>" alt="ìcone do módulo" />
    <h2><?=$Modulo['titulo']?></h2>
    <ul>
        <li><button class="adm_bts" type="submit">Save</button></li>
        <li><a class="adm_bts" href="?m=<?=$Modulo['modulo']?>&amp;a=lista">Cancel</a></li>
    </ul>
</div>


    <?
    
		$informacoes = '';
		if($_GET['id']>0){
			$info['valorID'] = $_GET['id'];
		}
		// Informações do módulo (tabela, destino, pasta de arquivo, etc)
		while($linha = each($Modulo)){
			$informacoes.=$linha['key'].'=>'.$linha['value'].',';
		}

	?>
    
    
    <input name="id" type="hidden" value="<?=$Dados[$Modulo['id_tabela']]?>" />
    <input type="hidden" name="info" value="<?=$informacoes?>'" />	
    
    <div class="geral_inputs">
    	<label>ID e-mail:</label><input style="width:450px;" type="text" name="identifica" value="<?=$Dados['identifica']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Subject:</label><input style="width:450px;" type="text" name="subject" value="<?=$Dados['subject']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Country:</label>
        <textarea name="email" id="main" style="width:800px; height:250px;"><?=$Dados['email']?></textarea>
    </div>
            <script type="text/javascript">
        var milestone1 = {
                // General options
                mode : "exact",
                language : "en",
                elements : "email",
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
    <div id="bts_baixos">
    	<button class="adm_bts" type="submit">Save</button>
    	<button class="adm_bts" onclick="window.location ='sistema.php?m=<?=$Modulo['modulo']?>'" type="button">Cancel</button>
    </div>
</form>
<?	}?>

