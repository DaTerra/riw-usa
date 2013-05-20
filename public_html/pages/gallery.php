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
            	<p style=" width:627px;margin:0px 0px 0px 14px;">The inaugural Russian Innovation Week Conference was an overwhelming success! With more than 450 participants and high-profile guests from U.S. and Russia gathered at the Computer History Museum on Oct. 25 – 26, the conference offered unparalleled depth and perspective on the Russian investment climate and business opportunities in Russia. Thank you to all the participants and guests for your contribution to this discussion. Stay tuned to hear more about future events!</p>
                <p style="margin-right:15px;font-size:11px; font-style:italic; color:red; float:right;">Photo Credit: Jared Brick, <a href="http://www.BHImages.com" target="_blank">www.BHImages.com</a></p>
                <br/>
				<ul>
					<?
					$SQL  = 'SELECT * FROM  tbphotogallery  ORDER BY rand();';
					$consulta = $DB->consulta($SQL);		
					while($linha = $DB->lista($consulta)){	
					?>
                        <li>
                        <a target="_blank" href="/gallery-images-new/BHI_<?=$linha['picture'];?>.JPG" rel="lightbox[photogallery]" title="Russian Innovation Week 2012">
                        	<img src="/gallery-images-new/thumbs/BHI_<?=$linha['picture'];?>.JPG" width=200 height=132>
                        </a>                      
                        </li>
                    <? } ?>  
                </ul>       
                <div class="clear"></div>                                                          
            </div>
         <div class="clear"></div>
         <div class="bottom"></div>
        </div>
        <div class="clear"></div> 
</div>

