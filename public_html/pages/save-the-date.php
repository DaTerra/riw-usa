<div id="content-container" class="right_column_of2 registration bg_red" style="margin-top:-120px; border:#CCC 1px solid;">
					<script type="text/javascript">
                          $(function() {
                                $('#content-container-packages h4').bind('click', function() {
                                    if ($(this).parent().hasClass('aberto')) {
                                        $(this).parent().find('#content-container-packages-content').slideUp();
                                        $(this).parent().removeClass('aberto');
                                        return 0;
                                    }
                                    $(this).parent().find('#content-container-packages-content').slideDown();
                                    $(this).parent().addClass('aberto');
                                })
                             });
                    </script>                                                      

                    <div id="content-container-packages" class="header">
                        <h3>SAVE THE DATE!</h3>                                                    
                        <h1><strong>Russian Innovation Week 2013</strong></h1>

                        <h1 style="font-style:normal; margin-top:12px;">Boston: <span>September 17<sup>th</sup></span></h1>    
                        <h1 style="font-style:normal">Silicon Valley: <span>September 19<sup>th</sup> &amp; 20<sup>th</sup><br/></span></h1>                             					 

                        <div class="clear"></div> 

                    </div>  


                    <style type="text/css">#erro_box{ width:390px; border:1px solid red; padding:10px; background:#FFEBEB; margin:0 auto; margin-bottom:15px;}</style>
    			<div id="erro_box" style="display:none;"></div>
					<form action="../processa/save-the-date.php" method="post" name="envitation" onsubmit="return validaFormulario(this);">
                    
                    	<input type="hidden" name="origem" value="<?=$_SERVER['REQUEST_URI']?>" />
                    	<input type="hidden" name="etapa" value="1" />
    					<!--Conntac Information -->

                        <div id="content-container-packages">                                                              
                            <h4><a href="javascript:void(null)">RIW-2013 IS BY INVITATION ONLY.</a></h4> 
                            
                            <p style="text-align:center; line-height:20px;">Use the form below to update your contact info.  You may also use the form to refer yourself or business associates who might be interested in RIW2013. Please submit one referral at a time, for as many referrals as you wish.  THIS IS NOT AN INVITATION. We will send formal invitations at a later date.
