<script type="text/javascript">
      $(function() {
        var moveLeft = 2;
        var moveDown = 2;        
        $('a#trigger').hover(function(e) {
          $('div#pop-up-home').show();
          //.css('top', e.pageY + moveDown)
          //.css('left', e.pageX + moveLeft)
          //.appendTo('body');
        }, function() {
          $('div#pop-up-home').hide();
        });        
        $('a#trigger').mousemove(function(e) {
          $("div#pop-up-home").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
        });        
      });
</script>
          

<div id="home">
    <div class="countdown">
        <p>Starts in &nbsp; </p>
        <p id="time" class="time"></p>
        <p>&nbsp; Days</p>
        <div class="clear"></div>
        <a href="#">Register</a>
    </div>
    <div id="highlights_stage">
<!--*************************************************************************-->  
<!--*************************************************************************-->     
        <div id="container-home">
             	<a id="trigger" class="hl_1">
                    <div class="highlight_box">
                        <div class="highlight_id">
                            <h2>1</h2>
                        </div>
                    </div>
                    <div class="clear"></div>
            	</a>
          <!-- HIDDEN / POP-UP DIV -->
          <div id="pop-up-home">
            <p>
			   100 best<br/> 
               Russian<br/> 
               startups with<br/> 
               cutting-edge technology in IT, CleanTech and Biotech
            </p>
          </div>
        </div>    
<!--*************************************************************************-->  
<!--*************************************************************************-->    
        <div id="container-home">
             	<a id="trigger" class="hl_2">
                    <div class="highlight_box">
                        <div class="highlight_id">
                            <h2>2</h2>
                        </div>
                    </div>
                    <div class="clear"></div>
            	</a>
          <!-- HIDDEN / POP-UP DIV -->
          <div id="pop-up-home">
            <p>
			   100 best<br/> 
               Russian<br/> 
               startups with<br/> 
               cutting-edge technology in IT, CleanTech and Biotech
            </p>
          </div>
        </div>
<!--*************************************************************************-->


    
        <div class="home_text">
            <h2>About the RIW 2012</h2>
            <p>This visit of the leading Asia-Pacific investors and venture capitalists is Russia's opportunity to introduce foreign investors to the innovation landscape and new financial institutions in Russia. We will also share the best practices of the international venture investment industry and explore mutual interests that could lead to cooperation.<br/><br/>
               The third annual Global Innovation Partnerships forum will take place in Moscow on 2-4 October, 2012. RUSNANO, RVC, and The Skolkovo Foundation as the organizers of the 2012 Asia-Pacific Business Trip to Russia, together with the Russian Venture Capital Association (RVCA), will introduce the delegates to the Russian high technology sector and financial institutions, exchange views on the best practices of the international venture capital community and explore mutual interests.</p>
        </div>
    </div>
    
    
    <div class="clear"></div>
    <div class="home_organizers">
        <h2>Organized by</h2>
        <div class="div_line">
            <p>&copy; 2012 RIW</p>                	
        </div>
        <div class="clear"></div>
        <div class="logos">
            <a href="#"><img class="first" src="/img/organizer-rvc.png"/></a>
            <a href="#"><img src="/img/organizer-rusnano.png"/></a>
            <a href="#"><img src="/img/organizer-skolkovo.png"/></a>
        </div>
        <div class="clear"></div>
    </div>
</div>