<?php
$reqlevel = 1;
include("membersonly.inc.php");
$dttm=date('d-m-Y H:i:s');
$edt=date('Y-m-d');

$sl=$_POST['sl'];
$fdt=date('Y-m-d',strtotime($_POST['fdt']));
$tdt=date('Y-m-d',strtotime($_POST['tdt']));

$err="";
if($fdt=='' or $tdt=='')
{
	$err="FILL ALL FIELD";
}
if($err=='')
{
mysqli_query($conn,"update main_ssn set fdt='$fdt',tdt='$tdt' where sl='$sl'") or die(mysqli_error($conn));	
	?>
	<script>
	alert('Update Successfully. Thank You');
	document.location="ssn_list.php";
	</script>
	<?
}
else
{
	?>
	<script>
	alert('<?=$err;?>');
	history.go(-1);
	</script>
	<?	
}
?>