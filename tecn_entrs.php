<?php
$reqlevel = 0;
include("membersonly.inc.php");
include('SimpleImage.php');
ini_set("memory_limit","80M");
date_default_timezone_set('Asia/Kolkata');
$dttm=date('d-m-Y H:i:s');
$dt=date('Y-m-d');

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
	$q=mysqli_query($conn,"select * from main_technician where nm='$nm' and cnt='$cnt' and adrs='$adrs'")or die(mysqli_error($conn));
	$cnt1=mysqli_num_rows($q);
	if($cnt1==0)
	{
	
		$qr=mysqli_query($conn,"insert into main_technician(nm,cnt,adrs,edt,edtm,eby) values('$nm','$cnt','$adrs','$dt','$dttm','$user_currently_loged')")or die(mysqli_error($conn));
		
		$data= mysqli_query($conn,"select * from main_technician order by sl")or die(mysqli_error($conn));
		while ($row = mysqli_fetch_array($data))
		{
			$sl= $row['sl'];
		}
	   
		if(file_exists($_FILES['fileToUpload']['tmp_name'])){$path="files/".$sl.'.jpg';}else{$path="";}
		move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path);
 
		$query2 = "update main_technician set img='$path' where sl='$sl'";
		$result2 = mysqli_query($conn,$query2);


		?>
		<script>
		alert("Submit Successfully.....");
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