<?php
/**
 * class Banco - Acesso ao Banco de Dados MySQL
 * NOTE: -
 * @author Gustavo Sagrillo
 * @update 2009-05-01
 */
class Banco {
	private $conn;
	# Iniciando objeto
	function __construct($servidor,$usuario,$senha,$bd) {
		$this->conn = @mysql_connect($servidor, $usuario, $senha, true);
		if ($this->conn) {

			if (! @mysql_select_db($bd,$this->conn) ) $this->Erro("Get On it!!");

		} else $this->Erro("Ops!!: There is a problem connecting to the database at '".$servidor."'.");
	}
	# Finalizando objeto
	function __destruct() {
		//echo 'morreu maria';
		//exit;
		if ($this->conn) mysql_close($this->conn);
	}
	# Saída com Erro
	function Erro($msg,$ref=null) {
		echo '<div class="siteerr">'.$msg.(($ref)?$ref:'').'</div>';
	}
	function consulta($sql) {
		if ($this->conn) {
			$c = mysql_query($sql, $this->conn);
			if ($c) 
				return $c;
			else{
				$this->Erro("Erro: Mysql Error '".mysql_errno()."' - Não foi possível consultar banco de dados.", mysql_error());	
			}
		} else $this->Erro("Erro: Banco de dados não conectado.",$ref);
	}
	function executaNovos($tabela,$dados) {
		$busca = '';
		foreach ($dados as $a=>$b) $busca .= ' AND '.$a."='".$this->entrada($b)."'";
			
		$teste = $this->Count("SELECT * FROM ".$tabela." WHERE 1 ".$busca);
		if ($teste > 0) {
			//
		} else {
			$this->executa($tabela,$dados);
		}			
	}

	function executa($tabela, $dados, $acao = 'insert', $parametros = '') {
	
		reset($dados); 

		# Novo registro
		if (strtolower($acao) == 'insert') {
		  $consulta = 'INSERT INTO ' . $tabela . ' (';
		  
		  while (list($coluna, ) = each($dados)) $consulta .= $coluna . ', ';
		  $consulta = substr($consulta, 0, -2) . ') values (';

		  reset($dados);
		  while (list(, $valor) = each($dados)) {
			switch ((string)$valor) {
			  case 'now()':
				$consulta .= 'now(), ';
				break;
			  case 'null':
				$consulta .= 'null, ';
				break;
			  default:
				$consulta .= '\'' . $this->entrada($valor) . '\', ';
				break;
			}
		  }
		  $consulta = substr($consulta, 0, -2) . ')';
	
		# Atualizar
		} elseif (strtolower($acao) == 'update') {
		  $consulta = 'UPDATE ' . $tabela . ' SET ';

		  reset($dados);
		  while (list($coluna, $valor) = each($dados)) {
			switch ((string)$valor) {
			  case 'now()':
				$consulta .= $coluna . ' = now(), ';
				break;
			  case $coluna.'+1':
				$consulta .= $coluna . ' = '.$coluna.' + 1, ';
				break;
			  case $coluna.'-1':
				$consulta .= $coluna . ' = '.$coluna.' - 1, ';
				break;
			  case 'null':
				$consulta .= $coluna .= ' = null, ';
				break;
			  default:
				$consulta .= $coluna . ' = \'' . $this->entrada($valor) . '\', ';
				break;
			}
		  }
		  $consulta = substr($consulta, 0, -2) . ' WHERE ' . $parametros;
		}
		return $this->consulta($consulta);
	}
	function existe($consulta) {
		if ( $this->qtLinhas($this->consulta($consulta)) > 0 )  
			return true; 
		else 
			return false;
	}
	function lista($consulta) {
		return mysql_fetch_array($consulta);
	}
	function qtLinhas($consulta) {
		return mysql_num_rows($consulta);
	}
	function insertId() {
		return mysql_insert_id($this->conn);
	}
	function liberaConsulta($consulta) {
		return mysql_free_result($consulta);
	}
	function saida($string) {
		return htmlspecialchars($string);
	}
	function entrada($string) {
		return addslashes($string);
	}


	function dados($string) {
		return $this->lista($this->consulta($string));
	}
	function vetor($string) {
		$consulta = $this->consulta($string);
		$vetor = array();
		while ($linha = $this->lista($consulta)) {
			$vetor[] = $linha;	
		}
		return $vetor;
	}
	function valor($string) {
		list($valor) = $this->lista($this->consulta($string));
		return $valor;
	}
	function Count($string) {
		$from = strpos(strtolower($string),"from");
		if ($from > 0) {
			$string = "SELECT count(*) ".substr($string,$from,strlen($string));
			list($qtde) = $this->dados($string);
			return $qtde;
			
		} else return 0;
	}	
	# Procura um Registro no Banco de Dados
	# Se o registro não existir, ele cadastra.
	function idRegistro($tabela, $campo, $valor) {
		$condicao='';
		if (is_array($campo)) {
			foreach ($campo as $a=>$b) {
				# Tira os zeros à esquerda
				$valor[$a] = ltrim($valor[$a],'0');
	
				$condicao .= " AND ".$b." LIKE '".$this->entrada($valor[$a])."'";
				$dados[$b]=$valor[$a];
			}
		} else {
			# Tira os zeros à esquerda
			$valor = ltrim($valor,'0');
	
			$condicao = "AND ".$campo." LIKE '".$this->entrada($valor)."'";
			$dados[$campo]=$valor;
		}
		list($id) = $this->dados("SELECT * FROM ".$tabela." WHERE 1 ".$condicao);
		if ($id>0) return $id; 
		else {
			$this->executa($tabela,$dados);
			return $this->insertId();
		}
	}
}
?>