<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$brncd=$_POST['brncd'];
$bcd=$_POST['bcd'];
$brand=$_POST['brand'];
$sl=$_POST['sl'];



if($brncd=='' or $bcd=='' or $brand=='')
{
	$err="Please fill  !";
}

$geti=mysqli_query($conn,"select * from main_godown_tag where brncd='$brncd' and brand='$brand' and sl!='$sl'") or die(mysqli_error($conn));
$count=mysqli_num_rows($geti);
if($count>0)
{
    $err="Already Exists";
}
if($err=='')
{


mysqli_query($conn,"update main_godown_tag set brncd='$brncd',bcd='$bcd',brand='$brand' where sl='$sl'") or die(mysqli_error($conn));

?>
	<script type="text/javascript" language="javascript">
	alert('Submitted Successfully. Thank You ');
	document.location="godown_tag.php";
	</script>
<?php
}
else
{
	?>
	<script type="text/javascript" language="javascript">
	alert('<?php echo $err;?>');
	window.history.go(-1);
	</script>
	<?php 
}
?>