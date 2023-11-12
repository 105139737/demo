<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$brncd=$_POST['brncd'];
$bcd=$_POST['bcd'];
$brand=$_POST['brand'];



if($brncd=='' or $bcd=='' or $brand=='')
{
	$err="Please fill  !";
}

$geti=mysqli_query($conn,"select * from main_godown_tag where brncd='$brncd' and brand='$brand'") or die(mysqli_error($conn));
$count=mysqli_num_rows($geti);
if($count>0)
{
    $err="Already Exists";
}
if($err=='')
{


mysqli_query($conn,"insert into main_godown_tag(brncd,bcd,brand)values('$brncd','$bcd','$brand')") or die(mysqli_error($conn));

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