</p>
                            <br/>
                            <h5 style="text-align:center"><a><span>This information will not be shared</span></a></h4>
                             
                            <div id="content-container-packages-content" style="display:block">                            
                                <div class="packages-description">
                                    <div id="contact">                                       
                                    <div id="contact">                                       
                                            <div class="column1of2">
                                                <label style="font-style:normal;">First Name<span>*</span>:</label> <input type="text" name="first_name" /><br/>
                                                <label style="font-style:normal;">Last Name<span>*</span>:</label> <input type="text" name="last_name" /><br/>
                                                <label style="font-style:normal;">Company*:</label> <input type="text" name="company" /><br/>
                                                <label style="font-style:normal;">Title:</label> <input type="text" name="title" /><br/>
                                                <label style="font-style:normal;">E-mail<span>*</span>:</label> <input type="text" name="email" />
                                            </div>
                                            <div class="column2of2">
                                                <label style="font-style:normal;">Phone:</label> <input type="text" name="phone" /><br/>
                                                <label style="font-style:normal;">City:</label> <input type="text" name="city" /><br/>
                                                <label style="font-style:normal;">State:</label> <input type="text" name="state" /><br/>
                                                <label style="font-style:normal;">Country:</label> <input type="text" name="country" /><br/>
                                                <label style="font-style:normal;">Postal Code:</label> <input type="text" name="postal_code" />                                            </div>                                                  
                                    </div>   
                                    <div class="clear"></div>
                                    <p>* mandatory fields</p>                                   

                                    <div class="clear"></div>
                                    <p>Would you like to unsubscribe to RIW updates?</p>
 									<div class="clear"></div>
                                    <ul class="center" style="margin-left:214px;">
                                		<li style="width:126px;"><input type="radio" name="unsubscribe" value="1" /><label  style="font-style:normal;" class="label_radio"> Yes</label></li>
                                        <li><input type="radio" name="unsubscribe" value="0" checked="checked"/><label style="font-style:normal;" class="label_radio"> No</label></li>	
                                	</ul>                                                                                                
                                </div>		
                                </div><!-- content-container-packages-content END -->   
                                </div>                       
                            	<h4><a href="javascript:void(null)"><img src="../img/pull-down-button.png"/></a></h4> 
                            </div> 
                        <div id="content-container-packages">                                                              
                            <h4><a href="javascript:void(null)">SHORT SURVEY<br/><br/></a></h4>
                            
                            <h4><span>Which RIW event are you likely to attend? (Check all that apply)</span></h4>    
                            		<br/>           
                                    <ul style="margin-left:37px;">
										<li style="width:40%; margin-left:50px;"><input type="checkbox" name="id_events[]" value="boston" /><label style="font-style:normal;" class="label_check">RIW Boston - Sept. 17<sup>th</sup></label></li>
                                        <li style="width:40%"><input type="checkbox" name="id_events[]" value="sillicon-valley" /><label style="font-style:normal;" class="label_check">RIW Silicon Valley - Sept. 19<sup>th</sup> - 20<sup>th</sup></label></li>
									</ul>                                    
                                    <div class="clear"></div><br/>
                            <h4><span>What industry are you associated with? (Check all that apply)</span></h4>
                            
                        	<!--<!--SRURVEY-->	 
                            <div id="content-container-packages-content" style="display:block">                            
                                <div class="packages-description">
									<ul class="block3" style="margin-left:110px;">
										<?
											$consulta = $DB->consulta('SELECT * FROM tbindustry');										
											while($linha = $DB->lista($consulta)){
                                        ?>
                                        <li><input type="checkbox" name="id_typeindustry[]" value="<?=$linha['id_typeindustry']?>" /><label class="label_check"><?=$linha['typeindustry']?></label></li>
										<? }?>					
			
                                    </ul>  

                                    <div class="clear"></div>

                                    <p> What are your interests/areas of focus? (Check all that apply)</p>   

                                    <div class="clear"></div>

                                    <ul class="block3" style="margin-left:110px;">
										<?
											$consulta = $DB->consulta('SELECT * FROM tbinterests');
											while($linha = $DB->lista($consulta)){
                                        ?>
                                        <li><input type="checkbox" name="id_interest[]" value="<?=$linha['id_interest']?>" /><label for="id_teste" class="label_check"><?=$linha['interest']?></label></li>
										<? }?>					
                                    </ul>  

                                    <div class="clear"></div>                                                                                                 	

                                </div><!-- content-container-packages-content END -->                          

                            </div> <!-- content-container-packages END -->   

							<h4><a href="javascript:void(null)"><img src="../img/pull-down-button.png"/></a></h4>                           

                        </div>  

    

    					
                           
                            
                        <!-- content-container-packages END -->    

   

                               

                            

                            <span id="bt-submit"><input style="margin-left:221px" type="submit" value="Submit"/></span>

                    </form>

</div>

<div class="clear"></div>

<script type="text/javascript">

	
	function escreve_html(conteudo, id){
		$("#"+id).html(conteudo);
		$("#"+id).css('display', 'block');
	}


	
	
	
	function validaFormulario(){
		
		//alert('Oi');return false;

		var x = document.envitation;
		var erro = false;
		var alerta = "<strong>Please fill in the mandatory fields.:</strong> <br />"
		
		if(x.first_name.value < 3){
			erro = true;
			alerta+=" - First Name; <br />";
		}
		if(x.last_name.value < 3){
			erro = true;
			alerta+=" - Last Name; <br />";
		}
		if(x.company.value < 3){
			erro = true;
			alerta+=" - Company; <br />";
		}
		
		if(!valida_email(x.email.value)){
			erro = true;
			alerta+=" - E-mail; <br />";
		}
		

		if(!(jQuery("input[@name='id_event[]']:checked").length > 0)){
			erro = true;
			alerta+=" - Choose at least one event; <br />";

		}
		
		if(!(jQuery("input[@name='id_typeindustry[]']:checked").length > 0)){
			erro = true;
			alerta+=" - Select you industry; <br />";

		}
		
		if(!(jQuery("input[@name='id_interest[]']:checked").length > 0)){
			erro = true;
			alerta+=" - Check at least one area of your interest; <br />";

		}
		
		
		
		
		
		// Enviado o erro
		if(erro){
			escreve_html(alerta, 'erro_box');
			return false;
		}
		
		return true;
	
	}
	
		<?
			// Mensagem de erro
			if(strlen($_GET['erro'])>0){
				echo "escreve_html('".urldecode($_GET['erro'])."', 'erro_box');";
			}elseif($_GET['suc']){
				echo 'alert("'.urldecode($_GET['suc']).'")';
			}
			
		?>
</script>