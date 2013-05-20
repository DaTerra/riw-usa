<div class="left_column_of2 menu_agenda">
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
<div class="right_column_of2 agenda">        
    <div class="corned_box">
    	<div class="top"></div>
        <div class="body">                      
           <style>
		   		.ptitle {text-align:center;font-weight:600}
		   </style>     
            <p class="ptitle">
                COMPUTER HISTORY MUSEUM<br/>
                (Mountain View, California, USA)<br/>
                October 25-26, 2012<br/>
            </p>
            
            <br/>
           <!-- 
            <p class="agenda_tag">RIW 2012 - Agenda</p>
           -->
            <div class="clear"></div>
                 
             
             <!-- inicia agenda -->
			<? if($url['1']=='Day-1-Thu-Oct-25' or empty($url['1'])){?>  
             
             	<!-- dia 1-->
              <div class="agenda_horizontal_rule"></div>
              <h3>Thursday, October 25, 2012</h3>
              
	
	<?
		$SQL = 'SELECT * FROM tbagenda_locais WHERE id_dia=1';		
		if(!empty($url['2'])){
			$SQL .= ' AND urllocal="'.$url['2'].'"';
		}
		$consulta0 = $DB->consulta($SQL);
        while($linha0 = $DB->lista($consulta0)){
    ?>   
      
              <h4><?=$linha0['local']?></h4>  
                <div class="agenda_horizontal_rule"></div>
                <br/>
              <!----><!----><!---->
           	<?
            	$consulta = $DB->consulta('SELECT * FROM tbagenda WHERE id_dia=1 AND id_local='.(int)$linha0['id_local'].' ORDER BY position ASC');
				while($linha = $DB->lista($consulta)){
			?>
            <!--line-->
            <div class="left_col">
            	<p><?=$linha['time']?></p>
            </div>
            <div class="right_col">
				<? if(!empty($linha['link'])){?>
                	<h4><a name="<?=$linha['link']?>"><?=$linha['title']?></a></h4>
                <? }else{?>
                	<h4><?=$linha['title']?></h4>
                <? }?>
				
				<? if(!empty($linha['moderator'])){?>
                
				<strong>Moderator: </strong><?=$linha['moderator']?>
				<? }?>
                
                <? if(!empty($linha['content'])){?>
                	<?=$linha['content']?>
                <? }?>
            </div>
            <div class="clear space"></div>
            <? }?>
			<br/>
            <? }?>
<? }?>            
            <!-- dia 2 -->
			<? if($url['1']=='Day-2-Fri-Oct-26' or empty($url['1'])){?>  
              <div class="agenda_horizontal_rule"></div>
              <h3>Friday, October 26, 2012</h3>
	<?
        
		$SQL = 'SELECT * FROM tbagenda_locais WHERE id_dia=2';
		
		if(!empty($url['2'])){
			$SQL .= ' AND urllocal="'.$url['2'].'"';
		}
		$consulta0 = $DB->consulta($SQL);
        while($linha0 = $DB->lista($consulta0)){
    ?>
              <h4><?=$linha0['local']?></h4>  
                <div class="agenda_horizontal_rule"></div>
                <br/>
              <!----><!----><!---->
           	<?
            	$consulta = $DB->consulta('SELECT * FROM tbagenda WHERE id_dia=2 AND id_local='.(int)$linha0['id_local'].' ORDER BY position ASC');
				while($linha = $DB->lista($consulta)){
			?>
            <!--line-->
            <div class="left_col">
            	<p><?=$linha['time']?></p>
            </div>
            <div class="right_col">
				<? if(!empty($linha['link'])){?>
                	<h4><a name="<?=$linha['link']?>"><?=$linha['title']?></a></h4>
                <? }else{?>
                	<h4><?=$linha['title']?></h4>
                <? }?>

				<? if(!empty($linha['moderator'])){?>
                
				<strong>Moderator: </strong><?=$linha['moderator']?>
				<? }?>
                <? if(!empty($linha['content'])){?>
                	<?=$linha['content']?>
                <? }?>
            </div>
            <div class="clear space"></div>
            <? }?>
			<br/>
            <? }?>
            
 <? }?>           
            
             <!-- fim agenda -->
            
            
            <div class="agenda_horizontal_rule"></div>
            <p>More details to follow soon.<br/> To receive updates on the RIW conference, please follow us on <a href="https://twitter.com/RIW_SV" target="_blank">Twitter</a>, <a href="https://www.facebook.com/pages/Russian-Innovation-Week/408163625899875" target="_blank">Facebook</a>, <a href="https://plus.google.com/u/0/103179661446801281383/posts" target="_blank">Google+</a> and <a href="http://www.youtube.com/channel/UCL39Q4f-izAVgoCj-3jh6Kw?feature=guide" target="_blank">YouTube</a>.</p> 
        </div>       
        <div class="bottom"></div>
    </div>      
    <div class="clear"></div>                       
</div>