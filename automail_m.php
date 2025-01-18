<?php 

/**
 * @author Nirmal Biswas
 * @copyright 2015
 */
 ini_set("memory_limit","80M");
 date_default_timezone_set('Asia/Kolkata');
require_once('class.phpmailer.php');
include "config.php";

$ftm=date('H:i',strtotime('20:45'));
$ttm=date('H:i',strtotime('21:45'));
$query2 = "INSERT INTO ch(ftm,ttm) VALUES ('$ftm','$ttm')";
$result2 = mysqli_query($conn,$query2);


ob_start();
    include('stock_closing_xlsm.php');

$imgbinary = ob_get_clean();

$to = "nirmal@onnetsolution.com"; 
$to1="basuroyrules@gmail.com";
$to2="gaurab.basuroy@Syngenta.com";
$to3="bodhisatwaguha@gmail.com";
$to4="Bodhisatwa.guha@Syngenta.com";
$to5 = "ikbal@onnetsolution.com"; 
$to6 = "ikbal.jafar46@gmail.com"; 
$from = "info@onlinedkmitra.com"; 
$subject = "Online D. K. Mitra"; 
$message = "<p>Please see the attachment.</p>";
echo date('H:i');
// attachment name
$filename = "stock_closing.xls";

file_put_contents($filename, $imgbinary);

$mail		=	new PHPMailer(true);
	$mail->IsSMTP();
	try 
	{
		$mail->Host				=	"mail.onlinedkmitra.com";				//	SMTP server
		$mail->SMTPDebug		=	0;								//	Enables SMTP debug information (for testing)
		$mail->SMTPAuth			=	true;							//	Enable SMTP authentication
		$mail->Host				=	"mail.onlinedkmitra.com";				//	Sets the SMTP server
		$mail->Port				=	25;							//	Set the SMTP port for the GMAIL server
		$mail->Username			=	"dkmitra";			//	SMTP account user-name
		$mail->Password			=	"aGt59824";					//	SMTP account password
		$mail->AddAddress($to);
		$mail->AddAddress($to1);
		$mail->AddAddress($to2);
		$mail->AddAddress($to3);
		$mail->AddAddress($to4);
		$mail->AddAddress($to5);
		$mail->AddAddress($to6);
		$mail->SetFrom($from, $subject);
		$mail->AddReplyTo($from, $subject);
		$mail->Subject = $subject;
		$mail->AltBody = 'Please Use HTML Compatible Email Viewer!';	
		$mail->MsgHTML($message);
		$mail->addAttachment($filename,'stock_closing.xls');
		$mail->Send();
		
		
		exit ("<meta http-equiv='refresh' content='0;url=index.php'>");
	} 
	catch (phpmailerException $e) 
	{
		echo $e->errorMessage(); //Pretty error messages from PHPMailer
	}

?>