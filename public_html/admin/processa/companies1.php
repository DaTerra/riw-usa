<?

/******************************************************************

	Processa todos os m�dulos / Carlos Brito - Adiante Desenvovimento Web

*******************************************************************/

	include('../sistema/includes/top.php');

	// Pegando as informa��es do m�dulo
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

	// Validar as informa��es

	$Arquivos = array('imagem');

	

	$Erro = '';

	//if(!(strlen($nome)>=5)){ $Erro .= '<p> - O campo "Titulo" deve conter no m�nimo 5 letras</p>';}




	//exit;


	// Preencha os dados no array

	$Dados = array('id_submit'=>$id_submit, 'titulo'=>$titulo);

	
//=======================================================================================================================



	// Se for para cadastrar ou editar 

	if($Info['acao']=='cadastra' || $Info['acao']=='edita'){

		

		if(strlen($Erro)>0){ 

			$a = ($Info['acao']== 'cadastra')? 'cadastra' : 'edita-'.$Info['valorID'];



			header('Location: ../sistema.php?m='.$Info['modulo'].'&a='.$Info['acao'].'&F='.urlencode($Erro));exit;

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

					

				// Se n�o for imagem	

				}else{

					$arq = explode('.', $_FILES[$v]['name']);

					if(!in_array($arq['1'], array('php', 'htlm', 'htaccess'))){

						if(!move_uploaded_file($nomeTemp, '../../arquivos/'.$Info['pasta'].'/'.$nome)) exit('Erro no upload');

					}else{

						echo 'Arquivo inv�lido';

					}			

					

				}



			}#



		}



		if($id){




			

			//exit($ID);

			//print_r($Dados);
			//exit('edita');
			$DB->insereArray($Info, $Dados, 'atualiza', $ID);
			
		}else{
			//exit('cadastra');
			$DB->insereArray( $Info, $Dados, 'cadastra', $ID);

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

	

	// Apagando v�fios registros

	if($_GET['acao']== 'apagaVarios'){



		foreach($_POST['selected'] as $id){

			foreach($Arquivos as $v){

				list($arquivo) = $DB->dados('SELECT '.$v.' FROM '.$Info['tabela'].' WHERE '.$Info['id_tabela'].'='.(int)$id);

				@unlink('../../arquivos/'.$Info['pasta'].'/'.$arquivo);

				@unlink('../../arquivos/'.$Info['pasta'].'/_mini/'.$arquivo);

			}

			$DB->consulta('DELETE FROM '.$Info['tabela'].' WHERE '.$Info['id_tabela'].'='.(int)$id);
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