<div  class="right_column_of2">
    <div class="title">        
        <h2>Participants</h2>
        <div class="title_line" style="width:640px;"></div>
    </div>    
    <div class="clear"></div>         

	<?
		$SQL  = 'SELECT * FROM tbuser WHERE public_profile=1 AND id_status=5';
		
		if(!empty($url['1'])){
			$SQL  .= ' AND industry LIKE "%;'.(int)$url['1'].';%"';
		}
		
    	$consulta = $DB->consulta($SQL);
		while($linha = $DB->lista($consulta)){
			
	?>
	<!-- -->
    <div class="corned_min_box" style="width:209px;height:125px; float:left; margin:0 15px 25px 5px;">
        <div class="top"></div>
        <div class="body">
        	<h3><?=$linha['company']?></h3>
            <h3><?=$linha['first_name']?>&nbsp;<?=$linha['last_name']?></h3>  
            <div class="left">                              
                <p><span><?=$linha['data']?>  <br/> <?=$linha['local']?></span><br/>
                </p>
            </div>
            <div class="right">
            	<img src="/img/nopic.jpg"/>
                <!--<a href="#">Presentation</a>
                <div class="clear"></div>
                <a href="#">Corp. Info</a>-->
            </div>
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
