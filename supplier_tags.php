<?php  
$reqlevel = 3;
include("membersonly.inc.php");
$sup=$_POST['sup'];
$brand=$_POST['brand'];


$err="";
if($sup=='')
{
	$err="Please Select Supplier !";
}


if(count($brand)==0)
{
	$err="Please Select Brand !";
}

if($err=='')
{
$brand=implode(',',$brand);
$subcnt=0;
mysqli_query($conn,"DELETE FROM main_supplier_tag where sup='$sup'");

mysqli_query($conn,"insert into main_supplier_tag(sup,brand)values('$sup','$brand')");

?>
	<script type="text/javascript" language="javascript">
	alert('Submitted Successfully. Thank You ');
	document.location="supplier_tag.php";
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