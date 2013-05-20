<?
	include("top.php");	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="keywords" content="Biotechnology/biotech,Bioengineering,Medicine production,Pharmacogenomics,Pharmaceutical,IT security,Privacy,Data privacy,Cloud security,Cyber security,Cyber crime,Cyber attack,Computer virus,Hacker/hacking,Computer passwords,Digital life,Cleantech,Renewable energy,Entrepreneur,Energy,Startups,Solar Energy,Nanotechnology,Sustainable energy,Enterprise,Life sciences,Metallurgy,Venture capital,Investment,Electronics,Metalwork,Design engineering,Aerospace engineering,Design engineer,Electronics circuits,Systems engineering,Electronics devices,Mechanical design,Electronics workbench,Electronics companies,Mechanical engineering,Mechanical engineer,Electrical engineering,Investing" />

<meta name="description" content="The Russian Innovation Week conference brings together leading startup entrepreneurs, venture capitalists and successful business leaders from the U.S. and Russia to forge mutually beneficial partnerships and build pathways for doing business in Russia. The conference is a unique opportunity for attendees to gain access to leading industry analysts on the Russian market, learn about world-class Russian talent and technology, and explore networking opportunities."/>
<? //Favicon?>
<link rel="shortcut icon" href="http://riw-sv.com/favicon.ico">
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
<script type="text/javascript" src="/js/funcoes.js"></script> 
<script src="/js/jquery.roundabout2.js"></script>

<script type="text/javascript">
	var scroller = null;
	window.onload = function () {
	  var el = document.getElementById("Scroller-1");
	  scroller = new jsScroller(el, 400, 200);
	}
