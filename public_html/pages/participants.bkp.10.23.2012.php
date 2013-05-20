<style type="text/css">
	#speaker_day1{ float:left;}
	#speaker_day2{ float:left; margin-left:50px;}
	#select_table{ margin-left:100px; float:left;}
</style>

<div  class="right_column_of2">   
    <div class="clear"></div>         
	<?
		$SQL  = 'SELECT * FROM tbuser WHERE public_profile=1 AND id_status=5';
		if(!empty($url['1'])){
			$SQL  .= ' AND industry LIKE "%;'.(int)$url['1'].';%"';
		}
    	$consulta = $DB->consulta($SQL);
		while($linha = $DB->lista($consulta)){
			
            $dados = $DB->dados('SELECT * FROM tbuser INNER JOIN tbuser_keys ON tbuser.id_user=tbuser_keys.id_user WHERE tbuser.id_user='.(int)$linha['id_user'].' LIMIT 1');
			
			
	?>
	<!-- -->
    <div class="corned_min_box" style="width:209px;height:125px; float:left; margin:0 15px 25px 5px;">
        <div class="top"></div>
        <div class="body">
        	<img style="float:right;margin-top:-13px;" src="/img/riw_tag_participant.png"/>
            <div class="clear"></div> 
            <br/>
            <div style="height:35px;">
            <h3 style="font-size:12px;">            
			<?=$linha['last_name']?>,
            <br/>
			<?=$linha['first_name']?></h3>       
			
            </div>
            <div style="height:30px;">
            	<p style="padding-right:5px;margin-left:20px;font-size:11px;"><?=$linha['title']?></p>
            
            	<p style="padding-right:5px;margin-left:20px;font-size:11px;"><?=$linha['company']?></p>            
            </div>    
            <div class="clear"></div>
            <br/>
            <div style="height:15px; margin-top:-10px;">                                       
            <? if($_SESSION['site_agenda']['id_user']!=$linha['id_user'] and !empty($linha['id_user']) and !empty( $dados['chave'])) {?>
            <a style="font-size:11px; float:right; margin-right:20px; margin-right:20px;" href="/instantes/<?=$linha['id_user']?>">Propose a Meeting</a>            
            <? }?>
            </div>
            <!--<a href="#">Presentation</a>
            <div class="clear"></div>
            <a href="#">Corp. Info</a>-->       
            <div class="clear"></div> 
        </div>
        <div class="bottom"></div>
    </div>
	<!-- -->
    <? }?>
 <!--END Colum Right--> 
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
</div>  
<div class="clear"></div>  