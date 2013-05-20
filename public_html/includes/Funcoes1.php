<?

// Gera codigo (tamanho padrão 10)
function codigo($tamanho=10){
	return substr(md5(microtime()),0,$tamanho);
}



// Converter string para maiúsculo com acentos
function upper ($str) {
$LATIN_UC_CHARS = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝ°°ª";
$LATIN_LC_CHARS = "àáâãäåæçèéêëìíîïðñòóôõöøùúûüý°ºª";
$str = strtr ($str, $LATIN_LC_CHARS, $LATIN_UC_CHARS);
$str = strtoupper($str);
return $str;
}



// Define uma função que poderá ser usada para validar e-mails usando regexp
// Define uma função que poderá ser usada para validar e-mails usando regexp
function validaEmail($email){
 
 $valida = "/^[A-Za-z0-9]+([_.-][A-Za-z0-9]+)*@[A-Za-z0-9]+([_.-][A-Za-z0-9]+)*\\.[A-Za-z0-9]{2,4}$/";
 
 if (preg_match ($valida, $email)) {
        return true;
    } else {
        return false;
    }
}
	 
// Faz uma string menor de um texto, com determinado numero de caracteres...	 
function subTxt($texto, $tamanho=80){

	$texto1 = substr($texto, 0, $tamanho);
	
	if(strlen($texto)>$tamanho){
	
		$texto1 .='...';
	}
	return $texto1;
}

// Altertas do site

function AlertasJs($msg, $padrao="base64"){

 if(empty($msg)) return false;
 else
 return $msg = '<script>alert("'.base64_decode($msg).'")</script>';

}




// Banenrs
function Banner($arquivo, $dimensao){

	$caminho = explode('/', $arquivo);
	
	$abrir = $caminho[count($caminho)-1];
	$dimensao = explode('x', $dimensao);
	$aceita = array('swf', 'png', 'gif', 'jpg');
	$extencao = explode('.', $abrir);	
	
	if(in_array($extencao['1'], $aceita) and is_file('./'.$arquivo)){
		if($extencao['1']=='swf'){
			$saida ='<div style="width:'.$dimensao[0].'px; height:'.$dimensao[1].'px; overflow:hidden; margin:0 auto;">
					<object type="application/x-shockwave-flash" data="'.$arquivo.'" width="'.$dimensao[0].'" height="'.$dimensao[1].'">
						<param name="movie" value="'.$arquivo.'" />
					</object>
					</div>
					';
		}else{
			$saida = '<div style="width:'.$dimensao[0].'px; height:'.$dimensao[1].'px; overflow:hidden;"><img src="'.$arquivo.'" /></div>';	
		}
	}else{
		return false;	
	}
	return $saida;
}



// Função para listar registo
function paginacaoRegistos($SQL, $pagina=1, $qtd_registro){
	
	$paginaI = ($pagina<2)?$paginaI =0:($pagina*$qtd_registro)-$qtd_registro;
	
	$saida = $SQL." LIMIT $paginaI, $qtd_registro";
	return $saida;
}


// Função para cirar o menu de paginação

function paginacao($modulo, $DB){
	
	global $SQL, $qtd_registro, $pagina;

	if($pagina<1) $pagina=1;

	$consulta1 = $DB->consulta($SQL) or die('Erro na consulta de paginação! =/');
	$ultima= ceil($DB->nun_linhas($consulta1)/$qtd_registro);

	$saida = '<div id="site-paginacao">
	<ul>
		<li id="paginacao-primeira-pagina"><a title="Primeira Página" href="/'.$modulo.'/1">Primeira Página</a></li>
		<li id="paginacao-volta-uma"><a title="Página Anterior" href="/'.$modulo.'/'.($pagina-1).'">Voltar uma Página</a></li>
		<li id="paginacao-ativa" ><a title="" href="/'.$modulo.'/'.$pagina.'">'.$pagina.'</a></li>
		';

		if($pagina>1){
		$saida .='<li class="paginacao-pagina-numeros"><a title="" href="/'.$modulo.'/'.($pagina+1).'">'.($pagina+1).'</a></li>
		<li class="paginacao-pagina-numeros"><a title="" href="/'.$modulo.'/'.($pagina+2).'">'.($pagina+2).'</a></li>';
		}
		
		$avanca1 = ($ultima>1) ? '/'.$modulo.'/'.($pagina+1): 'javascript:void(0);';
		$ultimapg = ($ultima>1) ? '/'.$modulo.'/'.$ultima : 'javascript:void(0);';
		
		$saida .='<li id="paginacao-avanca-uma"><a title="Próxima Página" href="'.$avanca1.'">Avançar uma Página</a></li>
	<li id="paginacao-ultima-pagina"><a title="Última Página" href="'.$ultimapg.'">Última Página</a></li>
	';
	$saida .= '</ul></div>';
	echo $saida;
}



function tratar_arquivo_upload($string){
   // pegando a extensao do arquivo
   $partes 		= explode(".", $string);
   $extensao 		= $partes[count($partes)-1];	
   // somente o nome do arquivo
   $nome			= preg_replace('/\.[^.]*$/', '', $string);	
   // removendo simbolos, acentos etc
   $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýýþÿRr?';
   $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuuyybyRr-';
   $nome = strtr($nome, utf8_decode($a), $b);
   $nome = str_replace(".","-",$nome);
   $nome = preg_replace( "/[^0-9a-zA-Z\.]+/",'-',$nome);
   return utf8_decode(strtolower($nome.".".$extensao));
}





?>