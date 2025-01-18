<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$i=0;
   $query = "SELECT * FROM ".$DBprefix."product order by pnm";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$pcd=$R['sl'];
$pname=$R['pnm'];

$reo=0;
$data= mysqli_query($conn,"SELECT * FROM main_reorder where  pcd='$pcd' and bcd='$branch_code'");
while ($row = mysqli_fetch_array($data))
{
$reo = $row['re'];
}
 
 $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and bcd='$branch_code' group by pcd";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}

$stkf=$stck;
if($stck<=$reo)
{
$i++;
}
}
echo $i.' Product/s Below Reorder Level';
