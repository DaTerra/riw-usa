<?php

	include('../../includes/Config.inc.php');
	include('../../includes/phpmail/class.phpmailer.php');
	include('../../includes/Funcoes.php');


	if($_POST['id_user']>0){
		//exit('-');
		$DB->insereArray( array('tabela'=>'tbhistory'), array('id_user'=>$_POST['id_user'], 'action'=>$_POST['note']), 'cadastra', $ID);
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Contact History</title>
<script type="text/javascript" src="../sistema/js/jquery-v1.7.1.js"></script>
<style type="text/css">
	*{ padding:0; margin:0;}
	body{ font-size:12px; color:#333;}
	#geral{ width:500px; margin:0 auto; padding-top:15px;}
	h1{ font-size:20px;}
	.limpar{ clear:both;}
	#add_text{ margin-bottom:15px;}
	#add_text button{ width:80px; height:30px; margin-top:10px;}
	#text textarea{ width:300px; height:100px; border:1px solid  #ccc; padding:5px;}
	ul li{ list-style:none; margin-bottom:10px; border-top:1px dotted #ccc;}
</style>
</head>

<body>
<div id="geral">
	<h1>Add a note:</h1>
    <div id="add_text">
        <form action="" method="post">
        	<input type="hidden" name="id_user" value="<?=$_GET['id']?>" />
        	<div id="text"><textarea name="note"></textarea></div>
        	<button type="submit">Add note</button>
        </form>
	</div>
    
    <div class="limpar"></div>
    
    
    <ul>
	<?
		$id = $_GET['id'];
    	$consulta = $DB->consulta('SELECT * FROM tbhistory WHERE id_user='.(int)$id.' ORDER BY date DESC');
		
		while($linha = $DB->lista($consulta)){
	?>
    
    	<li><i><?=$linha['date']?></i> - <strong><?=$linha['action']?></strong></li>
        <? }?>
    </ul>
    
    
    
    
</div>

</body>
</html>
