// Mostrar e esconder as ações de um registo na lista de registos
function mostra_acoes(id, acao){
	if(acao=='show'){
		$("#"+id).show();
	}else if(acao=='hide'){
		$("#"+id).hide();
	}
}

// Alerta de quando for apagar vários registros
function em_massa(){
	var x = document.listagem;

	if(jQuery("input[@name='cb[]']:checked").length > 0){
		if(confirm('Deseja mesmo apagar estes registros? Isso não poderá ser desfeito.')) return true; else return false;
	}else{
		alert('Você deve selecionar pelo menos um registro!');
		return false;	
	}
}


// Selecionando vários registos
$(document).ready(function() {
	$('.selectAll').click(function() {
			if(this.checked == true){
			$("input[type=checkbox]").each(function() { this.checked = true; });
			$("#borda_marcar_todos").html('<a onclick="desmarcar_todos()" href="javascript:void(0)">Desmarcar todos</a>')				 
		}
		else { 
			$("input[type=checkbox]").each(function() { this.checked = false;});
			$("#borda_marcar_todos").html('<a onclick="marcar_todos()" href="javascript:void(0)">Marcar todos</a>')				 
		}
	});
});

function marcar_todos(){
	$("input[type=checkbox]").each(function() { this.checked = true; });
	$("#borda_marcar_todos").html('<a onclick="desmarcar_todos()" href="javascript:void(0)">Desmarcar dotos</a>')				 
}

function desmarcar_todos(){
	$("input[type=checkbox]").each(function() { this.checked = false; });
	$("#borda_marcar_todos").html('<a onclick="marcar_todos()" href="javascript:void(0)">Marcar dotos</a>')				 
}

// Menu
function menu(id){
	var cssObj = {
		 // 'position' : 'absolute',
		  'display' : 'block',
		  //'margin-left':'180px',
		 // 'margin-top':'-30px'
		}
	$(this).delay(500,function(){
		$('#'+id).css(cssObj);
	});
}

function fecha (id){
	$(this).delay(500,function(){
		$('#'+id).css('display','none');
	});
}


	function empty (mixed_var) {
		var key;
		 if (mixed_var === "" || mixed_var === 0 || mixed_var === "0" || mixed_var === null || mixed_var === false || typeof mixed_var === 'undefined') {
			return true;
		}
	 
		if (typeof mixed_var == 'object') {        for (key in mixed_var) {
				return false;
			}
			return true;
		} 
		return false;
	}		
		
		
		
// Abre Janela PopUp
function abreJanelaCentro(Url,NomeJanela,width,height,extras){
	var largura = width;
	var altura = height;
	var adicionais= extras;
	var extras2= extras;
	var topo = (screen.height-altura)/2;
	var esquerda = (screen.width-largura)/2;
	novaJanela=window.open(''+ Url + '',''+ NomeJanela + '','width=' + largura + ',height=' + altura + ',top=' + topo + ',left=' + esquerda + ',scrollbars=yes,resizable=no,features=' + adicionais + '');
	novaJanela.focus();	
}
