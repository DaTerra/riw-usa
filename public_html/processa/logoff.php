<?

	include('../includes/Config.inc.php');


	unset($_SESSION['site_agenda']);

	header('Location: ../meetings/?erro='.urlencode('You have been disconnected.'));exit;
?>

