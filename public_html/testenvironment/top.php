<?
	include('./includes/Config.inc.php');
	include('./includes/Funcoes.php');
	//include('./includes/mail.php');
	
	
	$url = explode('/', substr($_SERVER['REQUEST_URI'], strpos('/',$_SERVER['REQUEST_URI'] )+1,strlen($_SERVER['REQUEST_URI'])));


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

