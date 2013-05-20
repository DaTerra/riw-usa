<?	
if($_SESSION['adm_usuario']['id_usuario'] > 0){	}
else{
	header('Location: ../index.php?erro='.urlencode('Entre com usuario e senha.'));exit;
}
exit;
?>