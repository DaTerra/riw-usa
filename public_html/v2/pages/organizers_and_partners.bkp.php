<script type="text/javascript">
      $(function() {
        var moveLeft = 20;
        var moveDown = 10;
        
        $('a#trigger').hover(function(e) {
          $('div#pop-up').show();
          //.css('top', e.pageY + moveDown)
          //.css('left', e.pageX + moveLeft)
          //.appendTo('body');
        }, function() {
          $('div#pop-up').hide();
        });
        
        $('a#trigger').mousemove(function(e) {
          $("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
        });
        
      });
</script>
           
<div id="op">
    <div class="title">        
        <h2>Organizers</h2>
    </div>    
    <div class="div_line"><p>&copy; 2012 RIW</p></div>
    <div class="clear"></div>  
    <div class="content_index">
    	<h2>Russian Innovation Center</h2>
        <p>The Russian Innovation Center (RIC) was founded by Russian innovation and investment powerhouses RUSNANO, RVC and Skolkovo to facilitate innovation within Russian companies, connect innovative companies with venture capitalists and bring innovative products to the global marketplace.</p>
        <div class="content_index_column">
            <div class="content_img">
                 <a href="http://www.rusnano.com/" target="_blank"><img src="/img/organizer-rusnano.png"/></a>
            </div>
            <div class="content_txt">
                <p>
                    RUSNANO is a $10 billion state-backed fund based in Russia with an investment focus on late-start venture capital and private equity deals in nanotechnology. Founded in 2007, RUSNANO aims to develop the Russian nanotechnology industry through co-investment in nanotechnology projects with substantial potential or social benefit. RUSNANO is working to build a competitive nanotechnology industry based on the advances of Russian scientists and transfer of cutting-edge technologies from other countries. The government of the Russian Federation owns 100 percent of the shares in RUSNANO.<br/><br/>                    
                    While RUSNANO is a business entity, it collaborates with the non-commercial Fund for Infrastructure and Educational Programs, which supports development of the infrastructure to enable nanotechnology innovation in Russia and training for nanotechnology specialists.<br/><br/>                   
                    RUSNANO USA, established in 2010 to represent the interests of RUSNANO and its project companies in the U.S. and Canada, facilitates marketing of Russian nano-enabled products in world markets. RUSNANO USA organizes collaboration with American venture capital and direct investment funds, high-tech companies, universities and technology transfer centers that are interested in implementing joint projects with RUSNANO.<br/><br/>                    
                    RUSNANO has offices on Sand Hill Road in Menlo Park, Calif., and is proud to co-host the inaugural Russian Innovation Week with other members of the Russian Innovation Center.
                </p>
            </div>
            <div class="clear"></div>
        </div>
         
        <div class="content_index_column">        
            <div class="content_img">
                 <a href="http://www.rusventure.ru/en/" target="_blank"><img class="first" src="/img/organizer-rvc.png"/></a>
            </div>
            <div class="content_txt">
                <p>
                    Russian Venture Capital (RVC) is a government fund of funds that channels public incentives to venture capitalists and support to the hi-tech sector. RVC was founded by the Russian government in 2006 to ensure faster development of an efficient and globally competitive innovation system and venture capital industry in Russia. To fulfill its mission, RVC engages private venture capitalists; nurtures innovative entrepreneurship, technology and business expertise; and mobilizes Russian human resources. RVC currently backs 12 venture capital funds that run a portfolio of 118 companies. RVC - backed venture capital funds invest predominantly in technologies such as security and counterterrorism, biotech, energy, life sciences, IT and aerospace. At least 80 percent of the RVC's resources are invested in early-stage startups.<br/><br/>
                    RVC is a proud member of the Russian Innovation Center and a key sponsor for Russian Innovation Week 2012.
                </p>
            </div>
            <div class="clear"></div> 
        </div> 
        
        
        <div class="content_index_column">
            <div class="content_img">
                 <a href="http://www.sk.ru/en/" target="_blank"><img src="/img/organizer-skolkovo.png"/></a>
            </div>
            <div class="content_txt">
                <p>
                    The Skolkovo Foundation is a non-profit organization whose mission is to accelerate the transformation of Russia into an innovation-based economy through strategic partnerships with leading scientists and innovators around the world. Founded in May 2010 by the Russian government, the Skolkovo Foundation strives to turn cutting-edge research into world-class products by providing the ideal environment, R&D infrastructure, and scientific and education resources to facilitate innovation in five key business clusters: IT, Energy Efficiency, Nuclear Technology, Biomedicine and Space.<br/><br/> 
                    The Skolkovo Innovation Centre, a physical city currently under construction just outside of Moscow, is a physical manifestation of Skolkovo's mission – a global technology hub that represents Russia's commitment to creating the knowledge-based enterprise economy of tomorrow. The city, which will play host to the 2014 G8 Summit, includes a Technopark research facility, offices for participating companies and start-ups, and education facilities including the Skolkovo Institute of Science and Technology (SkTech), a joint venture between the Foundation and the Massachusetts Institute of Technology (MIT).<br/><br/> 
                    Skolkovo is a proud member of the Russian Innovation Center and a key sponsor for Russian Innovation Week 2012.                                
                </p>
            </div>
            <div class="clear"></div>
        </div>
        
               
        
    </div>
    <div class="clear"></div> 
<!--/*******************************/-->
    <div class="title">        
        <h2>Partners</h2>
    </div>    
    <div class="div_line"><p>&copy; 2012 RIW</p></div>
    <div class="clear"></div>  
    
    <div class="content_index">
        
        <div id="container">
          <a  id="trigger" onmouseover="ShowContent('pop1'); return true;"
                                    onmouseout="HideContent('pop1'); return true;" 
                                    onclick="ReverseContentDisplay ('pop1'); return true;"
                                    href="javascript:ShowContent('pop1')"> 
          	  <img src="../img/partner-candy-solutions.jpg"/>	
          </a>
          <!-- HIDDEN / POP-UP DIV -->
          <div id="pop1" class="pop-up" style="visibility:hidden;">
            <h3>THE HAPPY LIFE</h3>
            <p>
			    Asia-Pacific investors and venture capitalists is Russia's opportunity to introduce foreign investors to the innovation landscape and new financial institutions in Russia. We will also share the best practices of the international venture investment industry.
            </p>
          </div>
        </div>
        
        <div id="container">
          <a  id="trigger" onmouseover="ShowContent('pop2'); return true;"
                                    onmouseout="HideContent('pop2'); return true;" 
                                    onclick="ReverseContentDisplay ('pop2'); return true;"
                                    href="javascript:ShowContent('pop2')"> 
          	  <img src="../img/partner-candy-solutions.jpg"/>	
          </a>
          <!-- HIDDEN / POP-UP DIV -->
          <div id="pop2" class="pop-up" style="visibility:hidden;">
            <h3>THE HAPPY LIFE</h3>
            <p>
			    Asia-Pacific investors and venture capitalists is Russia's opportunity to introduce foreign investors to the innovation landscape and new financial institutions in Russia. We will also share the best practices of the international venture investment industry.
            </p>
          </div>
        </div>
        
        <div id="container">
          <a  id="trigger" onmouseover="ShowContent('pop3'); return true;"
                                    onmouseout="HideContent('pop3'); return true;" 
                                    onclick="ReverseContentDisplay ('pop3'); return true;"
                                    href="javascript:ShowContent('pop3')"> 
          	  <img src="../img/partner-candy-solutions.jpg"/>	
          </a>
          <!-- HIDDEN / POP-UP DIV -->
          <div id="pop3" class="pop-up" style="visibility:hidden;">
            <h3>THE HAPPY LIFE</h3>
            <p>
			    Asia-Pacific investors and venture capitalists is Russia's opportunity to introduce foreign investors to the innovation landscape and new financial institutions in Russia. We will also share the best practices of the international venture investment industry.
            </p>
          </div>
        </div>
        
        <div id="container">
          <a  id="trigger" onmouseover="ShowContent('pop4'); return true;"
                                    onmouseout="HideContent('pop4'); return true;" 
                                    onclick="ReverseContentDisplay ('pop4'); return true;"
                                    href="javascript:ShowContent('pop4')"> 
          	  <img src="../img/partner-candy-solutions.jpg"/>	
          </a>
          <!-- HIDDEN / POP-UP DIV -->
          <div id="pop4" class="pop-up" style="visibility:hidden;">
            <h3>THE HAPPY LIFE</h3>
            <p>
			    Asia-Pacific investors and venture capitalists is Russia's opportunity to introduce foreign investors to the innovation landscape and new financial institutions in Russia. We will also share the best practices of the international venture investment industry.
            </p>
          </div>
        </div>
                      
                                            
		<div id="container">
        <a  id="trigger" onmouseover="ShowContent('pop5'); return true;"
                                    onmouseout="HideContent('pop5'); return true;" 
                                    onclick="ReverseContentDisplay ('pop5'); return true;"
                                    href="javascript:ShowContent('pop5')"> 
          	  <img src="../img/partner-candy-solutions.jpg"/>	
          </a>
          <!-- HIDDEN / POP-UP DIV -->
          <div id="pop5" class="pop-up" style="visibility:hidden;">
            <h3>THE HAPPY LIFE</h3>
            <p>
			    Asia-Pacific investors and venture capitalists is Russia's opportunity to introduce foreign investors to the innovation landscape and new financial institutions in Russia. We will also share the best practices of the international venture investment industry.
            </p>
          </div>
        </div>
                                                             
    
    

    </div>
    <div class="clear"></div>     
<!--/*******************************/-->
    <div class="title">        
        <h2>Sponsors</h2>
    </div>    
    <div class="div_line"><p>&copy; 2012 RIW</p></div>
    <div class="clear"></div>  
    
    <div class="content_index">       
        <div id="container">
          <a  id="trigger" onmouseover="ShowContent('pop21'); return true;"
                                    onmouseout="HideContent('pop21'); return true;" 
                                    onclick="ReverseContentDisplay ('pop21'); return true;"
                                    href="javascript:ShowContent('pop21')"> 
          	  <img src="../img/partner-candy-solutions.jpg"/>	
          </a>
          <!-- HIDDEN / POP-UP DIV -->
          <div id="pop21" class="pop-up" style="visibility:hidden;">
            <h3>THE HAPPY LIFE</h3>
            <p>
			    Asia-Pacific investors and venture capitalists is Russia's opportunity to introduce foreign investors to the innovation landscape and new financial institutions in Russia. We will also share the best practices of the international venture investment industry.
            </p>
          </div>
        </div>                                                          
    </div>
    <div class="clear"></div>     
<!--/*******************************/-->    
</div>