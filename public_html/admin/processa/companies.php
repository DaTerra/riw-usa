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

	$Arquivos = array('company_logo');

	$Erro = '';

	// Dados
	$Dados = array('company'=>$company, 'contact_email'=>$contact_email, 'company_website'=>$company_website, 'year_founded'=>$year_founded, 'number_employees'=>$number_employees, 'location'=>$location, 'company_description'=>$company_description, 'twitter'=>$twitter, 'facebook'=>$facebook, 'google'=>$google, 'you_tube'=>$you_tube, 
					'text1'=>$text1, 'text2'=>$text2, 'text3'=>$text3, 'text4'=>$text4, 'text5'=>$text5, 'text6'=>$text6);



//=======================================================================================================================

	// Se for para cadastrar ou editar 

	if($Info['acao']=='cadastra' || $Info['acao']=='edita'){

	
		if(empty($pasta)){
			$pasta = codigo(15);
			mkdir('../../files/compay_submit/'.$pasta, 0777);
			$Dados['pasta'] = $pasta;
		}

		if(strlen($Erro)>0){ 

			$a = ($Info['acao']== 'cadastra')? 'cadastra' : 'edita-'.$Info['valorID'];



			header('Location: ../sistema.php?m='.$Info['modulo'].'&a='.$Info['acao'].'&id='.$ID.'&F='.urlencode($Erro));exit;
			

		}

	//==========================================
	
	//company_logo
	if(!empty($_FILES['company_logo']['tmp_name'])){
			$tipo = explode('/', $_FILES['company_logo']['type']);
			$nomeTemp = $_FILES['company_logo']['tmp_name'];
			$nome = nomeArquivo1($_FILES['company_logo']['name']);
			
			move_uploaded_file($nomeTemp, '../../files/compay_submit/'.$pasta.'/'.$nome);
			$Dados['company_logo'] = $nome;
	}
	
	if($id){

		$DB->insereArray($Info, $Dados, 'atualiza', $ID);
		$id_info = $ID;
	}else{
		$DB->insereArray( $Info, $Dados, 'cadastra', $ID);
		$id_info = $DB->lastInsertedId();
	}
	
	
	// Arquivos de apresentação
	if(strlen($_FILES['presentation_file']['name'][0])>0){
		foreach($_FILES['presentation_file']['name'] as $c => $present){
				
				$tipo = explode('/', $_FILES['presentation_file']['type'][$c]);
				$nomeTemp = $_FILES['presentation_file']['tmp_name'][$c];
				$nome = nomeArquivo1($present);
				if(!move_uploaded_file($nomeTemp, '../../files/compay_submit/'.$pasta.'/'.$nome)){exit('erro in presentation');}
				$DB->insereArray( array('tabela'=>'tbcompany_presentation'), array('id_info'=>$id_info, 'file'=>$nome), 'cadastra', $ID);
		}
	}
	// Arquivos videos
	if(strlen($_FILES['company_videos']['name'][0])>0){
		foreach($_FILES['company_videos']['name'] as $c => $file){
				
				$tipo = explode('/', $_FILES['company_videos']['type'][$c]);
				$nomeTemp = $_FILES['company_videos']['tmp_name'][$c];
				$nome = nomeArquivo1($file);
				if(!move_uploaded_file($nomeTemp, '../../files/compay_submit/'.$pasta.'/'.$nome)){exit('erro in presentation');}
				$DB->insereArray( array('tabela'=>'tbcompany_videos'), array('id_info'=>$id_info, 'file'=>$nome), 'cadastra', $ID);
		}
	}
	// Arquivos products
	if(strlen($_FILES['product_photos']['name'][0])>0){

		foreach($_FILES['product_photos']['name'] as $c => $file){
				
				$tipo = explode('/', $_FILES['product_photos']['type'][$c]);
				$nomeTemp = $_FILES['product_photos']['tmp_name'][$c];
				$nome = nomeArquivo1($file);
				if(!move_uploaded_file($nomeTemp, '../../files/compay_submit/'.$pasta.'/'.$nome)){exit('erro in videos');}
				$DB->insereArray( array('tabela'=>'tbcompany_products'), array('id_info'=>$id_info, 'file'=>$nome), 'cadastra', $ID);
		}
	}
	
	
	
	//===================================	



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

		foreach($_POST['selected'] as $id){


			$dados = $DB->dados('SELECT * FROM tbcompany_information WHERE id_info ='.(int)$id);
			if(removeTree('../../files/compay_submit/'.$dados['pasta'])); else die('');

			$DB->consulta('DELETE FROM tbcompany_information WHERE id_info='.(int)$id);
			$DB->consulta('DELETE FROM tbcompany_presentation WHERE id_info='.(int)$id);
			$DB->consulta('DELETE FROM tbcompany_products WHERE id_info='.(int)$id);
			$DB->consulta('DELETE FROM tbcompany_videos WHERE id_info='.(int)$id);
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

	if($_GET['acao']=='apaga-arquivo'){

		$flile = $DB->dados('SELECT * FROM '.$_GET['tabela'].' WHERE id_file='.(int)$_GET['id_file']);


		@unlink('../../flies/compay_submit/'.$_GET['pasta'].'/'.$flile['file']);


		$DB->consulta('DELETE FROM '.$_GET['tabela'].' WHERE id_file='.(int)$_GET['id_file']);
		
		header('Location: ../sistema.php?m=companies&a=edita&id='.$_GET['id'].'&S='.urlencode('Success'));exit;
	}

	//exit($mensagem);

	$mensagem = (strlen($mensagem)>1)? $mensagem:'Success';

		

	header('Location: ../sistema.php?m='.$Info['modulo'].'&a=lista&S='.urlencode($mensagem));exit;

?>