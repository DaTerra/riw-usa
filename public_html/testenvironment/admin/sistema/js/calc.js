// ======================== 		PREÇO DE LISTA 			=====================================

	// Com o preço de compra e o preço de lista, eu calculo a margem
	function lista_margem(){
		var compra = parseFloat($('#preco_compra').val());
		var lista = parseFloat($('#lista_preco').val());
		var margem = parseFloat($('#lista_margem').val());

		if(compra>0 && lista>0){
			margem = (((lista-compra)/compra)*100)
			margem = margem;
			$('#lista_margem').val(margem);
		}			
	}
	$("#lista_preco").focusout(lista_margem);

	// Com o preço de compra e a margem, eu calculo a preço de lista
	function lista_preco(){
		var compra = parseFloat($('#preco_compra').val());
		var lista = parseFloat($('#lista_preco').val());
		var margem = parseFloat($('#lista_margem').val());
		
		//alert(compra);alert(margem);
		if(compra>0 && margem>0){
			lista = (((compra*margem)/100)+compra);
			$('#lista_preco').val(lista);
		}
	
	} 
	$("#lista_margem").focusout(lista_preco);
// ======================== 		PREÇO DE GROOMER 		=====================================

	// Calcula o desconto e a margem
	function groomer_preco(){
		var compra = parseFloat($('#preco_compra').val());
		var lista = parseFloat($('#lista_preco').val());
		var preco = parseFloat($('#groomer_preco').val());
		var desconto = parseFloat($('#groomer_desc').val());
		var margem = parseFloat($('#groomer_margem').val());
		
		// Calcula desconto 
		if(lista>0 && preco>0){
			desconto = (((lista-preco)/lista)*100);
			$('#groomer_desc').val(desconto);
		}
		
		// Margem Grromer
		if(compra>0 && preco>0){
			margem = (((preco-compra)/compra)*100)
			margem = margem;
			$('#groomer_margem').val(margem);
		}			
	}
	$("#groomer_preco").focusout(groomer_preco);
	
	function groomer_desc(){
		var compra = parseFloat($('#preco_compra').val());
		var lista = parseFloat($('#lista_preco').val());
		var preco = parseFloat($('#groomer_preco').val());
		var desconto = parseFloat($('#groomer_desc').val());
		var margem = parseFloat($('#groomer_margem').val());
		
		
		// Preco Groomer
		if(desconto>0 && lista>0){
			subtrai = (lista*desconto)/100;
			preco = lista-subtrai;
			$('#groomer_preco').val(preco)
		}
		
		// Margem Grromer
		if(compra>0 && preco>0){
			margem = (((preco-compra)/compra)*100)
			margem = margem;
			$('#groomer_margem').val(margem);
		}			
		
	}
	$("#groomer_desc").focusout(groomer_desc);

	function groomer_margem(){
		var compra = parseFloat($('#preco_compra').val());
		var lista = parseFloat($('#lista_preco').val());
		var preco = parseFloat($('#groomer_preco').val());
		var desconto = parseFloat($('#groomer_desc').val());
		var margem = parseFloat($('#groomer_margem').val());

		//preco
		if(compra>0 && margem>0){
			soma = (compra*margem)/100;
			preco = soma+compra;
			$('#groomer_preco').val(preco)
		}
		
		//Desconto
		if(preco>0 && lista>0){
			desconto = (((lista-preco)/lista)*100);
			$('#groomer_desc').val(desconto);
		}
		
	}
	$("#groomer_margem").focusout(groomer_margem);
// ======================== 		PREÇO DE DESTRIBUIDOR 	=====================================
	// Calcula o desconto e a margem
	function dest_preco(){
		var compra = parseFloat($('#preco_compra').val());
		var lista = parseFloat($('#lista_preco').val());
		var preco = parseFloat($('#dest_preco').val());
		var desconto = parseFloat($('#dest_desconto').val());
		var margem = parseFloat($('#dest_margem').val());
		
		// Calcula desconto 
		if(lista>0 && preco>0){
			desconto = (((lista-preco)/lista)*100);
			$('#dest_desconto').val(desconto);
		}
		
		// Margem Grromer
		if(compra>0 && preco>0){
			margem = (((preco-compra)/compra)*100)
			margem = margem;
			$('#dest_margem').val(margem);
		}			
	}
	$("#dest_preco").focusout(dest_preco);
	
	function dest_desc(){
		var compra = parseFloat($('#preco_compra').val());
		var lista = parseFloat($('#lista_preco').val());
		var preco = parseFloat($('#dest_preco').val());
		var desconto = parseFloat($('#dest_desconto').val());
		var margem = parseFloat($('#dest_margem').val());
		
		
		// Preco Groomer
		if(desconto>0 && lista>0){
			subtrai = (lista*desconto)/100;
			preco = lista-subtrai;
			$('#dest_preco').val(preco)
		}
		
		// Margem Grromer
		if(compra>0 && preco>0){
			margem = (((preco-compra)/compra)*100)
			margem = margem;
			$('#dest_margem').val(margem);
		}			
		
	}
	$("#dest_desconto").focusout(dest_desc);

	function dest_margem(){
		var compra = parseFloat($('#preco_compra').val());
		var lista = parseFloat($('#lista_preco').val());
		var preco = parseFloat($('#dest_preco').val());
		var desconto = parseFloat($('#dest_desconto').val());
		var margem = parseFloat($('#dest_margem').val());

		//preco
		if(compra>0 && margem>0){
			soma = (compra*margem)/100;
			preco = soma+compra;
			$('#dest_preco').val(preco)
		}
		
		//Desconto
		if(preco>0 && lista>0){
			desconto = (((lista-preco)/lista)*100);
			$('#dest_desconto').val(desconto);
		}
		
	}
	$("#dest_margem").focusout(dest_margem);




























