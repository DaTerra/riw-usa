<?php
if(!empty($url['0'])){
	if($url['0']=='principal'){
		include('./pages/home.php');
	}elseif(file_exists('./pages/'.$url['0'].'.php')){
		include('./pages/'.$url['0'].'.php');
	}else{
		include('./pages/404.php');
	}
}else{
	include('./pages/home.php');
}
?>