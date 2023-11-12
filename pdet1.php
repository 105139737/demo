<?php
$reqlevel=3;
include("membersonly.inc.php");
$sl=$_REQUEST[sl];
$prid=$_REQUEST[prid];
  	  $data1= mysqli_query($conn,"select * from main_product where sl='$prid'");
while ($row1 = mysqli_fetch_array($data1))
{
  $pkgunt=$row1['pkgunt'];
}

$data2= mysqli_query($conn,"select * from main_unit where sl='$pkgunt'");
while ($row2 = mysqli_fetch_array($data2))
{
  $unitnm=$row2['unitnm'];

  $tunt=$row2['tunt'];
}

 $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$prid' and bcd='$sl' group by pcd";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
$stck1=$stck/$tunt;
echo '<b>Total Stock : '.$stck1." ".$unitnm.'</b>';

?>
<input type="hidden" id="oldstk" name="oldstk" value="<?=$stck1;?>"> 