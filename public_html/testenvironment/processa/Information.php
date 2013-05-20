<?php


	include('../includes/Config.inc.php');

	include('../includes/phpmail/class.phpmailer.php');

	include('../includes/Funcoes.php');

	 function nomeArquivo($nome){
		$separa = explode('.', $nome);
		$nome = strtolower(preg_replace("[^a-zA-Z0-9_.]", "", strtr($separa['0'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_")));
		return md5($nome.time()).'.'.$separa['1'];
	 }

	foreach ($_POST as $a => $b){

	 $$a = @addslashes($b);

	}

	$pasta = codigo(15);
	mkdir('../files/information/'.$pasta, 0777);

	// Dados
	
	$Dados = array('first_name'=>$first_name, 'last_name'=>$last_name, 'company'=>$company, 'title'=>$title, 'email'=>$email, 'company_contact_name'=>$company_contact_name, 'contact_email'=>$contact_email, 'company_website'=>$company_website, 'year_founded'=>$year_founded,
	'number_employees'=>$number_employees, 'location'=>$location, 'company_description'=>$company_description, 'twitter'=>$twitter, 'facebook'=>$facebook, 'google'=>$google,
	'you_tube'=>$you_tube, 'speaker_name'=>$speaker_name, 'speaker_bio'=>$speaker_bio, 'presentation_title'=>$presentation_title, 'presentation'=>$presentation, 'interested_speaking'=>$interested_speaking,
	'success_stories'=>$success_stories, 'speaker_twitter'=>$speaker_twitter, 'text1'=>$text1, 'text2'=>$text2, 'text3'=>$text3, 'text4'=>$text4, 'text5'=>$text5, 'text6'=>$text6, 'pasta'=>$pasta);
	
	
	// Movendo os files
	$Arquivos = array('profile_photo', 'company_logo');
	
	//print_r($_FILES['company_videos']['name']);exit;
	foreach($Arquivos as $v){
			$tipo = explode('/', $_FILES[$v]['type']);
			$nomeTemp = $_FILES[$v]['tmp_name'];
			$nome = nomeArquivo($_FILES[$v]['name']);
			
			move_uploaded_file($nomeTemp, '../files/information/'.$pasta.'/'.$nome);
			$Dados[$v] = $nome;
	}
	
	
	
	$DB->insereArray( array('tabela'=>'tbinformation'), $Dados, 'cadastra', $ID);
	
	$id_info = $DB->lastInsertedId();
	
	// Arquivos de apresentação
	foreach($_FILES['presentation_file']['name'] as $c => $present){
			
			$tipo = explode('/', $_FILES['presentation_file']['type'][$c]);
			$nomeTemp = $_FILES['presentation_file']['tmp_name'][$c];
			$nome = nomeArquivo($present);
			if(!move_uploaded_file($nomeTemp, '../files/information/'.$pasta.'/'.$nome)){exit('erro in presentation');}
			$DB->insereArray( array('tabela'=>'tbinfo_presentation'), array('id_info'=>$id_info, 'file'=>$nome), 'cadastra', $ID);
	}

	// Arquivos videos
	foreach($_FILES['company_videos']['name'] as $c => $file){
			
			$tipo = explode('/', $_FILES['company_videos']['type'][$c]);
			$nomeTemp = $_FILES['company_videos']['tmp_name'][$c];
			$nome = nomeArquivo($file);
			if(!move_uploaded_file($nomeTemp, '../files/information/'.$pasta.'/'.$nome)){exit('erro in presentation');}
			$DB->insereArray( array('tabela'=>'tbinformation_videos'), array('id_info'=>$id_info, 'file'=>$nome), 'cadastra', $ID);
	}

	// Arquivos products
	foreach($_FILES['product_photos']['name'] as $c => $file){
			
			$tipo = explode('/', $_FILES['product_photos']['type'][$c]);
			$nomeTemp = $_FILES['product_photos']['tmp_name'][$c];
			$nome = nomeArquivo($file);
			if(!move_uploaded_file($nomeTemp, '../files/information/'.$pasta.'/'.$nome)){exit('erro in videos');}
			$DB->insereArray( array('tabela'=>'tbinfo_products'), array('id_info'=>$id_info, 'file'=>$nome), 'cadastra', $ID);
	}

	
	
	
	
	
	/*//print_r($Dados);
	echo '<pre>';
	print_r($_FILES);
	echo '</pre>';*/
	exit; 




	header('Location: ../alert/?msg='.urlencode('Content Submission complete!'));exit;
?>