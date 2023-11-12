<?php
$reqlevel = 3; 
include("membersonly.inc.php");
include("functions.php");
$dttm=date('d-m-Y H:i:s');
$dt=date('Y-m-d');
$bno1=$_POST['bno1'];
$bno2=$_POST['bno2'];
if($bno1=="" or $bno2=="")
{
	
	?>
	<script>
	alert("Blank Entry.....");
	window.history.go(-1);
	</script>
	<?
}
else
{
	if($bno1==$bno2)
	{
	?>
	<script>
	alert("Same Bill No. !");
	window.history.go(-1);
	</script>
	<?
	}
	else
	{
	$q=mysqli_query($conn,"select * from main_billing where blno='$bno1'")or die(mysqli_error($conn));
	$q1=mysqli_query($conn,"select * from main_billing where blno='$bno2'")or die(mysqli_error($conn));
	$cnt1=mysqli_num_rows($q1);
	$cnt=mysqli_num_rows($q);
	if($cnt>0 and $cnt1>0)
	{
	$temp='SW'.$bno1;
	$temp1='SW'.$bno2;
	
	
	$result6 = mysqli_query($conn,"Update main_stock set sbill='$temp' where sbill='$bno1'")or die(mysqli_error($conn));
	$result6 = mysqli_query($conn,"Update main_billing set blno='$temp' where blno='$bno1'")or die(mysqli_error($conn));
	$result6 = mysqli_query($conn,"Update main_billdtls set blno='$temp' where blno='$bno1'")or die(mysqli_error($conn));
	$result6 = mysqli_query($conn,"Update main_drcr set cbill='$temp' where cbill='$bno1'")or die(mysqli_error($conn));
		
	$result6 = mysqli_query($conn,"Update main_stock set sbill='$temp1' where sbill='$bno2'")or die(mysqli_error($conn));
	$result6 = mysqli_query($conn,"Update main_billing set blno='$temp1' where blno='$bno2'")or die(mysqli_error($conn));
	$result6 = mysqli_query($conn,"Update main_billdtls set blno='$temp1' where blno='$bno2'")or die(mysqli_error($conn));
	$result6 = mysqli_query($conn,"Update main_drcr set cbill='$temp1' where cbill='$bno2'")or die(mysqli_error($conn));		
	
	
	$result6 = mysqli_query($conn,"Update main_stock set sbill='$bno1' where sbill='$temp1'")or die(mysqli_error($conn));
	$result6 = mysqli_query($conn,"Update main_billing set blno='$bno1' where blno='$temp1'")or die(mysqli_error($conn));
	$result6 = mysqli_query($conn,"Update main_billdtls set blno='$bno1' where blno='$temp1'")or die(mysqli_error($conn));
	$result6 = mysqli_query($conn,"Update main_drcr set cbill='$bno1' where cbill='$temp1'")or die(mysqli_error($conn));
	
	
	
	$result6 = mysqli_query($conn,"Update main_stock set sbill='$bno2' where sbill='$temp'")or die(mysqli_error($conn));
	$result6 = mysqli_query($conn,"Update main_billing set blno='$bno2' where blno='$temp'")or die(mysqli_error($conn));	
	$result6 = mysqli_query($conn,"Update main_billdtls set blno='$bno2' where blno='$temp'")or die(mysqli_error($conn));	
	$result6 = mysqli_query($conn,"Update main_drcr set cbill='$bno2' where cbill='$temp'")or die(mysqli_error($conn));
	edit_log_ntry('main_billing','blno','blno','blno',$bno1,$bno2,$dt,$dttm,$user_currently_loged);
	edit_log_ntry('main_billing','blno','blno','blno',$bno2,$bno1,$dt,$dttm,$user_currently_loged);
		
	edit_log_ntry('main_stock','sbill','sbill','sbill',$bno1,$bno2,$dt,$dttm,$user_currently_loged);
	edit_log_ntry('main_stock','sbill','sbill','sbill',$bno2,$bno1,$dt,$dttm,$user_currently_loged);
	
	edit_log_ntry('main_billdtls','blno','blno','blno',$bno1,$bno2,$dt,$dttm,$user_currently_loged);
	edit_log_ntry('main_billdtls','blno','blno','blno',$bno2,$bno1,$dt,$dttm,$user_currently_loged);
	
	edit_log_ntry('main_drcr','cbill','cbill','cbill',$bno1,$bno2,$dt,$dttm,$user_currently_loged);
	edit_log_ntry('main_drcr','cbill','cbill','cbill',$bno2,$bno1,$dt,$dttm,$user_currently_loged);
	?>
	<script>
	alert("Swap Successfully.....");
	window.location='swip_bno.php';
	</script>
	<?
	}


else
{
	?>
	<script>
	alert("Incurrect Bill No !");
	window.history.go(-1);
	</script>
	<?
}
}
}
?>