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

                                                          
				<? 
				
					if(empty($url[1])){
						echo '<label>Key</label> <input name="key" type="text" />';exit;
					}

					$Dados = $DB->dados('SELECT * FROM tbuser INNER JOIN tbuser_keys ON tbuser.id_user=tbuser_keys.id_user WHERE tbuser_keys.chave="'.(string)$url[1].'" LIMIT 1');
					//echo $Dados['usada'==1]
					if($Dados['usada']==1){exit('Chave já usada');}
				?>
                    <div id="content-container-packages" class="header">

                        <h3>RUSNANO, RVC and Skolkovo</h3>                          

                        <p>Cordially invite you to</p>                            

                        <h2>Russian Innovation Week</h2>

                        <p><span>October 25-26, 2012<br/>

                            Computer History Museum, Mountain View, California   

                        </span></p>                             

                        <p>Please RSVP below.</p>						 

                        <div class="clear"></div> 

                    </div>  

					<form method="post" action="#">	

                        <div id="content-container-packages">                                                              

                            <h4><a href="javascript:void(null)"> Event Options <br/>

                            <span>Which RIW 2012 events would you like to attend?  (Check all that apply)</span>

                            </a></h4>

                        	<!--<!--Event Options-->	 

                            <div id="content-container-packages-content" style="display:none">                            

                                <div class="packages-description_block1">

									<ul class="checkbox_1line_list">

										<?
                                        	$consulta = $DB->consulta('SELECT * FROM tbevents');
											$attending = explode(';', $Dados['attending']);
                                        	while($linha = $DB->lista($consulta)){
                                        ?>

                                        <li>
                                        	<input <? if(in_array($linha['id_event'], $attending)) echo ' checked="checked"';?> <? if($linha['preferences']) echo 'onChange="desabilita(this)" class="events_chec"';?> type="checkbox" name="id_event" value="<?=$linha['id_event']?>" />
                                        	<label class="label_check"><?=$linha['event']?></label>
                                        </li>
										<? }?>
	
                                    </ul>                                                                 

                                </div>                  

                            </div>   

                            <h4><a href="javascript:void(null)"><img src="../img/pull-down-button.png"/></a></h4>                      

                        </div>                                       

    
    						<script type="text/javascript">
							
							
							
								$(document).ready(function(){
								   //alert($('.events_chec').is(':checked'));
									if ($('.events_chec').is(':checked')){
										$('#mostra_se').show();
									}else{
										$('#mostra_se').hide();
									}	

									$(".events_chec").click(function(event){
										if ($('.events_chec').is(':checked')){
											$('#mostra_se').show();
										}else{
											$('#mostra_se').hide();
										}									
									});								 

								 
								 });							
							
							
							
								/*function desabilita(check){
								if ($('.events_chec').is(':checked')){
										$('#mostra_se').show();
									}else{
										$('#mostra_se').hide();
									}									
								}*/
                            </script>

                            <div style="display:none;" id="mostra_se">
                        <div id="content-container-packages">                                                              

                            <h4><a href="javascript:void(null)">Dinner Preferences<br/> 

                            <span>Entr&eacute;e preference for Keynote dinner on Thursday, October 25 at Sharon Heights Country Club.*</span>

                            </a></h4>

                        	<!--<!--DINNER PREFERENCES-->	 

                            <div id="content-container-packages-content" style="display:none">                            

                                <div class="packages-description_block2">

									<ul class="radiobtn_1line">

                                		<li><input <? if($Dados['entree']=='Poultry') echo 'checked="checked"'; ?>   type="radio" name="entree" value="Poultry" /><label class="label_radio"> Poultry</label></li>

                                        <li><input <? if($Dados['entree']=='Beef') echo 'checked="checked"'; ?> type="radio" name="entree" value="Beef"/><label class="label_radio"> Beef</label></li>

                                        <li><input <? if($Dados['entree']=='Fish') echo 'checked="checked"'; ?> type="radio" name="entree" value="Fish"/><label class="label_radio"> Fish</label></li>

                                        <li><input <? if($Dados['entree']=='Vegetarian') echo 'checked="checked"'; ?> type="radio" name="entree" value="Vegetarian"/><label class="label_radio"> Vegetarian</label></li>		

                                	</ul>

                        			<div class="clear"></div>

                                    <p>Do you have any allergies we should know about?*</p>

                                    <div class="clear"></div>

 									<ul class="center">

                                		<li><input <? if($Dados['allergy']==1) echo 'checked="checked"'; ?> id="alergy_true" onclick="toggleStatus()" type="radio" name="allergy" value="1" /><label class="label_radio"> Yes</label></li>

                                        <li><input <? if($Dados['allergy']==0) echo 'checked="checked"'; ?> onclick="toggleStatus()" type="radio" name="allergy" value="0"/><label class="label_radio"> No</label></li>	

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

                        <div id="content-container-packages">                                                              

                            <h4><a href="javascript:void(null)"> SURVEY<br/>

                            <span>What industry are you associated with? (Check all that apply)</span>

                            </a></h4>

                        	<!--<!--SRURVEY-->	 

                            <div id="content-container-packages-content" style="display:none">                            

                                <div class="packages-description">

									<ul class="block3">
										<?
											$consulta = $DB->consulta('SELECT * FROM tbindustry');
											$industry = explode(';', $Dados['industry']);
											while($linha = $DB->lista($consulta)){
                                        ?>

                                        <li><input <? if(in_array($linha['id_typeindustry'], $industry)) echo ' checked="checked"';?> type="checkbox" name="id_typeIndustry" value="<?=$linha['id_typeindustry']?>" /><label class="label_check"><?=$linha['typeindustry']?></label></li>
										<? }?>					

                                    </ul>  

                                    <div class="clear"></div>

                                    <p> What are your interests/areas of focus? (Check all that apply)</p>   

                                    <div class="clear"></div>

                                    <ul class="block3">

										<?
											$interests = explode(';', $Dados['interests']);
											$consulta = $DB->consulta('SELECT * FROM tbinterests');
											while($linha = $DB->lista($consulta)){
                                        ?>
                                        <li><input <? if(in_array($linha['id_interest'], $interests)) echo ' checked="checked"';?> type="checkbox" name="id_interest" value="<?=$linha['id_interest']?>" /><label class="label_check"><?=$linha['interest']?></label></li>
										<? }?>					

                                    </ul>  

                                    <div class="clear"></div>

                                                                                                                                       	

                                </div><!-- content-container-packages-content END -->                          

                            </div> <!-- content-container-packages END -->   

							<h4><a href="javascript:void(null)"><img src="../img/pull-down-button.png"/></a></h4>                           

                        </div>  

    

    

                        <div id="content-container-packages">                                                              

                            <h4><a href="javascript:void(null)"> RSVP<br/>

                            <span>Contact Information</span>

                            </a></h4> 

                            <div id="content-container-packages-content" style="display:block">                            

                                <div class="packages-description">

                                    <div id="contact">                                       

                                            <div class="column1of2">

                                                <label>First Name:</label> <input type="text" name="first_name" value="<?=$Dados['first_name']?>" /><br/>

                                                <label>Last Name:</label> <input type="text" name="last_name" value="<?=$Dados['last_name']?>" /><br/>

                                                <label>Company:</label> <input type="text" name="company" value="<?=$Dados['company']?>" /><br/>

                                                <label>Title:</label> <input type="text" name="title" value="<?=$Dados['title']?>" /><br/>

                                                <label>E-mail:</label> <input type="text" name="email" value="<?=$Dados['email']?>" />

                                            </div>

                                            <div class="column2of2">

                                                <label>Phone:</label> <input type="text" name="phone" value="<?=$Dados['phone']?>" /><br/>

                                                <label>City:</label> <input type="text" name="city" value="<?=$Dados['city']?>" /><br/>

                                                <label>State:</label> <input type="text" name="state" value="<?=$Dados['state']?>" /><br/>

                                                <label>Country:</label> <input type="text" name="country" value="<?=$Dados['country']?>" /><br/>

                                                <label>Postal Code:</label> <input type="text" name="postal_code" value="<?=$Dados['postal_code']?>" />

                                            </div>                                                                                                                             

                                    </div>

                                    <div class="clear"></div>

                                                   

                                    <p>Registration Code</p>

 		

                                	<input class="label_center" type="text" name="registration_code" value="<?=$Dados['registration_code']?>" />                    

                                    <div class="clear"></div>

                                    <p>Would you like to receive email updates about Russian Innovation Week 2012?</p>

 									<div class="clear"></div>

                                    <ul class="center">

                                		<li><input <? if($Dados['email_updates']==1) echo 'checked="checked"'; ?> type="radio" name="email_updates" value="1" /><label class="label_radio"> Yes</label></li>

                                        <li><input <? if($Dados['email_updates']==0) echo 'checked="checked"'; ?> type="radio" name="email_updates" value="0"/><label class="label_radio"> No</label></li>	

                                	</ul>

                                    <div class="clear"></div>

                                    <p>Would you like to know about RIW networking opportunities?</p>

 									<div class="clear"></div>

                                    <ul class="center">

                                		<li><input <? if($Dados['networking']==1) echo 'checked="checked"'; ?> type="radio" name="networking" value="1" /><label class="label_radio"> Yes</label></li>

                                        <li><input <? if($Dados['networking']==0) echo 'checked="checked"'; ?> type="radio" name="networking" value="0"/><label class="label_radio"> No</label></li>	

                                	</ul>

                                    <div class="clear"></div>

                                    <p>Would you like your name and company to be publicly visible on our attendee list?</p>

                                    <ul class="center">

                                        <li><label  class="label_radio"><input <? if($Dados['public_profile']==1) echo 'checked="checked"'; ?> type="radio" name="public_profile" value="1" /> Yes</label></li>

                                        <li><label class="label_radio"><input  <? if($Dados['public_profile']==0) echo 'checked="checked"'; ?> type="radio" name="public_profile" value="0"/> No</label></li>	

                                    </ul>                                                                           

                                </div>		

                                </div><!-- content-container-packages-content END -->                          

                            	<h4><a href="javascript:void(null)"><img src="../img/pull-down-button.png"/></a></h4> 

                            </div> <!-- content-container-packages END -->    

   

   

                        <div id="content-container-packages">                                                              

                            <h4><a href="javascript:void(null)">Refer a guest<br/>

                            <span>Contact Information</span>

                            </a></h4> 

                            <div id="content-container-packages-content" style="display:none">                             

                                <div class="packages-description">

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

                                    

                                    <p>What industry is your guest associated with? (Check all that apply)</p>    

                                                                                     

                                        <div class="packages-description">

                                            <ul class="block3">
										<?
											$consulta = $DB->consulta('SELECT * FROM tbindustry');
											
											while($linha = $DB->lista($consulta)){
                                        ?>

                                        <li><input type="checkbox" name="id_typeIndustry" value="<?=$linha['id_typeindustry']?>" /><label class="label_check"><?=$linha['typeindustry']?></label></li>
										<? }?>					
                                            </ul>  

                                            <div class="clear"></div>

                                            <br/>                                    

                                            <a style="text-align:center;">+ Refer another Guest</a>                                      

                                        </div>		

                                </div>                      

                            	

                            </div> <!-- content-container-packages END -->    

                            <h4><a href="javascript:void(null)"><img src="../img/pull-down-button.png"/></a></h4>                             

                        </div>    

                            

                            <span id="bt-going"><input type="submit" value="Yes, I Confirm"/></span>                         

                            <span id="bt-not-going"><input type="submit" value="No, Thank You"/></span> 

                    </form>

</div>

<div class="clear"></div>