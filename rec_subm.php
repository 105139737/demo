<?php 
$reqlevel = 3;
include("membersonly.inc.php");

date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$edtm=date('Y-m-d H:i:s');

$sl=rawurldecode($_REQUEST['abc']);
$chkval=explode(",",$sl);
$cnt=count($chkval);

//count($chkval)
for($i=0;$i<$cnt;$i++)
{
$log=0;
//echo $chkval[$i];
	$data= mysqli_query($conn,"select * from  main_discountdtls where sl='$chkval[$i]'") or die(mysql_error());
	while ($row = mysqli_fetch_array($data))
	{	
		$x=$row['sl'];
		$cid=$row['cid'];
		$blno=$row['blno'];
		$bdt1=$row['bdt'];
		$pdt1=$row['pdt'];
		$difdt=$row['difdt'];
		$prc=$row['prc'];
		$pamm=$row['pamm'];
		$damm=$row['damm'];
		$stat=$row['stat'];	
		$vno=$row['vno'];
		$dt=$row['vdt'];
		$bno=$row['bno'];
		$bill_typ=$row['bill_typ'];
		$ssn=$row['ssn'];
		$als=$row['als'];
		$brncd=$row['brncd'];
		$sman=$row['sman'];
		$btyp=$row['btyp'];
		$blnon=$row['blnon'];
		$typ=$row['typ'];
		
		$query31 = "INSERT INTO main_drcr (vno,dt,nrtn,typ,dldgr,cldgr,amm,eby,edtm,cid,brncd,cbill,sman,btyp,als,ssn,bill_typ,blno,blnon) VALUES 
		('$vno','$dt','Discount','CC01','46','4','$damm','$user_currently_loged','$edtm','$cid','$brncd','$blno','$sman','$btyp','$als','$ssn','$bill_typ','$bno','$blnon')";
		$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));
		
		mysqli_query($conn,"UPDATE main_discountdtls SET stat = '1' WHERE sl='$x' ")or die (mysqli_error($conn));
	}
}
?>
<script>
alert('Added Successfully. Thank You..!');
show();
</script>