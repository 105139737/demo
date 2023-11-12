<?PHP $reqlevel = 3; 
include("membersonly.inc.php");

$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
$fpcd=$_POST['fpcd'];
$tpcd=$_POST['tpcd'];
$cat=$_POST['cat'];
$scat=$_POST['scat'];
$tcat=$_POST['tcat'];
$tscat=$_POST['tscat'];

$err=="";

if($fpcd=="" or $tpcd=="")
{
$err="Please Select From Or To Product";
}

$queryx="select * from main_product_to where fpcd='$fpcd' and tpcd='$tpcd'";
$resultx = mysqli_query($conn,$queryx);
$cntx=mysqli_num_rows($resultx);
if($cntx>0){
    $err="Data Already Exist";
}

if($err==""){
$query6 = "INSERT INTO main_product_to (fpcd,tpcd,cat,scat,tcat,tscat) VALUES ('$fpcd','$tpcd','$cat','$scat','$tcat','$tscat')";
$result6 = mysqli_query($conn,$query6) or die(mysqli_error($conn));


?>
<Script language="JavaScript">
alert('Submit Successfully. Thank You...');
window.close();
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
?>