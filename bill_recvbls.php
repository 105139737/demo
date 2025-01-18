<?php  
$reqlevel = 1;
include("membersonly.inc.php");
$fdt=date('Y-m-d');
$edtm=date('Y-m-d h:i:s a');

$brnch=$_POST['brnch'];
$sper=$_POST['sper'];
$dt=$_POST['dt'];
$brand=$_POST['brand'];
$party1=$_POST['party'];
$pamnt=$_POST['pamnt'];
$refno=$_POST['refno'];
$ovramnt=$_POST['ovramnt'];
$party1=base64_decode($party1);
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
	<?php 
}
else
{
	$dt=date('Y-m-d',strtotime($dt));
	$data=mysqli_query($conn,"SELECT * FROM  bills_receivable where Ref_No='$refno'") or die(mysqli_error($conn));
	$cntt=mysqli_num_rows($data);
	if($cntt>0)
	{
	?>
	<script>
	alert("Data Already Exists !!");
	window.history.go(-1);
	</script>
	<?php 
	}
	else
	{
		

		/* drcr */
		

$query51="select * from ".$DBprefix."drcr order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['vno'];
}	
$vid1=substr($vnos,2,7);	
$count6=5;
while($count6>0)
{
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
$vcno="SV".$vnoc;
$query5="select * from ".$DBprefix."drcr where vno='$vcno'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);
}

$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES ('$vcno','$refno','$partysl','$dt','Sale','4','-1','$pamnt','$brnch','$user_currently_loged','$edtm','0','$sper')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
$qr=mysqli_query($conn," select * from main_drcr order by sl desc limit 0,1")or die(mysqli_error($conn));
while($r=mysqli_fetch_array($qr))
{
	$drcrsl=$r['sl'];
}
$qr2=mysqli_query($conn,"INSERT INTO bills_receivable(BRAND,Date,Ref_No,Party_Name,Pending,Overdue,SALES_PERSON,brncd,dsl)VALUES('$brand','$dt','$refno','$party','$pamnt','$ovramnt','$sper','$brnch','$drcrsl')") or die(mysqli_error($conn));

		/* drcr */
	?>
	<script>
	alert("Submitted Successfully");
	document.location="bill_recvbl.php";
	</script>
	<?php 
	}
	
}
?>