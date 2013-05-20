<?
	$_SERVER ['REQUEST_URI'] = str_replace("&ok=0","",$_SERVER ['REQUEST_URI']);
	$_SERVER ['REQUEST_URI'] = str_replace("&ok=1","",$_SERVER ['REQUEST_URI']);

	if ($_GET['ok']=='0') { ?><script language="javascript">alert('Ops!! Something is wrong...');</script><? }
	if ($_GET['ok']=='1') { ?><script language="javascript">alert('Thank you!!! We will get back to you soon.');</script><? }

?>
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
                        <p>Cordially invite you to</p>                            
                        <h2>Russian Innovation Week</h2>
                        <p><span>October 25-26, 2012<br/>
                            Computer History Museum, Mountain View, California   
                        </span></p>                             
                        <p>Please RSVP below.</p>						 
                        <div class="clear"></div> 
                    </div>   
					<form id="formContact" name="formContact" method="post" action="/app/contact_app.php" onsubmit="return validaFormulario(this);">	     
                        <div id="content-container-packages">                                                              
                            <h4><a href="javascript:void(null)"> Request an Invitation<br/>
                            <span></span>
                            </a></h4> 
                            <div id="content-container-packages-content" style="display:block">                            
                                <div class="packages-description">
                                    <div id="contact">                                       
                                            <div class="column1of2">
                                                <label>First Name:</label> <input type="text" name="contact_first_name" /><br/>
                                                <label>Last Name:</label> <input type="text" name="contact_last_name" /><br/>
                                                <label>Company:</label> <input type="text" name="contact_company_name" /><br/>
                                                <label>Title:</label> <input type="text" name="contact_title_name" /><br/>
                                                <label>E-mail:</label> <input type="text" name="contact_email" />
                                            </div>
                                            <div class="column2of2">
                                                <label>Phone:</label> <input type="text" name="contact_phone" /><br/>
                                                <label>City:</label> <input type="text" name="contact_city" /><br/>
                                                <label>State:</label> <input type="text" name="contact_state" /><br/>
                                                <label>Country:</label> <input type="text" name="contact_country" /><br/>
                                                <label>Postal Code:</label> <input type="text" name="contact_postal_code" />
                                            </div>                                                                                                                             
                                    </div>
                                    <div class="clear"></div>
                                    <p>Would you like your name and company to be publically visible on our attendee list?</p>
                                    <ul class="center">
                                        <li><label class="label_radio"><input type="radio" name="public_perfil" value="y"/>Yes</label></li>
                                        <li><label class="label_radio"><input type="radio" name="public_perfil" value="n"/>No</label></li>	
                                    </ul>                                                                           
                                </div>	
                                <div class="clear"></div>
                                <p>Registration Code</p>
 		
                                	<input class="label_center" type="text" name="registration_code" />                    
                                    <div class="clear"></div>	
                                </div><!-- content-container-packages-content END -->                          
                            	<h4><a href="javascript:void(null)"><img src="../img/pull-down-button.png"/></a></h4> 
                            </div> <!-- content-container-packages END -->    
                            <span id="bt-submit"><input type="submit" value="Submit"/></span>                                                     
                    </form>
</div>
<div class="clear"></div>
                                                        

