<?php



// -----------------------------------------------------------------------------------------------------------
// * processaArquivo: Processa um arquivo. Cria miniaturas, etc
// -----------------------------------------------------------------------------------------------------------
function processaArquivo($nome,$config,$file,$tipoNomeArq='') {

	$arquivos_path = dirname(__FILE__)."/../arquivos/";
	if (!empty($file[$nome]["name"])) {
		switch ($tipoNomeArq) {
			case 'amigavel': $NovoNome = nomeArquivo($file[$nome]['name'],$arquivos_path.$config['pasta']."/"); break;
			default: $NovoNome = md5(uniqid(time())).".".arquivoExtensao($file[$nome]['name']); break;
		}

		# Se for imagem
		if (validaTipoArquivo($file[$nome]['name'], 1) && $config[$nome]['x'] > 0 && $config[$nome]['y'] > 0 ) {

			$Arquivo = arquivoUpload($file[$nome],$arquivos_path."tmp/",$NovoNome);
			echo 'fez upload<BR>';
			if ($Arquivo != false) {

				echo 'arquivo valido<BR>';
				# Criando miniatura
				if ($config[$nome]['mini']['x']>0 && $config[$nome]['mini']['y']>0) {
					
					$miniatura2 = Miniatura($arquivos_path."tmp/".$Arquivo , $arquivos_path.$config['pasta']."/miniaturas/".$Arquivo, $config[$nome]['mini']['x'], $config[$nome]['mini']['y'], $config[$nome]['mini']['corte'], 0);
					
					if ($miniatura2) { # faz nada
					} else return false;
				}
				$miniatura = Miniatura($arquivos_path."tmp/".$Arquivo , $arquivos_path.$config['pasta']."/".$Arquivo, $config[$nome]['x'], $config[$nome]['y'], $config[$nome]['corte'], 1);
				if ($miniatura) { # faz nada
				} else return false;
			} else return false;

		# Arquivos
		} else {

			$Arquivo = arquivoUpload($file[$nome],$arquivos_path.$config['pasta']."/",$NovoNome);
			if ($Arquivo != false) {
				//
			} else return false;

		}



	} else return false;

	return $Arquivo;
}


# arquivoExtensao: retorna a extensão de um arquivo								
function arquivoExtensao($nomearquivo) {
	$extensao = explode(".", $nomearquivo);
	return strtolower($extensao[(count($extensao) - 1)]);
}


# arquivoUpload: faz um upload via formulário
function arquivoUpload($arquivo,$destino,$nome_arquivo='',$tamanhomax=0) {

	// Tamanho máximo do arquivo em bytes
	if ( ($arquivo["size"] > $tamanhomax) && ($tamanhomax > 0 ) ) return false; 

	// Definindo o nome do arquivo
	if ($nome_arquivo == "") { 
		$nome_arquivo = md5(uniqid(time())). "." . arquivoExtensao($arquivo['name']); 
	}
	
	// Fazendo o upload
	move_uploaded_file($arquivo["tmp_name"], $destino.$nome_arquivo); 
	
	// Retornando nome do arquivo
	return $nome_arquivo;

}


# listaDir: lista o conteúdo de um diretório									
function listaDir($diretorio, $tipoarquivo=null){ 
	$d = dir($diretorio); // Abrindo diretório 
	// Fazendo buscar por um arquivo ou diretorio de cada vez que estejam dentro da pasta especificada 
	while (false !== ($entry = $d->read())) {
		if ($tipoarquivo == '') {
			$array[] = $entry;
		}
		else if ($tipoarquivo == 'dir') {  
			// Verificando se o que foi encontrado é um diretorio 
			if (substr_count($entry, '.') == 0){
				// Se sim colocando na matriz 
				$array[] = $entry;
			}
		}
		else { 
			// Verificando se o que foi encontrado um arquivo especifico 
			if (substr_count($entry, $tipoarquivo) == 1) {
				// Se sim colocando na matriz 
				$array[] = $entry; 
			} // end if
		} // end if
	} // end while

	//Fechando diretorio 
	$d->close(); 
	if ($array=='') { 
		$array = false; 
	}
	else { 			
		sort ($array); // Colocando em ordem alfabetica 
		reset ($array); // Voltando o ponteiro para o inicio da matriz 
	} 
	return $array; // Retornado resultado final 
}


# apagarDir: Apaga um diretório completo !! CUIDADO !!				
function apagarDir($dir){
	if(is_dir($dir)) { // verifica se realmente é uma pasta
		if($handle = opendir($dir)) {
			while(false !== ($file = readdir($handle))) { // varre cada um dos arquivos da pasta
				if(($file == ".") or ($file == "..")) {
					continue;
				}
				if(is_dir($dir."/".$file)) { // verifica se o arquivo atual é uma pasta
					// caso seja uma pasta, faz a chamada para a funcao novamente
					apagarDir($dir."/".$file);
				} else {
					// caso seja um arquivo, exclui ele
					@unlink($dir."/".$file);
				}
			}
		} else {
			return false;
		}
	
		// fecha a pasta aberta
		closedir($handle);

		// apaga a pasta, que agora esta vazia
		@rmdir($dir);
	} else {
		return false;
	}
}




# Gera um nome para arquivo válido
function nomeArquivo($orig,$pasta='') {

	# Corrigindo texto (alfanumerico)
	$orig = preg_replace("/[^a-zA-ZÀ-ú0-9\s]/"," ",$orig);
	while (strpos($orig,"  ")) $orig=str_replace("  "," ",$orig);
	$orig = trim($orig);

	# Trocando os acentos
	$orig = str_replace( 
		array( "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" ),
		array( "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" ),
		$orig );
	$saida = str_replace(' ','-',$saida);

	if ($pasta!="") {

		$arqExtensao = substr($saida,strrpos($saida,'.'),strlen($saida));
		$arqNome = substr(str_replace($arqExtensao,'',$saida),0,90);

		$i=0;
		while (is_file($pasta.$saida)) { $i++;
			$saida = $arqNome . ',' .$i . $arqExtensao;

			if ($i>1000) break;
		}
	
	}

	return $saida ;

}



?>