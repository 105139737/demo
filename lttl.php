<?php 

/**
 * @author Nirmal Biswas
 * @copyright 2013
 */
$reqlevel = 1;
include("membersonly.inc.php");
$pcd=$_REQUEST[pcd];
$unt=$_REQUEST[unt];
$qnt=$_REQUEST[qnt];
$prc=$_REQUEST[prc];
$runt=$_REQUEST[runt];
if($unt==$runt){
    $vl=$qnt*$prc;
}
else
{
        $query = "SELECT * FROM ".$DBprefix."product where sl= '$pcd'";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$pcd=$R['sl'];
$b=$R['pname'];
$c=$R['pkgunt'];
$query1="Select * from ".$DBprefix."unit where sl='$c'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$punt=$R1['pkgunt'];
$upkg=$R1['untpkg'];
$ptu=$R1['tunt'];
}
}

if($unt==$punt){
    $vl=($qnt*$prc)*$ptu;
}
else{
    $vl=($qnt*$prc)/$ptu;
}
}
echo $vl;

?>