<?

/******************************************************************

	Processa todos os módulos / Carlos Brito - Adiante Desenvovimento Web

*******************************************************************/
	//print_r($_POST);exit;
	include('../sistema/includes/top.php');

	// Pegando as informações do módulo

	if(!empty($_POST['info'])) $informacoes = $_POST['info']; else if(!empty($_GET['info'])) $informacoes = $_GET['info'];

 	$a1 = explode(',', $informacoes);

 	$Info = array(); 

	foreach($a1 as $v){

		$linha = explode('=>', $v);

		$Info[$linha['0']]=$linha['1'];

	}

	$ID = $_POST['id'];



	foreach ($_POST as $a => $b){

		 $$a = @addslashes($b);

	}

	

	

//================================================ | Preencha os dad os corretamente| =======================================================================

	// Validar as informações

	$Arquivos = array('imagem');

	

	$Erro = '';


	if(!empty($chave) and empty($ID)){
		$Chave = $DB->dados('SELECT * FROM tbuser_keys WHERE chave="'.(string)$chave.'" LIMIT 1');
		
		if($Chave['id_key']>0) $Erro .= "<p> - This key ($chave) is already in use.</p>";
	}


	if($ID>0 and !empty($chave)){
		$Chave = $DB->dados('SELECT * FROM tbuser_keys WHERE chave="'.(string)$chave.'" AND id_user <> '.(int)$ID.' LIMIT 1');
		if($Chave['id_key']>0) $Erro .= "<p> - This key ($chave) is already in use.</p>";
	}


	//attending

	$events = '';

	foreach($_POST['id_event'] as $v){

		$events .=';'.$v;

	}

	$events .=';';

	

	

	// Industry

	$insdustry = '';

	foreach(@$_POST['id_typeindustry'] as $x){

		$insdustry1 .=';'.$x;

	}

	$insdustry1.=';';

	

	// interests/areas

	$interests = '';

	foreach(@$_POST['id_interest'] as $x){

		$interests .=';'.$x;

	}

	$interests.=';';

	

	

	// Preencha os dados no array

	$Dados = array('id_type'=>$id_type, 'id_status'=>$id_status, 'first_name'=>$first_name, 'last_name'=>$last_name, 'company'=>$company, 'title'=>$title, 'email'=>$email, 'phone'=>$phone, 'vip'=>$vip, 'city'=>$city, 'state'=>$state, 

					'country'=>$country, 'postal_code'=>$postal_code, 'address_line_1'=>$address_line_1, 'address_line_2'=>$address_line_2, 'address_line_3'=>$address_line_3, 'phone_work'=>$phone_work, 'fax'=>$fax, 'web_page'=>$web_page,

					'phone_mobile'=>$phone_mobile, 'public_profile'=>$public_profile, 'hotel_name'=>$hotel_name,	'hotel_payment'=>$hotel_payment, 'hotel_room_type'=>$hotel_room_type, 'hotel_gift_needed'=>$hotel_gift_needed,

					'hotel_arrival_date'=>$hotel_arrival_date, 'hotel_departure_date'=>$hotel_departure_date, 'transportation_to_event'=>$transportation_to_event, 	'transportation_notes'=>$transportation_notes, 

					'arrival_airport'=>$arrival_airport, 'arrival_flight'=>$arrival_flight, 'arrival_time'=>$arrival_time, 'arrival_transportation'=>$arrival_transportation, 'departure_airport'=>$departure_airport, 'departure_flight'=>$departure_flight,

					'departure_time'=>$departure_time, 'departure_notes'=>$departure_notes, 'email_updates'=>$email_updates, 'networking'=>$networking, 'attending'=>$events, 'entree'=>$entree, 'allergy'=>$allergy, 'allergy_details'=>$allergy_details, 'entree'=>$entree,

					'industry'=>$insdustry1,  'interests'=>$interests, 'registration_code'=>$registration_code);

	

	//print_r($Dados);exit;				

	

