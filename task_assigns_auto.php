<?php 
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$yr=$_REQUEST['yr'];
ini_set("memory_limit", "-1");
set_time_limit(0);
if($yr+1!=date('Y'))
{
    die('Please Check year');
}
$fdt=$yr.'-01-01';
$tdt=$yr.'-12-31';
$yr=$yr+1;
$data1 = mysqli_query($conn,"select * from main_task where sl IN
( SELECT MAX(sl) FROM main_task group by spid,day ) and `dt` BETWEEN '$fdt' AND '$tdt' ORDER BY `main_task`.`spid` ASC");
while ($row1 = mysqli_fetch_array($data1))
{
$spid=$row1['spid'];
$day=$row1['day'];
$cust=$row1['cust'];
$edt=date('Y-m-d');
$edtm=date('Y-m-d H:i:s a'); 
$eby=$user_currently_loged;
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


//$csl=implode(',',$cust);

$sql=mysqli_query($conn,"insert into main_task(spid,cust,day,dt,edt,eby) values('$spid','$cust','$day','$cdtt','$edt','$eby')") or die (mysqli_error($conn));
}
$cdtt=date('Y-m-d', strtotime($cdtt. ' + 7 days'));
$err="Submitted Successfully....";
}
}
?>
<script>
alert("<?php echo $err;?>");
document.location="task_assign.php";
</script>
<?php 
