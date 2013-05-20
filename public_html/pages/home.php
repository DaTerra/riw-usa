<script>
        $(document).ready(function() {
            $('#home ul').roundabout({
                minZ: 100,
                maxZ: 300,
                minOpacity: 0.1,
				maxOpacity: 1,
                minScale: 0.2,
				maxScale: 1,
                childSelector: '.mover',
                bearing: 0.2,
                tilt: 3
            });
        });
</script>

<style type="text/css">
.mover moverbggrey{ color:#fff;}

</style>
<div id="home">
    <!-- /*****/ -->
    <div class="clear"></div>
    <div class="right_column_of2">
        <div id="highlights_wrapper">
        	<ul class="carrossel">
            
            	<?
                	$consulta = $DB->consulta('SELECT * FROM tbhighlights WHERE status=1 ORDER BY RAND() LIMIT 6');
					$x=0;
					while($linha = $DB->lista($consulta	)){$x++;
					
					switch($x){
						case 1:
						$classe ='moverbggrey';
						break;
						case 2:
						$classe ='moverbgred';
						break;
						case 3:
						$classe ='moverbgblue';
						$x=0;
						break;
						
						default:
						$x=0;
					}
				?>
            
                <li class="mover <?=$classe?>">
                    <span>
                            <strong style="line-height:140%; color:#fff;"><?=$linha['titulo']?></strong><br/>
                           <div style="color:#fff; float:left;"><?=$linha['sub']?></div>
                           <a style="color:#fff; float: right" href="<?=$linha['link']?>">More Info</a>
                    </span>
                </li>
               <? }?> 
            </ul>
        </div>            
            <!-- /***** Text Home *****/ --> 
        <div class="clear"></div>
        <div  class="text-home">
            <h2>What is the Russian Innovation Week Conference?</h2>
            <br/>
            <p>
                The Russian Innovation Week Conference brings together leading startup entrepreneurs, venture capitalists and successful business leaders from the U.S. and Russia to forge mutually beneficial partnerships and build pathways for doing business in Russia.<br/><br/>
                
                The RIW Conference will bring Russian innovators and startups to the U.S. in search of the perfect investment partner and strategies to bring their products to a global market. Throughout this two-day information and networking-packed gathering, deals will be made and long-lasting strategic partnerships between Americans and Russians will be brokered. The RIW Conference is the perfect venue for investors looking for the next new innovative project to explore emerging developments in the fields of clean-tech, bio-tech, pharmaceuticals, the life sciences, nanotechnology and IT, while investors and companies who have business experience in Russia will share insights on tapping the best funding opportunities.<br/><br/>
                
                This inaugural event is hosted by the Russian Innovation Center, which is composed of three Russian technology and innovation powerhouses - RUSNANO, Russian Venture Company and the Skolkovo Foundation. Symbolically, it is taking place in the Computer History Museum, in the very heart of Silicon Valley.<br/><br/>
                
                Don't miss this opportunity to mingle, connect and learn from successful business leaders with footholds in Silicon Valley and Russia!
            </p>  
                        
        </div>       
        <div class="clear"></div>             
    </div>
</div>