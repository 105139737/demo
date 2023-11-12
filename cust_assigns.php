<?php
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('y-m-d');
$edtm=date('y-m-d H:i:s a'); 
$eby=$user_currently_loged;

$cust=$_POST['cust'];
$spid=$_POST['spid'];
	
if($spid=="" or $cust=="")
{
	?>
	<script>
	alert('Please Fill All The Field');
	history.go(-1);
	</script>
	<?
}
else
{
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
	

		$dsql=mysqli_query($conn,"select * from main_cust_asgn where spid='$spid'") or die (mysqli_error($conn));
		$drcnt=mysqli_num_rows($dsql);
		if($drcnt==0)
		{
			$sql=mysqli_query($conn,"insert into main_cust_asgn(spid,cust,edt,eby) values('$spid','$csl','$edt','$eby')") or die (mysqli_error($conn));

		


			?>
			<script>
			alert('Submitted Successfully. Thank You');
			document.location="cust_assign.php";
			</script>
			<?
		}
		else
		{
			?>
			<script>
			alert('Data Already Exists');
			history.go(-1);
			</script>
			<?
		}
}
	

?>