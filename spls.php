<?php  
$reqlevel = 3;
include("membersonly.inc.php");
$brncd=$_POST['brncd'];
$bcd=$_POST['bcd'] ?? "";
$brand=$_POST['brand'];


$err="";
if($brncd=='' or $brand=='')
{
	$err="Please fill  !";
}

$geti=mysqli_query($conn,"select * from main_spl where brncd='$brncd' and brand='$brand'") or die(mysqli_error($conn));
$count=mysqli_num_rows($geti);
if($count>0)
{
    $err="Already Exists";
}
if($err=='')
{


mysqli_query($conn,"insert into main_spl(brncd,brand)values('$brncd','$brand')") or die(mysqli_error($conn));

?>
	<script type="text/javascript" language="javascript">
	alert('Submitted Successfully. Thank You ');
	document.location="spl.php";
	</script>
<?php 
}
else
{
	?>
	<script type="text/javascript" language="javascript">
	alert('<?php  echo $err;?>');
	window.history.go(-1);
	</script>
	<?php  
}
?>