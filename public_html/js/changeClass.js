// JavaScript Document




	function mudaBgOver(qual) {
		if (qual == '') qual = '<?=$_GET['p'];?>';
		document.getElementById('ipe').style.backgroundImage='url(../img/daterra_ipe_'+qual+'.png)';
		document.getElementById('ipe_small').style.backgroundImage='url(../img/daterra_ipe_small_'+qual+'.png)';
		$('.sidemenu li ul').hide(0);
		$('.'+qual+' ul').show(0);
	}
	function mudaBg(qual) {
		if (qual == '') qual = '<?=$_GET['p'];?>';
		document.getElementById('ipe').style.backgroundImage='url(../img/daterra_ipe_'+qual+'.png)';
		document.getElementById('ipe_small').style.backgroundImage='url(../img/daterra_ipe_small_'+qual+'.png)';
		$('.sidemenu li ul').hide(0);
		$('.'+qual+' ul').show(0);
	}



<a href="?p=branding" onmouseover="mudaBgOver('branding')" onmouseout="mudaBg('')">Branding</a>


//<?
	// Mudando o "p" para HOME se for vazio
//	if ($_GET['p']=='') $_GET['p']='home';
//?>
