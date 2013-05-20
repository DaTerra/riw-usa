<?
	$urlSite[1] = trim((string)$urlSite[1]);
	$urlSite[0] = trim((string)$urlSite[0]);
		
		if (strlen($urlSite[1])>0) {
			if (file_exists('pages/'.$urlSite[1].'.php')) 
					include('pages/'.$urlSite[1].'.php');
		}
		else if (strlen($urlSite[0])>0) {				
		if (file_exists('pages/'.$urlSite[0].'.php')) 
			include('pages/'.$urlSite[0].'.php');
		else include("pages/404.php"); 
		} 
	else  include("pages/home.php");
?>					
		