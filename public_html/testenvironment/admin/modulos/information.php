<?php
// Configurando Módulo
$Modulo = array(
	'titulo'=>'Content submission',
	'tabela'=>'tbinformation',
	'modulo'=>'information',
	'pasta'=>'',
	'acao'=>$_GET['a'],
	'id_tabela'=>'id_info',
	'icone'=>'user.png',
);


// Configurando os a listagem de registos
// Listamdp registros
if($_GET['a']=='lista' or empty($_GET['a'])){
?>

<div id="modulo_cabecalho">
	<img src="./sistema/img/icones_sistema/<?=$Modulo['icone']?>" alt="ìcone do módulo" />
    <h2><?=$Modulo['titulo']?></h2>
    <ul>
        <li><a class="adm_bts" onclick="remove()">Delete</a></li>
    </ul>
</div>

<form method="post" name="invitation">
<?
	echo alertas($_GET);
?>

<table class="list">
<?
	if($_GET['order']=='asc'){
		$order = 'desc';
		$class_order = 'asc';
	}elseif($_GET['order']=='desc'){
		$order = 'asc';
		$class_order = 'desc';
	}else{
		$order = 'asc';
		//$class_order = 'desc';
	}
	
	$url_busca = '';
	if(!empty($_GET['fil_first'])){
		$url_busca .= '&fil_first='.$_GET['fil_first'];
	}elseif(!empty($_GET['fil_last'])){
		$url_busca .= '&fil_last='.$_GET['fil_last'];
	}elseif(!empty($_GET['fil_date'])){
		$url_busca .= '&fil_date='.$_GET['fil_date'];
	}
?>
    <thead>
    	<tr>
            <td style="text-align: center;" width="1"><input onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" type="checkbox"></td>
        	<td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=first_name&amp;order=<?=$order?><?=$url_busca?>" <? if($_GET['campo']=='first_name' or empty($_GET['campo'])) echo' class="'.$class_order.'"';?>>First Name</a></td>
        	<td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=last_name&amp;order=<?=$order?>" <? if($_GET['campo']=='last_name') echo' class="'.$class_order.'"';?>>Last Name</a></td>
            <td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=company&amp;order=<?=$order?>" <? if($_GET['campo']=='date') echo' class="'.$class_order.'"';?>>Date</a></td>
            <td></td>
    	</tr>
    </thead>
    <tbody>
        <tr class="filter">
        	<td></td>
        	<td><input type="text" name="fil_first" value="<?=$_GET['fil_first']?>" /></td>
        	<td><input type="text" name="fil_last" value="<?=$_GET['fil_last']?>" /></td>
        	<td><input type="text" name="fil_date" value="<?=$_GET['fil_date']?>" /></td>
        	<td align="right"><a class="adm_bts" onclick="filtro();" href="javascript:void(0)">Filter</a></td>
        </tr>

        <? 
		$SQL = 'SELECT *, DATE_FORMAT(date, "%m/%d/%Y") AS data1 FROM '.$Modulo['tabela'].' 
		 WHERE 1 ';
		 
		 
		if(!empty($_GET['fil_first'])){
			$SQL .= ' AND tbinformation.first_name LIKE "%'.(string)$_GET['fil_first'].'%"';
		}elseif(!empty($_GET['fil_last'])){
			$SQL .= ' AND tbinformation.last_name LIKE "%'.(string)$_GET['fil_last'].'%"';
		}elseif(!empty($_GET['fil_date'])){
			$SQL .= ' AND tbinformation.date LIKE "%'.(string)$_GET['fil_date'].'%"';
		}
		 
		 if($_GET['campo']){
		 	$SQL .=' ORDER BY '.(string)$_GET['campo'].' '.(string)$_GET['order'];
			
		 }else{
			 $SQL .= 'ORDER BY tbinformation.first_name DESC';
		}
		 
			$lista = $DB->consulta(sql_paginacao($SQL, $_GET['pg'], 20));
			
			if($DB->nun_linhas($lista)>0){
				while($linha = $DB->lista($lista)){
		?>
        <tr>
			<td style="text-align: center;"><input name="selected[]" value="<?=$linha[$Modulo['id_tabela']]?>" type="checkbox"></td>
            <td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;a=edita&amp;id=<?=$linha[$Modulo['id_tabela']]?>"><?=$linha['first_name']?></a></td>        
            <td class="left"><?=$linha['last_name']?></td>        
            <td class="left"><?=$linha['data1']?></td>        
            <td></td>        
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
			if(confirm('Want to delete this (s) record?')){
				f.action="./processa/remove_information.php";
				f.submit();
			}
			return false;
		}
	}


</script>


</form>
<script type="text/javascript">
function filtro() {
	url = '/admin/sistema.php?m=<?=$Modulo['modulo']?>&a=lista<? if(!empty($_GET['campo'])) echo '&campo='.$_GET['campo']; if(!empty($_GET['order'])) echo '&order='.$_GET['order'];?>';
	
	var fil_first = $('input[name=\'fil_first\']').attr('value');
	
	if (fil_first) {
		url += '&fil_first=' + encodeURIComponent(fil_first);
	}
	
	var fil_last = $('input[name=\'fil_last\']').attr('value');
	
	if (fil_last) {
		url += '&fil_last=' + encodeURIComponent(fil_last);
	}
	
	var fil_date = $('input[name=\'fil_date\']').attr('value');
	
	if (fil_date) {
		url += '&fil_title=' + encodeURIComponent(fil_date);
	}
	

	location = url;
}

</script>
<?	
	//echo lista_registros($Acoes, $Registros, sql_paginacao($SQL, $_GET['pg'],20), $Modulo);
	echo sistema_paginacao($Modulo, $pg=$_GET['pg']);

// Criando os campos
}elseif($_GET['a']=='cadastra' or $_GET['a']=='edita'){
	
		$SQL = 'SELECT * FROM '.$Modulo['tabela'].' 
		WHERE '.$Modulo['id_tabela'].'='.(int)$_GET['id'].' LIMIT 1';	
	
	$Dados = $DB->dados($SQL);
	
	//$Dados['status'] = ($Dados[$Modulo['id_tabela']]>0)?$Dados['status']:1;
	
	echo alertas($_GET);
	
?>
<form action="./processa/<?=$Modulo['modulo']?>.php" method="post" enctype="multipart/form-data">

<div id="modulo_cabecalho">
	<img src="./sistema/img/icones_sistema/<?=$Modulo['icone']?>" alt="ìcone do módulo" />
    <h2><?=$Modulo['titulo']?></h2>
    <ul>
        <li><a class="adm_bts" onclick="self.print()">Print</a></li>
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
    
    <style type="text/css">
    	#list_information{}
    	#list_information h4{ margin-bottom:10px; font-size:15px;}
    	.information_item{ margin-bottom:5px;}
		.info_separador{ display:block; height:1px; text-indent:-9000px; background:#ccc; margin-top:10px; margin-bottom:10px;}
    </style>
    
    <div id="list_information">
        <h4>Contact Information:</h4>
        <div class="information_item">
            <p><strong>First Name:</strong>&nbsp;<?=$Dados['first_name']?></p>
        </div>
        <div class="information_item">
            <p><strong>Last Name:</strong>&nbsp;<?=$Dados['last_name']?></p>
        </div>
        <div class="information_item">
            <p><strong>Company:</strong>&nbsp;<?=$Dados['company']?></p>
        </div>
        <div class="information_item">
            <p><strong>Title:</strong>&nbsp;<?=$Dados['title']?></p>
        </div>
        <div class="information_item">
            <p><strong>E-mail:</strong>&nbsp;<?=$Dados['email']?></p>
        </div>
        
        <span class="info_separador">&nbsp;</span>
        <div class="limpar"></div>
        
        <h4>PR Information:</h4>
        <div class="information_item">
            <p><strong>Company/PR Contact Name:</strong>&nbsp;<?=$Dados['company_contact_name']?></p>
        </div>
        <div class="information_item">
            <p><strong>Contact Email:</strong>&nbsp;<?=$Dados['contact_email']?></p>
        </div>
        
        <span class="info_separador">&nbsp;</span>
        <div class="limpar"></div>
        
        <h4>Tell Us About Your Company:</h4>

        <div class="information_item">
            <p><strong>Company website:</strong>&nbsp;<?=$Dados['company_website']?></p>
        </div>
        <div class="information_item">
            <p><strong>Year Founded:</strong>&nbsp;<?=$Dados['year_founded']?></p>
        </div>
        <div class="information_item">
            <p><strong>Number of Employees:</strong>&nbsp;<?=$Dados['number_employees']?></p>
        </div>
        <div class="information_item">
            <p><strong>Company Description:</strong>&nbsp;<?=$Dados['company_description']?></p>
        </div>
        <div class="information_item">
            <p><strong>Twitter:</strong>&nbsp;<?=$Dados['twitter']?></p>
        </div>
        <div class="information_item">
            <p><strong>Facebook:</strong>&nbsp;<?=$Dados['facebook']?></p>
        </div>
        <div class="information_item">
            <p><strong>Google+:</strong>&nbsp;<?=$Dados['google']?></p>
        </div>
        
        <div class="information_item">
            <p><strong>YouTube:</strong>&nbsp;<?=$Dados['you_tube']?></p>
        </div>
        
        <span class="info_separador">&nbsp;</span>
        <div class="limpar"></div>
        
        <h4>Speaker/Presentation Information:</h4>
        <div class="information_item">
            <p><strong>Speaker Name and Title:</strong>&nbsp;<?=$Dados['speaker_name']?></p>
        </div>
        <div class="information_item">
            <p><strong>Speaker Bio:</strong>&nbsp;<?=$Dados['speaker_bio']?></p>
        </div>
        <div class="information_item">
            <p><strong>Presentation Title:</strong>&nbsp;<?=$Dados['presentation_title']?></p>
        </div>
        <div class="information_item">
            <p><strong>Presentation description:</strong>&nbsp;<?=$Dados['presentation']?></p>
        </div>
        <div class="information_item">
            <p><strong>Interested in speaking to U.S. media?</strong>&nbsp;<?=($Dados['interested_speaking']==1)?'Yes':'NO'?></p>
        </div>
        <div class="information_item">
            <p><strong>Success stories:</strong>&nbsp;<?=$Dados['success_stories']?></p>
        </div>
        <div class="information_item">
            <p><strong>Speaker Twitter handle:</strong>&nbsp;<?=$Dados['speaker_twitter']?></p>
        </div>
        
        <span class="info_separador">&nbsp;</span>
        <div class="limpar"></div>
        <h4>Tell Us About Your Product:</h4>
        
        
        <div class="information_item">
            <p><strong>What are your product’s top three key differentiators from the competition?</strong>
            <br /><?=$Dados['text1']?></p>
        </div>
        <br />
        <div class="information_item">
            <p><strong>Is there anything special about the design of this product? (hardware or software)</strong>
            <br /><?=$Dados['text2']?></p>
        </div>
        <br />
        <div class="information_item">
            <p><strong>Why would you recommend this product to your family, friend or work colleagues?</strong>
            <br /><?=$Dados['text3']?></p>
        </div>
        <br />
        <div class="information_item">
            <p><strong>Is there an interesting story about how you designed your product and/or started your company?</strong>
            <br /><?=$Dados['text4']?></p>
        </div>
        <br />
        <div class="information_item">
            <p><strong>What demand/need/problem does this product address?</strong>
            <br /><?=$Dados['text5']?></p>
        </div>
        <br />
        <div class="information_item">
            <p><strong>Is it on sale now and where? Cost?</strong>
            <br /><?=$Dados['text6']?></p>
        </div>
        
        
        <br />
        
        <span class="info_separador">&nbsp;</span>
        <div class="limpar"></div>
        <h4>Media Upload:</h4>
        
        <div  class="information_item">
        	<p><strong>Profile Photo:</strong></p>
            <a target="_blank" href="../../files/information/<?=$Dados['pasta']?>/<?=$Dados['profile_photo']?>">Download</a>
        </div>
        <br />
        
        <div  class="information_item">
        	<p><strong>Company Logo:</strong></p>
            <a target="_blank" href="../../files/information/<?=$Dados['pasta']?>/<?=$Dados['company_logo']?>">Download</a>
        </div>
        <br />
        <div  class="information_item">
        	<p><strong>Presentation:</strong></p>
            
            <ul>
            	<?
                	$consulta = $DB->consulta('SELECT * FROM tbinfo_presentation WHERE id_info='.(int)$Dados['id_info']);
					if($DB->nun_linhas($consulta)>0){
						$x=0;
						while($linha = $DB->lista($consulta)){$x++;
				?>
            	<li>
            		<a target="_blank" href="../../files/information/<?=$Dados['pasta']?>/<?=$linha['file']?>">Download <?=$x?></a>
                </li>
                <? } }else{?>
                	<li>No results</li>
                <? }?>
            </ul>
        </div>
        <br />
        <div  class="information_item">
        	<p><strong>Company videos:</strong></p>
            
            <ul>
            	<?
                	$consulta = $DB->consulta('SELECT * FROM tbinformation_videos WHERE id_info='.(int)$Dados['id_info']);
					if($DB->nun_linhas($consulta)>0){
						$x=0;
						while($linha = $DB->lista($consulta)){$x++;
				?>
            	<li>
            		<a target="_blank" href="../../files/information/<?=$Dados['pasta']?>/<?=$linha['file']?>">Download <?=$x?></a>
                </li>
                <? } }else{?>
                	<li>No results</li>
                <? }?>
            </ul>
        </div>
        <br />
        <div  class="information_item">
        	<p><strong>Product photos:</strong></p>
            
            <ul>
            	<?
                	$consulta = $DB->consulta('SELECT * FROM tbinfo_products WHERE id_info='.(int)$Dados['id_info']);
					if($DB->nun_linhas($consulta)>0){
						$x=0;
						while($linha = $DB->lista($consulta)){$x++;
				?>
            	<li>
            		<a target="_blank" href="../../files/information/<?=$Dados['pasta']?>/<?=$linha['file']?>">Download <?=$x?></a>
                </li>
                <? } }else{?>
                	<li>No results</li>
                <? }?>
            </ul>
        </div>
        
        
        
        
    </div>
</form>
<?	}?>