//=======================================================================================================================



	// Se for para cadastrar ou editar 

	if($Info['acao']=='cadastra' || $Info['acao']=='edita'){

		

		if(strlen($Erro)>0){ 

			$a = ($Info['acao']== 'cadastra')? 'cadastra' : 'edita-'.$Info['valorID'];



			header('Location: ../sistema.php?m='.$Info['modulo'].'&a='.$Info['acao'].'&id='.$ID.'&F='.urlencode($Erro));exit;
			

		}

		

		

		// Pegando imagem e arquivos

		foreach($Arquivos as $v){

			if(strlen($_FILES[$v]['name'])>0){

				$tipo = explode('/', $_FILES[$v]['type']);

				$nomeTemp = $_FILES[$v]['tmp_name'];

				$nome = nomeArquivo($_FILES[$v]['name']);

				// Se for imagem

				if($tipo[0]=='image'){

					

					

					

					/* Imagem grande */

					$img->carrega( $nomeTemp )		

					->hexa('#c8c8c8')

					->redimensiona( 920, 250, 'crop' )

					->grava('../../arquivos/'.$Info['pasta'].'/'.$nome);

					

					// _mini

					if($v =='imagem'){

						$img->carrega($nomeTemp)		

						->hexa('#ffffff')

						->redimensiona( 100, 65, 'redimensiona' )

						->grava('../../arquivos/'.$Info['pasta'].'/_mini/'.$nome);

					}

					

					$Dados[$v] = $nome;

					

				// Se não for imagem	

				}else{

					$arq = explode('.', $_FILES[$v]['name']);

					if(!in_array($arq['1'], array('php', 'htlm', 'htaccess'))){

						if(!move_uploaded_file($nomeTemp, '../../arquivos/'.$Info['pasta'].'/'.$nome)) exit('Erro no upload');

					}else{

						echo 'Arquivo inválido';

					}			

					

				}



			}#



		}



		if($id){



			foreach($Arquivos as $v){



				list($arquivo) = $DB->dados('SELECT '.$v.' FROM '.$Info['tabela'].' WHERE '.$Info['id_tabela'].'='.$id);



				if($arquivo and !empty($Dados[$v])){

					@unlink('../../arquivos/'.$Info['pasta'].'/'.$arquivo);

					@unlink('../../arquivos/'.$Info['pasta'].'/_mini/'.$arquivo);

				}

			}

			

			//exit($ID);

			

			$DB->insereArray($Info, $Dados, 'atualiza', $ID);
			$DB->consulta("DELETE FROM tbuser_keys WHERE id_user=$ID");
			$DB->insereArray(array( 'tabela'=>'tbuser_keys'), array('chave'=>$chave, 'id_user'=>$ID), 'cadastra', $ID);
		}else{
			//exit($chave);
			$DB->insereArray( $Info, $Dados, 'cadastra', $ID);
			$DB->insereArray(array( 'tabela'=>'tbuser_keys'), array('chave'=>$chave, 'id_user'=>$DB->lastInsertedId()), 'cadastra', $ID);
			$DB->insereArray( array('tabela'=>'tbhistory'), array('action'=>'Inserted by admin', 'id_user'=>$DB->lastInsertedId()), 'cadastra', $ID);

		}





		header('Location: ../sistema.php?m='.$Info['modulo'].'&a=lista&S='.urlencode('Success!'));exit;

	

	

	}# Fim cadastra ou edita

	

	

	// Apagando

	if($_GET['acao']== 'apaga'){



		foreach($Arquivos as $v){



			list($arquivo) = $DB->dados('SELECT '.$v.' FROM '.$Info['tabela'].' WHERE '.$Info['id_tabela'].'='.(int)$_GET['id']);

			@unlink('../../arquivos/'.$Info['pasta'].'/'.$arquivo);

			@unlink('../../arquivos/'.$Info['pasta'].'/_mini/'.$arquivo);

		}

		$DB->consulta('DELETE FROM '.$Info['tabela'].' WHERE '.$Info['id_tabela'].'='.(int)$_GET['id']);

	}

	

	// Apagando váfios registros

	if($_GET['acao']== 'apagaVarios'){



		foreach($_POST['cb'] as $id){

			foreach($Arquivos as $v){

				list($arquivo) = $DB->dados('SELECT '.$v.' FROM '.$Info['tabela'].' WHERE '.$Info['id_tabela'].'='.(int)$id);

				@unlink('../../arquivos/'.$Info['pasta'].'/'.$arquivo);

				@unlink('../../arquivos/'.$Info['pasta'].'/_mini/'.$arquivo);

			}

			$DB->consulta('DELETE FROM '.$Info['tabela'].' WHERE '.$Info['id_tabela'].'='.(int)$id);

		}

	}

	

	

	// Mudando o status

	if($_GET['acao']== 'status'){

		$status = $_GET['status'] ==1 ? 0 : 1;

		

		$DB->consulta('UPDATE '.$Info['tabela'].' SET status='.(int)$status.' WHERE '.$Info['id_tabela'].'='.(int)$_GET['id']);



		if($status==1){

			$mensagem = 'Ativado com sucesso!';

		}elseif($status==0){

			$mensagem = 'Desativado com sucesso!';

		}

		

	}





	// Apagando apenas um campo arquivo ou imagem

	if($Info['acao']=='apaga-arquivo'){

		list($arquivo) = $DB->dados('SELECT '.$_GET['campo-arquivo'].' FROM '.$Info['tabela'].' WHERE '.$Info['id_tabela'].'='.(int)$Info['valorID']);



		@unlink('../../arquivos/'.$Info['pasta'].'/'.$arquivo);

		@unlink('../../arquivos/'.$Info['pasta'].'/_mini/'.$arquivo);

		$Dados = array($_GET['campo-arquivo']=>'');

		$DB->insereArray($Info, $Dados, 'atualiza', $Info['valorID']);



		header('Location: ../sistema.php?m='.$Info['modulo'].'&a=edita&id='.$Info['valorID'].'&S='.urlencode('Arquivo removido com sucesso.'));exit;

	}

	//exit($mensagem);

	$mensagem = (strlen($mensagem)>1)? $mensagem:'Success';

		

	header('Location: ../sistema.php?m='.$Info['modulo'].'&a=lista&S='.urlencode($mensagem));exit;

?>