<?

$reqlevel = 3;
include("membersonly.inc.php");
$sl4=$_REQUEST['sl4'];

$sl3=base64_decode($sl4);
date_default_timezone_set('Asia/Kolkata');
$dt6 = date('Y-m-d');
$dtm = date('Y-m-d h:i:sa');







$data= mysqli_query($conn,"select * from main_trn where sl='$sl3' and stat='0'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
  $sl3=$row['sl'];
  $stsl=$row['stsl'];
  $bcd=$row['bcd'];
  $q111=mysqli_query($conn,"SELECT * FROM ".$DBprefix."branch where sl='$bcd'");
while($r111=mysqli_fetch_array($q111))
{
$bnm=$r111['bnm'];
}

  $queryw1 = "SELECT * FROM ".$DBprefix."stock where sl='$stsl'";
   $resultw1 = mysqli_query($conn,$queryw1);
while ($Rw1 = mysqli_fetch_array ($resultw1))
{
$stin=$Rw1['stin'];
$opst=$Rw1['opst'];
$pcd=$Rw1['pcd'];
$dt=$Rw1['dt'];

$stout=$Rw1['stout'];
$betno=$Rw1['betno'];
$expdt=$Rw1['expdt'];
$ret=$Rw1['ret'];


$q1=mysqli_query($conn,"SELECT * FROM ".$DBprefix."product where sl='$pcd'");
while($r11=mysqli_fetch_array($q1))
{
$pname=$r11['pname'];
$pkgunt=$r11['pkgunt'];
}



$q12=mysqli_query($conn,"SELECT * FROM ".$DBprefix."unit where sl='$pkgunt'");
while($r12=mysqli_fetch_array($q12))
{
$tunt=$r12['tunt'];
$unitnm=$r12['unitnm'];

$stout1=$stout/$tunt;

}
}}
$criu=mysqli_query($conn,"update main_trn set stat='1' where sl='$sl3'");
$crii=mysqli_query($conn,"insert main_stock(pcd,bcd,dt,opst,stin,stout,nrtn,dtm,eby,clst,betno,expdt,ret) value ('$pcd','$bcd','$dt6','0','$stout','0','Stock Recieve','$dtm','$user_currently_loged','0','$betno','$expdt','$ret')");
?>
<script>
alert('Stock Recieves Successfully');
window.location.assign('stock_recv.php');
</script>
