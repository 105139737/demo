<?php

function send_sms($mob1,$message,$messagetype=1)
{
  
$user="HINDIS"; 
$password="5f4cb27909XX"; 
$mobilenumbers=$mob1; 
$senderid="CLNEXT"; 
//$url="http://onssms.onnetsolution.com/submitsms.jsp?";
$url="http://103.233.79.246/submitsms.jsp?";
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

//send_sms('8101236848','test jafar');
?>

