<div  class="right_column_of2">
    <div class="title">        
        <h2>Company</h2>
        <div class="title_line" style="width:640px;"></div>
    </div>    
    <div class="clear"></div>         

	<?
			$SQL  = 'SELECT * FROM tbcompanies  
			INNER JOIN tbinformation ON tbcompanies.id_submit=tbinformation.id_info 	
			WHERE id_submit>0 AND id_company="'.(int)$url['1'].'" LIMIT 1
			';
			$dados = $DB->dados($SQL);
	?>

    <div class="corned_box">
    	<div class="top"></div>
        <div class="body">
            <h3><?=$dados['titulo']?></h3>
        	<div class="left"> 
            <p><?=$dados['company_description']?></p>                             
            	<ul>                           
				<?
                	$consulta1 = $DB->consulta('SELECT * FROM tbuser WHERE company LIKE "%'.(string)$dados['titulo'].'%" #AND public_profile=1');
					while($linha1 = $DB->lista($consulta1)){
				?>
					<li><?=$linha1['first_name']?> <?=$linha1['last_name']?> <? if(!empty($linha1['title'])) echo ", $linha1[title]"?></li>
                  <? }?>  
                </ul>
 			</div>
            <div class="right">
            	<img src="/files/information/<?=$dados['pasta']?>/<?=$dados['company_logo']?>"/>
                <img src="/img/riw_tag_speaker.jpg"/>
                <a href="#">Founded In: <?=$dados['year_founded']?></a>
                <div class="clear"></div>
                <a>Employees: <?=$dados['number_employees']?></a>
                <div class="clear"></div>
                <a>Location:<?=$dados['location']?></a>
                <div class="clear"></div><? if(!empty($dados['company_website'])){?>
                <a target="_blank" href="<?=$dados['company_website']?>">Website</a>
                <div class="clear"></div>
                <? }?>
                <a target="_blank" href="<?=$dados['twitter']?>">Twitter</a>
                <div class="clear"></div>
                <a target="_blank" href="<?=$dados['facebook']?>">Facebook</a>
                <div class="clear"></div>
                <a target="_blank" href="<?=$dados['google']?>">Google+</a>
                <div class="clear"></div>
                <a target="_blank" href="<?=$dados['you_tube']?>">Youtube</a>
  
            </div>
            <div class="clear"></div> 
			
            <div>
            	<strong>Download</strong>
                
                
                
                
        <div  class="information_item">
        	<p><strong>Company Logo:</strong></p>
            <a target="_blank" href="/files/information/<?=$dados['pasta']?>/<?=$dados['company_logo']?>"><img src="/img.php?dim=100x80&arquivo=./files/information/<?=$dados['pasta']?>/<?=$dados['company_logo']?>" /></a>
        </div>
        <br />
        <div  class="information_item_files">
        	<p><strong>Presentation:</strong></p>
            
            <ul>
            	<?
                	$consulta = $DB->consulta('SELECT * FROM tbinfo_presentation WHERE id_info='.(int)$dados['id_info']);
					if($DB->nun_linhas($consulta)>0){
						$x=0;
						while($linha = $DB->lista($consulta)){$x++;
						
						$ext = explode('.', $linha['file']);
						$ext = $ext['1'];
						
						$ext = (file_exists('./sistema/img/icones_extensoes/'.$ext.'.png'))?$ext:'embranco';
						
				?>
            	<li>
            		<a target="_blank" href="/files/information/<?=$dados['pasta']?>/<?=$linha['file']?>"><img src="/admin/sistema/img/icones_extensoes/<?=$ext?>.png" />Download <?=$x?></a>
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
                	$consulta = $DB->consulta('SELECT * FROM tbinformation_videos WHERE id_info='.(int)$dados['id_info']);
					if($DB->nun_linhas($consulta)>0){
						$x=0;
						while($linha = $DB->lista($consulta)){$x++;
						
						$ext = explode('.', $linha['file']);
						$ext = $ext['1'];
						$ext = (file_exists('./sistema/img/icones_extensoes/'.$ext.'.png'))?$ext:'embranco';
						
				?>
            	<li>
            		<a target="_blank" href="/files/information/<?=$dados['pasta']?>/<?=$linha['file']?>"><img src="/admin/sistema/img/icones_extensoes/<?=$ext?>.png" />Download <?=$x?></a>
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
                	$consulta = $DB->consulta('SELECT * FROM tbinfo_products WHERE id_info='.(int)$dados['id_info']);
					if($DB->nun_linhas($consulta)>0){
						$x=0;
						while($linha = $DB->lista($consulta)){$x++;
						$ext = explode('.', $linha['file']);
						$ext = $ext['1'];
						$ext = (file_exists('./sistema/img/icones_extensoes/'.$ext.'.png'))?$ext:'embranco';
				?>
            	<li>
            		<a target="_blank" href="/files/information/<?=$Dados['pasta']?>/<?=$linha['file']?>"><img src="/img.php?dim=100x80&arquivo=./files/information/<?=$dados['pasta']?>/<?=$linha['file']?>" /></a>
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






