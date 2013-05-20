<?php
/*
	Adiante Soluções Web
*/
// Lista registros de um módulo
function lista_registros($acoes, $campos, $SQL, $Modulo, $metodo='post'){
	// Informações do Módulo
	$informacoes = '';
	while($linha = each($Modulo)){
		$informacoes.=$linha['key'].'=>'.$linha['value'].',';
	}

	//Pegando os campos
	foreach($campos as $campo){
		$campostd.='<th>'.$campo.'</th>';
	}	

	$qtd = mysql_fetch_array(mysql_query('SELECT count( * ) AS qtd FROM '.$Modulo['tabela']));
	$consulta = mysql_query($SQL);
	
	$saida = '<div id="modulos_lista_registros">';
	if(mysql_num_rows($consulta)>0){
		$saida .= '<form name="registros" onsubmit="return em_massa(this);" method="'.$metodo.'" action="./processa/'.$Modulo['modulo'].'.php?acao=apagaVarios">
		<input type="hidden" name="info" value="'.$informacoes.'" />
		<table id="tabela_lista_registros" cellpadding="5px" cellspacing="0" border="0">
			<tr id="lista_campos_borda_sup">
				<td class="th_check"><input title="Marcar todos os registros" type="checkbox" value="0" class="selectAll"></td>
				'.$campostd.'
				</tr>';
		$x=0;		
		while($linha = mysql_fetch_assoc($consulta)){$x++;
			
			// Montando os registros
			$registro='';
			$y=0;
			foreach($campos as $c=>$v){$y++;
				if($y==1){
					$registro.='<td onmouseover="mostra_acoes(\'registo'.$x.'\', \'show\')" onmouseout="mostra_acoes(\'registo'.$x.'\', \'hide\')">';
					// 1 - Edita | 2- apaga | 3 - Status | 4 - Fotos
						$registro.='<a class="registo_titulo" href="?m='.$Modulo['modulo'].'&a=edita&id='.$linha[$Modulo['id_tabela']].'">'.$linha[$c].'</a><br />';
						$registro.='<div class="td_acoes" style="padding-top:8px; margin-bottom:-10px; height:15px;">
						<span id="registo'.$x.'" style="display:none;" >';
					foreach( $acoes as $aco){
						switch ($aco){
							
							case '1':
								$registro.='<a class="td_bt_editar" title="Editar" href="?m='.$Modulo['modulo'].'&a=edita&id='.$linha[$Modulo['id_tabela']].'">Editar</a>&nbsp;';
								break;
							case '2':
								$registro.='|&nbsp;<a title="Apagar definitivamente este registo" class="td_bt_excluir" href="javascript:void(0)" onclick="confirma('.$linha[$Modulo['id_tabela']].');">Excluir</a>&nbsp;';
								break;
							case '3':
								if($linha['status']==1){
									$registro.='|&nbsp;<a href="./processa/'.$Modulo['modulo'].'.php?acao=status&info='.$informacoes.'&id='.$linha[$Modulo['id_tabela']].'&status='.$linha['status'].'">Desativar</a>';
								}else{
									$registro.='|&nbsp;<a href="./processa/'.$Modulo['modulo'].'.php?acao=status&info='.$informacoes.'&id='.$linha[$Modulo['id_tabela']].'&status='.$linha['status'].'">Ativar</a>';
								}
								break;
							case '4':
								$registro.='&nbsp;|&nbsp;<a title="Adicionar Fotos" class="td_bt_fotos" href="?m='.$Modulo['modulo'].'_fotos&id=&id='.$linha[$Modulo['id_tabela']].'">Fotos</a>&nbsp;';
							break;
						}
					}
					$registro.='</span></div></td>';
				}else{
				$registro.='<td>'.$linha[$c].'</td>';
				}
			}

			$saida .='<tr style="height:50px; line-height:10px;';
			if($x%2==0 and $linha['status']==1) $saida .='background:#F7F7F7;">'; elseif($linha['status']==0)$saida .='background:#FFF2F2;">'; else $saida .='">';
			$saida .='<td class="th_check"><input type="checkbox" class="chM" value="'.$linha[$Modulo['id_tabela']].'" name="cb[]" /></td>';
			$saida .=$registro;
			$saida .='</tr>';	
		}
		$saida .='</table>';
		$saida .= '<div id="registos_borda_acoes">
            	<div id="borda_marcar_todos">
                	<a onclick="marcar_todos()" href="javascript:void(0)">Marcar todos</a>
               	</div>
                <div id="borda_acao_massa">
                	<span>Aplicar aos marcados:&nbsp;</span>
                    <ul>
                    	<!--<li><a title="Excluir registos selecionados" href="javascript:void(0)" onclick="em_massa()">Excluir</a></li>-->
                    	<li><button title="Excluir registos selecionados" type="submit">Excluir</button></li>
                    </ul>
                </div>
                
                <div id="registos_numero_registors">Total de <strong>'.$qtd['qtd'].'</strong> registos</div>
				<script type="text/javascript">function confirma(n){ if(confirm("Deseja mesmo apagar? Isso não poderá ser desfeito.")){ window.location = "./processa/'.$Modulo['modulo'].'.php?acao=apaga&info='.$informacoes.'&id="+n;}else{ return false;}}</script>            </div>
		</div>';
	}else{
		$saida ='<div id="listagem_sem_registros"><p>Nenhum registro cadastrado no momento.</p></div>';
	}
	
 return $saida;	
}
function lista_registros1($acoes, $campos, $SQL, $Modulo, $metodo='post'){
	// Informações do Módulo
	$informacoes = '';
	while($linha = each($Modulo)){
		$informacoes.=$linha['key'].'=>'.$linha['value'].',';
	}

	//Pegando os campos
	foreach($campos as $campo){
		$campostd.='<th>&nbsp;&nbsp;'.$campo.'</th>';
	}	

	$qtd = mysql_fetch_array(mysql_query('SELECT count( * ) AS qtd FROM '.$Modulo['tabela']));
	$consulta = mysql_query($SQL);
	
	$saida = '<div id="modulos_lista_registros">';
	if(mysql_num_rows($consulta)>0){
		$saida .= '<form name="registros" onsubmit="return em_massa(this);" method="'.$metodo.'" action="./processa/'.$Modulo['modulo'].'.php?acao=apagaVarios">
		<input type="hidden" name="info" value="'.$informacoes.'" />
		<table id="tabela_lista_registros" cellpadding="5px" cellspacing="0" border="0">
			<tr id="lista_campos_borda_sup">
				'.$campostd.'
				</tr>';
		$x=0;		
		while($linha = mysql_fetch_assoc($consulta)){$x++;
			
			// Montando os registros
			$registro='';
			$y=0;
			foreach($campos as $c=>$v){$y++;
				if($y==1){
					$registro.='<td onmouseover="mostra_acoes(\'registo'.$x.'\', \'show\')" onmouseout="mostra_acoes(\'registo'.$x.'\', \'hide\')"><a class="registo_titulo" href="?m='.$Modulo['modulo'].'&a=edita&id='.$linha[$Modulo['id_tabela']].'">&nbsp;&nbsp;'.$linha[$c].'</a><br /><div class="td_acoes" style="padding-top:8px; margin-bottom:-10px; height:15px;"><span id="registo'.$x.'" style="display:none;" ><a class="td_bt_editar" title="Editar" href="?m='.$Modulo['modulo'].'&a=edita&id='.$linha[$Modulo['id_tabela']].'">&nbsp;&nbsp;Editar</a>';
					$registro.='</span></div></td>';
				}else{
				$registro.='<td>'.$linha[$c].'</td>';
				}
			}

			$saida .='<tr style="height:50px; line-height:10px;';
			if($x%2==0) $saida .='background:#F7F7F7;">'; else $saida .='">';
			$saida .=$registro;
			$saida .='</tr>';	
		}
		$saida .='</table>';
		$saida .= '<div id="registos_borda_acoes">
                
                <div id="registos_numero_registors">Total de <strong>'.$qtd['qtd'].'</strong> registos</div>
				<script type="text/javascript">function confirma(n){ if(confirm("Deseja mesmo apagar? Isso não poderá ser desfeito.")){ window.location = "./processa/'.$Modulo['modulo'].'.php?acao=apaga&info='.$informacoes.'&id="+n;}else{ return false;}}</script>            </div>
		</div>';
	}else{
		$saida ='<div id="listagem_sem_registros"><p>Nenhum registro cadastrado no momento.</p></div>';
	}
	
 return $saida;	
}




