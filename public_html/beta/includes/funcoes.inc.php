<?php

# Checa login
function checaLogin() {
	if ($_SESSION['Login']['id_usuario']>0) {
		
		# Verifica o e-mail!
		if (! validaEmail($_SESSION['Login']['email'])) {
			header('Location: /cadastro-completar/?comprar='.(int)$_GET['comprar']);	
			exit;
		}

	} else {
		header('Location: /login/?comprar='.(int)$_GET['comprar']);	
		exit;
	}
}


# Download CURL
function curlDownload($url, $saida=''){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);

	if (!empty($saida)) {
		$arquivo = fopen($saida, 'wb');
		if ($arquivo == false){
			return false;
		}
	    curl_setopt($ch, CURLOPT_FILE, $arquivo);
	} else {
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	}

    $conteudo = curl_exec($ch);
    curl_close($ch);
    if ($arquivo) fclose($arquivo);
	return $conteudo;
}

# Código do Cupom
function codigoCupom($tamanho) {
	$caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$cupom='';
	for ($j=0;$j<$tamanho;$j++) {
		$cupom .= $caracteres{rand(0,strlen($caracteres)-1)};
	}
	
	return $cupom;
}


# Configs: Configurações do site
function Configs($id,$dados=array()) {
	global $mysql;
	list($valor) = $mysql->dados("SELECT valor FROM tbconfiguracoes WHERE id_configuracao=".(int)$id);
	foreach ((array)$dados as $a=>$b) {
			$valor = str_replace("{".$a."}",$dados[$a],$valor);
	}
	return $valor;
}

function Conteudo($id) {
	global $mysql;
	$conteudo = $mysql->valor("SELECT conteudo FROM tbconteudo WHERE id_conteudo=".(int)$id);
	return $conteudo;
}


# soNumeros: Deixa somente números em uma string
function soNumeros($fonte) {
	return preg_replace("/[^0-9]/","",$fonte);
}


# Monta uma máscara com string.
function montaMascara($msg="", $mask="") {
	$cMask = $mask;
	$cMsg = $msg;
	//refaz máscara
	for($i=0;$i<=strlen($cMask)-1;$i++)
		if(strlen($cMsg)-1 >= $i) //verifica se existe tantos caracteres na Mensagem quanto na máscara
			if($cMask[$i] != "#" && $cMsg[$i] != $cMask[$i]) {
				//Verifica se o caracter da máscara é especial, se for verifica se é igual ao da mensagem
				$nMsg = ""; //Cria nova mensagem 
				for($b=0;$b<=strlen($cMsg)-1;$b++) //refaz mensagem 
				if($b==$i) $nMsg = $nMsg.$cMask[$i].$cMsg[$b]; //Se o caracter da mensagem for igual ao da mascara, coloca caracter especial da mascara
					else $nMsg = $nMsg.$cMsg[$b];
				$cMsg = $nMsg;
			}

	return $nMsg;
} 

