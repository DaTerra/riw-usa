<?php


	include('../includes/Config.inc.php');

	include('../includes/phpmail/class.phpmailer.php');

	include('../includes/Funcoes.php');

	 function nomeArquivo($nome){
		$separa = explode('.', $nome);
		$nome = strtolower(preg_replace("[^a-zA-Z0-9_.]", "", strtr($separa['0'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_")));
		return md5($nome.time()).'.'.$separa['1'];
	 }

	//echo strlen($_FILES['profile_photo']['name']);exit;
	//print_r($_FILES);exit;
	$Erro = '';	
	if((strlen($_FILES['profile_photo']['name'])>0) and !in_array($_FILES['profile_photo']['type'], array('image/jpeg', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/png', 'image/tiff'))){
		$Erro = '<p>Profile Photo: You can only upload files .jpg, .jpeg, .svg</p>';	
	}

	if($_FILES['profile_photo']['size']>300){
		//$Erro = 'Imagem acima de 300 kb';	
	}

	//
	if((strlen($_FILES['company_logo']['name'])>0) and !in_array($_FILES['company_logo']['type'], array('image/jpeg', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/png', 'image/png', 'image/tiff'))){
		$Erro = '<p>Company Logo: You can only upload files .jpg, .jpeg, .svg</p>';	
	}

	if($_FILES['company_logo']['size']>300){
		//$Erro .= 'Imagem acima de 300 kb';	
	}
	
	
	if(strlen($_FILES['presentation_file']['name'][0])>0){
		foreach($_FILES['presentation_file']['name'] as $c=>$v){
			
			if(!in_array($_FILES['presentation_file']['type'][$c], array('application/pdf', 'application/ppt', 'application/pptx'))){
				$erropresent= true;	
			}
		}
		
		if($erropresent){
			$Erro .= '- Presentation: You can only upload files .pdf, .ptt, .pptx <br />';
		}
	}
	
	
	if(strlen($_FILES['company_videos']['name'][0])>0){
		foreach($_FILES['company_videos']['name'] as $c=>$v){
			
			if(!in_array($_FILES['company_videos']['type'][$c], array('video/mp4', 'video/mov', 'video/wmv'))){
			$errov = true;		
			}
			
		}
		if($errov){
				$Erro .= '- Company videos: You can only upload files .mp4, .mov, .wmv ';	

		}
	}
	
	
	if(strlen($_FILES['product_photos']['name'][0])>0){
		foreach($_FILES['product_photos']['name'] as $c=>$v){
			
			if(!in_array($_FILES['product_photos']['type'][$c], array('image/jpeg', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/png', 'image/tiff'))){
				$erroF = true;
			}
			
		}
		if($erroF){
				$Erro .= '<p>Product photos: You can only upload files .jpg, .jpeg, .svg</p>';	
		}
	}
	
	
	if(strlen($Erro)>0){
		header('Location: ../submit/?erro='.urlencode($Erro));exit;
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
	if(strlen($_FILES['presentation_file']['name'][0])>0){
		foreach($_FILES['presentation_file']['name'] as $c => $present){
				
				$tipo = explode('/', $_FILES['presentation_file']['type'][$c]);
				$nomeTemp = $_FILES['presentation_file']['tmp_name'][$c];
				$nome = nomeArquivo($present);
				if(!move_uploaded_file($nomeTemp, '../files/information/'.$pasta.'/'.$nome)){exit('erro in presentation');}
				$DB->insereArray( array('tabela'=>'tbinfo_presentation'), array('id_info'=>$id_info, 'file'=>$nome), 'cadastra', $ID);
		}
	}

	// Arquivos videos
	if(strlen($_FILES['company_videos']['name'][0])>0){
		foreach($_FILES['company_videos']['name'] as $c => $file){
				
				$tipo = explode('/', $_FILES['company_videos']['type'][$c]);
				$nomeTemp = $_FILES['company_videos']['tmp_name'][$c];
				$nome = nomeArquivo($file);
				if(!move_uploaded_file($nomeTemp, '../files/information/'.$pasta.'/'.$nome)){exit('erro in presentation');}
				$DB->insereArray( array('tabela'=>'tbinformation_videos'), array('id_info'=>$id_info, 'file'=>$nome), 'cadastra', $ID);
		}
	}

	// Arquivos products
	if(strlen($_FILES['product_photos']['name'][0])>0){

		foreach($_FILES['product_photos']['name'] as $c => $file){
				
				$tipo = explode('/', $_FILES['product_photos']['type'][$c]);
				$nomeTemp = $_FILES['product_photos']['tmp_name'][$c];
				$nome = nomeArquivo($file);
				if(!move_uploaded_file($nomeTemp, '../files/information/'.$pasta.'/'.$nome)){exit('erro in videos');}
				$DB->insereArray( array('tabela'=>'tbinfo_products'), array('id_info'=>$id_info, 'file'=>$nome), 'cadastra', $ID);
		}
	}

	
	
	
	
	
	/*//print_r($Dados);
	echo '<pre>';
	print_r($_FILES);
	echo '</pre>';*/
	//exit; 



	//exit('fim');
	header('Location: ../alert/?msg='.urlencode('Content Submission complete!'));exit;
?>