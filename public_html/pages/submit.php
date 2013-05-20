<style type="text/css">
	#form_information{}
	#form_information h4{ margin-bottom:20px;}
	.forma_separa{ display: block; width:100%; border-top:1px dotted #ccc; text-indent:-9000px; margin-top:15px; margin-bottom:15px;}
	.form_item{  float:left; clear:both; margin-bottom:10px; width:100%;}
	.form_item label{ float:left; display:block; width:150px;}
	input{ width:200px; }
	select{ width:100px; border:1px solid #CCC;}
	.form_item textarea{ width:200px; height:100px; border:1px solid #CCC; font-size:12px; padding:5px;}
	.form_item span{ margin-left:10px;}
</style>

<div id="content-container" class="right_column_of2 registration bg_red">
	<div id="form_information">
                        <style type="text/css">#erro_box{ width:390px; border:1px solid red; padding:10px; background:#FFEBEB; margin:0 auto; margin-bottom:15px;}</style>

    			<div id="erro_box" style="display:none;"></div>

        <form action="../processa/Information.php" method="post" enctype="multipart/form-data" name="sub" onsubmit="return validaFormulario(this);">
        
            <h4>Contact Information:</h4>
        	<div class="form_item"><label>First Name:</label><input type="text" name="first_name" /></div>
        	<div class="form_item"><label>Last Name:</label><input type="text" name="last_name" /></div>
        	<div class="form_item"><label>Company:</label><input type="text" name="company" /></div>
        	<div class="form_item"><label>Title:</label><input type="text" name="title" /></div>
        	<div class="form_item"><label>E-mail:</label><input type="text" name="email" /></div>
            
			<div class="clear"></div>
        	<span class="forma_separa">&quot;</span>
            <h4>PR Information:</h4>
        	<div class="form_item"><label>Company/PR Contact Name</label><input type="text" name="company_contact_name" value="" /></div>
        	<div class="form_item"><label>Contact Email</label><input type="text" name="contact_email" value="" /></div>
            
			<div class="clear"></div>
        	<span class="forma_separa">&quot;</span>
            
            
            <h4>Tell Us About Your Company:</h4>
        
        	<div class="form_item"><label>Company website:</label><input type="text" name="company_website" value="" /><span>(If not available, please write N/A)</span></div>
        	<div class="form_item"><label>Year Founded:</label><input type="text" name="year_founded" value="" /></div>
        	<div class="form_item"><label>Number of Employees:</label><input type="text" name="number_employees" value="" /></div>
        	<div class="form_item"><label>Location:</label><input type="text" name="location" value="" /></div>
        	<div class="form_item"><label>Company Description:</label><textarea name="company_description"></textarea></div>
            <p style="line-height:170%; text-align:left">Social Media Channels: Please provide your social media information. The official RIW Conference channels will follow your company on social media in order to make the most of your presence at this conference.</p>   
            
            <div class="form_item"><label>Twitter:</label><input type="text" name="twitter" value="" /></div>
        	<div class="form_item"><label>Facebook: </label><input type="text" name="facebook" value="" /></div>
        	<div class="form_item"><label>Google+:</label><input type="text" name="google" value="" /></div>
        	<div class="form_item"><label>YouTube:</label><input type="text" name="you_tube" value="" /></div>
			
            <div class="clear"></div>
        	<span class="forma_separa">&quot;</span>

            <h4>Speaker/Presentation Information:</h4>
            
            <div class="form_item"><label>Speaker Name and Title:</label><input type="text" name="speaker_name" value="" /><span>(Max. 600 words)</span></div>
        	<div class="form_item"><label> Speaker Bio:</label><input type="text" name="speaker_bio" value="" /></div>
        	<div class="form_item"><label> Presentation Title:</label><input type="text" name="presentation_title" value="" /></div>
        	<div class="form_item"><label>Presentation description:</label><input type="text" name="presentation" value="" /></div>
        	<div class="form_item"><label>Interested in speaking to U.S. media?</label><select name="interested_speaking"><option value="1">Yes</option><option value="0">No</option></select></div>
        	<div class="form_item">Success stories:(Links to recent articles about your company, any recent partnerships, etc)</div>
           <div class="form_item"> <label>Link 1</label><input type="text" name="success_stories[]" /></div>
           <div class="form_item"> <label>Link 2</label><input type="text" name="success_stories[]" /></div>
           <div class="form_item"> <label>Link 3</label><input type="text" name="success_stories[]" /></div>
        	
            
            <div class="limpar"></div>
            
            <div class="form_item"><label>Speaker Twitter handle:</label><input type="text" name="speaker_twitter" value="" /></div>
        	
            <div class="clear"></div>
        	<span class="forma_separa">&quot;</span>

            <h4>Tell Us About Your Product:</h4>
            
            <div class="form_item"><p style="line-height:110%; text-align:left">What are your product’s top three key differentiators from the competition?</p><br /><textarea name="text1" style="height:80px; width:250px;"></textarea></div>
            <div class="form_item"><p style="line-height:110%; text-align:left">Is there anything special about the design of this product? (hardware or software)</p><br /><textarea name="text2" style="height:80px; width:250px;"></textarea></div>
            <div class="form_item"><p style="line-height:110%; text-align:left">Why would you recommend this product to your family, friend or work colleagues?</p><br /><textarea name="text3" style="height:80px; width:250px;"></textarea></div>
            <div class="form_item"><p style="line-height:110%; text-align:left">Is there an interesting story about how you designed your product and/or started your company?</p><br /><textarea name="text4" style="height:80px; width:250px;"></textarea></div>
            <div class="form_item"><p style="line-height:110%; text-align:left">What demand/need/problem does this product address?</p><br /><textarea name="text5" style="height:80px; width:250px;"></textarea></div>
            <div class="form_item"><p style="line-height:110%; text-align:left">Is it on sale now and where? Cost?</p><br /><textarea name="text6" style="height:80px; width:250px;"></textarea></div>
            <div class="clear"></div>
        	<span class="forma_separa">&quot;</span>

            <h4>Media Upload:</h4>
        	<div class="form_item"><label>Profile Photo:</label><input type="file" name="profile_photo" /><span style="padding-left:50px;">(.jpg, .gif , .png, .tiff, .svg)</span></div>
        	<div class="form_item"><label>Company Logo:</label><input type="file" name="company_logo" /><span style="padding-left:50px;">(.jpg, .gif , .png, .tiff, .svg)</span></div>
        	<div class="form_item"><label>Presentation:</label><input type="file" name="presentation_file[]" multiple="multiple" /><span style="padding-left:50px;">(.ppt, .pdf)</span></div>
        	<div class="form_item"><label>Company videos:</label><input type="file" name="company_videos[]" multiple="multiple" /><span style="padding-left:50px;">(.mov, .mp4, .wmv )</span></div>
        	<div class="form_item"><label>Product photos:</label><input type="file" name="product_photos[]" multiple="multiple" /><span style="padding-left:50px;">(.jpg, .gif , .png, .tiff, .svg)</span></div>
            
            <br />
            	<p style="line-height:170%; text-align:left">Please follow Russian Innovation Week on <a target="_blank" href="https://twitter.com/RIW_SV">Twitter</a>, <a target="_blank" href="https://www.facebook.com/pages/Russian-Innovation-Week/408163625899875">Facebook</a>, <a href="https://plus.google.com/u/0/103179661446801281383/posts" target="_blank">Google+</a> and <a href="http://www.youtube.com/channel/UCL39Q4f-izAVgoCj-3jh6Kw?feature=guide">YouTube</a> to help publicize your company and spread the word about the Russian Innovation Week Conference.
			</p>
            
            
            
            <div style="margin-top:20px;"><button>Submit Content</button></div>
        </form>
	</div>
</div>
<div style="clear:both"></div>

<script type="text/javascript">
	function escreve_html(conteudo, id){
		$("#"+id).html(conteudo);
		$("#"+id).css('display', 'block');
	}
	
	function validaFormulario(){
		var x = document.sub;
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

		if(x.title.value < 3){
			erro = true;
			alerta+=" - Title; <br />";
		}

		if(!valida_email(x.email.value)){
			erro = true;
			alerta+=" - E-mail; <br />";
		}
		
		
		
		
		// Enviado o erro
		if(erro){
			escreve_html(alerta, 'erro_box');
			return false;
		}
		
		alert("Once you click on the OK button the upload will start. This process might take up to a few minutes. Please don't close this page or click on the back button until content submission is complete.");

		return true;
}


</script>

<?
	// Mensagem de erro
	if(strlen($_GET['erro'])>0){
		echo '<script type="text/javascript"> escreve_html("'.urldecode($_GET['erro']).'", "erro_box")</script>';
	}			
?>
