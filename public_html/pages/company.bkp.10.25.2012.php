<div  class="right_column_of2">  
    <div class="clear"></div>         
	<?
			$SQL  = 'SELECT * FROM tbcompany_information  
						WHERE 1 AND id_info="'.(int)$url['1'].'" LIMIT 1
			';
			$dados = $DB->dados($SQL);
	?>
    <div class="corned_box">
    	<div class="top"></div>
        <div class="body">
            <h3><?=$dados['company']?></h3>
        	<div class="left"> 
            <div style="min-height:100px;">
                <p style="font-weight:bold; margin-bottom:5px; font-size:13px;">Company Description</p>
                <p style="margin-top:-5px; font-size:12px;"><?=$dados['company_description']?></p> 
            </div>
            
            <p style="font-weight:bold; margin-bottom:5px; font-size:13px;">Company RIW Participants</p>                            
            	<ul>                           
				<?
                	$consulta1 = $DB->consulta('SELECT * FROM tbuser WHERE company LIKE "%'.(string)$dados['company'].'%" AND public_profile=1');
					while($linha1 = $DB->lista($consulta1)){
				?>
					<li>
                        <span style="font-size:13px; font-weight:600;"> <?=$linha1['first_name']?> <?=$linha1['last_name']?> </span>
                        <br/>
                        <span style="font-size:11px;"><? if(!empty($linha1['title'])) echo "$linha1[title]"?></span>
                    </li>
                  <? }?>  
                </ul>
 			</div>
            <div class="right">            	
                <a target="_blank" href="/files/compay_submit/<?=$dados['pasta']?>/<?=$dados['company_logo']?>"><img src="/img.php?dim=100x80&arquivo=./files/compay_submit/<?=$dados['pasta']?>/<?=$dados['company_logo']?>" /></a>
                <div class="clear"></div>
                <img src="/img/riw_tag_speaker.jpg"/>
                <? if(!empty($dados['year_founded'])){?>
                <a href="#">Founded In: <?=$dados['year_founded']?></a>                
                <div class="clear"></div>
                <? }?>
                <? if(!empty($dados['number_employees'])){?>
                <a>Employees: <?=$dados['number_employees']?></a>
                <div class="clear"></div>
                <? }?>
                <? if(!empty($dados['location'])){?>
                <a>Location:<?=$dados['location']?></a>
                <div class="clear"></div>
                <? }?>
				<? if(!empty($dados['company_website'])){?>
                <a target="_blank" href="<?=$dados['company_website']?>">Website</a>
                <div class="clear"></div>
                <? }?>
                <? if(!empty($dados['twitter'])){?>
                	<a target="_blank" href="<?=$dados['twitter']?>">Twitter</a>                
                	<div class="clear"></div>
                <? } ?> 
                <? if(!empty($dados['facebook'])){?>   
                    <a target="_blank" href="<?=$dados['facebook']?>">Facebook</a>
                    <div class="clear"></div>
                <? } ?>
                <? if(!empty($dados['google'])){?> 
                    <a target="_blank" href="<?=$dados['google']?>">Google+</a>
                    <div class="clear"></div>
                <? } ?>
                <? if(!empty($dados['you_tube'])){?> 
                <a target="_blank" href="<?=$dados['you_tube']?>">Youtube</a>
  				<? } ?>
            </div>
            <div class="clear"></div> 
			
     <div style="margin-left:20px;">
        <p style="font-weight:bold; margin-bottom:5px; font-size:13px;">Download</p>              
        <div  class="information_item">
        	<p><span style="font-size:13px; font-weight:600;">Company Logo:</span></p>
            <a target="_blank" href="/files/compay_submit/<?=$dados['pasta']?>/<?=$dados['company_logo']?>"><img src="/img.php?dim=100x80&arquivo=./files/compay_submit/<?=$dados['pasta']?>/<?=$dados['company_logo']?>" /></a>
        </div>
        <br />
        <div  class="information_item_files">
        	<p><strong>Presentation:</strong></p>
            
            <ul>
            	<?
                	$consulta = $DB->consulta('SELECT * FROM tbcompany_presentation WHERE id_info='.(int)$dados['id_info']);
					if($DB->nun_linhas($consulta)>0){
						$x=0;
						while($linha = $DB->lista($consulta)){$x++;
						
						$ext = explode('.', $linha['file']);
						$ext = $ext['1'];
						
						$ext = (file_exists('./admin/sistema/img/icones_extensoes/'.$ext.'.png'))?$ext:'embranco';
						
				?>
            	<li>
            		<a target="_blank" href="/files/compay_submit/<?=$dados['pasta']?>/<?=$linha['file']?>"><img src="/admin/sistema/img/icones_extensoes/<?=$ext?>.png" /><?=$linha['file']?> <?=$x?></a>
                </li>
                <? } }else{?>
                	<li>No results</li>
                <? }?>
            </ul>
        </div>
        <br />
        <div  class="information_item_files">
        	<p><strong>Company videos:</strong></p>
            
            <ul>
            	<?
                	$consulta = $DB->consulta('SELECT * FROM tbcompany_videos WHERE id_info='.(int)$dados['id_info']);
					if($DB->nun_linhas($consulta)>0){
						$x=0;
						while($linha = $DB->lista($consulta)){$x++;						
						$ext = explode('.', $linha['file']);
						$ext = $ext['1'];
						$ext = (file_exists('./admin/sistema/img/icones_extensoes/'.$ext.'.png'))?$ext:'embranco';						
				?>
            	<li>
            		<a target="_blank" href="/files/compay_submit/<?=$dados['pasta']?>/<?=$linha['file']?>"><img src="/admin/sistema/img/icones_extensoes/<?=$ext?>.png" /><?=$linha['file']?> <?=$x?></a>
                </li>
                <? } }else{?>
                	<li>No results</li>
                <? }?>
            </ul>
        </div>
        <br />
        <div  id="list_produtos">
        	<p><strong style="margin-bottom:10px;">Product photos:</strong></p>
            
            <ul>
            	<?
                	$consulta = $DB->consulta('SELECT * FROM tbcompany_products WHERE id_info='.(int)$dados['id_info']);
					if($DB->nun_linhas($consulta)>0){
						$x=0;
						while($linha = $DB->lista($consulta)){$x++;
						$ext = explode('.', $linha['file']);
						$ext = $ext['1'];
						$ext = (file_exists('./admin/sistema/img/icones_extensoes/'.$ext.'.png'))?$ext:'embranco';
				?>
            	<li>
            		<a target="_blank" href="/files/compay_submit/<?=$Dados['pasta']?>/<?=$linha['file']?>"><img src="/img.php?dim=100x80&arquivo=./files/compay_submit/<?=$dados['pasta']?>/<?=$linha['file']?>" /></a>
                </li>
                <? } }else{?>
                	<li>No results</li>
                <? }?>
            </ul>
        </div>
			</div>
        </div>
        
        <div class="bottom"></div>
    </div>


 <!--END Colum Right-->
 
 
 </div>  
 <div class="clear"></div>  
<script>
	function display(id, acao){
		if(acao=='mostra'){
			$('#'+id).show();	
		}
		if(acao=='esconde'){
			$('#'+id).hide();	
		}
	}
</script>






