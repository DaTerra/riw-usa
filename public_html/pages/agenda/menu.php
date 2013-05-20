

<div class="menu_agenda">

<ul>  

    <li><a href="/agenda" ><strong class="<? if(empty($url['1'])) echo 'btn_on';?>">All</strong></a></li>

	<?

    	$consulta = $DB->consulta('SELECT * FROM tbagenda_dia');

		

		while($linha = $DB->lista($consulta)){

	?>  	

    <li><a href="/agenda/<?=$linha['urldia']?>" ><strong class="<? if($url['1'] == $linha['urldia']) echo 'btn_on';?>"><?=$linha['dia']?></strong></a> 

        <ul>

			<?

                $consulta1 = $DB->consulta('SELECT * FROM tbagenda_locais WHERE id_dia='.(int)$linha['id_dia']);

                

                while($linha1 = $DB->lista($consulta1)){

            ?>  	

            <li><a href="/agenda/<?=$linha['urldia']?>/<?=$linha1['urllocal']?>" class="<? if($url['2'] == $linha1['urllocal'] and $url['1'] == $linha['urldia']) echo 'btn_on';?>"><?=$linha1['local']?></a></li>

            <? }?>

        </ul>

    </li>

    <br/>

    <? }?>

</ul>

</div>





