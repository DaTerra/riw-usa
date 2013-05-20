<?php

function montaTexto($texto, $categoria) {
	
	/*if(!($categoria['id_departamento']==9)){
		return $texto;
	}*/
	$texto = str_replace("<hr>","<hr />",$texto);
	$texto = str_replace("<hr/>","<hr />",$texto);
	$texto = explode('<hr />',$texto);
	
	$x=0;
	foreach($texto as $c=>$v){$x++;
		$texto[$x] = $v;
	}
	
	if($categoria['id_departamento']==9){
		if(empty($_GET['page']) or $_GET['page']==1){
		
		$saida .='
		<div class="banner">
			<h2>'.$categoria['titulo_topo'].'</h2>
			<h3>'.$categoria['data_topo'].'</h3>
		</div>';
		 }else{
			 $saida .='
		<div class="banner_small">
			<h2>'.strip_tags($categoria['titulo_topo']).'</h2>
			<div class="pagination">    
				';
				
				if($x>1){
				$saida .='<p><a href="?page=1">&lt;&lt;</a></p>         
				<ul>';
					for($i = 1; $i <= $x; $i++){
	
					$saida .='<li><a href="?page='.$i.'">'.$i.'</a></li>';
					}
			   $saida.=' </ul>
				<p><a href="?p=page='.$x.'">&gt;&gt;</a></p>';  
				}
			$saida .='</div>          
		</div>	';
		 }
	}
	
	
	
	
	
	if(!empty($_GET['page'])){
		$saida .= $texto[$_GET['page']];
	}else{
		$saida .= $texto[1];
	}
	
	
	if($x>1){
	
	$saida .= '<div class="pagination bottom"> 
    <p>- '.strip_tags($categoria['titulo_topo']).' -</p>           
    <ul>';
	for($i = 1; $i <= $x; $i++){
		
       $saida .= ' <li><a href="?page='.$i.'">'.$i.'</a></li> ';
	}
    $saida .= '</ul> 
    <p><a href="?page='.($x).'">&gt;&gt;</a></p> 
    <div clas="clear"></div>  
	</div>    ';
	}
	
	
	return $saida;

}
function montaTexto2($texto) {
	
	return $texto;
}

?>