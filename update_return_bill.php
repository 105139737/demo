<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$get=mysqli_query($conn,"select * from main_billtype where sl='130' ") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$bsl=$row['sl'];
echo  $als=$row['als'];
echo "<br>";
$tp=$row['tp'];
$adrs=$row['adrs'];
$ssn=$row['ssn'];
$start_no=$row['start_no'];

$tota=strlen($als);

$query100 = "SELECT * FROM main_billing_ret where bill_no='0'";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$blno=$R100['blno'];
$bill=explode($ssn,$blno);
$same=substr($bill[0],0,$tota);

$bill2=explode($als,$bill[0]);

$bill_no=$bill2[1];
if($same==$als)
{
echo $same."-".$als." Blno: ".$blno." No : ".$bill_no." Sl : ".$bsl;
$z=mysqli_query($conn,"update main_billing_ret set bill_no='$bill_no',bill_typ='$bsl' where blno='$blno'" ) or die (mysqli_error($conn));
echo "<br>";
}
}
echo "<br>";
}
?>
