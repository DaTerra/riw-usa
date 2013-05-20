<div  class="right_column_of2">  
    <div class="clear"></div>         
	<?
		$SQL  = 'SELECT * FROM tbcompany_information
				';
		if(!empty($url['1'])){
			$SQL  .= ' WHERE tbcompanies.industry LIKE "%;'.(int)$url['1'].';%"';
		}
		$SQL .=' ORDER BY company ASC';
    	$consulta = $DB->consulta($SQL);
		while($linha = $DB->lista($consulta)){			
	?>
	<!-- -->
    <div onmouseover="display('speker<?=$linha['id_info']?>', 'mostra')" onmouseout="display('speker<?=$linha['id_info']?>', 'esconde')" style="position:relative; width:209px;height:125px; float:left; margin:0 15px 25px 5px;">
    <div class="corned_min_box">
        <div class="top"></div>
        <div class="body" style="min-height:70px;">
        	<img style="float:right;margin-top:-13px;" src="/img/riw_tag_company_small.png"/>
            <br/>
            <h3><?=$linha['company']?></h3>              
            <div class="left">                                                      
                <p><span><?=$data['0']?> <? if(!empty($data['1'])) echo '<br />see more';?></span></p>                
            </div>
            <div class="right" style="min-height:50px;">  
                <? if(!empty($linha['company_logo'])){ ?>
                <img style="margin-top:0; margin-bottom:0;paddin-top:0;padding-bottom:0;"src="/files/compay_submit/<?=$linha['pasta']?>/<?=$linha['company_logo']?>"/>   
                <? } ?>  
            </div>
            <div class="clear"></div> 
        </div>
        <div class="bottom"></div>
    </div>
    <!-- -->    
	<div class="corned_small_box" id="speker<?=$linha['id_info']?>" <? if($linha['id_info'] == 22) echo 'style="margin-left:0px;"';?>>
    	<div class="top"></div>
        <a href="/company/<?=$linha['id_info']?>">
        <div class="body" style="min-height:140px;">
        	<img style="float:right;margin-top:-23px;" src="/img/riw_tag_company_small.png"/>
            <h3><?=$linha['company']?></h3><br/>
        	<div class="left"> 
           		<p><?=subTxt(strip_tags($linha['company_description']), 100)?></p> 
                <br/>
            	<ul>                           
				<?
                	$consulta1 = $DB->consulta('SELECT * FROM tbuser WHERE company LIKE "%'.(string)$linha['company'].'%" AND public_profile=1 LIMIT 3');
					while($linha1 = $DB->lista($consulta1)){
				?>
					<li style="margin-bottom:5px;">
					<span style="font-size:13px; font-weight:bold;"><?=$linha1['first_name']?> <?=$linha1['last_name']?></span><br/> 
					<span style="font-size:11px;"><? if(!empty($linha1['title'])) echo "$linha1[title]"?></span>
                    </li>
                  <? }?>  
                </ul>
           		
            </div>
            <div class="right">
	            <? if(!empty($linha['company_logo'])){ ?>
            	<img src="/files/compay_submit/<?=$linha['pasta']?>/<?=$linha['company_logo']?>"/>
                <? }?>  
            </div>
            <div class="clear"></div> 
        </div>
        </a>
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
