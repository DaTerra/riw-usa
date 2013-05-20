<?php
	ob_start();
	session_start();
	include('db.class.php');
				// Bancao  | sevidor   | usuario | senha
	$DB = new DB('riw2012_db', 'localhost', 'riw2012', 'RUSTerra1' );
	
	define(SITENOME, 'RIW 2012');
	define(DOMINIO, 'riw2012');
	define(EMAILPRINCIPAL, '');
?>
