<?php 
$_REQUEST['blno'] ?? "";
include("membersonly.inc.php");
include("Numbers/Words.php");
$blno=$_REQUEST[blno];

$data1= mysqli_query($conn,"select * from main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$brncd=$row1['bcd'];
$dt=date('d-m-Y',strtotime($row1['dt']));
$cid=$row1['cid'];
$amm=$row1['amm'];
$damm=$row1['damm'];
$invto=$row1['invto'];
$sale_per=$row1['sale_per'];

if($invto!='')
{
$cust_sl=$invto;	
}
else
{
$cust_sl=$cid;	
}

$datad= mysqli_query($conn,"select * from main_cust where sl='$cust_sl'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$caddr=$rowd['addr'];
$cust_nm=$rowd['nm'];
$cust_cont=$rowd['cont'];
}
}


$rgttl=$amm-$damm;
include "send_sms.php";
$message="Dear ".$cust_nm.",\nThank you for your purchases amounting to Rs.".number_format($rgttl,2)."\nvide Invoice No ".$blno." on ".$dt;
$sms=send_sms($cust_cont,$message,'1');
$datad1= mysqli_query($conn,"select * from main_sale_per where spid='$sale_per'")or die(mysqli_error($conn));
while ($rowd1 = mysqli_fetch_array($datad1))
{
$mob=$rowd1['mob'];
}
$sms=send_sms($mob,$message,'1');	

?>
<Script language="JavaScript">
alert("SMS Send Successfully. Thank You....");
</script>
