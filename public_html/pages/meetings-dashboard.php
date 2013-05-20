<?
	if(!($_SESSION['site_agenda']['id_user']>0)){
		header('Location: /meetings');exit;
	}
	//print_r($_SESSION['site_agenda']);
?>
<style>
	.menu-meetings{
		text-align:right;
		}
	.menu-meetings li{
		}
	.menu_meetings{
		text-align:right;
		margin-right:20px;
		margin-top:65px;
		}
	.menu_meetings a{
		font-size:15px;
		color:#4D4D4D;
		font-family:"dtr_pro_lightRg";
		text-transform:capitalize;
		margin-top:10px;
		line-height:25px;
		}	
	.menu_meetings a:hover,
	.menu_meetings .btn_on{
		color:#BD111F;
		}		
	.meetings-btn-propose	
	.meeting-table-content{
		padding-left:50px;
		}
	.meeting-table-content table{
		font-size:12px;
		text-align:left;
		margin-left:20px;	
		width:659px;
		}
	.meeting-table-content h3{
		width:656px;
		text-align:left;
		border-bottom:1px solid #CCC;
		margin-bottom:15px;
		}	
	.meeting-table-content .btn_meet_accept {
		width:16px;
		height:16px;
		background: url("/img/accept-icon.jpg");	
		display:block;
		text-indent:-99999px;
		float:right;
		}
	.meeting-table-content .btn_meet_deny {		
		width:16px;
		height:16px;		
		background: url("/img/decline-icon.jpg");	
		display:block;
		text-indent:-99999px;
		float:right;
		}
	.meeting-table-content .btn_cancel {
		width:16px;
		height:16px;
		background: url("/img/btn_meet_cancel.png");	
		display:block;
		text-indent:-99999px;	
		float:right;
		}
	.meeting-table-content .btn_meet_another_time {
		width:16px;
		height:16px;
		background: url("/img/reschedule-icon.jpg");	
		display:block;
		text-indent:-99999px;	
		float:right;	
		}				
	.meet_date{width:40px;}
	.meet_start{width:60px;}
	.meet_end{width:60px;}
	.meet_description{width:290px;}
	.meet_table{width:60px;}
	.meet_status{width:80px;}
	.meet_actions{width:70px;}
	.left_column_of2 a { text-decoration:underline;}
	.left_column_of2 a:hover {color:red;}
</style>
<div class="left_column_of2">
	<div style="margin:0px 10px 0px 15px; padding:10px;background:white; border:2px solid #CCC;">
        <p>To propose a meeting, go to the <a href="/speakers">Speaker</a> profile or <a href="/participants">Participants</a> page and click 'Propose a Meeting'.</p>
        <br/>
        <p>Please note that not all partcipants are available for meetings.</p>
    </div>
