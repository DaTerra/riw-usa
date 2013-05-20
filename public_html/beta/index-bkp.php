<?
	# Cabeçalho
	include("header.php");	
	//print_r($urlSite);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? //Fonts ?>
<link rel="stylesheet" type="text/css" href="/css/typefaces.css" />
<? // CSS ?>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
<? // Title ?>
<title>RIW2012 - Russian Inovation Week 2012</title>
<? // JS?>
<script type="text/javascript" src="/js/jquery-1.7.js"></script>
<script type="text/javascript" src="/js/jquery.jcountdown.min.js"></script>
<script type="text/javascript" src="/js/countdown.js"></script>
<script language="text/javascript">
	function mudaBgOver(hl_id) {
		document.getElementById('.hl_id ').getParent.style.backgroundImage='url(/img/highlight-on-content.png)';
	}
	function mudaBg() {
		document.getElementById('.hl_id ').getParent.style.backgroundImage='url(/img/highlight-on-content.png)';
	}
</script>
<script language="javascript" type="text/javascript">
function mouseOverImage()
{
	document.getElementById("img1").src = "images/green.gif";
}

function mouseOutImage()
{
	document.getElementById("img1").src = "images/blue.gif";
}
</script>   
<body>
    <div id="wrapper">  
    	<div id="main_logo">
        	<h1><a href="/home">Russian Inovation Week 2012 - October 25-26 - USA</a></h1>            
        </div>
        <div id="register">
        
        </div>
        <div id="main_menu">
        	<ul>		           	 
            	<li class="mm_home"><a class="dtr_pro_mediumRg <? if($urlSite['0'] == 'home' || $urlSite['0'] == '') echo 'mm_home_on';?>" href="/home">Home</a></li>                
                <li class="mm_agenda"><a class="<? if($urlSite['0'] == 'agenda') echo 'mm_agenda_on';?>" href="/agenda">Agenda</a></li>                               
                <li class="mm_registration"><a class="<? if($urlSite['0'] == 'registration') echo 'mm_registration_on'; ?>" href="/registration">Registration</a></li>
                <li class="mm_organizers_and_partners"><a class="<? if($urlSite['0'] == 'organizers_and_partners') echo 'mm_organizers_and_partners_on'; ?>" href="/organizers_and_partners">Organizers and Partners</a></li>
                <li class="mm_speakers_and_participants"><a class="<? if($urlSite['0'] == 'speakers_and_participants') echo 'mm_speakers_and_participants_on'; ?>" href="/speakers_and_participants">Speakers and Participants</a></li>
                <li class="mm_media"><a class="<? if($urlSite['0'] == 'media') echo 'mm_media_on'; ?>" href="/media">Media</a></li>
                <li class="mm_travel_info"><a class="<? if($urlSite['0'] == 'travel_info') echo 'mm_travel_info_on'; ?>" href="/travel_info">Travel Info</a></li>
            </ul>   
        </div>  
        <div class="clear"></div>      
        <div id="main_content">
            <?
                include('secoes.php');
            ?>
        </div>  
        <div id="footer_line">
             	<p>&copy; 2012 RIW/p>                	
        </div>
        <div id="footer">        	
            <div class="clear"></div>
        	<div id="mf_copyright">
            	<p>&copy; 2012 RIW<br/>Russian innovation week</p>                
            </div>
            <div id="mf_social_media">
            	<ul>
                    <li id="facebook"><a href="#">Facebook</a></li>  
                    <li id="twitter"><a href="#">Twitter</a></li>  
                    <li id="linkedin"><a href="#">Linkedin</a></li>  
                    <li id="youtube"><a href="#">Youtube</a></li> 
                </ul>              
            </div>
            <div id="mf_contact">
            	<h3>Contact Us</h3>
                <a>8 800 100 20 30</a> 
                <a href="#">info@riw2012.com</a>          
            </div>
            <div id="mf_search">
            	<input  type="text" name="search" maxlength="80" size="17">       
            </div>
        </div>  
    </div>
</body>
</html>