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
 $query100 = "SELECT * FROM ".$DBprefix."ptemp where eby='$user_currently_loged' order by sl";
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
$pprc=$R100['pprc'];
$usl=$R100['usl'];
$expdt=date('d-m-Y', strtotime($expdt));
$prc1="";
$un="";
$query1="Select * from ".$DBprefix."unit where sl='$usl'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$ptu=$R1['tunt'];
$pkgunt=$R1['pkgunt'];
$prc1=$prc/$ptu;

}




?>

<?


$sl+=1;
}
 $query1 = "SELECT sum(ttl) as gttl,sum(ppt) as pprc1 FROM ".$DBprefix."ptemp where eby='$user_currently_loged'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$pprc1=$R1['pprc1'];

}
if($vat!="")
{
$vat1=($gttl*$vat)/100;
$tot=$vat1+$pprc1;
}

else
{
$tot=$pprc1;	
}
echo number_format($tot,2);
?>
