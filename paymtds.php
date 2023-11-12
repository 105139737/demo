<?PHP $reqlevel = 3; 
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
$mtd=$_POST['mtd'];
$err=="";if($mtd==''){?><script>alert('Please Fill All The Fields.');history.go(-1);</script><?	}else{
$queryx="select * from ac_paymtd where mtd='$mtd'";
$resultx = mysqli_query($conn,$queryx) or die(mysqli_error($conn));
$cntx=mysqli_num_rows($resultx);
if($cntx>0){$err="Data Already Exist";
}
if($err==""){
$query6 = "INSERT INTO ac_paymtd (mtd) VALUES ('$mtd')";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));
?>
<Script language="JavaScript">
alert('Submitted Successfully. Thank You...');
document.location="paymtd.php";
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
}}
?>