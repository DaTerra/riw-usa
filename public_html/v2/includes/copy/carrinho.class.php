<?php

# Define a Classe Carrinho
class Carrinho {
	public $ofertas = array();
	private $mysql;

	# Função Construtora para a Classe
	function __construct($bd) {
		$this->ofertas = $_SESSION['carrinho']['ofertas'];
		$this->mysql = $bd;
	}
	
	# Sair
	function __destruct() {
		$_SESSION['carrinho']['ofertas'] = $this -> ofertas;
	}


	# Função para Adicionar Itens ao Carrinho de Compras
	function AdicionarItem($codigo, $quantidade, $variacao=0) {
		if ( $quantidade > 0 ) {
				$this -> ofertas[$codigo][$variacao] += $quantidade;
				return true;
		} else {
			return false;
		}
	}

	# Função para Remover Itens do Carrinho de Compras
	function RemoverItem($codigo, $quantidade, $variacao=0) {
		if ( isset( $this->ofertas[$codigo] ) ) {
			if ( $this->ofertas[$codigo][$variacao] > $quantidade ) {
				$this->ofertas[$codigo][$variacao] -= $quantidade;
			} else {
				$this->ofertas[$codigo][$variacao] = 0;
				unset($this->ofertas[$codigo][$variacao]);
				if (count($this->ofertas[$codigo])==0) unset($this->ofertas[$codigo]);
			}
			return true;
		} else {
			return false;
		}
	}

	# Limpar o carrinho
	function Resetar() {
		$this -> ofertas = null;
	}

	# Subtotal
	function ItensTotal() {
		return count($this -> ofertas);
	}
	
	# Valor Total
	function ValorTotal() {
		$valor=$this->valorSubTotal();
		if ($valor<0) $valor=0;
		return $valor;	
		
	}

	# Valor Subtotal
	function ValorSubTotal() {
		$subtotal = 0;
	 	 if (count($this->ofertas)>0) { 
			foreach ($this->ofertas as $OfertaID=>$variacoes){
				foreach ((array)$variacoes as $variacao=>$qtde) {
					if ($qtde>0) {

						if ($variacao > 0) {

							$subtotal += $qtde * (float)$this->mysql->valor("SELECT valor FROM tbofertas_variacoes WHERE oferta_id=".(int)$OfertaID." AND id_variacao=".(int)$variacao);

						} else { 
						
							$subtotal += $qtde * (float)$this->mysql->valor("SELECT valor FROM tbofertas WHERE id_oferta=".(int)$OfertaID);
						
						}

					}
				  }
			  }
		 }

		return $subtotal;
	}


}


?>