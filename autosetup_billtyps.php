<?php  
$reqlevel = 1;
include("membersonly.inc.php");
$sesn=$_POST['sesn'];

$getdata=mysqli_query($conn,"SELECT * FROM main_billtype where stat='0' order by sl") or die(mysqli_error($conn));
while($r1=mysqli_fetch_array($getdata))
{
	$brncd=$r1['brncd'];
	$als=$r1['als'];
	$tp=$r1['tp'];
	$adrs=$r1['adrs'];
	$ssn=$r1['ssn'];
	$brand=$r1['brand'];
	$start_no=$r1['start_no'];
	$inv_typ=$r1['inv_typ'];
	$stat=$r1['stat'];
	$rv=$r1['rv'];
	mysqli_query($conn,"INSERT INTO main_billtype(brncd, als, tp, adrs, ssn, brand, start_no, inv_typ, rv,stat)VALUES('$brncd', '$als', '$tp', '$adrs', '$sesn', '$brand', '0', '$inv_typ', '$rv','1')") or die(mysqli_error($conn));
}
?>
<script>
alert("Auto Setup Completed Successfully !!!");
document.location="billtyp_ntry.php";
</script>