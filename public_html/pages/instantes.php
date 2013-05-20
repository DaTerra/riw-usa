<?
	if(!($_SESSION['site_agenda']['id_user']>0)){

		header('Location: /meetings');exit;

	}
?>
<style>
.content_index{width:655px;margin-right:20px;}
#login {
    background: none repeat scroll 0 0 #F1F1F1;
    border: 1px solid #CCCCCC;
    border-radius: 3px 3px 3px 3px;
	width:225px;
	margin:0 auto;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-top: 30px;
}
#login form div {
    clear: both;
    float: none;
    height: 30px;
    margin-bottom: 20px;
}
#login form div p {
    background: url("../img/input_login.jpg") no-repeat scroll 0 0 transparent;
    display: block;
    float: left;
    height: 27px;
    width: 202px;
}
#login form div p input {
    background: none repeat scroll 0 0 transparent;
    border: medium none;
    height: 25px;  
    line-height: 25px;
    margin-left: 1px;
    margin-top: 1px;
    padding-left: 5px;
    padding-right: 5px;
    width: 190px;
}
#login form a {
    color: #000000;
    display: block;
    float: left;
    font-size: 11px;
    height: 27px;
    line-height: 27px;
    margin-left: 60px;
    width: 105px;
}
#login form button {
    background: url("../img/bt_login_entrar.gif") no-repeat scroll 0 0 transparent;
    border: medium none;
    float: right;
    height: 27px;
    margin-right: 38px;
    text-indent: -9000px;
    width: 70px;
}
	#speaker_day1{ float:left;}
	#speaker_day2{ float:left; }
	#select_table{ margin-left:100px; float:left;}
