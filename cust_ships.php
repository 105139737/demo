<?PHP 
$reqlevel = 3; 
include("membersonly.inc.php");

$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');

$cid=$_POST['cid'];
$sl=$_POST['sl'];
$addr=$_POST['addr'];
$mob=$_POST['mob'];
$is_default=0;
$data= mysqli_query($conn,"select * from main_cust_shipping where cid='$cid' ")or die(mysqli_error($conn)); 
$count=mysqli_num_rows($data);
if($count==0){$is_default=1;}
if($sl==""){
$query6 = "INSERT INTO main_cust_shipping (cid,addr,mob,edtm,eby,is_default)
 VALUES ('$cid','$addr','$mob','$dttm','$user_currently_loged','$is_default')";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));
}
else
{
$query6 = "UPDATE main_cust_shipping set addr='$addr',mob='$mob',edtm='$dttm',eby='$user_currently_loged' where sl='$sl'";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));   
}
?>

<Script language="JavaScript">
alert('Submitted Successfully. Thank You...');
document.location="cust_ship.php?cid="+<?php echo $cid;?>;
</script>

