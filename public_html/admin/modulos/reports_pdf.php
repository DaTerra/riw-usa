<?
//require('../../includes/WriteHTML.php');
include('../../includes/Config.inc.php');
include('../../includes/phpmail/class.phpmailer.php');
//include('../../includes/Funcoes.php');
require('../../includes/mc_table.php');


$consulta1 = $DB->consulta($_POST['sql']);
$dados = array();
while($linha = $DB->lista($consulta1)){
	$dados[$linha['id_user']] = $DB->dados('SELECT * FROM tbhistory WHERE id_user='.$linha['id_user'].' ORDER BY date DESC LIMIT 1');
}


$pdf=new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

$pdf->SetWidths(array(35,30,25,25, 20 ,20 ,30));
srand(microtime()*1000000);
$pdf->Row(array('First Name', 'Last Name', 'Title', 'Company', 'Type', 'Status', 'Last Msg'));
$consulta = $DB->consulta($_POST['sql']);

while($linha = $DB->lista($consulta))
	
	$pdf->Row(array($linha['first_name'], $linha['last_name'], $linha['title'], $linha['company'], $linha['usertype'], $linha['userstatus'], $dados[$linha['id_user']]['action']));
	$pdf->Output();


?>