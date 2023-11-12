<?php
$reqlevel = 0;
include("membersonly.inc.php");
include('SimpleImage.php');
ini_set("memory_limit","80M");
date_default_timezone_set('Asia/Kolkata');
$dttm=date('d-m-Y H:i:s');
$dt=date('Y-m-d');

$sl=$_POST['sl'];
$nm=$_POST['nm'];
$cnt=$_POST['cnt'];
$adrs=$_POST['adrs'];

if($nm==""||$cnt==""||$adrs=="")
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
	$q=mysqli_query($conn,"select * from main_technician where nm='$nm' and cnt='$cnt' and adrs='$adrs' and sl!='$sl'")or die(mysqli_error($conn));
	$cnt1=mysqli_num_rows($q);
	if($cnt1==0)
	{
		$get=mysqli_query($conn,"select * from main_technician where sl='$sl'") or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($get))
		{
			$path1=$row['img'];
		}
		
		if(file_exists($_FILES['fileToUpload']['tmp_name'])){$path="files/".$sl.'.jpg';}else{$path=$path1;}
		
		move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path);
	
		$qr=mysqli_query($conn,"update main_technician set nm='$nm',cnt='$cnt',adrs='$adrs',img='$path' where sl='$sl'")or die(mysqli_error($conn));
		
		?>
		<script>
		alert("Update Successfully.....");
		window.location='tecn_entr.php';
		</script>
		<?
	}
	else
	{
		?>
		<script>
		alert("Duplicate Entry.....");
		window.history.go(-1);
		</script>
		<?
		
	}
}
?>