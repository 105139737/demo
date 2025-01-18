<?php  
$reqlevel = 3;
include("membersonly.inc.php");
$sper=$_POST['sper'];
$brand=$_POST['brand'];


$target_per=$_POST['targetp'];
if($sper=='')
{
	$err="Please Check Sales Person !";
}

if($brand=='')
{
	$err="Please Check Brand !";
}

if($err=='')
{
	$subcnt=0;
mysqli_query($conn,"DELETE FROM main_sptarget where brand='$brand' and spid='$sper'");

$data11= mysqli_query($conn,"SELECT * FROM main_scat where sl>0 and cat='$brand' ");
while ($row11= mysqli_fetch_array($data11))
{
	$csl=$row11['sl'];
	
	$target=$_POST['target'.$csl];
	
	
	if($target>0 or $target_per>0)
	{
		mysqli_query($conn,"insert into main_sptarget(spid,cat,tgt,brand,target_per)values('$sper','$csl','$target','$brand','$target_per')");
		$subcnt++;
	}
	
}

mysqli_query($conn,"update main_sptarget set target_per='$target_per' where spid='$sper' ");

?>
	<script type="text/javascript" language="javascript">
	alert('<?php  echo $subcnt;?> Data Submitted Successfully !');
	document.location="sper_target_setup.php";
	</script>
<?php 
}
else{
	?>
	<script type="text/javascript" language="javascript">
	alert('<?php  echo $err;?>');
	window.history.go(-1);
	</script>
	<?php  
}
?>