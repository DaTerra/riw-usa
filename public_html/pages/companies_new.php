<div  class="right_column_of2">
    <div class="title">        
        <h2>Companies</h2>
        <div class="title_line" style="width:640px;"></div>
    </div>    
    <div class="clear"></div>         

	<?
		$SQL  = 'SELECT * FROM tbcompany_information
				';

		if(!empty($url['1'])){
			$SQL  .= ' WHERE tbcompanies.industry LIKE "%;'.(int)$url['1'].';%"';

		}

		$SQL .=' ORDER BY position ASC';


    	$consulta = $DB->consulta($SQL);
		while($linha = $DB->lista($consulta)){
			
	?>
	<!-- -->
    <div onmouseover="display('speker<?=$linha['id_info']?>', 'mostra')" onmouseout="display('speker<?=$linha['id_info']?>', 'esconde')" style="position:relative; width:209px;height:125px; float:left; margin:0 15px 25px 5px;">
    <div class="corned_min_box">
        <div class="top"></div>
        <div class="body">
            <h3><?=$linha['titulo']?></h3>  
            <div class="left">
            
                                          
                <p><span><?=$data['0']?> <? if(!empty($data['1'])) echo '<br />see more';?></span></p>
            </div>
            <div class="right">
                <img src="/files/compay_submit/<?=$linha['pasta']?>/<?=$linha['company_logo']?>"/>
    
            </div>
            <div class="clear"></div> 
        </div>
        <div class="bottom"></div>
    </div>
	<div class="corned_small_box" id="speker<?=$linha['id_info']?>">
    	<div class="top"></div>
        <div class="body">
            <h3><?=$linha['titulo']?><br/>
        	<div class="left"> 
            	<ul>                           
				<?
                	$consulta1 = $DB->consulta('SELECT * FROM tbuser WHERE company LIKE "%'.(string)$linha['titulo'].'%" AND public_profile=1 LIMIT 3');
					while($linha1 = $DB->lista($consulta1)){
				?>
					<li><?=$linha1['first_name']?> <?=$linha1['last_name']?> <? if(!empty($linha1['title'])) echo ", $linha1[title]"?></li>
                  <? }?>  
                </ul>
           		<p><a href="/company/<?=$linha['id_info']?>">More</a></p>
            </div>
            <div class="right">
            	<img src="/files/compay_submit/<?=$linha['pasta']?>/<?=$linha['company_logo']?>"/>
            </div>
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
