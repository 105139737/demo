<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$fdt=date('Y-m-d');
$edtm=date('Y-m-d h:i:s a');

$sl=$_POST['sl'];
$dsl=$_POST['dsl'];
$brnch=$_POST['brnch'];
$sper=$_POST['sper'];
$dt=$_POST['dt'];
$brand=$_POST['brand'];
$party1=$_POST['party'];
$pamnt=$_POST['pamnt'];
$refno=$_POST['refno'];
$ovramnt=$_POST['ovramnt'];

$str=explode("@",$party1);
$party=$str[1];
$partysl=$str[0];

if($brnch=="" || $sper=="" || $dt=="" || $brand=="" || $party=="" || $pamnt=="" || $refno=="" || $ovramnt=="")
{
	?>
	<script>
	alert("Fill all fields !!");
	window.history.go(-1);
	</script>
	<?
}
else
{
	
	
	$data=mysqli_query($conn,"SELECT * FROM  bills_receivable where Ref_No='$refno' and sl!='$sl'") or die(mysqli_error($conn));
	$cntt=mysqli_num_rows($data);
	if($cntt>0)
	{
	?>
	<script>
	alert("Data Already Exists !!");
	window.history.go(-1);
	</script>
	<?
	}
	else
	{
		
$dt=date('Y-m-d',strtotime($dt));

$query21 = "UPDATE ".$DBprefix."drcr SET cbill='$refno',cid='$partysl',dt='$dt',amm='$pamnt',brncd='$brnch',sman='$sper' WHERE sl='$dsl'";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));

$qr2=mysqli_query($conn,"UPDATE bills_receivable SET BRAND='$brand',Date='$dt',Ref_No='$refno',Party_Name='$party',Pending='$pamnt',Overdue='$ovramnt',SALES_PERSON='$sper',brncd='$brnch' WHERE sl='$sl'") or die(mysqli_error($conn));

		
	?>
	<script>
	alert("Updated Successfully");
	document.location="bill_recvbl.php";
	</script>
	<?
	}
	
}
?>