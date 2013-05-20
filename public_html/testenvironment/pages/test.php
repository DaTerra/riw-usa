
					<script type="text/javascript">
                          $(function() {
                                $('#content-container-packages a').bind('click', function() {
                                    if ($(this).parent().hasClass('aberto')) {
                                        $(this).parent().find('#content-container-packages-content').slideUp();
                                        $(this).parent().removeClass('aberto');
                                        return 0;
                                    }
                                    // $(this).parent().parent().find('#content-container-packages-content').slideUp();
                                    $(this).parent().find('#content-container-packages-content').slideDown();
                                    $(this).parent().addClass('aberto');
									$("#side-box").load('pages/column-right-special-free-hosting.php');
                                    $("#side-box1").load('pages/column-right-special-case-studies.php');
                                })
                             });
                    </script>                 
 
                       
                    <div id="content-container-packages">                                                              
                      <h4><a href="javascript:void(null)"> Packages </a></h4> 
                      <div id="content-container-packages-content" style="display:none">                            
                              <p>aaaaaaaaaaaaaaaaaaaa</p> 
	  
                      </div><!-- content-container-packages-content END -->                
                    </div> <!-- content-container-packages END -->                           
         
                           



   