# mostraBanner: Gera saída para publicidade (imagem ou flash)
function mostraBanner($arq,$x,$y, $destino) {

	$extensao = explode(".", $arq);
	$fimarray = (count($extensao) - 1);

	if ($extensao[$fimarray]=='swf') {

		$arq = substr($arq,0,strlen($arq)-4);

		return  '<script type="text/javascript">
	          		AC_FL_RunContent(\'codebase\',\'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0\',\'width\',\''.$x.'\',\'height\',\''.$y.'\',\'src\',\''.$arq.'\',\'quality\',\'high\',\'pluginspage\',\'http://www.macromedia.com/go/getflashplayer\',\'movie\',\''.$arq.'\',\'wmode\',\'transparent\' );
            	</script>
				<noscript>
					<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" 
            	    width="'.$x.'" height="'.$y.'"><param name="movie" value="'.$arq.'.swf" /><param name="quality" value="high" /><embed src="'.$arq.'.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" 
            	    width="'.$x.'" height="'.$y.'"></embed></object>
				</noscript>';

	} else 	if ($extensao[$fimarray]=='html') {

		if (file_exists($arq)) {
			return file_get_contents($arq);
		}

	} else  {
		$saida = '<img src="'.$arq.'" width="'.$x.'" height="'.$y.'">';
		if (strlen($destino)>0) $saida = '<a href="'.$destino.'" target="_blank">'.$saida.'</a>';
		
		return $saida;
	
	}

}

# tiraCaracteres: Deixa somente caracteres a-z A-Z 0-9 (com acentos)
function alfanumerico($aonde,$adicional='') {
	$texto = preg_replace("/[^a-zA-ZÀ-ú0-9".$adicional."\s]/"," ",$aonde);
	while (strpos($texto,"  ")) $texto=str_replace("  "," ",$texto);
	return trim($texto);
}

function retiraAcentos($texto) {
	$a1 = array("á","à","â","ã","ä","é","è","ê","ë","í","ì","î","ï","ó","ò","ô","õ","ö","ú","ù","û","ü","ç","Á","À","Â","Ã","Ä","É","È","Ê","Ë","Í","Ì","Î","Ï","Ó","Ò","Ô","Õ","Ö","Ú","Ù","Û","Ü","Ç","$" );
	$a2 = array("a","a","a","a","a","e","e","e","e","i","i","i","i","o","o","o","o","o","u","u","u","u","c","A","A","A","A","A","E","E","E","E","I","I","I","I","O","O","O","O","O","U","U","U","U","C","S" );
	return str_replace( $a1, $a2, $texto );
}

# buscaQuery: Monta uma query de pesquisa para MySQL. 
function buscaQuery($colunas,$termos,$prefixo='%',$sufixo='%') {
	$buscastr = "";
	if (empty($termos)) return '';
	if (!is_array($colunas)) $colunas = array($colunas);
	$termos = array_unique(explode(" ",alfanumerico($termos)));
	foreach ((array)$termos as $termo) {
		
		if (count($colunas)>1) {
			$buscastr .= ' AND (';
			$i=0; foreach ($colunas as $coluna) { $i++;
				if ($i>1) $buscastr .= ' OR ';
				$buscastr .= $coluna." LIKE '".$prefixo.$termo.$sufixo."'";
			}
			$buscastr .= ')';
		} else $buscastr .= " AND ".$colunas[0]." LIKE '".$prefixo.$termo.$sufixo."'";
		
	}
	return $buscastr;
}

function geraPaginacao($sql,$pp) {
	global $mysql;
	global $_GET;
	global $_SERVER;
	
	$total = $mysql->Count($sql);
	$pg = $_GET['pg'] > 0 ? (int)$_GET['pg'] : 1;
	
	$consulta = $mysql->consulta($sql." limit ".($pp * ($pg -1)).",".$pp );
	$total_consulta = $mysql->qtLinhas($consulta);

	# Quantidade de Páginas
	$qt_paginas = (($total % $pp)==0) ? (int)($total / $pp) : (int)($total / $pp)+1;


	# URL
	$url = '?' . $_SERVER['QUERY_STRING'];
	$url = str_replace(array("&pg=".$pg,"pg=".$pg),"",$url);

	# Inicio - Fim
	$inicio = 1;
	$fim = $qt_paginas;
	if ($qt_paginas > 10) {
		$inicio=$pg - 4;
		$fim = $pg + 5;
		if ($inicio < 1) {
			$fim=$fim - $inicio +1;
			$inicio = 1;
		}
		if ($fim > $qt_paginas) {
			$fim = $qt_paginas;
			$inicio = $fim - 9; 
		}
	}

	# Paginação
	$saida = '<table><tr>';
	$saida .= '<td class="anterior"><a href="'. ( $pg>1 ? $url.'&pg='.($pg-1) : '#' ).'">Anterior</a></div>';
	for ($i=$inicio;$i<=$fim;$i++) {
		$saida .= '<td class="item"><a href="'.$url.'&pg='.$i.'"';
		if ($i==$pg) $saida .= ' class="ativo" ';
		$saida .= '>'.$i.'</a></td>';
	}
	$saida .= '<td class="proxima"><a href="'.($pg<$qt_paginas ? $url.'&pg='.($pg+1) : '#' ) . '">Pr&oacute;xima</a></td>';
	$saida .= '</tr></table>';


	$resultado = array(
		'sql'=>$sql,
		'pp'=>$pp,
		'pg'=>$pg,
		'total'=>$total,
		'qt_paginas'=>$qt_paginas,
		'total_consulta'=>$total_consulta,
		'paginacao'=>$saida,
		'consulta'=>$consulta
	);
	
	return $resultado;
		
}

# nomeDia: retorna o dia da semana (1-dom , 7-sáb)
function nomeDia($dia) { 
	switch($dia) {
		case 1: return "Domingo"; break;
		case 2: return "Segunda-feira"; break;
		case 3: return "Terça-feira"; break;
		case 4: return "Quarta-feira"; break;
		case 5: return "Quinta-feira"; break;
		case 6: return "Sexta-feira"; break;
		case 7: return "Sábado"; break;
	}			
}

# nomeMes: retorna o mês do ano
function nomeMes($mes,$full=false) { 
	switch($mes) {
		case 1: return ($full)?"Janeiro":"Jan"; break;
		case 2: return ($full)?"Fevereiro":"Fev"; break;
		case 3: return ($full)?"Março":"Mar"; break;
		case 4: return ($full)?"Abril":"Abr"; break;
		case 5: return ($full)?"Maio":"Mai"; break;
		case 6: return ($full)?"Junho":"Jun"; break;
		case 7: return ($full)?"Julho":"Jul"; break;
		case 8: return ($full)?"Agosto":"Ago"; break;
		case 9: return ($full)?"Setembro":"Set"; break;
		case 10: return ($full)?"Outubro":"Out"; break;
		case 11: return ($full)?"Novembro":"Nov"; break;
		case 12: return ($full)?"Dezembro":"Dez"; break;
	}			
}


# dateFormat: formata datas
function dateFormat($fonte,$origem='Y/m/d',$saida='d/m/Y'){
	$delimitador='/';
	if (strpos($fonte,"-")) $delimitador='-';
	if (strpos($fonte,".")) $delimitador='.';

	$fonte = explode(" ",$fonte);
	if (!empty($fonte[1])) $fonte[1] = ' '.$fonte[1];

	switch ($origem) {
		case 'd/m/Y':
			list($dia,$mes,$ano)=explode($delimitador,$fonte[0]);
			break;
		default:
			list($ano,$mes,$dia)=explode($delimitador,$fonte[0]);
			break;
	}
	
	switch ($saida) {
		case 'Y-m-d':
			$data= $ano."-".$mes."-".$dia.$fonte[1];
			break;
		default:
			$data= $dia."/".$mes."/".$ano.$fonte[1];
			break;
	}
	return $data;
}



?>