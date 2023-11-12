<?PHP
 $reqlevel = 1; 
include("membersonly.inc.php");

$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
$a=$_POST[cnm];
$b=$_POST[addr];
$c=$_POST[mob1];
$d=$_POST[mob2];
$e=$_POST[bal];
$g=$_POST[eml];
$k=$_POST[brncd];
$l=$_POST[spnm];
$title_mail="Customer";
$email_message_header= "From: Moonlight <info@moonlightindia.net>";
$err=="";

$vid=0;
$count5=5;

while($count5>0){
$vid=$vid+1;
$vno=str_pad($vid, 8, '0', STR_PAD_LEFT);

$sid=$branch_als.$vno;
$query5="select * from ".$DBprefix."cust where cid='$sid'";
$result5 = mysqli_query($conn,$query5);
$count5=mysqli_num_rows($result5);

}

$queryx="select * from ".$DBprefix."cust where nm='$a' and mob1=$c";
$resultx = mysqli_query($conn,$queryx);
$cntx=mysqli_num_rows($resultx);
if($cntx>0){
    $err="Customer Already Exist";
}

if($err==""){
$query6 = "INSERT INTO ".$DBprefix."cust (cid,nm,addr,mob1,mob2,email,opbl,dbl,edt,eby,brncd) VALUES ('$sid','$a','$b','$c','$d','$g','$e','$e','$dttm','$user_currently_loged','$k')";
$result6 = mysqli_query($conn,$query6);


/*

	$message_mail="Hi, ".$a.", Welcome to Moonlight.Your Customer ID is ".$sid." and Password is . Login for Update www.moonlightindia.net. Thank you.";;
	mail($g, $title_mail, $message_mail, $email_message_header);
 
 
$message="Hi, ".$a.", Welcome to Moonlight.Your Customer ID is ".$sid.". Login for Update www.moonlightindia.net. Thank you.";
//Please Enter Your Details
 $user="sharee"; //your username
 $password="sknsk"; //your password
 $mobilenumbers="91".$c; //enter Mobile numbers comma seperated
 $senderid="SKHUTI"; //Your senderid
 $messagetype="N"; //Type Of Your Message
$url="http://message.onnetsolution.com/TransSMS/SMSAPI.jsp";
 //domain name: Domain name Replace With Your Domain  
 $message = urlencode($message);
 $ch = curl_init(); 
 if (!$ch){die("Couldn't initialize a cURL handle");}
 $ret = curl_setopt($ch, CURLOPT_URL,$url);
 curl_setopt ($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
 curl_setopt ($ch, CURLOPT_POSTFIELDS, 
"username=$user&password=$password&mobileno=$mobilenumbers&message=$message&sendername=$senderid");
 $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");



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
	//echo $curlresponse;    //echo "Message Sent Succesfully" ;
   
 }
*/


?>
<Script language="JavaScript">
alert('Entry Completed.Your Supplier ID is <? echo $sid; ?> Thank You...');
window.history.go(-1);
</script>
<?
}
else
{
?>
<Script language="JavaScript">
alert('<? echo $err;?>');
window.history.go(-1);
</script>
<?
}
?>