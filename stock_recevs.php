<?php
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$blno=$_REQUEST['blno'];
$dt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s a');
$query111 = "SELECT * FROM main_trns where blno='$blno'";
$result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$tbcd=$R111['tbcd'];
}

$query211 = "update main_trns set stat='1',rdt='$dt' where blno='$blno'";
$result211 = mysqli_query($conn,$query211)or die (mysqli_error($conn)); 

$query100 = "SELECT * FROM ".$DBprefix."trndtl where blno='$blno' and stat='0' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$dtl_sl=$R100['sl'];
$prsl=$R100['prsl'];
$prnm=$R100['prnm'];
$qnty=$R100['qty'];
$rmk=$R100['rmk'];
$fbcd=$R100['fbcd'];
$refno=$R100['refno'];
$usl=$R100['usl'];
$unit=$R100['unit'];
$betno=$R100['betno'];
$ret=$R100['ret'];
$rate=$R100['rate'];
$stk_rate=$R100['stk_rate'];


$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$prsl'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}
if($unit=='sun'){$stock_in=$qnty*$smvlu;$uval=$smvlu;}
if($unit=='mun'){$stock_in=$qnty*$mdvlu;$uval=$mdvlu;}
if($unit=='bun'){$stock_in=$qnty*$bgvlu;$uval=$bgvlu;}

$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,stin,nrtn,eby,dtm,stat,refno,tin,ret,rate,stk_rate,unit,usl,uval,betno) VALUES ('$prsl','$tbcd','$dt','$stock_in','Receive','$user_currently_loged','$edtm','1','$refno','$blno','$ret','$rate','$stk_rate','$unit','$usl','$uval','$betno')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 

$query211 = "update ".$DBprefix."stock set stat='1' where tout='$blno' and pcd='$prsl'";
$result211 = mysqli_query($conn,$query211)or die (mysqli_error($conn)); 

$query211 = "update main_trndtl set stat='1'  where sl='$dtl_sl'";
$result211 = mysqli_query($conn,$query211)or die (mysqli_error($conn)); 
}
?>
<Script language="JavaScript">
alert('Receive Successfully. Thank You...');
document.location="stock_recv.php";
</script>

