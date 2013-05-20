<?
	# Cabeçalho
	include("header.php");	
	//print_r($urlSite);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Biotechnology/biotech,Bioengineering,Medicine production,Pharmacogenomics,Pharmaceutical,IT security,Privacy,Data privacy,Cloud security,Cyber security,Cyber crime,Cyber attack,Computer virus,Hacker/hacking,Computer passwords,Digital life,Cleantech,Renewable energy,Entrepreneur,Energy,Startups,Solar Energy,Nanotechnology,Sustainable energy,Enterprise,Life sciences,Metallurgy,Venture capital,Investment,Electronics,Metalwork,Design engineering,Aerospace engineering,Design engineer,Electronics circuits,Systems engineering,Electronics devices,Mechanical design,Electronics workbench,Electronics companies,Mechanical engineering,Mechanical engineer,Electrical engineering,Investing" />
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
<script type="text/javascript" src="/js/highlightChange.js"></script>
<script type="text/javascript" src="/js/jsScroller.js"></script> 
<script type="text/javascript">
var scroller = null;
window.onload = function () {
  var el = document.getElementById("Scroller-1");
  scroller = new jsScroller(el, 400, 200);
}
</script>
<script>
(function() {
  var cx = '000549393153229706384:jqxae0ndqfe'; // Insert your own Custom Search engine ID here
  var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
  gcse.src = (document.location.protocol == 'https' ? 'https:' : 'http:') +
      '//www.google.com/cse/cse.js?cx=' + cx;
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
})();
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34536141-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

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
            	<p>&copy; 2012 RIW<br/>Russian Innovation Week</p>                
            </div>
            <div id="mf_social_media">
            	<ul>
                    <li id="facebook"><a href="http://www.facebook.com/pages/Russian-Innovation-Week/408163625899875" target="_blank">Facebook</a></li>  
                    <li id="twitter"><a href="https://twitter.com/RIW_SV" target="_blank">Twitter</a></li>  
                    <li id="linkedin"><a href="https://plus.google.com/u/0/b/103179661446801281383/103179661446801281383/posts" target="_blank">Google</a></li>  
                    <li id="youtube"><a href="http://www.youtube.com/channel/UCL39Q4f-izAVgoCj-3jh6Kw?feature=guide" target="_blank">Youtube</a></li> 
                </ul>              
            </div>
            <div id="mf_contact">
            	<h3>Contact Us</h3>
             	<a>+1 650.681.0747</a><br/> 
                <a href="mailto:info@riw-sv.com">info@riw-sv.com</a>          
            </div>
            <div id="mf_search"> 
                <gcse:searchbox-only> 
            </div>
            <div class="clear"></div>
        </div>  
    </div>
</body>
</html>