<?php

	@session_start();
	@ob_start();

	# Encoding
	header('Content-type: text/html; charset=iso-8859-1'); 
	header('Content-Encoding: iso-8859-1'); 

	# Timezone
	date_default_timezone_set("");

	# Banco de Dados
	define(BD_SERVIDOR, 'riw2012.db.7767961.hostedresource.com');
	define(BD_USUARIO, 	'riw2012');
	define(BD_SENHA, 	'RUSTerra1');
	define(BD_BANCO, 	'riw2012');

	# Ininciando Banco de Dados
	global $mysql;
	$mysql = new Banco(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
	//$mysql = new Banco('localhost', 'root', 'adiante123', 'globalwealth');

	# Constantes
	define(SITE_ID, 	1);
	define(DOMINIO, 	'GWP');
	define(BASE, 		'/');
	define(BASE_PATH, 	'/projetos/Dominios/globalwealthpartnersinc.com/');
	define(ADMIN_URL, 	'/admin/');
	define(ADMIN_PATH, 	BASE_PATH.'/admin/');
	define(SITE_NOME, 	'Global Wealth Partnersinc');
	define(SITE_EMAIL, 	'suporte@impactaweb.com.br');
	define(LINGUA,		'pt');
	define(VERSAO,		'1.0');
	define(SITEKEY,		'b7fc873b1dbb5e75bfdae875f1e600bbb63cef72');


	# Senha
	function senha($s) {
		return md5( md5($s) . SITEKEY );
	}


?>