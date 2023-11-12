<?php
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$blno=$_REQUEST['blno'];
$psl=$_REQUEST['psl'];
$tsl=$_REQUEST['tsl'];


$query100 = "SELECT * FROM main_purchasedet_edt where sl='$tsl' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$mrp=$R100['mrp'];
$disp=$R100['disp'];
$disa=$R100['disa'];
$cgst_rt=$R100['cgst_rt'];
$sgst_rt=$R100['sgst_rt'];
$igst_rt=$R100['igst_rt'];
$fst=$R100['fst'];
$tst=$R100['tst'];
$rate=$R100['rate'];

}

$query100 = "SELECT * FROM main_purchasedet_edt where eby='$user_currently_loged' and blno='$blno' and prsl='$psl' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$cat=$R100['cat'];
$scat=$R100['scat'];
$unit=$R100['unit'];
$prsl=$R100['prsl'];
$qty=$R100['qty'];
$ttl=$R100['ttl'];
$cgst_rt=$R100['cgst_rt'];
$cgst_am=$R100['cgst_am'];
$sgst_rt=$R100['sgst_rt'];
$sgst_am=$R100['sgst_am'];
$igst_rt=$R100['igst_rt'];
$igst_am=$R100['igst_am'];
$net_am=$R100['net_am'];
$total=$R100['total'];
$bcd=$R100['bcd'];
$betno=$R100['betno'];

$total=round($qty*$mrp,2);
if($disp>0)
{
$disa=round(($total*$disp)/100,2);
}
$lttl=($total-$disa);
if($sgst_rt>0)
{
$sgst_am=round(($lttl*$sgst_rt)/100,2);
}
if($cgst_rt>0)
{
$cgst_am=round(($lttl*$cgst_rt)/100,2);
}
if($igst_rt>0)
{
$igst_am=round(($lttl*$igst_rt)/100,2);
}
$net_am=$sgst_am+$cgst_am+$igst_am+$lttl;

$query21 = "UPDATE main_purchasedet_edt SET mrp='$mrp',
ttl='$lttl',cgst_rt='$cgst_rt',sgst_rt='$sgst_rt',igst_rt='$igst_rt',
cgst_am='$cgst_am',sgst_am='$sgst_am',igst_am='$igst_am',net_am='$net_am',amm='$lttl',total='$total',
disp='$disp',disa='$disa',ldis='$ldis',ldisa='$ldisa',rate='$rate' WHERE sl='$tsl'";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 	


}
?>
<script>
tmppr1();
reset();
get_prod('<?=$psl;?>');
</script>
