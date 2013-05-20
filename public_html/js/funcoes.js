//

function toggleStatus() {

	if ($('#alergy_true').is(':checked')) {
		$('#alergy_description').removeAttr('disabled', true);
	}else{
		
		$('#alergy_description').val('');
		$('#alergy_description').attr('disabled', true);
	}	
}                                    


/* Valida E-mail */
function valida_email(email){
	var expressao = /^[\w-]+(\.[\w-]+)*@(([A-Za-z\d][A-Za-z\d-]{0,61}[A-Za-z\d]\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
	return expressao.test(email);
}

