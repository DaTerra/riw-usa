<?php
// Configurando Módulo
$Modulo = array(
	'titulo'=>'Companies',
	'tabela'=>'tbcompany_information',
	'modulo'=>'companies',
	'pasta'=>'',
	'acao'=>$_GET['a'],
	'id_tabela'=>'id_info',
	'icone'=>'',
);


// Listamdp registros
if($_GET['a']=='lista' or empty($_GET['a'])){
?>

<div id="modulo_cabecalho">
	<img src="./sistema/img/icones_sistema/<?=$Modulo['icone']?>" alt="" />
    <h2><?=$Modulo['titulo']?></h2>
    <ul>
        <li><a class="adm_bts" href="?m=<?=$Modulo['modulo']?>&amp;a=cadastra">Insert</a></li>
        <li><a class="adm_bts" onclick="remove()">Delete</a></li>
    </ul>
</div>

<form method="post" name="invitation">
<?
	echo alertas($_GET);
?>

<table class="list">
<?
	
	$SQL = 'SELECT * FROM '.$Modulo['tabela'].' WHERE 1 ';

	$lista = $DB->consulta(sql_paginacao($SQL, $pagina=$_GET['pg'],$qtd_registro=50));
	
	echo sistema_paginacao2($Modulo, $pg=$_GET['pg'], $_SERVER['REQUEST_URI'], $DB);
	
?>
<div class="limpar"></div>
    <thead>
    	<tr>
            <td style="text-align: center;" width="1"><input onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" type="checkbox"></td>
        	<td class="left">Company</td>
        	<td class="left">Email</td>
        	<td class="left">Logo</td>
    	</tr>
    </thead>
    <tbody>

        <? 
			
			if($DB->nun_linhas($lista)>0){
				while($linha = $DB->lista($lista)){
		?>
        <tr>
			<td style="text-align: center;"><input  name="selected[]" value="<?=$linha[$Modulo['id_tabela']]?>" type="checkbox"></td>
            <td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;a=edita&amp;id=<?=$linha[$Modulo['id_tabela']]?>"><?=$linha['company']?></a></td>        
            <td class="left"><?=$linha['contact_email']?></td>        
            <td class="left"><img src="../../img.php?dim=80x60&arquivo=./files/compay_submit/<?=$linha['pasta']?>/<?=$linha['company_logo']?>" /></td>        
        </tr>
        <? }}else{?>
        <tr><td class="center" colspan="8">No results!</td></tr>
        <? }?>
    </tbody>
</table>
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
<script type="text/javascript">
	
	f=document.invitation;
	function remove(){
		if(jQuery("input[@name='selected[]']:checked").length > 0){
			if(confirm('Delete?')){
				f.action="./processa/companies.php?acao=apagaVarios&info=<?=$informacoes?>";
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
	
		if($_GET['id']>0){
			$SQL = 'SELECT * FROM '.$Modulo['tabela'].' 
			WHERE '.$Modulo['id_tabela'].'='.(int)$_GET['id'].' LIMIT 1';
			
			$Dados = $DB->dados($SQL);
		}
		echo alertas($_GET);
	
?>
<form action="./processa/<?=$Modulo['modulo']?>.php" method="post" enctype="multipart/form-data">

<div id="modulo_cabecalho">
	<img src="./sistema/img/icones_sistema/<?=$Modulo['icone']?>" alt="" />
    <h2><?=$Modulo['titulo']?></h2>
    <ul>
        <li><button class="adm_bts" type="submit">Save</button></li>
        <li><a class="adm_bts" href="<?=$_SERVER['HTTP_REFERER']?>">Cancel</a></li>
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
    <input type="hidden" name="pasta" value="<?=$Dados['pasta']?>" />	
    
    
    <div class="geral_inputs">
    	<label>Company:</label><input style="width:450px;" type="text" name="company" value="<?=$Dados['company']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Contact Email:</label><input style="width:450px;" type="text" name="contact_email" value="<?=$Dados['contact_email']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Company website:</label><input style="width:450px;" type="text" name="company_website" value="<?=$Dados['company_website']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Year Founded:</label><input style="width:450px;" type="text" name="year_founded" value="<?=$Dados['year_founded']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Number of Employees:</label><input style="width:450px;" type="text" name="number_employees" value="<?=$Dados['number_employees']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Location:</label><input style="width:450px;" type="text" name="location" value="<?=$Dados['location']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Company Description:</label><textarea style="width:445px; height:80px; padding:5px; border:1px solid #999;" name="company_description"><?=$Dados['company_description']?></textarea>
    </div>
    
    
    <div class="geral_inputs">
    	<label>Twitter:</label><input style="width:450px;" type="text" name="twitter" value="<?=$Dados['twitter']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Facebook:</label><input style="width:450px;" type="text" name="facebook" value="<?=$Dados['facebook']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Google +:</label><input style="width:450px;" type="text" name="google" value="<?=$Dados['google']?>" />
    </div>
    <div class="geral_inputs">
    	<label>YouTube:</label><input style="width:450px;" type="text" name="you_tube" value="<?=$Dados['you_tube']?>" />
    </div>

    <div class="geral_inputs">
    	<label style="width:140px; margin-right:10px;">What are your product’s top three key differentiators from the competition?</label><textarea style="width:445px; height:80px; padding:5px; border:1px solid #999;" name="text1"><?=$Dados['text1']?></textarea>
    </div>
    <div class="geral_inputs">
    	<label style="width:140px; margin-right:10px;">Is there anything special about the design of this product?</label><textarea style="width:445px; height:80px; padding:5px; border:1px solid #999;" name="text2"><?=$Dados['text2']?></textarea>
    </div>
    <div class="geral_inputs">
    	<label style="width:140px; margin-right:10px;">Why would you recommend this product to your family, friend or work colleagues?</label><textarea style="width:445px; height:80px; padding:5px; border:1px solid #999;" name="text3"><?=$Dados['text3']?></textarea>
    </div>
    <div class="geral_inputs">
    	<label style="width:140px; margin-right:10px;">Is there an interesting story about how you designed your product and/or started your company?</label><textarea style="width:445px; height:80px; padding:5px; border:1px solid #999;" name="text4"><?=$Dados['text4']?></textarea>
    </div>
    <div class="geral_inputs">
    	<label style="width:140px; margin-right:10px;">What demand/need/problem does this product address?</label><textarea style="width:445px; height:80px; padding:5px; border:1px solid #999;" name="text5"><?=$Dados['text5']?></textarea>
    </div>
    <div class="geral_inputs">
    	<label style="width:140px; margin-right:10px;">Is it on sale now and where? Cost?</label><textarea style="width:445px; height:80px; padding:5px; border:1px solid #999;" name="text6"><?=$Dados['text6']?></textarea>
    </div>
    
    <div class="geral_inputs">
    	<label>Company Logo:</label><input name="company_logo" type="file" multiple="multiple" />
    </div>
    <?
    	if($Dados['company_logo']){
	?>
		<img src="../../img.php?dim=80x60&arquivo=./files/compay_submit/<?=$Dados['pasta']?>/<?=$Dados['company_logo']?>" />
    <? }?>
    <br />
    <br />
    <div class="geral_inputs">
    	<label>Presentation:</label><input type="file" name="presentation_file[]" multiple="multiple" />
    </div>
    <ul>
    <?
    
		if($Dados['id_info']>0){
			$consulta = $DB->consulta('SELECT * FROM tbcompany_presentation WHERE id_info='.(int)$Dados['id_info']);
			$dados = $DB->dados('SELECT * FROM tbcompany_information WHERE id_info='.(int)$Dados['id_info']);
			while($linha = $DB->lista($consulta)){
	?>
    	<li><a target="_blank" href="../../files/compay_submit/<?=$dados['pasta']?>/<?=$linha['file']?>"><?=$linha['file']?></a>&nbsp;&nbsp;<a href="./processa/companies.php?acao=apaga-arquivo&id_file=<?=$linha['id_file']?>&pasta=<?=$dados['pasta']?>&id=<?=$dados['id_info']?>&tabela=tbcompany_presentation"><i style="color:red;">Delete</i></a></li>
    <?
		}}
	?>
    </ul>
        <br />
    <br />

    <div class="geral_inputs">
    	<label>Company videos:</label><input type="file" name="company_videos[]" multiple="multiple" />
    </div>
    
    
        <ul>
    <?
    
		if($Dados['id_info']>0){
			$consulta = $DB->consulta('SELECT * FROM tbcompany_videos WHERE id_info='.(int)$Dados['id_info']);
			$dados = $DB->dados('SELECT * FROM tbcompany_information WHERE id_info='.(int)$Dados['id_info']);
			while($linha = $DB->lista($consulta)){
	?>
    	<li><a target="_blank" href="../../files/compay_submit/<?=$dados['pasta']?>/<?=$linha['file']?>"><?=$linha['file']?></a>&nbsp;&nbsp;<a href="./processa/companies.php?acao=apaga-arquivo&id_file=<?=$linha['id_file']?>&pasta=<?=$dados['pasta']?>&id=<?=$dados['id_info']?>&tabela=tbcompany_videos"><i style="color:red;">Delete</i></a></li>
    <?
		}}
	?>
    </ul>

    
    <div class="geral_inputs">
    	<label>Product photos:</label><input type="file" name="product_photos[]" multiple="multiple" />
    </div>
    
        <ul>
    <?
    
		if($Dados['id_info']>0){
			$consulta = $DB->consulta('SELECT * FROM tbcompany_products WHERE id_info='.(int)$Dados['id_info']);
			$dados = $DB->dados('SELECT * FROM tbcompany_information WHERE id_info='.(int)$Dados['id_info']);
			while($linha = $DB->lista($consulta)){
	?>
    	<li><a target="_blank" href="../../files/compay_submit/<?=$dados['pasta']?>/<?=$linha['file']?>"><?=$linha['file']?></a>&nbsp;&nbsp;<a href="./processa/companies.php?acao=apaga-arquivo&id_file=<?=$linha['id_file']?>&pasta=<?=$dados['pasta']?>&id=<?=$dados['id_info']?>&tabela=tbcompany_products"><i style="color:red;">Delete</i></a></li>
    <?
		}}
	?>
    </ul>
    <br />
    <div class="limpar"></div>
    <div id="bts_baixos">
    	<button class="adm_bts" type="submit">Save</button>
    	<button class="adm_bts" onclick="window.location ='sistema.php?m=<?=$Modulo['modulo']?>'" type="button">Cancel</button>
    </div>
</form>
<?	}?>