</style>
<div  class="right_column_of2">  
    <div class="clear"></div>         
    <div class="corned_box">
    	<div class="top"></div>
        <div class="body">
            <div style="width:55%; padding-left:25px; float:left;">       	                    
                <?
                    if($_GET['reg']>0){							
                        $id_convidado = $_GET['con'];
                        $id_solicitante = $_GET['sol'];														
                    }else{							
                        $id_convidado = $url['1'];
                        $id_solicitante = $_SESSION['site_agenda']['id_user'];															
                    }
					
					if($_GET['id']>0){
						
                        $id_convidado = $_GET['id'];
						
					}
                ?>
                <p>
                	<?
                    echo  'Dear '.$_SESSION['site_agenda']['first_name'].' '.$_SESSION['site_agenda']['last_name'];
                    ?> 
                	<br/><br/>
                    
                    <?
					
						if(!empty($url['1'])){
							$id_convidado = $url['1'];
						}else{
							$id_convidado = $_GET['con'];
						}
						
                    	$convidado = $DB->dados('SELECT * FROM tbuser WHERE tbuser.id_user='.(int)$id_convidado.' LIMIT 1');
                    	//$convidado = $DB->dados('SELECT * FROM tbuser INNER JOIN tbuser_keys ON tbuser.id_user=tbuser_keys.id_user WHERE tbuser.id_user='.(int)$id_convidado.' LIMIT 1');
						
					?>
                    You are proposing a meeting to:<br/><br/>
                    <? echo $convidado['first_name'].' '.$convidado['last_name'];?><br/>
                    <? echo $convidado['title'];?><br/>
                    <? echo $convidado['company'];?>
                	<br/>
                	<br/>
                    Please select a time. Note that you can only select times when you and the other party have no other meetings confirmed and with tables available.</p>
                
					
                </p>
             </div>   
             <div style="widht:25%; float:right;margin-right:25px; padding:15px; background:#CCC;border: 1px solid #CCCCCC; border-radius: 3px 3px 3px 3px;">
                <form action="/processa/meeting_proposals.php" method="post">
                    <input type="hidden" name="id_convidado" value="<?=$id_convidado?>" />
                    <input type="hidden" name="id_solicitante" value="<?=$id_solicitante?>" />
                    <?
                        if($_GET['acao']=='res'){
                            
                    ?>
                    <input type="hidden" name="id_registro" value="<?=$_GET['reg']?>" />
                    <? }?>
                    <p style="width:90%; padding:0 10px;border-bottom:1px solid #666;margin-bottom:5px;">Select  day</p>
                <div id="busca_check_tipo">
                    <div id="check_aluguel" style=" float:left"><input type="radio" name="dia" value="25" id="dia25" checked="checked" /><label for="dia25">October 25</label></div>
                    <div id="check_venda" style=" float:left; margin-left:30px;"><input type="radio" name="dia" value="26" id="dia26" /><label for="dia26">October 26</label></div>
                </div>                     
                <div class="clear"></div>                              
                <script>
                    $(document).ready(function(){
                      $("input[name$='dia']").click(function(){					
                      var radio_value = $(this).val();						 
                      if(radio_value=='25') {
                          $("#select_dia2").val(0);
                          $("#speaker_day1").show();
                          $("#speaker_day2").hide();
                      }
                      else if(radio_value=='26'){
                          $("#select_dia1").val(0);
                          $("#speaker_day1").hide();
                          $("#speaker_day2").show();
                       }
                      });						
                    });
                </script>
                <br/>   
                <p style="width:90%; padding:0 10px;border-bottom:1px solid #666;margin-bottom:5px;">Select time</p>                                                             
                <div id="speaker_day1">
                <strong>&nbsp;&nbsp;October 25 &nbsp;&nbsp;&nbsp;</strong>
                        <select name="id_instante1" class="instantes" id="select_dia1">
                        <option></option>
                        <?
                            $SQL = 'SELECT * FROM tbmeeting_instantes WHERE id_day=1';							
                            $instantes_usados = $DB->consulta('SELECT * FROM tbmeeting_convites WHERE status=1 AND(id_convidado='.(int)$id_convidado.' OR id_solicitante='.(int)$id_solicitante.')');
                            while($instante = $DB->lista($instantes_usados)){
                                $SQL .=' AND id_instante <> '.$instante['id_instante'];
                            }				
                            //exit($SQL);
                            $consulta1 = $DB->consulta($SQL);                                
                            while($linha1 = $DB->lista($consulta1)){
                        ?>
                           <option value="<?=$linha1['id_instante']?>"> <?=$linha1['instante']?></option>
                          
                        <? }?>                                                        
                        </select>
                </div>
                <div id="speaker_day2" style="display:none;">
                <strong>&nbsp;&nbsp;October 26 &nbsp;&nbsp;&nbsp;</strong>
                                                                     
                        <select name="id_instante2" class="instantes" id="select_dia2">
                        <option></option>
                        <?
                            $SQL = 'SELECT * FROM tbmeeting_instantes WHERE id_day=2';							
                            $instantes_usados = $DB->consulta('SELECT * FROM tbmeeting_convites WHERE status=1 AND(id_convidado='.(int)$id_convidado.' OR id_solicitante='.(int)$id_solicitante.')');
                            while($instante = $DB->lista($instantes_usados)){
                                $SQL .=' AND id_instante <> '.$instante['id_instante'];
                            }
                            $consulta1 = $DB->consulta($SQL);                                
                            while($linha1 = $DB->lista($consulta1)){
                        ?>
                           <option value="<?=$linha1['id_instante']?>"> <?=$linha1['instante']?></option>
                           
                        <? }?>                                                        
                        </select>                                                      
                </div>                    
                <div class="clear"></div> 
                <br />
                <br />
                <button style="height:20px; width:65px;float:right;" type="submit">Send</button>
                </form>
                
            </div>
            <div class="clear"></div>
            </div>                       
         	<div class="clear"></div>
          
         <div class="clear"></div>
         <div class="bottom"></div>
  </div>
        <div class="clear"></div> 
</div>
<script type="text/javascript">
$(function(){
	$('.instantes').change(function(){
		if( $(this).val() ) {
			//alert($(this).val());
			$.getJSON('/ajax/table.ajax.php?search=',{id_instante: $(this).val(), ajax: 'true'}, function(j){
				var options = '';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].id_table + '">' + j[i].table + '</option>';
				}	
				$('#testefunciona').html(options).show();
			});
		} else {
			$('#select_tables').html('<option value="">– Seleciona um instante –</option>');
		}
	});
});
</script>
<script type="text/javascript">
<? if(!empty($_GET['msg'])) echo 'alert("'.urldecode($_GET['msg']).'");';?>
</script>