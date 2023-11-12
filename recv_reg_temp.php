<?php
$reqlevel = 1;
include("membersonly.inc.php");
$blno=rawurldecode($_REQUEST['blno']);
$amm=rawurldecode($_REQUEST['amm']);
$sman=rawurldecode($_REQUEST['sman']);
$cid=rawurldecode($_REQUEST['cid']);
$brncd=rawurldecode($_REQUEST['brncd']);
$disl=rawurldecode($_REQUEST['disl']);
$damm=rawurldecode($_REQUEST['damm']);
$ramm=rawurldecode($_REQUEST['ramm']);
$remk=rawurldecode($_REQUEST['remk']);
$blno_ref=rawurldecode($_REQUEST['blno_ref']);


if($blno=='')
{
$err="Please Select Bill No...";
}
if($damm>0)
{
if($disl=='')
{
$err="Please Select Discount Ledger...";
}	
}
else if($ramm<$amm)
{
$err="Amount Can't be More Than Rest Amount";	
}
		
if($err=='')
{
$query21 = "INSERT INTO main_recv_reg_temp (blno,amm,sman,cid,eby,brncd,disl,damm,remk,app_ref)
VALUES ('$blno','$amm','$sman','$cid','$user_currently_loged','$brncd','$disl','$damm','$remk','$blno_ref')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	
?>
<script>
temp();
reset();
</script>
<?
}
if($err!='')
{
?>
<script>
alert("<?=$err;?>");
temp();
</script>
<?
}
?>