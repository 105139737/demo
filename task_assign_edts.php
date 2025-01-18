<?php 
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$edtm=date('Y-m-d H:i:s a'); 
$eby=$user_currently_loged;

$sl=$_POST['sl'];
$spid=$_POST['spid'];
$day=$_POST['day'];
$cust=$_POST['cust'];
$dt=$_POST['dt'];
$err="";	
if($spid=="" or $cust=="" or $day=="" or $dt=="")
{
$err='Please Fill All The Field....';
}
$qr=mysqli_query($conn,"select * from main_task where spid='$spid' and cust='$cust' and day='$day' and dt='$dt' and sl!='$sl'") or die (mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0)
{
	$err="Duplicate Entry....";
}
if($err==""){
$dt=date('Y-m-d',strtotime($dt));

$csl="";
$cnt=count($cust);	
for($i=0;$i<$cnt;$i++)
{
if($csl=="")
{
$csl=$cust[$i];	
}
else
{
$csl=$csl.",".$cust[$i];
}
}

$sql=mysqli_query($conn,"update main_task set cust='$csl' where sl>='$sl' and spid='$spid' and day='$day'") or die (mysqli_error($conn));


?>
<script>
alert("Update Successfully....");
document.location="task_assign.php";
</script>
<?php 
}
else
{
?>
<script>
alert("<?php  echo $err;?>");
window.history.go(-1);
</script>
<?php 	
}
?>