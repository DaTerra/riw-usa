<?
include('../../includes/Config.inc.php');
include('../../includes/Funcoes.php');


//exit($_POST['sql']);

$consulta1 = $DB->consulta($_POST['sql']);
$dados = array();
while($linha = $DB->lista($consulta1)){
	$dados[$linha['id_user']] = $DB->dados('SELECT * FROM tbhistory WHERE id_user='.$linha['id_user'].' ORDER BY date DESC LIMIT 1');
}


$consulta = $DB->consulta($_POST['sql']);

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");
header("Pragma: no-cache");
header("Expires: 0");

echo "First Name,Last Name, Title, Company, Type, Status, Last Msg,\n";

$saida='';
while($linha = $DB->lista($consulta)){
	$saida ="$linha[first_name], $linha[last_name], $linha[title],  $linha[company], $linha[usertype], $linha[userstatus],". $dados[$linha['id_user']]['action']."; \n";

	echo str_replace('[1]', 'Yes',str_replace('[0]', 'No', $saida));
	
}

?>