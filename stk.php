<?
$reqlevel = 1;
include("membersonly.inc.php");
$pcd=$_REQUEST[pcd];
$betno=$_REQUEST[betno];

 $query3="Select * from ".$DBprefix."stock where sl='$betno'";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{
$betno=$R3['betno'];
}
   $query = "SELECT * FROM ".$DBprefix."product where sl='$pcd'";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$c=$R['pkgunt'];
}
$query1="Select * from ".$DBprefix."unit where sl='$c'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$puntsl=$R1['sl'];
$punt=$R1['pkgunt'];
$upkg=$R1['untpkg'];
$ptu=$R1['tunt'];
}

 $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and betno='$betno' and bcd='$branch_code' group by betno";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
$stkf=$stck/$ptu;

echo $stkf;