</div>
<div  class="right_column_of2">  
    <div class="clear"></div>         
    <div class="corned_box">
    	<div class="top"></div>
        <div class="body">
          <div class="meeting-table-content">     			
         
			<? //=$_SESSION['site_agenda']['id_user']?>
            <h3>My Meetings
            <a style="float:right; margin-left:10px;font-weight:normal;text-transform:none;" href="/meetings-dashboard">Refresh&nbsp;&nbsp;</a> 
             <span style="float:right; text-transform:none;font-size:12px;">&nbsp;&nbsp;&nbsp;|</span>
            <a style="float:right; margin-left:10px;font-weight:normal;text-transform:none;" href="/processa/logoff.php">Log off</a> 
            <span style="float:right; text-transform:none;font-size:12px;"> 
			<?
            	echo 'Hello '. $_SESSION['site_agenda']['first_name'].' '.$_SESSION['site_agenda']['last_name'].'&nbsp;&nbsp;&nbsp;&nbsp;|';
			?> 
            </span></h3>	
            <table>            	
                <tr>
                	<th class="meet_date">Date</th>
                    <th class="meet_start">Start</th>
                    <th class="meet_end">End</th>
                    <th class="meet_description">Description</th>
                    <th class="meet_table">Table</th>
                    <th class="meet_status">Status</th>
                    <th class="meet_actions">Actions</th>
                </tr>
				<?
                	$consulta = $DB->consulta('SELECT * FROM tbmeeting_convites
												INNER JOIN tbmeeting_instantes ON tbmeeting_convites.id_instante=tbmeeting_instantes.id_instante
												INNER JOIN tbmeeting_day ON tbmeeting_instantes.id_day=tbmeeting_day.id_day
												WHERE (id_convidado='.(int)$_SESSION['site_agenda']['id_user'].' OR id_solicitante='.(int)$_SESSION['site_agenda']['id_user'].') AND (status=1 or  status_edit=4) ORDER BY ordem DESC');
					
					if($DB->nun_linhas($consulta)>0){
					while($linha = $DB->lista($consulta)){
						$instante = $DB->dados('SELECT * FROM tbmeeting_instantes WHERE id_instante='.(int)($linha['id_instante']+1).' LIMIT 1');
						
						if($_SESSION['site_agenda']['id_user']==$linha['id_convidado']){
							$id_user = $linha['id_solicitante'];
						}else{
							$id_user = $linha['id_convidado'];
						}
						$convidado = $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$id_user.' LIMIT 1');
						$mesa = $DB->dados('SELECT * FROM tbmeeting_table WHERE id_table='.(int)$linha['id_table'].' LIMIT 1');
												
						switch ($linha['status']){
							case 1:
								$satus = 'Confirmed';
								break;
							case 2:
								$satus = 'Declined';
								break;
							case 3:
								$satus = 'Rescheduled';
								break;
								
							default:
								$satus = 'Pending';
						}
				?>
                <tr>
                  <td height="19"><?=$linha['day']?></td>
                  <td><?=$linha['instante']?></td>
                  <td><?=$instante['instante']?></td>
                  <td><?=$convidado['first_name']?> <?=$convidado['last_name']?>, <? if(!empty($convidado['title'])) echo $convidado['title'].',';?> <?=$convidado['company']?></td>
                  <td><?=$mesa['table']?></td>
                  <td><?=$satus?></td>
                  <td> <? if($satus!='Declined') {?> 
                  		<a class="btn_meet_another_time"  onclick="confirma_remarca('/instantes?acao=res&con=<?=($linha['id_solicitante']==$_SESSION['site_agenda']['id_user'])? $linha['id_convidado']:$linha['id_solicitante']?>&sol=<?=$_SESSION['site_agenda']['id_user']?>&reg=<?=$linha['id_convite']?>')" href="javascript:voind(0)" title="Reschedule">Change</a>
                        <a class="btn_meet_deny"  onclick="confirma_decline('/processa/meeting_acoes.php?acao=mydecline&con=<?=$linha['id_convidado']?>&sol=<?=$linha['id_solicitante']?>&reg=<?=$linha['id_convite']?>')" href="javascript:voind(0)" title="Decline">Decline</a> 
                        
                  	<? }?>
                  </td>
                </tr>
                <? }}else{?>
                <tr>
                	<td colspan="7" align="center"><br />No results!</td>
                </tr>
                <? }?>

            </table>  
            <br/>
            <br/>                
            <h3>Received Proposals</h3>
            <table>            	
                <tr>
               	  <th class="meet_date">Date</th>
                  <th class="meet_start">Start</th>
                  <th class="meet_end">End</th>
                  <th class="meet_description">Description</th>
                  <th class="meet_table">Table</th>
                  <th class="meet_status">Status</th>
                  <th class="meet_actions">Actions</th>
                </tr>
				<?
                	$consulta = $DB->consulta('SELECT * FROM tbmeeting_convites
												INNER JOIN tbmeeting_instantes ON tbmeeting_convites.id_instante=tbmeeting_instantes.id_instante
												INNER JOIN tbmeeting_day ON tbmeeting_instantes.id_day=tbmeeting_day.id_day
												WHERE (id_convidado='.(int)$_SESSION['site_agenda']['id_user'].') AND (status=0 OR status=3 OR status_edit=6 or status_edit=5) ORDER BY ordem DESC');
					if($DB->nun_linhas($consulta)>0){
					while($linha = $DB->lista($consulta)){
						$instante = $DB->dados('SELECT * FROM tbmeeting_instantes WHERE id_instante='.(int)($linha['id_instante']+1).' LIMIT 1');
						
						if($_SESSION['site_agenda']['id_user']==$linha['id_convidado']){
							$id_user = $linha['id_solicitante'];
						}else{
							$id_user = $linha['id_convidado'];
						}											
						$convidado = $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$id_user.' LIMIT 1');
						$mesa = $DB->dados('SELECT * FROM tbmeeting_table WHERE id_table='.(int)$linha['id_table'].' LIMIT 1');						
						switch ($linha['status']){
							case 1:
								$satus = 'Confirmed';
								break;
							case 2:
								$satus = 'Declined';
								break;
							case 3:
								$satus = 'Rescheduled';
								break;
								
							default:
								$satus = 'Pending';
						}
				?>
                <tr>
                  <td><?=$linha['day']?></td>
                  <td><?=$linha['instante']?></td>
                  <td><?=$instante['instante']?></td>
                  <td><?=$convidado['first_name']?> <?=$convidado['last_name']?>, <? if(!empty($convidado['title'])) echo $convidado['title'].',';?> <?=$convidado['company']?></td>
                  <td><?=$mesa['table']?></td>
                  <td><?=$satus?></td>
                  <td>
					<? if($satus!='Declined') {?>                     
                    <a class="btn_meet_another_time" onclick="confirma_remarca('/instantes?acao=res&con=<?=($linha['id_solicitante']==$_SESSION['site_agenda']['id_user'])? $linha['id_convidado']:$linha['id_solicitante']?>&sol=<?=$_SESSION['site_agenda']['id_user']?>&reg=<?=$linha['id_convite']?>')" href="javascript:voind(0)" title="Reschedule">Change</a>    
                	<a class="btn_meet_deny" onclick="confirma_decline('/processa/meeting_acoes.php?acao=decline&tp=1&con=<?=$linha['id_convidado']?>&sol=<?=$linha['id_solicitante']?>&reg=<?=$linha['id_convite']?>')" href="javascript:voind(0)" title="Decline">Decline</a>
                    
                    <a class="btn_meet_accept" onclick="confirma_acept('/processa/meeting_acoes.php?acao=acept&tp=1&con=<?=$linha['id_convidado']?>&sol=<?=$linha['id_solicitante']?>&reg=<?=$linha['id_convite']?>')" href="javascript:voind(0)" title="Accept">Accept</a

					><? }?> 
                  </td>
                </tr>
                <? }}else{?>
                <tr>
                	<td colspan="7" align="center"><br />No results!</td>
                </tr>
                <? }?>
            </table> 
            <br/>
            <br/>                    
            <h3>Sent Proposals</h3>
            <table>            	
                <tr>
               	  <th class="meet_date">Date</th>
                  <th class="meet_start">Start</th>
                  <th class="meet_end">End</th>
                  <th class="meet_description">Description</th>
                  <th class="meet_table">Table</th>
                  <th class="meet_status">Status</th>
                  <th class="meet_actions">Actions</th>
                </tr>
				<?
                	$consulta = $DB->consulta('SELECT * FROM tbmeeting_convites
												INNER JOIN tbmeeting_instantes ON tbmeeting_convites.id_instante=tbmeeting_instantes.id_instante
												INNER JOIN tbmeeting_day ON tbmeeting_instantes.id_day=tbmeeting_day.id_day
												WHERE id_solicitante='.(int)$_SESSION['site_agenda']['id_user'].' AND status<>1 AND status_edit <> 4   ORDER BY ordem DESC');
																								
					if($DB->nun_linhas($consulta)>0){
					while($linha = $DB->lista($consulta)){
						$instante = $DB->dados('SELECT * FROM tbmeeting_instantes WHERE id_instante='.(int)($linha['id_instante']+1).' LIMIT 1');
												
						if($_SESSION['site_agenda']['id_user']==$linha['id_convidado']){
							$id_user = $linha['id_solicitante'];
						}else{
							$id_user = $linha['id_convidado'];
						}
						
						$convidado = $DB->dados('SELECT * FROM tbuser WHERE id_user='.(int)$id_user.' LIMIT 1');
						$mesa = $DB->dados('SELECT * FROM tbmeeting_table WHERE id_table='.(int)$linha['id_table'].' LIMIT 1');
						
						switch ($linha['status']){
							case 1:
								$satus = 'Confirmed';
								break;
							case 2:
								$satus = 'Declined';
								break;
							case 3:
								$satus = 'Rescheduled';
								break;
								
							default:
								$satus = 'Pending';
						}

				?>
                <tr>
                  <td><?=$linha['day']?></td>
                  <td><?=$linha['instante']?></td>
                  <td><?=$instante['instante']?></td>
                  <td><?=$convidado['first_name']?> <?=$convidado['last_name']?>, <? if(!empty($convidado['title'])) echo $convidado['title'].',';?> <?=$convidado['company']?></td>
                  <td><?=$mesa['table']?></td>
                  <td><?=$satus?></td>
                  <td>
                  <? if($satus!='Declined') {?> 
                   <a class="btn_meet_another_time" onclick="confirma_remarca('/instantes?acao=res&con=<?=($linha['id_solicitante']==$_SESSION['site_agenda']['id_user'])? $linha['id_convidado']:$linha['id_solicitante']?>&sol=<?=$_SESSION['site_agenda']['id_user']?>&reg=<?=$linha['id_convite']?>')" href="javascript:voind(0)" title="Reschedule">Change</a>
                  	<a class="btn_meet_deny" onclick="confirma_decline('/processa/meeting_acoes.php?acao=sentdecline&tp=1&con=<?=$linha['id_convidado']?>&sol=<?=$linha['id_solicitante']?>&reg=<?=$linha['id_convite']?>')" href="javascript:voind(0)" title="Decline">Decline</a>                      
                  <? }?>
                  </td>
                </tr>
                <? }}else{?>
                <tr>
                	<td colspan="7" align="center"><br />No results!</td>
                </tr>
                <? }?>
            </table>
          </div>                                         
          <div class="clear"></div>
      </div>          
     <div class="clear"></div>
     <div class="bottom"></div>
  </div>
  <div class="clear"></div> 
</div>
<script type="text/javascript">
	function confirma_decline(n){
		if(confirm("Are you sure you want to decline this meeting?")){
			window.location = n;
		}else{ 
			return false;
		}
	}
	
	function confirma_acept(n){
		if(confirm("Are you sure you want to accept this meeting?")){
			window.location = n;
		}else{ 
			return false;
		}
	}
	
	function confirma_remarca(n){
		if(confirm("Are you sure you want to  reschedule this meeting?")){
			window.location = n;
		}else{ 
			return false;
		}
	}
</script>
<script type="text/javascript">
<? if(!empty($_GET['msg'])) echo 'alert("'.urldecode($_GET['msg']).'");';?>
</script>
