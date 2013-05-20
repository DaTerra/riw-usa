<?php
// Configurando Módulo
$Modulo = array(
	'titulo'=>'Invitation',
	'tabela'=>'tbuser',
	'modulo'=>'invitation',
	'pasta'=>'',
	'acao'=>$_GET['a'],
	'id_tabela'=>'id_user',
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
        <li><a class="adm_bts" href="?m=<?=$Modulo['modulo']?>&amp;a=cadastra">Insert</a></li>
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
	}elseif(!empty($_GET['fil_title'])){
		$url_busca .= '&fil_title='.$_GET['fil_title'];
	}elseif(!empty($_GET['fil_comp'])){
		$url_busca .= '&fil_comp='.$_GET['fil_comp'];
	}elseif(!empty($_GET['fil_type'])){
		$url_busca .= '&fil_type='.$_GET['fil_type'];
	}elseif(!empty($_GET['fil_status'])){
		$url_busca .= '&fil_status='.$_GET['fil_status'];
	}
	
	
	
	
	
		$SQL = 'SELECT * FROM '.$Modulo['tabela'].' 
		INNER JOIN tbuser_type ON '.$Modulo['tabela'].'.id_type=tbuser_type.id_type
		INNER JOIN tbuser_status ON '.$Modulo['tabela'].'.id_status=tbuser_status.id_status
		 WHERE 1 ';
		 
		 
		if(!empty($_GET['fil_first'])){
			$SQL .= ' AND tbuser.first_name LIKE "%'.(string)$_GET['fil_first'].'%"';
		}elseif(!empty($_GET['fil_last'])){
			$SQL .= ' AND tbuser.last_name LIKE "%'.(string)$_GET['fil_last'].'%"';
		}elseif(!empty($_GET['fil_title'])){
			$SQL .= ' AND tbuser.title LIKE "%'.(string)$_GET['fil_title'].'%"';
		}elseif(!empty($_GET['fil_comp'])){
			$SQL .= ' AND tbuser.company LIKE "%'.(string)$_GET['fil_comp'].'%"';
		}elseif(!empty($_GET['fil_type'])){
			$SQL .= ' AND tbuser.id_type="'.(int)$_GET['fil_type'].'"';
		}elseif(!empty($_GET['fil_status'])){
			$SQL .= ' AND tbuser.id_status="'.(int)$_GET['fil_status'].'"';
		
		}elseif(!empty($_GET['fil_msg'])){
			$SQL .= ' AND tbhistory.action="'.(string)$_GET['fil_msg'].'"';
		
		}
		 
			// echo $SQL;
		 //fil_msg
		 if($_GET['campo']){
		 	$SQL .=' ORDER BY '.(string)$_GET['campo'].' '.(string)$_GET['order'];
			
		 }else{
			 $SQL .= 'ORDER BY tbuser_status.prioridade DESC';
		}
		 
		 
			$lista = $DB->consulta(sql_paginacao($SQL, $pagina=$_GET['pg'],$qtd_registro=50));
	
	echo sistema_paginacao2($Modulo, $pg=$_GET['pg'], $_SERVER['REQUEST_URI'], $DB);
	
