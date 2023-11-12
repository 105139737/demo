<?php
$reqlevel = 1;
include("membersonly.inc.php");
//$today=date('Y-m-d');
$cid=$_REQUEST['cid'];
$blno=$_REQUEST['blno'];
$tod=$_REQUEST['dt'];
$today=date('Y-m-d',strtotime($tod));



$data2= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
	$dt=$row2['dt'];
}
//echo "(".$today." - ".$dt.")";
$diff = abs(strtotime($today) - strtotime($dt));
$day=($diff/60/60/24);
$result = mysqli_query($conn,"SELECT * FROM main_discount where custid='$cid' and days>='$day' order by days limit 0,1");
if(mysqli_num_rows($result)>0)
{
while ($row = mysqli_fetch_array($result))
{
	$custid=$row['custid'];
	$days=$row['days'];
	$prefnd=$row['prefnd'];
}
}
else
{
   	$days=0;
	$prefnd=0; 
}
?>
<script>
document.getElementById('day').value="<?php echo $day;?>";
document.getElementById('rdis').value="<?php echo $prefnd;?>";
document.getElementById('cdate').value="<?php echo $days;?>";
if(document.getElementById('rdis').value>0)
{
	$('#disl').val('202');
	$('#disl').trigger('chosen:updated');
}

gtcrvl1();
</script>