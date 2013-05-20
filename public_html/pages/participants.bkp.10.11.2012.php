<div  class="right_column_of2"> 
    <div class="clear"></div>         

	<?
		$SQL  = 'SELECT * FROM tbuser WHERE public_profile=1';
		
		if(!empty($url['1'])){
			$SQL  .= ' AND industry LIKE "%;'.(int)$url['1'].';%"';
		}
		
    	$consulta = $DB->consulta($SQL);
		while($linha = $DB->lista($consulta)){
			
	?>
	<!-- -->
    <div class="corned_min_box" style="width:209px;height:125px; float:left; margin:0 15px 10px 5px;">
        <div class="top"></div>
        <div class="body" style="min-height:50px;">
            <h3><?=$linha['first_name']?><?=$linha['last_name']?>, <?=$linha['company']?></h3>  
            <div class="clear"></div> 
        </div>
        <div class="clear"></div> 
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
