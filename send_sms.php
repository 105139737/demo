<?php 

function send_sms($mob1,$message,$messagetype=1)
{
include("config.php");
$datas=mysqli_query($conn,"select * from global where sl=1")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($datas))
{
$sms=$row['sms'];
$linkGen=$row['linkGen'];
}
if($sms==1){
$user="HINDIS"; 
$password="5f4cb27909XX"; 
$mobilenumbers=$mob1; 
$senderid="HINDBR"; 
$url="http://onssms.onnetsolution.com/submitsms.jsp?";
//$url="http://103.233.79.246/submitsms.jsp?";
$message = urlencode($message);
$postdata = "user=$user&key=$password&mobile=$mobilenumbers&message=$message&senderid=$senderid&accusage=$messagetype";
$ch = curl_init($url.$postdata);
$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$curlresponse = curl_exec($ch); // execute
if(curl_errno($ch))
	echo 'curl error : '. curl_error($ch);

 if (empty($ret)) {
    // some kind of an error happened
    die(curl_error($ch));
    curl_close($ch); // close cURL handler
 } else {
    $info = curl_getinfo($ch);
    curl_close($ch); // close cURL handler
    //echo "<br>";
	//echo $curlresponse;    
	//echo "Message Sent Succesfully" ;
  
 }
return $curlresponse;
}
}

echo send_sms('8101236848','test jafar');
?>

