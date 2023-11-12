<?PHP 
$reqlevel = 3; 
include("membersonly.inc.php");

$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');

$sl=$_POST['sl'];
$spn=$_POST['spnm'];
$addr=$_POST['addr'];
$gstin=$_POST['gstin'];
$pan=$_POST['pan'];
$st=$_POST['fst'];

$err=="";
if($spn=='' or $gstin=='' or $st=='')
{
?>
<script>
alert('Please Fill All The Fields.');
history.go(-1);
</script>
<?	
}
else
{
$queryx="select * from ".$DBprefix."suppl_gst where gstin='$gstin' and spn='$spn' and sl!='$sl'";
$resultx = mysqli_query($conn,$queryx) or die(mysqli_error($conn));
$cntx=mysqli_num_rows($resultx);

if($cntx>0)
{
$err="Data Already Exist";
}

if($err=="")
{
	
$query6 = "Update ".$DBprefix."suppl_gst set spn='$spn',addr='$addr',pan='$pan',gstin='$gstin',st='$st' where sl='$sl'";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));	
	

?>

<Script language="JavaScript">
alert('Update Successfully. Thank You...');
document.location="sup_gst.php";
</script>
<?
}
else
{
?>

<Script language="JavaScript">
alert('<? echo $err;?>');
window.history.go(-1);
</script>
<?
}
}
?>