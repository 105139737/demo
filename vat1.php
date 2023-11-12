<?php

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$sl=1;
$vat=$_REQUEST[vat];
$car=$_REQUEST[car];
$dis=$_REQUEST[dis];
$query100 = "SELECT * FROM ".$DBprefix."slt where eby='$user_currently_loged' order by sl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$prnm=$R100['prnm'];
$qnty=$R100['qty'];
$prc=$R100['prc'];
$ttl=$R100['ttl'];
$unt=$R100['unt'];
$betno=$R100['betno'];
$expdt=$R100['expdt'];
$usl=$R100['usl'];
$prc1="";
$un="";
$expdt=date('d-m-Y', strtotime($expdt));

$log="";

$unit=mysqli_query($conn,"select * from main_unit where sl='$usl'");
while($pr=mysqli_fetch_array($unit))
{
$punt=$pr['pkgunt'];
$upkg=$pr['untpkg'];
$ptu1=$pr['tunt'];	
}
$sl+=1;
}
 $query1 = "SELECT sum(ttl) as gttl FROM ".$DBprefix."slt where eby='$user_currently_loged'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];


}
if($vat!="")
{
$vat1=($gttl*$vat)/100;
$tot=($vat1+$gttl+$car)-$dis;
}

else
{
$tot=($gttl+$car)-$dis;	
}
echo number_format($tot,2);
?>
