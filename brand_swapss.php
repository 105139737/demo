<?php
$reqlevel = 3;
include("membersonly.inc.php");
$dt=date('Y-m-d');

$dttm=date('d-m-Y H:i:s');

$fbnd=$_POST['fbnd'];
$tbnd=$_POST['tbnd'];



$err="";

if($fbnd=="" or $tbnd=="" )
{
$err="Please Fill All Field...";	
}	

if($err=="")
{
	
$query1 = mysqli_query($conn,"Update main_scat set cat='$tbnd' where cat='$fbnd'") or die(mysqli_error($conn));

$query2 = mysqli_query($conn,"Update main_product set cat='$tbnd' where cat='$fbnd'") or die(mysqli_error($conn));

$query3 = mysqli_query($conn,"Update main_billdtls set cat='$tbnd' where cat='$fbnd'") or die(mysqli_error($conn));

$query4 = mysqli_query($conn,"Update main_billdtls_ret set cat='$tbnd' where cat='$fbnd'") or die(mysqli_error($conn));

$query5 = mysqli_query($conn,"Update main_orderdtls set cat='$tbnd' where cat='$fbnd'") or die(mysqli_error($conn));

$query6 = mysqli_query($conn,"Update main_purchasedet set cat='$tbnd' where cat='$fbnd'") or die(mysqli_error($conn));

$query6 = mysqli_query($conn,"Update main_purchasedet_ret set cat='$tbnd' where cat='$fbnd'") or die(mysqli_error($conn));


$msg="Brand Swap Successfully. Thank You.......!";

?>
<script language="javascript">
alert('<?=$msg;?>');
document.location="pcat.php";
</script>
<?

}
else
{
	
?>
<script language="javascript">
alert('<?=$err;?>');
window.history.go(-1);
</script>
<?

}
?>







