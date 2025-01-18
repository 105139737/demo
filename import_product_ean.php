<?php 
$reqlevel = 3; 
include("config.php");
$result = mysqli_query($conn,"SELECT * FROM main_product_ean ");
while ($R = mysqli_fetch_array ($result))
{
$pnm=$R['pnm'];
$ean=$R['ean'];



$dsql=mysqli_query($conn,"update main_product set ean='$ean'  where pnm='$pnm'") or die (mysqli_error($conn));	

$result1 = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM main_product WHERE pnm='$pnm'"));
if($result1==0)
{
$dsql=mysqli_query($conn,"update main_product_ean set stat='1' where pnm='$pnm'") or die (mysqli_error($conn));	
echo $ean." --- ".$pnm."<br>";
}
}
?>