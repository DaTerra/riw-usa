<?php

	@session_start();
	@ob_start();

	# Encoding
	header('Content-type: text/html; charset=iso-8859-1'); 
	header('Content-Encoding: iso-8859-1'); 

	# Timezone
	date_default_timezone_set("");

	# Banco de Dados
	define(BD_SERVIDOR, 'localhost');
	define(BD_USUARIO, 	'riw2012');
	define(BD_SENHA, 	'RUSTerra1');
	define(BD_BANCO, 	'riw2012_db');

	# Ininciando Banco de Dados
	global $mysql;
	$mysql = new Banco(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
	//$mysql = new Banco('localhost', 'root', 'adiante123', 'globalwealth');

	# Constantes
	
	# Constantes
	define(CONF_EMAIL, 'you@daterraweb.com', true);
	define(SITE_ID, 	1);
	define(DOMINIO, 	'rusnano');
	define(BASE, 		'/');
	define(BASE_PATH, 	'/');
	define(ADMIN_URL, 	'/');
	define(ADMIN_PATH, 	BASE_PATH.'/admin/');
	define(SITE_NOME, 	'RIW 2012');
	define(SITE_EMAIL, 	'you@daterraweb.com');
	define(LINGUA,		'en');
	define(VERSAO,		'1.0');
	define(SITEKEY,		'b7fc873b1dbb5e75bfdae875f1e600bbb63cef72');


	# Senha
	function senha($s) {
		return md5( md5($s) . SITEKEY );
	}


?>