</script>
<script>
  (function() {
    var cx = '000549393153229706384:-vpya0bbroe';
    var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
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
<? // Edge ?>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="bg_animation_edgePreload.js"></script>
    <style>
        .edgeLoad-EDGE-156337445 { visibility:hidden; }
    </style>
<!--Adobe Edge Runtime End-->
<body style="margin:0;padding:0;height:100%;">
    <div id="Stage" class="EDGE-156337445 edgeLoad-EDGE-156337445">      
    </div>
    <div style="position:absolute; top:0px; left:50%;margin-left:-480px;z-index:100;">
    
    
    <div id="wrapper">    
        <div id="main_logo">  
            <h1><a href="/">Russian Inovation Week 2012 - October 25-26 - USA</a></h1>                
        </div> 
<style type="text/css">
	#site_menu{ height:50px;padding-top:30px;}
	#site_menu ul li{ float:left; height:50px;display:bock;}
	#site_menu ul li a:hover{color:red;}
	.meu_principal{ margin-left:20px;}
	
	.menu_sub{ margin-top:5px; margin-left:-50px; position:absolute; z-index:500;}
	.menu_sub li{ margin-right:20px;}
	.menu_sub li a{ }
	
	#menu_ativo, #sub_ativo{ color:red;}
	
</style>        
        
        <div id="main_menu_content">    
          <div id="site_menu">
          	<ul>
            	<li style="margin-left:70px;" class="meu_principal" ><a <? if($url['0']=='agenda') echo 'id="menu_ativo"';?> href="/agenda">Agenda</a></li>
            	<li class="meu_principal"><a  <? if($url['0']=='meetings') echo 'id="menu_ativo"';?> href="/meetings">Meetings</a></li>
            	<li <? if($url['0']=='speakers' or $url['0']=='participants' or $url['0']=='speakers' or $url['0']=='companies' or $url['0']=='speaker' ) echo ''; else echo 'onmouseover="display(\'menu_Speakers_ativo\', \'mostra\')" onmouseout="display(\'menu_Speakers_ativo\', \'esconde\')" ';?> class="meu_principal" >
                	<a  <? if($url['0']=='speakers' or $url['0']=='participants' or $url['0']=='speakers' or $url['0']=='companies' or $url['0']=='speaker' ) echo 'id="menu_ativo"';?> href="javascript:void(0)"><a href="/speakers">Speakers and Participants</a></a>
                	<ul class="menu_sub" <? if(!($url['0']=='speakers' or $url['0']=='participants' or $url['0']=='speakers' or $url['0']=='companies' or $url['0']=='speaker')) echo 'style="display:none;"';?> id="menu_Speakers_ativo" style="margin-left:-69px;" >
                    	<li><a <? if($url['0']=='speakers') echo 'id="sub_ativo"';?> href="/speakers">Speakers</a></li>
                    	<li><a <? if($url['0']=='participants') echo 'id="sub_ativo"';?> href="/participants">Participants</a></li>
                    	<li><a <? if($url['0']=='companies') echo 'id="sub_ativo"';?> href="/companies">Companies</a></li>
                    </ul>
                </li>
            	<li <? if($url['0']=='organizers' or $url['0']=='sponsors') echo ''; else echo 'onmouseover="display(\'menu_Organizers_ativo\', \'mostra\')" onmouseout="display(\'menu_Organizers_ativo\', \'esconde\')" ';?> class="meu_principal" >
                	<a <? if($url['0']=='organizers' or $url['0']=='sponsors') echo 'id="menu_ativo"';?> href="javascript:void(0)"><a href="/organizers">Organizers and Sponsors</a></a>
                	<ul style=" margin-left:10px; <? if(!($url['0']=='organizers' or $url['0']=='sponsors')) echo 'display:none;';?>" class="menu_sub"  id="menu_Organizers_ativo" >
                    	<li><a <? if($url['0']=='organizers') echo 'id="sub_ativo"';?>  href="/organizers">Organizers</a></li>
                    	<li><a <? if($url['0']=='sponsors') echo 'id="sub_ativo"';?>  href="/sponsors">Sponsors</a></li>
                    </ul>
                </li>
            	<li <? if($url['0']=='media' or $url['0']=='articles') echo ''; else echo 'onmouseover="display(\'menu_media_ativo\', \'mostra\')" onmouseout="display(\'menu_media_ativo\', \'esconde\')" ';?> class="meu_principal" >
                	<a  <? if($url['0']=='media' or $url['0']=='articles') echo 'id="menu_ativo"';?> href="javascript:void(0)"><a href="/media">Media</a></a>
                	<ul class="menu_sub" style=" margin-left:0px; <? if(!($url['0']=='media' or $url['0']=='articles')) echo 'display:none;';?>" id="menu_media_ativo" >
                    	<li><a <? if($url['0']=='articles') echo 'id="sub_ativo"';?> href="/articles">Articles</a></li>
                        <li><a <? if($url['0']=='media') echo 'id="sub_ativo"';?> href="/media">Media Kit</a></li>                    	
                    </ul>
                </li>
                
                <li class="meu_principal" <? if($url['0']=='registration') echo 'id="menu_ativo"';?>><a href="/registration">Register</a></li>
            </ul>
          </div>
        </div>      
        <div class="clear"></div> 
        
        <br/>
        
        
                 
        <div id="main_content">    
            <div class="left_column_of2">
            	<style>
					.presented_sponsored{
						text-align:center;
						position:absolute;
						alignment-baseline:central;						
						bottom:100px;
						padding-left:40px;
						}
					.presented_sponsored h4{
						font-size:12px;
						line-height:32px;
						font-weight:normal;
						font-style:italic;
						}
					.presented_sponsored img{
						text-align:center;
						alignment-baseline:central;
						}
						#bt_sort_industry a{ display:block; width:127px; height:24px; background:url(/img/sort-btn.png) no-repeat; font-size:12px; text-align:left; line-height:24px;padding-left:10px;}
						#lista_industry{}
				</style>
                <div class="clear"></div>


				<? if($url['0']=='speakers' or $url['0']=='participants' or $url['0']=='companies'){?>
                <div style="position:relative;">
                	<div onmouseover="display('lista_industry', 'mostra')" onmouseout="display('lista_industry', 'esconde')" style="margin:20px 0 0 20px; position:absolute; z-index:50; background:#fff;">
                    	<span id="bt_sort_industry"><a href="javascript:void(0)">Sort by Industry</a></span>
                        <div style=" display:none" id="lista_industry">
                            <ul>
                                <?
                                    $consulta = $DB->consulta('SELECT * FROM tbindustry ORDER BY position ASC');
                                    while($linha = $DB->lista($consulta)){
                                ?>
                                
                                <li><a href="/<?=$url['0']?>/<?=$linha['id_typeindustry']?>"><?=$linha['typeindustry']?></a></li>
                                <? }?>
                            </ul>
                        </div>
                    </div>
                </div>
                <? }?>
				<script type="text/javascript">
                    function display(id, acao){
                        if(acao=='mostra'){
                            $('#'+id).show();	
                        }
                        if(acao=='esconde'){
                            $('#'+id).hide();	
                        }
                    }
                </script>
                <div class="clear"></div>
                
				<div class="presented_sponsored">
                    <h4>Presented by</h4>
                    <div class="clear"></div>
                    <a href="http://www.rusnano.com/" target="_blank"><img src="/img/logo_small_rusnano.png" border="0" class="first"/></a>
                    <div class="clear"></div>
                    <a href="http://www.rusventure.ru/en/" target="_blank"><img src="/img/logo_small_rvc.png"/></a> 
                    <div class="clear"></div>       
                    <a href="http://www.sk.ru/en/" target="_blank"><img src="/img/logo_small_skolkovo.png"/></a>
                    <div class="clear"></div>
                    <h4>Sponsored by</h4>
					<?
						$consulta = $DB->consulta('SELECT * FROM tbsponsor WHERE status=1 ORDER BY RAND() LIMIT 3');
						while($linha = $DB->lista($consulta	)){$x++;
					?>                    
                    <div class="clear"></div>
                    <a style="margin-bottom:15px; float:left;" href="<?=$linha['link']?>" target="_blank"><img width="80px;" src="/img/<?=$linha['logo']?>" border="0" class="first"/></a>
                    <div class="clear"></div>
                    <? }?>
                </div>
                
                
                
            </div>
            <div style="min-height:150px;">
            <?
                include('url.php');
            ?>  
            </div>  
        </div> 
        <div class="clear"></div>     
        <div id="footer"> 
        	<div id="footer_line"></div>
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
    <div id="wrapper-footer"></div>      
    
</div>	     
</body>
</html>