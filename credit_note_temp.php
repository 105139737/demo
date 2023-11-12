<?php
$reqlevel = 1;
include("membersonly.inc.php");
$blno=rawurldecode($_REQUEST['blno']);
$amm=rawurldecode($_REQUEST['amm']);
$sman=rawurldecode($_REQUEST['sman']);
$cid=rawurldecode($_REQUEST['cid']);
$brncd=rawurldecode($_REQUEST['brncd']);

$ramm=rawurldecode($_REQUEST['ramm']);
$due=rawurldecode($_REQUEST['due']);



if($blno=='')
{
$err="Please Select Bill No...";
}
else if($ramm<$amm)
{
$err="Amount Can't be More Than Rest Amount";	
}
else if($due<$amm)
{
$err="Amount Can't be More Than Due Amount";	
}		
if($err=='')
{
$query21 = "INSERT INTO main_credit_note_temp (blno,amm,sman,cid,eby,brncd)
VALUES ('$blno','$amm','$sman','$cid','$user_currently_loged','$brncd')";
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