<?php
require('../../includes/WriteHTML.php');
include('../../includes/Config.inc.php');
include('../../includes/phpmail/class.phpmailer.php');
include('../../includes/Funcoes.php');

$SQL = 'SELECT * FROM tbinformation 
WHERE id_info='.(int)$_GET['id'].' LIMIT 1';	

$Dados = $DB->dados($SQL);
	foreach ($Dados as $a => $b){

	 	$$a = @addslashes($b);

	}

$flag = ($interested_speaking==1)?'Yes':'NO';

$saida = "<p align=\"center\">Content submission</p>
			<br>Contact Information:<br><p><b>First Name:</b>$first_name</p><br><p><b>Last Name:</b>$last_name</p>
            <br><p><b>Last Name:</b>$last_name</p>
		
            <br><p><b>Company:</b>$company</p>
            <br><p><b>Title:</b>$title</p>
            <br><p><b>E-mail:</b>$email</p>
        	<br><hr>	
        	<br>PR Information:
            <br><p><b>Company/PR Contact Name:</b>$company_contact_name</p>
            <br><p><b>Contact Email:</b>$contact_email</p>
        
        	<br><hr>	

        	<br><h4>Tell Us About Your Company:</h4>

            <br><p><b>Company website:</b>$company_website</p>
            <br><p><b>Year Founded:</b>$year_founded</p>
            <br><p><b>Number of Employees:</b>$number_employees</p>
            <br><p><b>Company Description:</b>$company_description</p>
            <br><p><b>Twitter:</b>$twitter</p>
            <br><p><b>Facebook:</b>$facebook</p>
            <br><p><b>Google+:</b>$google</p>
            <br><p><b>YouTube:</b>$you_tube</p>
			
			
			
		<br><hr>
        <br>Speaker/Presentation Information:
            <br><p><b>Speaker Name and Title:</b>$speaker_name</p>
            <br><p><b>Speaker Bio:</b>$speaker_bio</p>
            <br><p><b>Presentation Title:</b>$presentation_title</p>
            <br><p><b>Presentation description:</b>$presentation</p>
            <br><p><b>Interested in speaking to U.S. media?</b>$flag</p>
            <br><p><b>Success stories:</b>$success_stories</p>
            <br><p><b>Speaker Twitter handle:</b>$speaker_twitter</p>
        
		<br><hr>
		
        <br>Tell Us About Your Product:
        
        
           <br> <br><p><b>What are your product’s top three key differentiators from the competition?</b>
            <br>$text1</p>
           <br> <br><p><b>Is there anything special about the design of this product? (hardware or software)</b>
            <br>$text2</p>
            <br><br><p><b>Why would you recommend this product to your family, friend or work colleagues?</b>
           <br> $text3</p>
           <br><br><p><b>Is there an interesting story about how you designed your product and/or started your company?</b>
            <br>$text4</p>
            <br><br><p><b>What demand/need/problem does this product address?</b>
            <br>$text5</p>
            <br><br><p><b>Is it on sale now and where? Cost?</b>
           <br>$text6</p>
        
			
        

";




$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);
$pdf->WriteHTML($saida);
$pdf->Output();
?>
