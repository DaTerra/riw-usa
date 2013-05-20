<div id="content-container" class="right_column_of2 registration bg_red">

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

                        <h3>RUSNANO, RVC and Skolkovo</h3>                          

                        <p>Present</p>                            



                        <h2>Russian Innovation Week Conference</h2>



                        <p><span>October 25-26, 2012<br/>



                            Computer History Museum, Mountain View, California   



                        </span></p>                             



                        <p>Request an invitation</p>						 



                        <div class="clear"></div> 



                    </div>  





                    <style type="text/css">#erro_box{ width:390px; border:1px solid red; padding:10px; background:#FFEBEB; margin:0 auto; margin-bottom:15px;}</style>

    			<div id="erro_box" style="display:none;"></div>

					<form action="../processa/registration.php" method="post" name="envitation" onsubmit="return validaFormulario(this);">

                    	<input type="hidden" name="origem" value="<?=$_SERVER['REQUEST_URI']?>" />

                    	<input type="hidden" name="etapa" value="1" />



                        <div id="content-container-packages">                                                              



                            <h4><a href="javascript:void(null)"> Event Options <br/>



                            <span>Which RIW 2012 events would you like to attend?  (Check all that apply)</span>



                            </a></h4>



                        	<!--<!--Event Options-->	 



                            <div id="content-container-packages-content" style="display:block">                            



                                <div class="packages-description_block1">



									<ul class="checkbox_1line_list">



										<?

                                        	$consulta = $DB->consulta('SELECT * FROM tbevents');

                                        

                                        	while($linha = $DB->lista($consulta)){

                                        ?>



                                        <li>

                                        	<input class="valida_events" <? if($linha['preferences']) echo 'onclick="desabilita(this)" id="events_chec"';?> type="checkbox" name="id_event[]" value="<?=$linha['id_event']?>" />

                                        	<label class="label_check"><?=$linha['event']?></label>

                                        </li>

										<? }?>



                                    </ul>                                                                 



                                </div>                  



                            </div>   



                            <h4><a href="javascript:void(null)"><img src="../img/pull-down-button.png"/></a></h4>                      



                        </div>                                       



    						<script type="text/javascript">

								function desabilita(check){

								if ($('#events_chec').is(':checked')){

										$('#mostra_se').show();

									}else{

										$('#mostra_se').hide();

									}									

								}

                            </script>



                            <div style="display:none;" id="mostra_se">



                        <div id="content-container-packages">                                                              



                            <h4><a href="javascript:void(null)">Dinner Preferences<br/> 



                            <span>Entr&eacute;e preference for Keynote dinner on Thursday, October 25 at Sharon Heights Country Club</span>



                            </a></h4>



                        	<!--<!--DINNER PREFERENCES-->	 

							

                            <div id="content-container-packages-content" style="display:block">                            



                                <div class="packages-description_block2">



									<ul class="radiobtn_1line">



                                		<li><input class="valida_entree" type="radio" name="entree" value="Poultry" /><label class="label_radio"> Poultry</label></li>



                                        <li><input class="valida_entree" type="radio" name="entree" value="Beef"/><label class="label_radio"> Beef</label></li>



                                        <li><input class="valida_entree" type="radio" name="entree" value="Fish"/><label class="label_radio"> Fish</label></li>



                                        <li><input type="radio" name="entree" value="Vegetarian"/><label class="label_radio"> Vegetarian</label></li>		



                                	</ul>



                        			<div class="clear"></div>



                                    <p>Do you have any allergies we should know about?</p>



                                    <div class="clear"></div>



 									<ul class="center">





                                		<li><input class="alergia" id="alergy_true" onclick="toggleStatus()" type="radio" name="allergy" value="1" /><label class="label_radio"> Yes</label></li>



                                        <li><input class="alergia" onclick="toggleStatus()" type="radio" name="allergy" value="0"/><label class="label_radio"> No</label></li>	



                                	</ul> 



                                    <div class="clear"></div>



                                    <p>Please describe your dietary needs:</p>



                                    <div class="clear"></div>



                                    <input id="alergy_description" class="label_center" type="text" name="allergy_details" disabled="disabled" />  



                                    <div class="clear"></div>                   



                                </div>                      



                            </div>   



                            <h4><a href="javascript:void(null)"><img src="../img/pull-down-button.png"/></a></h4>                                        



                        </div>                            

						</div>

                        <!-- -->

    



                        <div id="content-container-packages">                                                              



                            <h4><a href="javascript:void(null)"> SURVEY<br/>



                            <span>What industry are you associated with? (Check all that apply)</span>



                            </a></h4>



                        	<!--<!--SRURVEY-->	 



                            <div id="content-container-packages-content" style="display:block">                            



                                <div class="packages-description">



									<ul class="block3">

										<?

											$consulta = $DB->consulta('SELECT * FROM tbindustry');

											

											while($linha = $DB->lista($consulta)){

                                        ?>



                                        <li><input class="industry" type="checkbox" name="id_typeindustry[]" value="<?=$linha['id_typeindustry']?>" /><label class="label_check"><?=$linha['typeindustry']?></label></li>

										<? }?>					

			

                                    </ul>  



                                    <div class="clear"></div>



                                    <p> What are your interests/areas of focus? (Check all that apply)</p>   



                                    <div class="clear"></div>



                                    <ul class="block3">

										<?

											$consulta = $DB->consulta('SELECT * FROM tbinterests');

											while($linha = $DB->lista($consulta)){

                                        ?>

                                        <li><input class="valida_interests" type="checkbox" name="id_interest[]" value="<?=$linha['id_interest']?>" /><label for="id_teste" class="label_check"><?=$linha['interest']?></label></li>

										<? }?>					

                                    </ul>  



                                    <div class="clear"></div>                                                                                                 	



                                </div><!-- content-container-packages-content END -->                          



                            </div> <!-- content-container-packages END -->   



							<h4><a href="javascript:void(null)"><img src="../img/pull-down-button.png"/></a></h4>                           



                        </div>  



    



    



                        <div id="content-container-packages">                                                              



                            <h4><a href="javascript:void(null)">Contact Information<br/>



                            <span>This information will not be shared</span>



                            </a></h4> 



                            <div id="content-container-packages-content" style="display:block">                            



                                <div class="packages-description">



                                    <div id="contact">                                       



                                    <div id="contact">                                       



                                            <div class="column1of2">



                                                <label>First Name:</label> <input type="text" name="first_name" /><br/>



                                                <label>Last Name:</label> <input type="text" name="last_name" /><br/>



                                                <label>Company:</label> <input type="text" name="company" /><br/>



                                                <label>Title:</label> <input type="text" name="title" /><br/>



                                                <label>E-mail:</label> <input type="text" name="email" />



                                            </div>



                                            <div class="column2of2">



                                                <label>Phone:</label> <input type="text" name="phone" /><br/>



                                                <label>City:</label> <input type="text" name="city" /><br/>



                                                <label>State:</label> <input type="text" name="state" /><br/>



                                                <label>Country:</label> <input type="text" name="country" /><br/>



                                                <label>Postal Code:</label> <input type="text" name="postal_code" />



                                            </div>                                                                                                                             



                                    </div>



                                    <div class="clear"></div>



                                    <p>Promo  Code</p>



 		



                                	<input class="label_center" type="text" name="registration_code" />                    



                                    <div class="clear"></div>



                                    <p>Would you like to receive email updates about Russian Innovation Week 2012?</p>



 									<div class="clear"></div>



                                    <ul class="center">



                                		<li><input type="radio" name="email_updates" value="1" checked="checked"/><label class="label_radio"> Yes</label></li>



                                        <li><input type="radio" name="email_updates" value="0"/><label class="label_radio"> No</label></li>	



                                	</ul>



                                    <div class="clear"></div>



                                    <p>Would you like to know about RIW networking opportunities?</p>



 									<div class="clear"></div>



                                    <ul class="center">



                                		<li><input type="radio" name="networking" value="1" checked="checked"/><label class="label_radio"> Yes</label></li>



                                        <li><input type="radio" name="networking" value="0"/><label class="label_radio"> No</label></li>	



                                	</ul>



                                    <div class="clear"></div>



                                    <p>Would you like your name and company to be publicly visible on our attendee list?</p>



                                    <ul class="center">



                                        <li><label class="label_radio"><input type="radio" name="public_profile" value="1" checked="checked"/> Yes</label></li>



                                        <li><label class="label_radio"><input type="radio" name="public_profile" value="0"/> No</label></li>	



                                    </ul>                                                                           



                                </div>		



                                </div><!-- content-container-packages-content END -->   



                                </div>                       



                            	<h4><a href="javascript:void(null)"><img src="../img/pull-down-button.png"/></a></h4> 



                            </div> <!-- content-container-packages END -->    



   



                               



                            



                            <span id="bt-submit"><input type="submit" value="Submit"/></span>



                    </form>



