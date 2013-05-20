<style>
.speaker .body .left ul li{
	list-style:circle inside;
	font-size: 12px;
    line-height: 20px;
	}
</style>
<div  class="right_column_of2 speaker">
 
    <div class="clear"></div>         

	<?
		$dados = $DB->dados('SELECT * FROM tbspeaker WHERE urlamigavel="'.(string)$url['1'].'" LIMIT 1');
	?>

    <div class="corned_box">
    	<div class="top"></div>
        <div class="body">
            <h3><?=$dados['first_name']?> <?=$dados['last_name']?>, <?=$dados['company']?><br/>
            <span><?=$dados['data']?></span></h3>  
        	<div class="left">                              
            	<?=$dados['texto']?>
 			</div>
            <div class="right">
            	<img src="/img/<?=$dados['imagem']?>"/>
                <img src="/img/riw_tag_speaker.jpg"/>
  	            <!--  
                <a href="#">Propose a Meeting</a>
                <div class="clear"></div>
                <a href="#">See Presentation</a>
  				-->
            </div>
            <div class="clear"></div> 
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






