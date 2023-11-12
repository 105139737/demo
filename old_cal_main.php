<?php
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$tdis=$_REQUEST['tdis'];
$query = "SELECT sum(ttl) as total FROM ".$DBprefix."old_ptemp where eby='$user_currently_loged' order by sl";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$total=$R['total'];
}
$dis_sub=0;
if($tdis>0)
{
$dis_sub=$tdis/$total;
}
$sl=1;
$query1 = "SELECT * FROM ".$DBprefix."old_ptemp where eby='$user_currently_loged' order by sl";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$sl=$R1['sl'];
$ttl=$R1['ttl'];
$cgst_rt=$R1['cgst_rt'];
$cgst_am=$R1['cgst_am'];
$sgst_rt=$R1['sgst_rt'];
$sgst_am=$R1['sgst_am'];
$igst_rt=$R1['igst_rt'];
$igst_am=$R1['igst_am'];
$net_am=$R1['net_am'];
$dis=$R1['dis'];
if($tdis>0)
{
$dis=round($dis_sub*$ttl,2);
}
$amm=$ttl-$dis;
if($cgst_rt>0){$cgst_am=round(($cgst_rt*$amm)/100,2);}
if($sgst_rt>0){$sgst_am=round(($sgst_rt*$amm)/100,2);}
if($igst_rt>0){$igst_am=round(($igst_rt*$amm)/100,2);}
$net_am=$amm+$cgst_am+$sgst_am+$igst_am;
$query21 = "update ".$DBprefix."old_ptemp set dis='$dis',amm='$amm',cgst_am='$cgst_am',sgst_am='$sgst_am',igst_am='$igst_am',net_am='$net_am' where sl='$sl'";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));

}
?>

<script>
tmppr1();

</script>