</div>



<div class="clear"></div>



<script type="text/javascript">
	function escreve_html(conteudo, id){
		$("#"+id).html(conteudo);
		$("#"+id).css('display', 'block');
	}
	
	function validaFormulario(){
		var x = document.envitation;
		var erro = false;
		var alerta = "<strong>Please fill up the mandatory fields.:</strong> <br />"

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

		if(x.title.value < 3){
			erro = true;
			alerta+=" - Title; <br />";
		}

		if(!valida_email(x.email.value)){
			erro = true;
			alerta+=" - E-mail; <br />";
		}
		
		
		if(!($(".valida_events:checked").length>0)){
			erro = true;
			alerta+=" - Choose at least one event; <br />";
		}
		
		if(!($(".industry:checked").length>0)){
			erro = true;
			alerta+=" - Select you industry; <br />";
		}
		
		if(!($(".valida_interests:checked").length>0)){
			erro = true;
			alerta+=" - Check at least one area of your interest; <br />";
		}
		

		
		if($("#events_chec:checked").length>0){
			if(!($(".valida_entree:checked").length==1)){
				erro = true;
				alerta+=" - Preference for dinner; <br />";
			}
			
			if(!($(".alergia:checked").length==1)){
				erro = true;
				alerta+=" - Tell if you have allergies; <br />";
			}
			
			//tem_alergia
			if(($("#alergy_true:checked").length==1) &&  x.allergy_details.value<3){
				erro = true;
				alerta+=" - Describe allergy; <br />";
			}
			
			
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