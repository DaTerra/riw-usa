<?
	if(!empty($_SESSION['site_agenda']) and $_SESSION['site_agenda']['id_user']>0){
		header('Location: /painel');exit;
	}
?>
<style>
.content_index{width:655px;margin-right:20px;}
#login {
    background: none repeat scroll 0 0 #F1F1F1;
    border: 1px solid #CCCCCC;
    border-radius: 3px 3px 3px 3px;
	width:225px;
	margin:0 auto;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-top: 30px;
}
#login form div {
    clear: both;
    float: none;
    height: 30px;
    margin-bottom: 20px;
}
#login form div p {
    background: url("../img/input_login.jpg") no-repeat scroll 0 0 transparent;
    display: block;
    float: left;
    height: 27px;
    width: 202px;
}
#login form div p input {
    background: none repeat scroll 0 0 transparent;
    border: medium none;
    height: 25px;
    line-height: 25px;
    margin-left: 1px;
    margin-top: 1px;
    padding-left: 5px;
    padding-right: 5px;
    width: 190px;
}
#login form a {
    color: #000000;
    display: block;
    float: left;
    font-size: 11px;
    height: 27px;
    line-height: 27px;
    margin-left: 60px;
    width: 105px;
}
#login form button {
    background: url("../img/bt_login_retrieve.jpg") no-repeat scroll 0 0 transparent;
    border: medium none;
    float: right;
    height: 27px;
    margin-right: 38px;
    text-indent: -9000px;
    width: 70px;
}
</style>
<div  class="right_column_of2">  
    <div class="clear"></div>         
    <div class="corned_box">
    	<div class="top"></div>
        <div class="body">
          <div style="width:55%; float:left; margin-left:20px;">
             <h2>RIW 2012 Meeting Scheduller.</h2>
             <br/> 
             <p> To request your key please enter the follow field with the e-mail that were used to register for the event.</p>
             <br/>
             <p>If you don't have access to the e-mail used to register please contact <a href="mailto:registration@riw-sv.com">registration@riw-sv.com</a>.</p>  
          </div> 
          <div style="width:40%; float:left;">       
                <div id="login">
                    <form name="login" method="post" action="/processa/Keyrecover.php">
                        <div>
                          <label for="email">E-mail:</label><p><input id="email" type="text" name="email" /></p></div>
                        <div>
                        <br/>
                        <button title="Login to Control Panel" type="submit">LogIn</button>
                    </form>
                    <div class="clear"></div>
                </div>
            </div>                       
         	<div class="clear"></div>
      </div>          
         <div class="clear"></div>
         <div class="bottom"></div>
  </div>
        <div class="clear"></div> 
</div>
<script type="text/javascript">
<? if(!empty($_GET['msg'])) echo 'alert("'.urldecode($_GET['msg']).'");';?>
</script>