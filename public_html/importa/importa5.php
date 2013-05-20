<?
include('../includes/Config.inc.php');

$file = file_get_contents('RIW_Invitees_5.csv');

$arr = explode("\n", $file);

$x=0;


foreach($arr as $v){$x++;


	if($x>1){
		$celula = explode(';', $v);
		
		//print_r($celula);exit;

		$dados = array();
		$dados['id_status'] = 8;
		$dados['id_type'] = 1;
		$dados['id_list'] = 4;
		$dados['first_name'] =@addslashes($celula['0']);
		$dados['last_name'] = @addslashes($celula['1']);
		$dados['email'] = @addslashes($celula['2']);
		$dados['company'] = @addslashes($celula['3']);
		$dados['title'] = @addslashes($celula['4']);
		$dados['address_line_1'] = @addslashes($celula['5']);
		$dados['city'] = @addslashes($celula['6']);
		$dados['state'] = @addslashes($celula['7']);
		$dados['postal_code'] = @addslashes($celula['8']);
		$dados['phone_work'] = @addslashes($celula['6']);
		$dados['phone'] = @addslashes($celula['10']);		
		$dados['vip'] = 0;

		$DB->insereArray(array('tabela'=>'tbuser'), $dados, 'cadastra', $id);
		$DB->insereArray(array('tabela'=>'tbhistory'),array('id_user'=>$DB->lastInsertedId(), 'action'=>'Uploaded from the list  riw_invitees_5.'), 'cadastra', $id);
	
	}
	
}

echo ($x-1);
?>