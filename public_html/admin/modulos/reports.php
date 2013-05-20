<?php
// Configurando Módulo
$Modulo = array(
	'titulo'=>'Reports',
	'tabela'=>'tbuser',
	'modulo'=>'reports',
	'pasta'=>'',
	'acao'=>$_GET['a'],
	'id_tabela'=>'id_user',
	'icone'=>'reports.png',
);


// Configurando os a listagem de registos
// Listamdp registros
if($_GET['a']=='lista' or empty($_GET['a'])){
?>

<div id="modulo_cabecalho">
	<img src="./sistema/img/icones_sistema/<?=$Modulo['icone']?>" alt="ìcone do módulo" />
    <h2><?=$Modulo['titulo']?></h2>
    <ul>
        <li><a onclick="busca_post()" class="adm_bts" href="javascript:void(0)">Filter</a></li>
        <li><a class="adm_bts" onclick="repert_pdf()" href="javascript:void(0)">PDF</a></li>
        <li><a class="adm_bts" onclick="repert_csv()" href="javascript:void(0)">CSV</a></li>
    </ul>
</div>

<form method="post" name="busca">
<?
	echo alertas($_GET);
?>
<div>
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
	if(!empty($_GET['fil_company'])){
		$url_busca .= '&fil_company='.$_GET['fil_company'];
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
		 
		 
		 
		if(!empty($_POST['fil_company'])){
			$SQL .= ' AND tbuser.company LIKE "%'.(string)$_POST['fil_company'].'%"';
		}
		if(!empty($_POST['fil_title'])){
			$SQL .= ' AND tbuser.title LIKE "%'.(string)$_POST['fil_title'].'%"';
		}
		
		if($_POST['fil_vip']=='no' or $_POST['fil_vip']=='yes'){
			$vip = ($_POST['fil_vip']=='yes')?1:0;
			$SQL .= ' AND tbuser.vip='.(int)$vip;
		}
		
		if(!empty($_POST['fil_hotel_name'])){
			$SQL .= ' AND tbuser.hotel_name LIKE "%'.(string)$_POST['fil_hotel_name'].'%"';
		}
		
		if(!empty($_POST['fil_arrival_airport'])){
			$SQL .= ' AND tbuser.arrival_airport LIKE "%'.(string)$_POST['fil_arrival_airport'].'%"';
		}
		if(!empty($_POST['fil_departure_airport'])){
			$SQL .= ' AND tbuser.departure_airport LIKE "%'.(string)$_POST['fil_departure_airport'].'%"';
		}
		
		if($_POST['fil_email_updates']=='no' or $_POST['fil_email_updates']=='yes'){
			$vip = ($_POST['fil_email_updates']=='yes')?1:0;
			$SQL .= ' AND tbuser.email_updates='.(int)$vip;
		}
		
		if($_POST['fil_networking']=='no' or $_POST['fil_networking']=='yes'){
			$vip = ($_POST['fil_networking']=='yes')?1:0;
			$SQL .= ' AND tbuser.networking='.(int)$vip;
		}

		
		if(!empty($_POST['fil_attending']) and !($_POST['fil_attending'][0]=="nada")){
			$qtd = count($_POST['fil_attending']);
			$SQL .= ' AND (';
			$x=0;
			foreach($_POST['fil_attending'] as $v){$x++;
				$SQL .= "tbuser.attending LIKE \"%;$v;%\" ";
				if($qtd>1 and $x<$qtd){
					
					$SQL .= " AND ";
				}
			}
			$SQL .= ')';
		}
		
		
		
		
		if(!empty($_POST['fil_entree']) and $_POST['fil_entree']!='nada'){
			$SQL .= ' AND tbuser.entree="'.(string)$_POST['fil_entree'].'"';
		}

		if($_POST['fil_allergy']=='no' or $_POST['fil_allergy']=='yes'){
			
			$vip = ($_POST['fil_allergy']=='yes')?1:0;
			$SQL .= ' AND tbuser.allergy='.(int)$vip;
		}
		
		 
		if(!empty($_POST['fil_allergy_details'])){
			$SQL .= ' AND tbuser.allergy_details LIKE "%'.(string)$_POST['fil_allergy_details'].'%"';
		}
		
		//fil_allergy_details
		if(!empty($_POST['fil_industry']) and !($_POST['fil_industry'][0]=="nada")){
			$qtd = count($_POST['fil_industry']);
			$SQL .= ' AND (';
			$x=0;
			foreach($_POST['fil_industry'] as $v){$x++;
				$SQL .= "tbuser.industry LIKE \"%;$v;%\" ";
				if($qtd>1 and $x<$qtd){
					
					$SQL .= " AND ";
				}
			}
			$SQL .= ')';
		}
		
		if(!empty($_POST['fil_interests']) and !($_POST['fil_interests'][0]=="nada")){
			$qtd = count($_POST['fil_interests']);
			$SQL .= ' AND (';
			$x=0;
			foreach($_POST['fil_interests'] as $v){$x++;
				$SQL .= "tbuser.interests LIKE \"%;$v;%\" ";
				if($qtd>1 and $x<$qtd){
					
					$SQL .= " AND ";
				}
			}
			$SQL .= ')';
		}
		

		if($_POST['fil_public_profile']=='no' or $_POST['fil_public_profile']=='yes'){
			$vip = ($_POST['fil_public_profile']=='yes')?1:0;
			$SQL .= ' AND tbuser.public_profile='.(int)$vip;
		}

		if(!empty($_POST['fil_registration_code'])){
			$SQL .= ' AND tbuser.registration_code LIKE "%'.(string)$_POST['fil_registration_code'].'%"';
		}
		
		if(!empty($_POST['fil_status']) and $_POST['fil_status']!='nada'){
			$SQL .= ' AND tbuser.id_status="'.(int)$_POST['fil_status'].'"';
		}
		
		if(!empty($_POST['fil_type']) and $_POST['fil_type']!='nada'){
			$SQL .= ' AND tbuser.id_type="'.(int)$_POST['fil_type'].'"';
		}
		
		
		
		#echo($SQL);

		$lista = $DB->consulta($SQL);
	
	
?>
<input name="sql" type="hidden" value='<?=$SQL?>' />
<div class="limpar"></div>

<style type="text/css">
	#busca_detalhada{ margin-bottom:25px; float:left;}
	#busca_detalhada div label{ font-weight:bold; font-size:13px; color:#333;}
	.div_busca{ float:left; width:250px; margin-right:20px;}
	.div_busca div{ margin-bottom:10px;}
</style>
<div id="busca_detalhada">
        	
            
            <div class="div_busca" id="div1">
                <div>
                    <label>Company</label>	<br />
                    <input type="text" name="fil_company" value="<?=$_POST['fil_company']?>" />
                </div>
                <div>
                    <label>Title</label><br />
                    <input type="text" name="fil_title" value="<?=$_POST['fil_title']?>" />
                </div>
                <div>
                    <label>VIP</label><br />
                    <select name="fil_vip">
                            <option value="nada"></option>
                            <option <? if($_POST['fil_vip']=='no') echo 'selected="selected"'; ?> value="no">No</option>
                            <option <? if($_POST['fil_vip']=='yes') echo 'selected="selected"'; ?> value="yes">Yes</option>
                    </select>
                </div>
                <div>
                    <label>Hotel Name</label><br />
                    <input type="text" name="fil_hotel_name" value="<?=$_POST['fil_hotel_name']?>" />
                </div>
                <div>
                    <label>Arrival Airport</label><br />
                    <input type="text" name="fil_arrival_airport" value="<?=$_POST['fil_arrival_airport']?>" />
                </div>
            </div>
            
            <div class="div_busca" id="div2">
                <div>
                    <label>Departure Airport</label><br />
                    <input type="text" name="fil_departure_airport" value="<?=$_POST['fil_departure_airport']?>" />
                </div>
                
                <div>
                    <label>Email Updates</label><br />
                    <select name="fil_email_updates">
                            <option value="nada"></option>
                            <option <? if($_POST['fil_email_updates']=='no') echo 'selected="selected"'; ?> value="no">No</option>
                            <option <? if($_POST['fil_email_updates']=='yes') echo 'selected="selected"'; ?> value="yes">Yes</option>
                    </select>
                </div>
                
                
                <div>
                    <label>Networking</label><br />
                    <select name="fil_networking">
                        <option value="nada"></option>
                        <option <? if($_POST['fil_networking']=='no') echo 'selected="selected"'; ?> value="no">No</option>
                        <option <? if($_POST['fil_networking']=='yes') echo 'selected="selected"'; ?> value="yes">Yes</option>
                    </select>
                </div>
            
            </div>
            
            <div class="div_busca" id="div3">
                <div>
                    <label>Entree</label><br />
                    <select name="fil_entree">
                            <option value="nada"></option>
                            <option <? if($_POST['fil_entree']=='Poultry') echo 'selected="selected"'; ?> value="Poultry">Poultry</option>
                            <option <? if($_POST['fil_entree']=='Beef') echo 'selected="selected"'; ?> value="Beef">Beef</option>
                            <option <? if($_POST['fil_entree']=='Fish') echo 'selected="selected"'; ?> value="Fish">Fish</option>
                            <option <? if($_POST['fil_entree']=='Vegetarian') echo 'selected="selected"'; ?> value="Vegetarian">Vegetarian</option>
                    </select>
                </div> 
                <div>
                    <label>Allergy</label><br />
                    
                    <select name="fil_allergy">
                        <option value="nada"></option>
                        <option <? if($_POST['fil_allergy']=='no') echo 'selected="selected"'; ?> value="no">No</option>
                        <option <? if($_POST['fil_allergy']=='yes') echo 'selected="selected"'; ?> value="yes">Yes</option>
                    </select>
                </div>
                <div>
                    <label>Allergy Details</label><br />
                    <input type="text" name="fil_allergy_details" value="<?=$_POST['fil_allergy_details']?>" />
                </div>
                <div>
                    <label>Industry</label><br />
                    <select name="fil_industry[]" multiple="multiple">
                            <option value="nada">--</option>
                            
                            <? 
                                $consulta = $DB->consulta('SELECT * FROM tbindustry');
                                while($linha = $DB->lista($consulta)){
                            ?>
                            <option <? if(@in_array($linha['id_typeindustry'], $_POST['fil_industry'])) echo 'selected="selected"'; ?> value="<?=$linha['id_typeindustry']?>"><?=$linha['typeindustry']?></option>
                            <? }?>
                    </select>
                </div> 
            
            </div>
            
            
            <div class="div_busca" id="div4">
                <div>
                    <label>Interests</label><br />
                    <select name="fil_interests[]" multiple="multiple">
                            <option value="nada">--</option>
                            <? 
                                $consulta = $DB->consulta('SELECT * FROM tbinterests');
                                while($linha = $DB->lista($consulta)){
                            ?>
                            <option <? if(@in_array($linha['id_interest'], $_POST['fil_interests'])) echo 'selected="selected"'; ?> value="<?=$linha['id_interest']?>"><?=$linha['interest']?></option>
                            <? }?>
                    </select>
                </div> 
                <div>
                    <label>Public Profile</label><br />
                    <select name="fil_public_profile">
                        <option value="nada"></option>
                        <option <? if($_POST['fil_public_profile']=='no') echo 'selected="selected"'; ?> value="no">No</option>
                        <option <? if($_POST['fil_public_profile']=='yes') echo 'selected="selected"'; ?> value="yes">Yes</option>
                    </select>
                </div>
                <div>
                    <label>Promo Code</label><br />
                    <input type="text" name="fil_registration_code" value="<?=$_POST['fil_registration_code']?>" />
                </div>
                
                


            </div>
            
            

            <div class="div_busca" id="div5" style="width:150px;">
                <div>
                    <label>Type</label><br />
                    
                    <select name="fil_type">
                        <option value="nada"></option>
						<?
                        $consulta = $DB->consulta('SELECT * FROM tbuser_type');
                        
                        while($linha = $DB->lista($consulta)){
                        ?>
                        	<option <? if($_POST['fil_type']==$linha['id_type']) echo 'selected="selected"'; ?> value="<?=$linha['id_type']?>"><?=$linha['usertype']?></option>
                        <? }?>
                    </select>
                </div>
                <div>
                    <label>Status</label><br />
                    
                    <select name="fil_status">
                        <option value="nada"></option>
						<?
                        $consulta = $DB->consulta('SELECT * FROM tbuser_status');
                        
                        while($linha = $DB->lista($consulta)){
                        ?>
                        	<option <? if($_POST['fil_status']==$linha['id_status']) echo 'selected="selected"'; ?> value="<?=$linha['id_status']?>"><?=$linha['userstatus']?></option>
                        <? }?>
                    </select>
                </div>
                
                
            </div>


	<div class="limpar"></div>
    
                    <div>
                    <label>Attending</label><br />
                    <select name="fil_attending[]" multiple="multiple">
                            <option value="nada">--</option>
                            <? 
                                $consulta = $DB->consulta('SELECT * FROM tbevents');
                                while($linha = $DB->lista($consulta)){
                            ?>
                            <option <? if(@in_array($linha['id_event'], $_POST['fil_attending'])) echo 'selected="selected"'; ?> value="<?=$linha['id_event']?>"><?=$linha['event']?></option>
                            <? }?>
                    </select>
                </div> 
            

    

</div>



    <thead>
    	<tr>
        	<td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=first_name&amp;order=<?=$order?><?=$url_busca?>" <? if($_GET['campo']=='first_name' or empty($_GET['campo'])) echo' class="'.$class_order.'"';?>>First Name</a></td>
        	<td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=last_name&amp;order=<?=$order?>" <? if($_GET['campo']=='last_name') echo' class="'.$class_order.'"';?>>Last Name</a></td>
        	<td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=title&amp;order=<?=$order?>" <? if($_GET['campo']=='title') echo' class="'.$class_order.'"';?>>Title</a></td>
            <td class="left"><a href="?m=<?=$Modulo['modulo']?>&amp;campo=company&amp;order=<?=$order?>" <? if($_GET['campo']=='company') echo' class="'.$class_order.'"';?>>Company</a></td>
        	<td class="left"><a>Type</a></td>
        	<td class="left"><a>Status</a></td>
        	<td class="left"><a>Last Message</a></td>
    	</tr>
    </thead>
    <tbody>

        <? 
			
			if($DB->nun_linhas($lista)>0){
				while($linha = $DB->lista($lista)){
		?>
        <tr>
            <td class="left"><?=$linha['first_name']?></td>        
            <td class="left"><?=$linha['last_name']?></td>        
            <td class="left"><?=$linha['title']?></td>        
            <td class="left"><?=$linha['company']?></td>        
            <td class="left"><?=$linha['usertype']?></td>        
            <td class="left"><?=$linha['userstatus']?></td>
            <?
            	$dados = $DB->dados('SELECT * FROM tbhistory WHERE id_user='.$linha['id_user'].' ORDER BY date DESC LIMIT 1');
			?>
            <td><?=$dados['action']?></td>        
        </tr>
        <? }}else{?>
        <tr><td class="center" colspan="8">No results!</td></tr>
        <? }?>
    </tbody>
</table>

</div>
<script type="text/javascript">
	f=document.busca;
	
	//
	function busca_post(){
			f.action="";
			f.submit();
			//return false;
	}
	
	
	function repert_pdf(){
			f.action="/admin/modulos/reports_pdf.php";
			f.target="_blank"; 
			f.submit();
	}
	function repert_csv(){
			f.action="/admin/modulos/reports_csv.php";
			f.target="_blank"; 
			f.submit();
	}
	
	
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
			}
			
			
			if(confirm(mensagem)){
				f.action="./processa/mail.php"; 
				f.submit();
			}
		}
	}

</script>


</form>
<?	
	//echo lista_registros($Acoes, $Registros, sql_paginacao($SQL, $_GET['pg'],20), $Modulo);
	//echo sistema_paginacao2($Modulo, $pg=$_GET['pg'], $_SERVER['REQUEST_URI'], $DB);
	
	// Criando os campos
}

