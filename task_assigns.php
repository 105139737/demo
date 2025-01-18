<?php 
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$edtm=date('Y-m-d H:i:s a'); 
$eby=$user_currently_loged;
$spid=$_POST['spid'];
$day=$_POST['day'];
$cust=$_POST['cust'];
$yr=$_POST['yr'];
$cdt=date('Y-m-d');
$dd=strtolower(date('l'));
if($dd==$day)
{
	$cdtt=date("Y-m-d",strtotime($cdt));
}
else
{
	$cdtt=date("Y-m-d", strtotime("next $day", strtotime($cdt)));
}
$ldtt=$yr.'-12-31';
$ldtt=date('Y-m-d',strtotime($ldtt));

	
if($spid=="" or $cust=="" or $day=="" or $yr=="")
{
$err='Please Fill All The Field....';
}
$diff = (strtotime($ldtt) - strtotime($cdtt));
$diff = floor($diff / (60*60*24));


$ddig=floor($diff/7);
for($i=0;$i<$ddig;$i++)
{
	$err="";
	

$qr=mysqli_query($conn,"select * from main_task where spid='$spid'  and day='$day' and dt='$cdtt'") or die (mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0)
{
	$err="Duplicate Entry....";
}
if($err=="")
{


$csl=implode(',',$cust);
$sql=mysqli_query($conn,"insert into main_task(spid,cust,day,dt,edt,eby) values('$spid','$csl','$day','$cdtt','$edt','$eby')") or die (mysqli_error($conn));
}
$cdtt=date('Y-m-d', strtotime($cdtt. ' + 7 days'));
$err="Submitted Successfully....";
}
?>
<script>
alert("<?php echo $err;?>");
document.location="task_assign.php";
</script>
<?php 