?>
<div class="limpar"></div>
    <thead>
    	<tr>
            <td style="text-align: center;" width="1"><input onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" type="checkbox"></td>
        	<td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=first_name&amp;order=<?=$order?><?=$url_busca?>" <? if($_GET['campo']=='first_name' or empty($_GET['campo'])) echo' class="'.$class_order.'"';?>>First Name</a></td>
        	<td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=last_name&amp;order=<?=$order?>" <? if($_GET['campo']=='last_name') echo' class="'.$class_order.'"';?>>Last Name</a></td>
        	<td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=title&amp;order=<?=$order?>" <? if($_GET['campo']=='title') echo' class="'.$class_order.'"';?>>Title</a></td>
            <td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=company&amp;order=<?=$order?>" <? if($_GET['campo']=='company') echo' class="'.$class_order.'"';?>>Company</a></td>
        	<td class="left"><a>Type</a></td>
        	<td class="left"><a>Status</a></td>
        	<td class="left"><a>Last Message</a></td>
            <td></td>
    	</tr>
    </thead>
    <tbody>
        <tr class="filter">
        	<td></td>
        	<td><input type="text" name="fil_first" value="<?=$_GET['fil_first']?>" /></td>
        	<td><input type="text" name="fil_last" value="<?=$_GET['fil_last']?>" /></td>
        	<td><input type="text" name="fil_title" value="<?=$_GET['fil_title']?>" /></td>
        	<td><input type="text" name="fil_comp" value="<?=$_GET['fil_comp']?>" /></td>
        	<td>
            	<select name="fil_type">
                    	<option value="*"></option>
						<?
                        $consulta = $DB->consulta('SELECT * FROM tbuser_type');
                        
                        while($linha = $DB->lista($consulta)){
                        ?>
                        	<option <? if($_GET['fil_type']==$linha['id_type']) echo 'selected="selected"'; ?> value="<?=$linha['id_type']?>"><?=$linha['usertype']?></option>
                        <? }?>
                </select>
            </td>
        	<td>
            	<select name="fil_status">
                    	<option value="*"></option>
						<?
                        $consulta = $DB->consulta('SELECT * FROM tbuser_status');
                        
                        while($linha = $DB->lista($consulta)){
                        ?>
                        	<option <? if($_GET['fil_status']==$linha['id_status']) echo 'selected="selected"'; ?> value="<?=$linha['id_status']?>"><?=$linha['userstatus']?></option>
                        <? }?>
                </select>
            </td>
            <td> <? /* <input type="text" name="fil_msg" value="<?=$_GET['fil_msg']?>" /> */?></td>
        	<td align="right"><a class="adm_bts" onclick="filtro();" href="javascript:void(0)">Filter</a></td>
        </tr>

        <? 
			
			if($DB->nun_linhas($lista)>0){
				while($linha = $DB->lista($lista)){
		?>
        <tr>
			<td style="text-align: center;"><input  name="selected[]" value="<?=$linha[$Modulo['id_tabela']]?>" type="checkbox"></td>
            <td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;a=edita&amp;id=<?=$linha[$Modulo['id_tabela']]?>"><?=$linha['first_name']?></a></td>        
            <td class="left"><?=$linha['last_name']?></td>        
            <td class="left"><?=$linha['title']?></td>        
            <td class="left"><?=$linha['company']?></td>        
            <td class="left"><?=$linha['usertype']?></td>        
            <td class="left"><?=$linha['userstatus']?></td>
            <?
            	$dados = $DB->dados('SELECT * FROM tbhistory WHERE id_user='.$linha['id_user'].' ORDER BY date DESC LIMIT 1');
			?>
            <td><?=$dados['action']?></td>        
            <td></td>        
        </tr>
        <? }}else{?>
        <tr><td class="center" colspan="8">No results!</td></tr>
        <? }?>
    </tbody>
</table>

<div>
	<label>Email</label>
    <select name="email_action" id="email_action">
    	<option value="intite">INVITE</option>
    	<option value="decline">DECLINE</option>
        <?
        	$consulta1 = $DB->consulta('SELECT * FROM tbemails WHERE flag_dinamico=1');
			
			while($linha = $DB->lista($consulta1)){
		?>
    	<option value="<?=$linha['id_email']?>"><?=$linha['identifica']?></option>
        <? }?>
    </select>
    <button onclick="envia()" type="button">Send</button>
    
    <button onclick="remove()" type="button">Delete</button>
    
</div>

