<style>
.content_index{width:655px;margin-right:20px;}
.content_index li{width:200px; float:left; margin-left:14px; margin-bottom:10px;}
.content_index li img{width:200px;}
</style>
<div  class="right_column_of2">  
    <div class="clear"></div>         
    <div class="corned_box">
    	<div class="top"></div>
        <div class="body">
            <div class="content_index">
        
            	<h2>Participants</h2>
				<ul>
					<?
					$SQL  = 'SELECT * FROM  tbphotospeakers ORDER BY rand();';
					$consulta = $DB->consulta($SQL);		
					while($linha = $DB->lista($consulta)){	
					?>
                        <li>
                        <a target="_blank" href="/gallery-images/participants/BHI_<?=$linha['picture'];?>.JPG" rel="lightbox[photogallery]" title="Russian Innovation Week 2012">
                        	<img src="/gallery-images/participants/thumb/BHI_<?=$linha['picture'];?>.JPG" width=200 height=132>
                        </a>                      
                        
                    <? } ?>  
                </ul>       
                <div class="clear"></div>        
                <h2>Speakers</h2>  
				<ul>
                	<?
                    $SQL  = 'SELECT * FROM tbphotoparticipants  ORDER BY rand();';
					$consulta2 = $DB->consulta($SQL);		
					while($linha2 = $DB->lista($consulta2)){	
					?>
                        <li>
                        <a target="_blank" href="/gallery-images/speakers/BHI_<?=$linha2['picture'];?>.JPG" rel="lightbox[photogallery]" title="Russian Innovation Week 2012">
                        	<img src="/gallery-images/speakers/thumb/BHI_<?=$linha2['picture'];?>.JPG" width=200 height=132>
                        </a>
                        </li>
                    <? } ?>  
                </ul>                                                 
            </div>
         <div class="clear"></div>
         <div class="bottom"></div>
        </div>
        <div class="clear"></div> 
</div>

