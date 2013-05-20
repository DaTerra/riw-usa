<div  class="right_column_of2">    
    <div class="clear"></div>         

	<?
		$SQL  = 'SELECT * FROM tbspeaker';
		if(!empty($url['1'])){
			$SQL  .= ' WHERE industry LIKE "%;'.(int)$url['1'].';%"';
		}
		$SQL  .= ' ORDER BY posicao DESC, last_name ASC';
    	$consulta = $DB->consulta($SQL);
		while($linha = $DB->lista($consulta)){
			
	?>
	<!-- -->
    <div onmouseover="display('speker<?=$linha['id_speaker']?>', 'mostra')" onmouseout="display('speker<?=$linha['id_speaker']?>', 'esconde')" style="position:relative; width:209px;height:125px; float:left; margin:0 15px 25px 5px;">
    <div class="corned_min_box">
        <div class="top"></div>
        <div class="body">
            <h3><?=$linha['first_name']?> <?=$linha['last_name']?>, <?=$linha['company']?></h3>  
            <div class="left">
            <?
				$data = str_replace('<br/>', '<br />', $linha['data']);
				$data = str_replace('<br>', '<br />', $data);
            	$data = explode('<br />', $data);
				//echo $data['0'];
				//exit;
			?>
            
                                          
                <p><span><?=$data['0']?> <? if(!empty($data['1'])) echo '<br />...';?></span></p>
            </div>
            <div class="right">
                <img src="/img/<?=$linha['imagem']?>"/>
    
            </div>
            <div class="clear"></div> 
        </div>
        <div class="bottom"></div>
    </div>
	<div class="corned_small_box" id="speker<?=$linha['id_speaker']?>" <? if($linha['id_speaker'] == 1) echo 'style="margin-left:0px;"';?>>
    	<div class="top"></div>
        
        <div class="body">
        	<a href="/speaker/<?=$linha['urlamigavel']?>">
            <h3><?=$linha['first_name']?> <?=$linha['last_name']?>, <?=$linha['company']?><br/>
            </a>
            <span><?=$linha['data']?></span></h3>  
        	<a href="/speaker/<?=$linha['urlamigavel']?>">
            <div class="left">                              
                <p><?=subTxt(strip_tags($linha['texto']), 100)?> 
           			
                </p>
            </div>
            <div class="right">
            	<img src="/img/<?=$linha['imagem']?>"/>
                <!--<a href="#">Presentation</a>
                <div class="clear"></div>
                <a href="#">Corp. Info</a>-->
            </div>
            </a>
            <div class="clear"></div> 
        </div>
        
        <div class="bottom"></div>
    </div>  
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
