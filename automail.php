<?php 

/**
 * @author Nirmal Biswas
 * @copyright 2015
 */
 ini_set("memory_limit","80M");
 date_default_timezone_set('Asia/Kolkata');
require_once('class.phpmailer.php');
include "config.php";
$dt=date('Y-m-d');
$ftm=date('H:i',strtotime('20:45'));
$ttm=date('H:i',strtotime('21:45'));
$dttm=date('Y-m-d H:i:s a');
$query2 = "INSERT INTO ch(ftm,ttm,dt,dtm) VALUES ('$ftm','$ttm','$dt','$dttm')";
$result2 = mysqli_query($conn,$query2);

if($ftm<date('H:i') && $ttm>date('H:i'))
{

ob_start();
    include('stock_closing_xlsm.php');

$imgbinary = ob_get_clean();

$to = "nirmal@onnetsolution.com"; 
$to2="abhradip.pal@syngenta.com";
$to3="bodhisatwa.guha@syngenta.com";
$to5 = "ikbal@onnetsolution.com"; 
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
		$mail->Username			=	"info@onlinedkmitra.com";			//	SMTP account user-name
		$mail->Password			=	"aGt59824";					//	SMTP account password
		$mail->AddAddress($to);
		$mail->AddAddress($to2);
		$mail->AddAddress($to3);
		
		$mail->AddAddress($to5);
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
}
?>