<?

ob_start();
    include('stock_closing_xlsm.php');

$imgbinary = ob_get_clean();


$to = "nirmal@onnetsolution.com"; 
$to1="basuroyrules@gmail.com";
$to2="gaurab.basuroy@Syngenta.com";
$to3="bodhisatwaguha@gmail.com";
$to4="Bodhisatwa.guha@Syngenta.com";
$from = "Online D. K. Mitra<info@onlinedkmitra.com>"; 
$subject = "Online D. K. Mitra"; 
$message = "<p>Please see the attachment.</p>";

$separator = md5(time());
// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;
// attachment name
$filename = "stock_closing.xls";

$attachment = chunk_split(base64_encode($imgbinary));
// main header (multipart mandatory)
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol; 
$headers .= "Content-Transfer-Encoding: 7bit".$eol;
$headers .= "This is a MIME encoded message.".$eol;
// message
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$headers .= "Content-Transfer-Encoding: 8bit".$eol;
$headers .= $message.$eol;
// attachment
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$headers .= "Content-Transfer-Encoding: base64".$eol;
$headers .= "Content-Disposition: attachment".$eol;
$headers .= $attachment.$eol;// send message
mail($to, $subject, "", $headers);
?>