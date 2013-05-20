<style>
	#lsita_companie{}
	#lsita_companie li{ float:left; width:200px; margin-bottom:50px;text-align:right;}
	#lsita_companie li a {text-align:center;}
</style>
<div  class="right_column_of2">   
    <div class="clear"></div>         
	<ul id="lsita_companie" style="margin-left:20px;">
	<?
		$SQL  = 'SELECT * FROM tbsponsor ORDER BY  position ASC';
		
    	$consulta = $DB->consulta($SQL);
		$x=0;
		while($linha = $DB->lista($consulta)){$x++;
			
	?>
	<!-- -->
    	<li><a target="_blank" href="<?=$linha['link']?>"><img src="/img/<?=$linha['logo']?>" alt="<?=$linha['titulo']?>" /></a></li>
        <? if($x==3){
			echo '<div class="clear"></div>';
			$x=0;
			}?>
    <? }?>
	</ul>
 </div>  
 <div class="clear"></div>  
