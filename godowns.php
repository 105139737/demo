<?php
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('y-m-d');
$edtm=date('y-m-d H:i:s a');

$sl=$_POST['sl'];
$bnm=$_POST['bnm'];
$gnm=$_POST['gnm'];
$addr=$_POST['addr'];
$dist=$_POST['dist'];
$pin=$_POST['pin'];
if($gnm=="")
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
	
	if($sl=="")
	{
	$dsql=mysqli_query($conn,"select * from main_godown where gnm='$gnm' and addr='$addr' ") or die (mysqli_error($conn));
	$drcnt=mysqli_num_rows($dsql);
	if($drcnt==0)
	{
			$sql=mysqli_query($conn,"insert into main_godown(gnm,addr,dist,pin) values('$gnm','$addr','$dist','$pin')") or die (mysqli_error($conn));
	
			?>
			<script>
			alert('Submitted Successfully. Thank You');
			document.location="godown.php";
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
	else
	{
		$dsql=mysqli_query($conn,"select * from main_godown where gnm='$gnm' and addr='$addr' and sl!='$sl'") or die (mysqli_error($conn));
	$drcnt=mysqli_num_rows($dsql);
	if($drcnt==0)
	{
	$sql=mysqli_query($conn,"update main_godown set gnm='$gnm',addr='$addr',dist='$dist',pin='$pin' where sl='$sl'") or die (mysqli_error($conn));

			?>
			<script>
			alert('Update Successfully. Thank You');
			document.location="godown.php";
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

	
	
	}
?>