<script type="text/javascript">
	
	f=document.invitation;
	function remove(){
		if(jQuery("input[@name='selected[]']:checked").length > 0){
			if(confirm('Are you sure you want to delete the selected contact(s)?')){
				f.action="./processa/remove_user.php";
				f.submit();
			}
			return false;
		}
	}

	function envia(){
		if(jQuery("input[@name='selected[]']:checked").length > 0){
			
			if($("#email_action").val()=="intite"){
				var mensagem = "Are you sure you want to invite the selected contact(s)?";
			}else if($("#email_action").val()=="decline"){
				var mensagem = "Are you sure that you don't want to invite the selected contact(s)?";
			}else{
				var mensagem = "Are you sure you want to send this messages to the selected(s) concat(s).";
			}
			
			
			if(confirm(mensagem)){
				f.action="./processa/mail.php"; 
				f.submit();
			}
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
	
	var fil_title = $('input[name=\'fil_title\']').attr('value');
	
	if (fil_title) {
		url += '&fil_title=' + encodeURIComponent(fil_title);
	}
	
	var fil_comp = $('input[name=\'fil_comp\']').attr('value');
	
	if (fil_comp) {
		url += '&fil_comp=' + encodeURIComponent(fil_comp);
	}
	
	
	var fil_type = $('select[name=\'fil_type\']').attr('value');
	
	if (fil_type != '*') {
		url += '&fil_type=' + encodeURIComponent(fil_type);
	}	
	
	
	var fil_status = $('select[name=\'fil_status\']').attr('value');
	
	if (fil_status != '*') {
		url += '&fil_status=' + encodeURIComponent(fil_status);
	}	
	
	var fil_msg = $('input[name=\'fil_msg\']').attr('value');
	
	if (fil_msg) {
		url += '&fil_msg=' + encodeURIComponent(fil_msg);
	}


	location = url;
}

</script>
<?	
	//echo lista_registros($Acoes, $Registros, sql_paginacao($SQL, $_GET['pg'],20), $Modulo);
	echo sistema_paginacao2($Modulo, $pg=$_GET['pg'], $_SERVER['REQUEST_URI'], $DB);
	

// Criando os campos
}elseif($_GET['a']=='cadastra' or $_GET['a']=='edita'){
	
		if($_GET['id']>0){
			$SQL = 'SELECT * FROM '.$Modulo['tabela'].' 
			INNER JOIN tbuser_type ON '.$Modulo['tabela'].'.id_type=tbuser_type.id_type
			INNER JOIN tbuser_status ON '.$Modulo['tabela'].'.id_status=tbuser_status.id_status
			WHERE tbuser.'.$Modulo['id_tabela'].'='.(int)$_GET['id'].' LIMIT 1';
	
			$Dados = $DB->dados($SQL);
			
			$Chave = $DB->dados('SELECT * FROM tbuser_keys WHERE id_user='.(int)$_GET['id'].' LIMIT 1');
			$Dados['chave'] = $Chave['chave'];
		}else{
			include('../includes/Funcoes.php');
			$Dados['chave'] = upper(codigo(7));
		}
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
    	<label>Type:</label>
        
        
        <select name="id_type">

		<?
        	$consulta = $DB->consulta('SELECT * FROM tbuser_type');
        
        	while($linha = $DB->lista($consulta)){
        ?>
        	<option <? if($Dados['id_type']==$linha['id_type']) echo 'selected="selected"'; ?> value="<?=$linha['id_type']?>"><?=$linha['usertype']?></option>
        <? }?>
        

        </select>
        
        
    </div>
    <div class="geral_inputs">
    	<label>Status:</label>
        
        
        <select name="id_status">
		
		<?
        	$consulta = $DB->consulta('SELECT * FROM tbuser_status');
			if($_GET['a']=='cadastra'){
        	while($linha = $DB->lista($consulta)){
        ?>
        
        	<option <? if($linha['id_status']==10) echo 'selected="selected"'; ?> value="<?=$linha['id_status']?>"><?=$linha['userstatus']?></option>
            <? }}else{
        	while($linha = $DB->lista($consulta)){
			?>
        	<option <? if($Dados['id_status']==$linha['id_status']) echo 'selected="selected"'; ?> value="<?=$linha['id_status']?>"><?=$linha['userstatus']?></option>
            <? }?>
        <? }?>
        </select>
        
        
    </div>
    
    
    <div class="geral_inputs">
    	<label>Key:</label><input style="width:450px;" type="text" name="chave" value="<?=$Dados['chave']?>" />
    </div>
    <div class="geral_inputs">
    	<label>First Name:</label><input style="width:450px;" type="text" name="first_name" value="<?=$Dados['first_name']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Last Name:</label><input style="width:450px;" type="text" name="last_name" value="<?=$Dados['last_name']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Company:</label><input style="width:450px;" type="text" name="company" value="<?=$Dados['company']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Title:</label><input style="width:450px;" type="text" name="title" value="<?=$Dados['title']?>" />
    </div>
    <div class="geral_inputs">
    	<label>E-mail:</label><input style="width:450px;" type="text" name="email" value="<?=$Dados['email']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Phone:</label><input style="width:450px;" type="text" name="phone" value="<?=$Dados['phone']?>" />
    </div>
    
    <div class="geral_inputs">
    	<label>VIP:</label>
        <select name="vip">
        	<option <? if($Dados['vip']==1) echo 'selected="selected"'; ?> value="1">Yes</option>
        	<option <? if($Dados['vip']==0) echo 'selected="selected"'; ?> value="0">No</option>
        </select>
    </div>
    
    <div class="geral_inputs">
    	<label>City:</label><input style="width:450px;" type="text" name="city" value="<?=$Dados['city']?>" />
    </div>
    <div class="geral_inputs">
    	<label>State:</label><input style="width:450px;" type="text" name="state" value="<?=$Dados['state']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Country:</label><input style="width:450px;" type="text" name="country" value="<?=$Dados['country']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Postal Code:</label><input style="width:450px;" type="text" name="postal_code" value="<?=$Dados['postal_code']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Address Line 1:</label><input style="width:450px;" type="text" name="address_line_1" value="<?=$Dados['address_line_1']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Address Line 2:</label><input style="width:450px;" type="text" name="address_line_2" value="<?=$Dados['address_line_2']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Address Line 3:</label><input style="width:450px;" type="text" name="address_line_3" value="<?=$Dados['address_line_3']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Phone Work::</label><input style="width:450px;" type="text" name="phone_work" value="<?=$Dados['phone_work']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Fax:</label><input style="width:450px;" type="text" name="fax" value="<?=$Dados['fax']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Web Page:</label><input style="width:450px;" type="text" name="web_page" value="<?=$Dados['web_page']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Phone Mobile:</label><input style="width:450px;" type="text" name="phone_mobile" value="<?=$Dados['phone_mobile']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Public:</label>
        <select name="public_profile">
        	<option <? if($Dados['public_profile']==1) echo 'selected="selected"'; ?> value="1">Yes</option>
        	<option <? if($Dados['public_profile']==0) echo 'selected="selected"'; ?> value="0">No</option>
        </select>
    </div>
    <div class="geral_inputs">
    	<label>Hotel name:</label><input style="width:450px;" type="text" name="hotel_name" value="<?=$Dados['hotel_name']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Payment:</label><input style="width:450px;" type="text" name="hotel_payment" value="<?=$Dados['hotel_payment']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Room type:</label><input style="width:450px;" type="text" name="hotel_room_type" value="<?=$Dados['hotel_room_type']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Gift needed:</label>
        
        <select name="hotel_gift_needed">
        	<option <? if($Dados['hotel_gift_needed']==1) echo 'selected="selected"'; ?> value="1">Yes</option>
        	<option <? if($Dados['hotel_gift_needed']==0) echo 'selected="selected"'; ?> value="0">No</option>
        </select>
    </div>
    <div class="geral_inputs">
    	<label>Arrival date:</label><input style="width:450px;" type="text" name="hotel_arrival_date" value="<?=$Dados['hotel_arrival_date']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Departure date:</label><input style="width:450px;" type="text" name="hotel_departure_date" value="<?=$Dados['hotel_departure_date']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Transportation to event:</label><input style="width:450px;" type="text" name="transportation_to_event" value="<?=$Dados['transportation_to_event']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Transportation Notes:</label>
        <textarea name="transportation_notes"><?=$Dados['transportation_notes']?></textarea>
    </div>
    <div class="geral_inputs">
    	<label>Arrival airport:</label><input style="width:450px;" type="text" name="arrival_airport" value="<?=$Dados['arrival_airport']?>" />
    </div>
    <div class="geral_inputs">
    	<label>ArrivalFlight #:</label><input style="width:450px;" type="text" name="arrival_flight" value="<?=$Dados['arrival_flight']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Arrival time:</label><input style="width:450px;" type="text" name="arrival_time" value="<?=$Dados['arrival_time']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Transportation needed:</label>
        
        <select name="arrival_transportation">
        	<option <? if($Dados['arrival_transportation']=='none') echo 'selected="selected"'; ?> value="none">None</option>
        	<option <? if($Dados['arrival_transportation']=='car') echo 'selected="selected"'; ?> value="car">Car</option>
        	<option <? if($Dados['arrival_transportation']=='Taxi') echo 'selected="selected"'; ?> value="taxi">Taxi</option>
        	<option <? if($Dados['arrival_transportation']=='shuttle') echo 'selected="selected"'; ?> value="shuttle">Shuttle</option>
        </select>
    </div>
    <div class="geral_inputs">
    	<label>Arrival Notes:</label>
        <textarea name="transportation_notes"><?=$Dados['arrival_notes']?></textarea>
    </div>
    <div class="geral_inputs">
    	<label>Departure airport:</label><input style="width:450px;" type="text" name="departure_airport" value="<?=$Dados['departure_airport']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Departure Flight #:</label><input style="width:450px;" type="text" name="departure_flight" value="<?=$Dados['departure_flight']?>" />
    </div>
    <div class="geral_inputs">
    	<label>Departure time:</label><input style="width:450px;" type="text" name="departure_time" value="<?=$Dados['departure_time']?>" />
    </div>

    <div class="geral_inputs">
    	<label>Departure Notes:</label>
        
        <textarea name="departure_notes"><?=$Dados['departure_notes']?></textarea>
    </div>
    <div class="geral_inputs">
    	<label>Email Updates:</label>
        
        <select name="email_updates">
        	<option <? if($Dados['email_updates']==1) echo 'selected="selected"'; ?> value="1">Yes</option>
        	<option <? if($Dados['email_updates']==0) echo 'selected="selected"'; ?> value="0">No</option>
        </select>
    </div>
    <div class="geral_inputs">
    	<label>Networking:</label>
        <select name="networking">
        	<option <? if($Dados['networking']==1) echo 'selected="selected"'; ?> value="1">Yes</option>
        	<option <? if($Dados['networking']==0) echo 'selected="selected"'; ?> value="0">No</option>
        </select>
    </div>
    
    <div class="geral_inputs" style="margin-bottom:20px; float:left;">
    	<label>Attending:</label>
        <div id="lista_check">
        	<ul>
			<?	
				$attending = explode(';', $Dados['attending']);

                $consulta = $DB->consulta('SELECT * FROM tbevents');
                $x=0;
                while($linha = $DB->lista($consulta)){$x++;
            ?>
            	<li class="<?=$class?>"><input <? if(in_array($linha['id_event'], $attending)) echo ' checked="checked"';?> id="depat<?=$x?>" type="checkbox" name="id_event[]" value="<?=$linha['id_event']?>" /><label for="depat<?=$x?>"><?=$linha['event']?></label></li>
         	<? }?>   	
            </ul>
        </div>        
        
    </div>
    <div class="limpar"></div>
    <div class="geral_inputs">
        <label>Entree:</label>
        <select name="entree">
        	<option <? if($Dados['entree']=='Poultry') echo 'selected="selected"'; ?> value="Poultry">Poultry</option>
        	<option <? if($Dados['entree']=='Beef') echo 'selected="selected"'; ?> value="Beef">Beef</option>
        	<option <? if($Dados['entree']=='Fish') echo 'selected="selected"'; ?> value="Fish">Fish</option>
        	<option <? if($Dados['entree']=='Vegetarian') echo 'selected="selected"'; ?> value="Vegetarian">Vegetarian</option>
        </select>

    </div>    
    <div class="geral_inputs">
        <label>Allergy:</label>
        
        <select name="allergy">
        	<option <? if($Dados['allergy']==1) echo 'selected="selected"'; ?> value="1">Yes</option>
        	<option <? if($Dados['allergy']==0) echo 'selected="selected"'; ?> value="0">No</option>
        </select>
    </div>
    <div class="geral_inputs">
        <label>AllergyDetails:</label><input style="width:450px;" type="text" name="allergy_details" value="<?=$Dados['allergy_details']?>" />
    </div>	
    <div class="geral_inputs" style="margin-bottom:20px; float:left;">
        <label>Industry:</label>
        
        <div id="lista_check">
        	<ul>
			<?	
                
				$industry = explode(';', $Dados['industry']);
				$consulta = $DB->consulta('SELECT * FROM tbindustry');
                $x=0;
                while($linha = $DB->lista($consulta)){$x++;

				$class = ($x%2==0)? 'list_cet_par':'list_cet_imp';
            ?>
            	<li class="<?=$class?>"><input <? if(in_array($linha['id_typeindustry'], $industry)) echo ' checked="checked"';?> id="ind<?=$x?>" type="checkbox" name="id_typeindustry[]" value="<?=$linha['id_typeindustry']?>" /><label for="ind<?=$x?>"><?=$linha['typeindustry']?></label></li>
         	<? }?>   	
            </ul>
        </div>        
        
    </div>
    <div class="limpar"></div>
    <div class="geral_inputs">
        <label>Interests:</label>
        
        <div id="lista_check">
        	<ul>
			<?	
				$interests = explode(';', $Dados['interests']);
				$consulta = $DB->consulta('SELECT * FROM tbinterests');
                $x=0;
                while($linha = $DB->lista($consulta)){$x++;

            ?>
            	<li class="<?=$class?>"><input <? if(in_array($linha['id_interest'], $interests)) echo ' checked="checked"';?> id="inte<?=$x?>" type="checkbox" name="id_interest[]" value="<?=$linha['id_interest']?>" /><label for="inte<?=$x?>"><?=$linha['interest']?></label></li>
         	<? }?>   	
            </ul>
        </div>        
    </div>
    
    
    
    <div class="limpar"></div>
    <div class="geral_inputs">
        <label>Email:</label>
        
        <select id="type_email">
        	<option value="invite">INVITE</option>
        	<option value="decline">(R) DECLINE</option>
        </select>
        <button type="button" onclick="mail()">Send</button>
    </div>	
    <script type="text/javascript">
    	function mail(){
			var type_email = $("#type_email").val();
			abreJanelaCentro('/admin/modulos/email.php?id=<?=$Dados[$Modulo['id_tabela']]?>&email='+type_email,'E-mail',500,500,'');
		}
    </script>
    <div class="limpar"></div>
		    
    <div class="geral_inputs">
    	<label>&nbsp;</label>
        <button type="button" onclick="notes()">Notes</button>
    </div>
    
    <div class="limpar"></div>
    <script type="text/javascript">
    	function notes(){
			abreJanelaCentro('/admin/modulos/notes.php?id=<?=$Dados[$Modulo['id_tabela']]?>','Notes',550,500,'');
		}
    </script>
    <div id="bts_baixos">
    	<button class="adm_bts" type="submit">Save</button>
    	<button class="adm_bts" onclick="window.location ='sistema.php?m=<?=$Modulo['modulo']?>'" type="button">Cancel</button>
    </div>
</form>
<?	}?>

