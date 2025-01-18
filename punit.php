<?php 
$reqlevel=3;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
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
?>
<select name="unt" size="1" id="unt" class="sc">
<?php 
$data2= mysqli_query($conn,"select * from main_unit where sl='$pkgunt'");
while ($row2 = mysqli_fetch_array($data2))
{
  $unitnm=$row2['unitnm'];

  $tunt=$row2['tunt'];
  $sl=$row2['sl'];
?>
<option value="<?php  echo $sl;?>"><?php  echo $unitnm;?></option>
<?php 
}
?>
</select>

 