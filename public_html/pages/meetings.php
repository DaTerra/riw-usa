<?
	if(!empty($_SESSION['site_agenda']) and $_SESSION['site_agenda']['id_user']>0){
		header('Location: /meetings-dashboard');exit;
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
    margin-left: 0px;
    width: 105px;
}
#login form button {
    background: url("../img/bt_login_entrar.gif") no-repeat scroll 0 0 transparent;
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
          <div style="width:660px; float:left; padding:0 20px;">
            <div style="width:38%; float:right; margin:0 0 15px 15px;">       
            <div id="login">
              <form name="login" method="post" action="/processa/Meetings.php">
                    <div>
                      <label for="email">E-mail:</label><p><input id="email" type="text" name="email" /></p>
                    </div>
                    <div>
                      <label for="key">Key:</label><p><input id="key" type="password" name="key" /></p>
                    </div>
                    <div class="clear"></div>
                <a title="" href="/keyrecover">Login trouble?</a>
                <button title="Login to Control Panel" type="submit">LogIn</button>
                
              </form>
              <div class="clear"></div>
                </div>
            </div>
             <h2>RIW 2012 Meeting Dashboard.</h2>
             <br/> 
             <p> Welcome to the RIW 2012 Meeting Dashboard.</p><br/>
             <p>Use your e-mail, the same used to register, and your personal key to login.</p><br/>
              
          </div> 
                                 
         	<div class="clear"></div>
      </div>          
         <div class="clear"></div>
         <div class="bottom"></div>
  </div>
        <div class="clear"></div> 
</div>
<script type="text/javascript">
<? if(!empty($_GET['msg'])) echo 'alert("'.urldecode($_GET['erro']).'");';?>
</script>
