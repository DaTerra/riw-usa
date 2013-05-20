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
                    $SQL  = 'SELECT * FROM tbphotogallery WHERE flag=1 AND id_category=1 ORDER BY rand() LIMIT 14;';
					$consulta = $DB->consulta($SQL);		
					while($linha = $DB->lista($consulta)){	
					?>
                        <li>
                        <a target="_blank" href="/gallery-images/participants/<?=$linha['picture'];?>" rel="lightbox[photogallery]" title="Russian Innovation Week 2012">
                        	<img src="/gallery-images/participants/thumb/<?=$linha['picture'];?>" width=200 height=132>
                        </a>
                        </li>
                    <? } ?>  
                </ul>       
                <div class="clear"></div>        
                <h2>Speakers</h2>  
				<ul>
                	<?
                    $SQL  = 'SELECT * FROM tbphotogallery WHERE flag=1 AND id_category=2 ORDER BY rand() LIMIT 14;';
					$consulta2 = $DB->consulta($SQL);		
					while($linha = $DB->lista($consulta2)){	
					?>
                        <li>
                        <a target="_blank" href="/gallery-images/speakers/<?=$linha['picture'];?>" rel="lightbox[photogallery]" title="Russian Innovation Week 2012">
                        	<img src="/gallery-images/speakers/thumb/<?=$linha['picture'];?>" width=200 height=132>
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

