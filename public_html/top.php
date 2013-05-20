<?
	include('./includes/Config.inc.php');
	include('./includes/Funcoes.php');
	//include('./includes/mail.php');
	
	
	$uri = $_SERVER['REQUEST_URI'];
	if (strpos($uri,'?')) {
		$uri = substr($uri,0,strpos($uri,'?'));
	}

	$url = explode('/', substr($uri, strpos('/',$uri )+1,strlen($uri)));


	switch($url['0']){
		case 'empresa':
			$urlpagina = 'empresa';
			break;
		
		case 'atividades':
			$urlpagina = 'atividades';
			break;
		
		case 'filosofia':
			$urlpagina = 'filosofia';
			break;
		
		case 'noticias':
			$urlpagina = 'noticias';
			break;
		
		case 'links':
			$urlpagina = 'links';
			break;
		
		case 'indicadores':
			$urlpagina = 'indicadores';
			break;
		
		case 'contato':
			$urlpagina = 'contato';
			break;
		
		default:
		$urlpagina = 'home';
	}

	$header_seo = $DB->dados('SELECT * FROM TBAA_OTIMIZACAO WHERE urlpagina="'.$urlpagina.'" LIMIT 1');
?>

