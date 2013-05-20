<?php
// Configurando Módulo
$Modulo = array(
	'titulo'=>'Textos',
	'tabela'=>'tbtextos',
	'modulo'=>'textos',
	'pasta'=>'',
	'acao'=>$_GET['a'],
	'id_tabela'=>'id_texto',
	'icone'=>'noticias32x32.png',
);

// Configurando os campos
$Campos[] = array('tipo'=>10, 'tamanho'=>'m', 'label'=>'TITULO', 'campoTabela'=>'titulo', 'ops'=>false, 'comentario'=>'');
$Campos[] = array('tipo'=>8, 'tamanho'=>'m', 'label'=>'TEXTO (noticia)', 'campoTabela'=>'texto', 'ops'=>false, 'comentario'=>'Lorem inpsu dolor');

// Configurando os a listagem de registos
$SQL = 'SELECT * FROM '.$Modulo['tabela'].' WHERE 1';

$Acoes = false;
$Registros = array('titulo'=>'TITULO');

// Listamdp registros
if($_GET['a']=='lista' or empty($_GET['a'])){
	echo cabecalho($Modulo['icone'], $Modulo['titulo']);
	echo alertas($_GET);
	echo lista_registros1($Acoes, $Registros, $SQL, $Modulo);

// Criando os campos
}elseif($_GET['a']=='cadastra' or $_GET['a']=='edita'){
	$Dados = $DB->dados('SELECT * FROM '.$Modulo['tabela'].' WHERE '.$Modulo['id_tabela'].'='.(int)$_GET['id'].' LIMIT 1');
	
	$Dados['status'] = ($Dados[$Modulo['id_tabela']]>0)?$Dados['status']:1;
	
	echo cabecalho($Modulo['icone'], $Modulo['titulo']);
	echo alertas($_GET);
	echo cria_formulario($Campos, $Modulo, $Dados, $_GET['id']);
}?>