/*


		
		// Distribuidor
		function distribuidor(){
			
			//alert('-');
			var pre = parseFloat($('#dest_pre').val());
			var desc = parseFloat($('#dest_desc').val());
			var margem = parseFloat($('#des_margem').val());
			var lista = parseFloat($('#pre_lista').val());
			var compra = parseFloat($('#pre_compra').val());
			
			// Desconto
			if(pre>0 && lista>0){
				desc = (((lista-pre)/lista)*100);
				$('#dest_desc').val(desc);
			}
			
			// Margem
			if(compra>0 && pre>0){
				margem = (((pre-compra)/pre)*100);
				$('#des_margem').val(margem);
			}
			
			// Preço
			if(isNaN(pre) && desc >0 && lista>0){
				valDesc = ((lista*desc)/100);
				valor1 = lista - valDesc;
				$('#dest_pre').val(valor1)				
			}
			
		}
		$("#dest_pre").focusout(distribuidor);
		$("#dest_desc").focusout(distribuidor);
		
		// ======================================== Groomer
		function grromer(){
			var pre = parseFloat($('#pre_grromer').val());
			var desc = parseFloat($('#des_groomer').val());
			var margem = parseFloat($('#margem_groomer').val());
			var lista = parseFloat($('#pre_lista').val());
			var compra = parseFloat($('#pre_compra').val());

			// Preço
			if(isNaN(pre) && desc >0 && lista>0){
				valDesc = ((lista*desc)/100);
				valor1 = lista - valDesc;
				$('#pre_grromer').val(valor1)	;
				
				if(compra>0){
					//alert(pre);
					//alert(compra);
					margem = (((valor1-compra)/valor1)*100);
					$('#margem_groomer').val(margem);
				}
			}
			
			// Desconto
			if(pre>0 && lista>0){
				//alert('OI');
				desc = (((lista-pre)/lista)*100);
				$('#des_groomer').val(desc);
			}
			
			
			// Margem
			if(compra>0 && pre>0){
				margem = (((pre-compra)/pre)*100);
				$('#margem_groomer').val(margem);
			}

			
		}
		$("#pre_grromer").focusout(grromer);
		
		// Com o desconto calcular a margem e o preço
		function groo_des(){
			var pre = parseFloat($('#pre_grromer').val());
			var desc = parseFloat($('#des_groomer').val());
			var margem = parseFloat($('#margem_groomer').val());
			var lista = parseFloat($('#pre_lista').val());
			var compra = parseFloat($('#pre_compra').val());
			
			// Preço
			if(desc >0 && lista>0){
				valDesc = ((lista*desc)/100);
				valor1 = lista - valDesc;
				$('#pre_grromer').val(valor1)	;
				
				if(compra>0){
					//alert(pre);
					//alert(compra);
					margem = (((valor1-compra)/valor1)*100);
					$('#margem_groomer').val(margem);
				}
			}//
		}
		$("#des_groomer").focusout(groo_des);
		
		
		
		function groomer_margem(){
			var pre = parseFloat($('#pre_grromer').val());
			var desc = parseFloat($('#des_groomer').val());
			var margem = parseFloat($('#margem_groomer').val());
			var lista = parseFloat($('#pre_lista').val());
			var compra = parseFloat($('#pre_compra').val());

			lista2 = lista;
			// Calcula preço e o desconto com o valor da margem
			if(compra>0 && margem>0){
				lista = (((compra*margem)/100)+compra)
				$('#pre_grromer').val(lista);
				
				pre = lista;
				//alert(lista2);alert(pre);
				desc = (((lista2-pre)/lista2)*100);
				$('#des_groomer').val(desc);
				
			}			
			
		}
		$("#margem_groomer").focusout(groomer_margem);
		
		
		
		// Lista
		function displayVals() {
			
			var compra = parseFloat($('#pre_compra').val());
			var lista = parseFloat($('#pre_lista').val());
			var margem = parseFloat($('#val_margem').val());

			if(compra>0 && lista>0){
				margem = (((lista-compra)/compra)*100)
				//margem = margem.toFixed(2);
				$('#val_margem').val(margem);
			}			

		}
		
		
		function calculaMar(){
			var compra = parseFloat($('#pre_compra').val());
			var lista = parseFloat($('#pre_lista').val());
			var margem = parseFloat($('#val_margem').val());
			
			if(compra>0 && margem>0){
				lista = (((compra*margem)/100)+compra)
				$('#pre_lista').val(lista)
			}
		}
		
		
		
		$("#pre_lista").focusout(displayVals);
		$("#val_margem").focusout(calculaMar);
		
		

*/