//prepara nome de arquivos // falta implementar recursos como nome repetido e tamanho máximo permitido por arquivo
 function nomeArquivo($nome){
	$separa = explode('.', $nome);
	$nome = strtolower(preg_replace("[^a-zA-Z0-9_.]", "", strtr($separa['0'], "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_")));
	return md5($nome.time()).'.'.$separa['1'];
 }

// Funçaõ para manipular imagens
function geraImg($nome1, $dimensao, $destino){
print_r($_FILES);
	//exit($nome);
		$img->carrega( 'cats.jpg' )		
		->hexa()
		->redimensiona( $dimensao['x'], $dimensao['y'], 'preenchimento' )
		->grava($destino);
	
}

# formata data
function formataData($data, $idioma=''){
	$data = explode( '/', $data);
	//print_r($data);exit;
	$novadata =$data['2'];
	$novadata .='-'.$data['1'];
	$novadata .='-'.$data['0'];
	
	return $novadata;
}


// Funcção para remover de uma string: Espaços, Acentos
function removeDaString($entrada){
	
}


// Prepara urlamigavel
function urlamigavel($entrada, $info, $id){
	
	# Cira a URL Amigavel
	$saida = strtr($entrada, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC-");
	

	$x=0;
	do{
		$x++;
		if($x>=2){
			$saida = $saida.'-1';
		}	
		# Verifica se existe alguma
		$verifica = mysql_fetch_array(mysql_query('SELECT * FROM '.$info['tabela'].' WHERE urlamigavel="'.$saida.'"'));

		if($verifica[$info['id']]==$id) break;
		
		
	}while($verifica[$info['id']]>0);

return strtolower($saida);
}	 

// Função para criar Pastas
function cria_pasta($dir){
	if(file_exists($dir)) return true;
	elseif(mkdir($dir ,0777));	
	else return false;
	
	return true;
}



// Redimensionar imagem
function Redimensionar($imagem, $name, $dim, $pasta){
	$img = imagecreatefromjpeg($_FILES[$imagem]['tmp_name']);

	$dim = explode('x', $dim);


	$x   = imagesx($img);
	$y   = imagesy($img);

	$nova = imagecreatetruecolor($dim['0'], $dim['1']);
	imagecopyresampled($nova, $img, 0, 0, 0, 0, $dim['0'], $dim['1'], $x, $y);
	imagejpeg($nova, "$pasta/$name");
	imagedestroy($img);
	imagedestroy($nova);
	return $name;
}


// Função para remover um diretório em seus arquivos automaticamente.
function removeTree($rootDir)

{
    if (!is_dir($rootDir))
    {
        return false;
    }

    if (!preg_match("/\\/$/", $rootDir))
    {
        $rootDir .= '/';
    }


    $stack = array($rootDir);

    while (count($stack) > 0)
    {
        $hasDir = false;
        $dir    = end($stack);
        $dh     = opendir($dir);

        while (($file = readdir($dh)) !== false)
        {
            if ($file == '.'  ||  $file == '..')
            {
                continue;
            }

            if (is_dir($dir . $file))
            {
                $hasDir = true;
                array_push($stack, $dir . $file . '/');
            }

            else if (is_file($dir . $file))
            {
                unlink($dir . $file);
            }
        }

        closedir($dh);

        if ($hasDir == false)
        {
            array_pop($stack);
            rmdir($dir);
        }
    }

    return true;
}

// Função para listar registo
function sql_paginacao($SQL, $pagina=1, $qtd_registro=10){
	
	$paginaI = ($pagina<2)?$paginaI =0:($pagina*$qtd_registro)-$qtd_registro;
	
	$saida = $SQL." LIMIT $paginaI, $qtd_registro";
	return $saida;
}


// Função para cirar o menu de paginação

function sistema_paginacao($Modulo, $pg_atual=1){
	
	$pg_volta = ($pg_atual<=1)?$pg_atual=1:$pg_atual-1;
	$pg_avanca = $pg_atual+1;
	
	$saida = '
	<div id="sistema_paginacao">
		<ul>
			<li id="bt_paginacao_volta"><a href="?m='.$Modulo['modulo'].'&a=lista&pg='.$pg_volta.'">Voltar</a></li>
			<li id="bt_paginacao_avanca"><a href="?m='.$Modulo['modulo'].'&a=lista&pg='.$pg_avanca.'">Avançar</a></li>
		</ul>
		<span>Page <strong>'.$pg_atual.'</strong></span>
	</div>
	';
	
	return $saida;
}


/*

function sistema_paginacao2($Modulo, $pg_atual=1, $DB){
	
	global $SQL, $qtd_registro, $pagina;

	$registros = $DB->dados('SELECT COUNT(*) FROM '.$Modulo['tabela']);
	
	$registros = $registros[0];

	$ultima= ceil($registros/$qtd_registro);
	
			
	if($pagina<1) $pagina=1;

	$saida = '<div id="sistema_paginacao2">
	<ul>
		<li id="paginacao-primeira-pagina"><a title="Primeira Página" href="?m='.$Modulo['modulo'].'&a=lista&pg=1"><<</a></li>
		<li id="paginacao-volta-uma"><a title="Página Anterior" href="?m='.$Modulo['modulo'].'&a=lista&pg='.($pagina-1).'"><</a></li>
		<li id="paginacao-ativa" ><a title="" href="?m='.$Modulo['modulo'].'&a=lista&pg='.$pagina.'">'.$pagina.'</a></li>
		';

		//if($pagina>1){
		$saida .='<li class="paginacao-pagina-numeros"><a title="" href="m='.$Modulo['modulo'].'&a=lista&pg='.($pagina+1).'">'.($pagina+1).'</a></li>
		<li class="paginacao-pagina-numeros"><a title="" href="?m='.$Modulo['modulo'].'&a=lista&pg='.($pagina+2).'">'.($pagina+2).'</a></li>';
		//}
		
		
		$avanca1 = ($ultima>1) ? '?m='.$Modulo['modulo'].'&a=lista&pg='.($pagina+1): 'javascript:void(0);';
		$ultimapg = ($ultima>1) ? '?m='.$Modulo['modulo'].'&a=lista&pg='.$ultima : 'javascript:void(0);';
		
		$saida .='<li id="paginacao-avanca-uma"><a title="" href="'.$avanca1.'">></a></li>
	<li id="paginacao-ultima-pagina"><a title="" href="'.$ultimapg.'">>></a></li>
	';
	$saida .= '</ul></div>';
	echo $saida;
}
*/
function sistema_paginacao2($Modulo, $pg_atual=1, $url, $DB){
	
	global $SQL, $qtd_registro, $pagina;

	$fim_url = (!(strpos($url, '&pg')===false))?strpos($url, '&pg'): strlen($url);
	$url = substr($url, 0, $fim_url);


	//$registros = $DB->dados('SELECT COUNT(*) FROM '.$Modulo['tabela']);
	$consulta= $DB->consulta($SQL);
	
	$registros = $DB->nun_linhas($consulta);

	$ultima= ceil($registros/$qtd_registro);
	$ultima = ($ultima==0)?1:$ultima;
	$inicio = ($pg_atual<1)?1:$pg_atual;
	$pg_atual = ($pg_atual<1)?1:$pg_atual;
	
	$limite = $inicio+4;
	$saida = '<div id="sistema_paginacao2">
	<ul>
		<li id="paginacao-primeira-pagina"><a title="Primeira Página" href="'.$url.'&pg=1"><<</a></li>
		<li id="paginacao-primeira-pagina"><a title="Primeira Página" href="'.$url.'&pg='.(($pg_atual<=1)?1:$pg_atual-1).'"><</a></li>';

		
		for($x = $inicio; $x<=$limite; $x++){

			if($x>$ultima){}else{
				if($x==$pg_atual){
					$saida .='<li id="paginacao-primeira-pagina"><a><b>'.$x.'</b></a></li>';
					
				}else{
					$saida .='<li id="paginacao-primeira-pagina"><a title="Primeira Página" href="'.$url.'&pg='.$x.'">'.$x.'</a></li>';
				}
			}
		}
		
		$saida .='<li id="paginacao-avanca-uma"><a title="" href="'.$url.'&pg='.(($inicio>=$ultima)?$ultima:$inicio+1).'">></a></li>
	<li id="paginacao-ultima-pagina"><a title="" href="?m='.$Modulo['modulo'].'&a=lista&pg='.$ultima.'">>></a></li>
	';
	$saida .= '</ul></div>';
	echo $saida;
}







// Cria cabeçalho do mádulo
function cabecalho($icone='embranco_32x32.png', $titulo){
	$cabecalho = '<div id="modulo_cabecalho"><img src="./sistema/img/icones_sistema/'.$icone.'" alt="ìcone do módulo" /><h2>'.$titulo.'</h2></div>';
	return $cabecalho;
}

// Cria formulário de Busca
function cria_busca($campos){
	$saida = '<div id="adm_busca">
		<form method="post" action="">
			<fieldset>
				<legend>Busca</legend>';
				foreach($campos as $c => $v){
					switch($v['0']){
						case 1:
							$saida .= '<div><label>'.$v['label'].'</label><input value="'.$_POST['titulo'].'" name="titulo" type="text" /></div>';
							break;
						case 2:
						
							$saida .='<div>
										<label>'.$v['label'].'</label>
										<select name="'.$v['campoTabela'].'">';
										foreach($v['opcoes'] as $c=>$x){
											$saida.='<option value="'.$c.'"  ';
											if($_POST[$v['campoTabela']]==$c){
												$saida .='selected="selected"';
											}
											$saida.='>'.$x.'</option>';
										}			
							$saida .='</select>
							';
					}			
				}
			$saida .='<p class="limpar"></p>
			<button type="submit">Buscar</button>
		</fieldset>
		</form>
	</div>';
	
	return $saida;
}


//Formulário
function cria_formulario($campos, $info, $dados, $valorId=0){
	
	$formulario = '';
	$informacoes = '';
	if($valorId>0){
		$info['valorID'] = $valorId;
	}
	// Informações do módulo (tabela, destino, pasta de arquivo, etc)
	while($linha = each($info)){
		$informacoes.=$linha['key'].'=>'.$linha['value'].',';
	}
	$formulario = '
	<div id="painel_campos">
		<form action="./processa/'.$info['modulo'].'.php" method="post" enctype="multipart/form-data">
		<input name="id" type="hidden" value="'.$dados['0'].'" />
		<input type="hidden" name="info" value="'.$informacoes.'" />	
	';

	// Montando os campos
	foreach($campos as $valor){

		// Tamanho dos campos
		switch ($valor['tamanho']){
			case 'p':
				$id_tem = 'form_item_pequeno';
				break;
			case 'g';
				$id_tem = 'form_item_grande';
				break;
			
			default:
				$id_tem = 'form_item_medio';
		}

		switch ($valor['tipo']){
			
			// Input do tipo text
			case 1:
				$formulario .='
				<div class="'.$id_tem.'">
					<div class="titulo_campos"><label class="label_cursor_poiter" for="'.$valor['campoTabela'].'">'.$valor['label'].'</label></div>
					<div class="item_conteudo"><input class="input_text"  id="'.$valor['campoTabela'].'" type="text" name="'.$valor['campoTabela'].'" value="'.$dados[$valor['campoTabela']].'" /></div>
					<div class="campo_comentario"><p>'.$valor['comentario'].'</p></div>
				</div>
				';
				break;
			
			// Input do tipo text
			case 10:
				$formulario .='
				<div class="'.$id_tem.'">
					<div class="titulo_campos"><label class="label_cursor_poiter" for="'.$valor['campoTabela'].'">'.$valor['label'].'</label></div>
					<div class="item_conteudo"><input class="input_text"  id="'.$valor['campoTabela'].'" type="text" name="'.$valor['campoTabela'].'" value="'.$dados[$valor['campoTabela']].'" disabled="disabled" /></div>
					<div class="campo_comentario"><p>'.$valor['comentario'].'</p></div>
				</div>
				';
				break;

			// Input do tipo select
			case 2:
				$formulario .='
				<div class="'.$id_tem.'">
					<div class="titulo_campos"><label class="label_cursor_poiter" for="'.$valor['campoTabela'].'">'.$valor['label'].'</label></div>
					<div style="margin-left:10px;">
						<p class="controle_campo_select">
						<select name="'.$valor['campoTabela'].'">';
						foreach($valor['ops'] as $c=>$v){
							$formulario .='<option ';
							if($dados[$valor['campoTabela']]==$c){
								$formulario .='selected="selected"';
							}
							$formulario.=' value="'.$c.'">'.$v.'</option>';
						}
						$formulario .='</select>
						</p>
					</div>
					<div class="campo_comentario"><p>'.$valor['comentario'].'</p></div>
				</div>
				';
				break;	



			// Input do tipo select / Optiongroup
			case 11:
				$formulario .='
				<div class="'.$id_tem.'">
					<div class="titulo_campos">
						<label class="label_cursor_poiter" for="'.$valor['campoTabela'].'">'.$valor['label'].'</label></div>
					<div style="margin-left:10px;">
						<p class="controle_campo_select_group">
						<select name="'.$valor['campoTabela'].'">';
						foreach($valor['ops'] as $c=>$v){
							$formulario .='<optgroup label="&nbsp;&nbsp;'.$c.'">';
							//print_r($v);exit;
								foreach($v as $id_valor=>$valor1){
									print_r($x);
								$formulario .='<option ';
								if($dados[$valor['campoTabela']]==$id_valor){
									$formulario .='selected="selected"';
								}
								$formulario.=' value="'.$id_valor.'">'.$valor1.'</option>';
							}
							
						}
						$formulario .='</select>
						</p>
					</div>
					<div class="campo_comentario"><p>'.$valor['comentario'].'</p></div>
				</div>
				';
				break;	









			// Input do tipo file
			case 3:
				$formulario .='
				<div class="'.$id_tem.'">
					<div class="titulo_campos"><label for="'.$valor['campoTabela'].'">'.$valor['label'].'</label></div>
					<div style="margin-left:10px;">
						<p><input  id="'.$valor['campoTabela'].'" type="file" name="'.$valor['campoTabela'].'" /></p>
					';
						if(!empty($dados[$valor['campoTabela']])){
							
							if(!empty($valor['subpasta'])){
								$logar_arquivo = '../arquivos/'.$info['pasta'].'/'.$valor['subpasta'].'/'.$dados[$valor['campoTabela']];
							}else{
								$logar_arquivo = '../arquivos/'.$info['pasta'].'/'.$dados[$valor['campoTabela']];
							}
							
							$end_arquivo = '';
							
							$arquivo = file_exists($logar_arquivo);

							if($arquivo){
								$ext_icones = array('pdf'=>'pdf.png');
								$extensao = explode('.', $dados[$valor['campoTabela']]);
								$extensao = $extensao['1'];
								$tem_icone = file_exists('./sistema/img/icones_extensoes/'.$extensao.'.png');
								
								$ic = ($tem_icone)?$extensao:'embranco';
								
								$icone = '<div class="icone_bt_apaga_arquivo"><a  class="apaga_um_arquivo" target="_blank" title="Ver" href="'.$logar_arquivo.'"><img src="./sistema/img/icones_extensoes/'.$ic.'.png" alt="" /></a> <a href="javascript:void(0)" onclick="confirma(\''.$valor['campoTabela'].'\')"><small><i>Apagar</i></small></a></div><div style="clear:both;"></div>';
								
							}else{
								$icone = '<div class="icone_bt_apaga_arquivo"><a style="cursor:pointer"  onclick=" alert(\'Arquivo não encontrado! Cadastre-o novamente ou contacte o administrador.\')"><img src="./sistema/img/icones_extensoes/fail.png" /></a></div>';
							
							}
							
							$formulario .=$icone;
						}
					$formulario .='</div>';
					
					$formulario .='<div class="campo_comentario"><p>'.$valor['comentario'].'</p></div>
				</div>
				';
				break;
				
			// Campos do tipo Radio
			case 4:
				$formulario .='
				<div class="'.$id_tem.'">
					<div class="titulo_campos"><label>'.$valor['label'].'</label></div>
					<div class="item_conteudo" style="background:none; height:auto;">
						<p class="inputs_radios" style="margin-bottom:5px;">';
						foreach($valor['ops'] as $c=>$v){
							$formulario .='<input type="radio" name="'.$valor['campoTabela'].'" value="'.$c.'" id="radio_'.$v.'"';
							 if($dados[$valor['campoTabela']]==$c){
								 $formulario .='checked="checked"';
							}
							$formulario .=' />&nbsp;<label style=" cursor:pointer" for="radio_'.$v.'">'.$v.';</label>&nbsp;&nbsp;';
						}
						$formulario .='</p>
					</div>	
					<div class="campo_comentario"><p>'.$valor['comentario'].'</p></div>
				</div>
				';
				break;
				
			// Campos do tipo Checkbox
			case 5:
				$formulario .='
				<div class="'.$id_tem.'">
					<div class="titulo_campos"><label style="cursor:normal" for="'.$valor['campoTabela'].'">'.$valor['label'].'</label></div>
					<div class="item_conteudo">';
						foreach($valor['ops'] as $c=>$v){
							$formulario .='<input type="checkbox" name="'.$valor['campoTabela'].'" value="'.$c.'" id="radio_'.$v.'"';
							if($dados[$valor['campoTabela']]==$c){
								 $formulario .='checked="checked"';
							}
							$formulario.=' />&nbsp;<label style=" cursor:pointer" for="radio_'.$v.'">'.$v.';</label>&nbsp;&nbsp;';
						}
						$formulario .='</div>
					<div class="campo_comentario"><p>'.$valor['comentario'].'</p></div>
				</div>
				';
				break;

			// Campo do site Textarea simples
			case 6:
				$formulario .='
				<div class="'.$id_tem.'">
					<div class="titulo_campos"><label class="label_cursor_poiter" for="'.$valor['campoTabela'].'">'.$valor['label'].'</label></div>
					<div style="margin-left:10px;">
							<textarea id="'.$valor['campoTabela'].'" name="'.$valor['campoTabela'].'">'.$dados[$valor['campoTabela']].'</textarea>
					</div>
					<div class="campo_comentario"><p>'.$valor['comentario'].'</p></div>
				</div>
				';
				break;
		
			// Input do tipo DISABLED
			case 7:
				$formulario .='
				<div class="'.$id_tem.'">
					<div class="titulo_campos"><label style="cursor:normal;" for="'.$valor['campoTabela'].'">'.$valor['label'].'</label></div>
					<div class="item_conteudo"><input  id="'.$valor['campoTabela'].'" type="text" name="'.$valor['campoTabela'].'" value="'.$dados[$valor['campoTabela']].'" /></div>
					<div class="campo_comentario"><p>'.$valor['comentario'].'</p></div>
				</div>
				';
				break;


			// Campo do tipo editor
			case 8:
				$formulario .='
				<div class="form_item_grande">
					<div class="titulo_campos"><label style="cursor:normal;">'.$valor['label'].'</label></div>
					<div class="item_conteudo" style="height:auto; background:none;">
                		<p >
                			<textarea name="'.$valor['campoTabela'].'" id="main" style="width:650px; height:250px;">'.$dados[$valor['campoTabela']].'</textarea>
						</p>
            		</div>
					<div class="campo_comentario"><p>'.$valor['comentario'].'</p></div>
						<!-- Script do Editor de texto -->
						<script type="text/javascript">
							var milestone1 = {
									// General options
									mode : "exact",
									language : "pt",
									elements : "'.$valor['campoTabela'].'",
									theme : "advanced",
									plugins : \'advlink,advimage,tabfocus,advlist,searchreplace,advhr\',
									tabfocus_elements: \':prev,:next\',
									object_resizing: false,
									apply_source_formatting: 1,
							
									// Theme options
									theme: \'advanced\',
									browser_preferred_colors: false,
							
									theme_advanced_buttons1 : "forecolor,backcolor,|,bullist,numlist,|,formatselect,fontselect,fontsizeselect,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,|,link,anchor",
									theme_advanced_buttons2 : "",
									theme_advanced_buttons3 : "",
									theme_advanced_buttons4 : "",
									theme_advanced_toolbar_name1 : "Command",
									theme_advanced_toolbar_name2 : "Format",
									theme_advanced_toolbar_align : "left",
									theme_advanced_toolbar_location : "top"
							};
							tinyMCE.init(milestone1);
						</script>
			<div class="limpar"></div>
				</div>
				';
				break;
			
			// Data
			case 9:
				$formulario .='
				<div class="'.$id_tem.'">
					<div class="titulo_campos"><label for="'.$valor['campoTabela'].'">'.$valor['label'].'</label></div>
					<div class="item_conteudo"><input  id="datepicker" type="text" name="'.$valor['campoTabela'].'" value="'.$dados[$valor['campoTabela']].'" /></div>
					<div class="campo_comentario"><p>'.$valor['comentario'].'</p></div>
				</div>
				';
				break;
		}

	}
	
	$formulario .= '
			<!-- Scripts -->
			<script type="text/javascript"> 
				function confirma(campo){
					if(confirm("Deseja mesmo apagar? Isso não poderá ser desfeito.")){
						 window.location = "./processa/'.$info['modulo'].'.php?info='.str_replace('acao=>edita', 'acao=>apaga-arquivo',$informacoes).'&campo-arquivo="+campo;
					}else{
						 return false;
					}
				}
			</script>
			<!-- Botões do formulário -->   
			<div id="controle_campos_botoes">
				<button id="painel_form_salvar" type="submit">Salvar</button>
				<button id="painel_form_cancelar" onclick="window.location =\'sistema.php?m='.$info['modulo'].'\'" type="button">Cancelar</button>
			</div>
		</form>
	</div>
	';
	
	//retorna o HTML pronto pra imprimir	
	return $formulario;
}


function alertas($get){

	if($get['S']){
		$alerta= '<div id="box_mensagem_sucesso"><span><b>Ok: </b>'.urldecode($get['S']).'</span></div>';
	}elseif($get['F']){
		$alerta= '<div id="box_mensagem_falha"><span><b>Erro: </b>'.urldecode($get['F']).'</span></div>';
	}
	
	return $alerta;
}



// Prepara os nomes dos departamentos
function nome_dep($id=0, $nome){
	global $DB;
	$dep = $DB->dados('SELECT * FROM tbdepartments WHERE id_department='.(int)$id);
	
	$saida =  $dep['department'].' > '.$nome;
	
	if($dep['id_father']>0){
		$saida = nome_dep($dep['id_father'], $saida);
	}
	
	return $saida;
}


// Apaga um determinado departamento e seus subdepartamentos

function apaga_dep($id){
	global $DB;

	$DB->consulta('DELETE FROM tbdepartments WHERE id_department='.(int)$id);

	$consulta = $DB->consulta('SELECT * FROM tbdepartments WHERE id_father='.(int)$id);
	
	while ($linha = $DB->lista($consulta)){
		apaga_dep($linha['id_department']);	
	}
	
	return true;
}




// Ao editar algum campo file
function campo_arquivo($qrquivo, $campo){
	global $Modulo;
	global $Dados;

	$src_file = '../arquivos/'.$Modulo['pasta'].'/'.$Dados[$campo];
	$arquivo = file_exists($src_file);

	if($arquivo){

		$extensao = explode('.', $Dados[$campo]);
		$extensao = $extensao['1'];

		$tem_icone = file_exists('./sistema/img/icones_extensoes/'.$extensao.'.png');
		
		$ic = ($tem_icone)?$extensao:'embranco';
		
		$icone = '<div class="icone_bt_apaga_arquivo">
					<a  class="apaga_um_arquivo" target="_blank" title="Ver" href="'.$src_file.'">
					<img src="./sistema/img/icones_extensoes/'.$ic.'.png" alt="" />
					</a> 
					<a href="javascript:void(0)" onclick="confirma(\''.$campo.'\')"><small><i>Apagar</i></small></a></div><div style="clear:both;"></div>';
		
	}else{
		$icone = '<div class="icone_bt_apaga_arquivo"><a style="cursor:pointer"  onclick=" alert(\'Arquivo não encontrado! Cadastre-o novamente ou contacte o administrador.\')"><img src="./sistema/img/icones_extensoes/fail.png" /></a></div>';
	
	}
	
	$formulario .=$icone;
	
	return $formulario;
}
?>