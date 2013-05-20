<?php
	//print_r($_POST);exit;
	include('../includes/Config.inc.php');
	#include('../includes/phpmail/class.phpmailer.php');
	include('../includes/Funcoes.php');

	foreach ($_POST as $a => $b){
	 $$a = @addslashes($b);
	}
	$origem = '/save-the-date';
	// Validando os campos necessarios
	$erro = '';
	if(!(strlen($first_name)>3)) $erro.= '- First Name <br />';
	if(!(strlen($last_name)>3)) $erro.= '- Last Name <br />';	
	if(strlen($erro)>0){
		header('Location: ..'.$origem.'/?erro='.urlencode('<strong>Please fill in the mandatory fields.:</strong><br />'.$erro));exit;
	}	
	//Verifica se o e-mail ja existe no banco de dados
	$veridica = $DB->dados('SELECT * FROM tbuser_2013 WHERE email="'.(string)$email.'" LIMIT 1');
	if($veridica['id_user']>0){
		header('Location: ..'.$origem.'/?erro='.urlencode('This E-mail is already registered.'));exit;
	}
	// events
	$events = '';
	foreach($_POST['id_events'] as $v){
		$events .=';'.$v;
	}
	$events .=';';
	// events
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
	$id_type = (strpos($insdustry1, ';12;')===false)?1:2;
	// Preparando os dados no array
	$Dados = array('first_name'=>$first_name, 'last_name'=>$last_name, 'company'=>$company, 'title'=>$title, 'email'=>$email, 'phone'=>$phone, 'city'=>$city, 'state'=>$state, 'country'=>$country, 'postal_code'=>$postal_code, 'unsubscribe'=>$unsubscribe,'attending'=>$events,'industry'=>$insdustry1, 'interests'=>$interests);
	$DB->insereArray( array('tabela'=>'tbuser_2013'), $Dados, 'cadastra', $ID);
	$id_user = $DB->lastInsertedId();	
	$DB->insereArray( array('tabela'=>'tbhistory_2013'), array('id_user'=>$id_user, 'action'=>"$first_name $last_name has filled up the save the date form"), 'cadastra', $ID);
	header('Location: ..'.$origem.'/?suc='.urlencode('Thank you. Your request has been sent!'));exit;
?>