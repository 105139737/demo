<?php
$reqlevel = 3;
include("membersonly.inc.php");
//catch the sent data
	$sl = $_POST['sl'];
	$vno = $_POST['vno'];
	$dt = $_POST['dt'];
	$brncd = $_POST['brncd'];
	$cldgr = $_POST['cldgr'];
	$dldgr = $_POST['dldgr'];
	$sid = $_POST['sid'];
	$refno = $_POST['cno'];
	$amm = $_POST['amm'];
	$nrtn = $_POST['nrtn'];

$typ='C01';
date_default_timezone_set('Asia/Kolkata');
$edt = date('d-m-Y h:i:s a', time());


$bsl = $_POST['bsl'];
$btyp = $_POST['btyp'];
	

	$get=mysqli_query($conn,"select * from main_billtype where sl='$bsl'") or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($get))
	{
	$als=$row['als'];
	$ssn=$row['ssn'];
	$start_no=$row['start_no'];
	}

$count6=5;
$query51="select * from ".$DBprefix."drcr where als='$als' and ssn='$ssn' and blnon!='' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
$vnos=$rows['blnon'];
}

$bill=explode($als,$vnos);
$bill1=explode($ssn,$bill[1]);
 $vnos=$bill1[0];

if($start_no>$vnos)
{
$vnos=$start_no;
}
$vid1=$vnos;

while($count6>0){
$vid1=$vid1+1;
//$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);
$vnoc=$vid1;
$blnon=$als.$vnoc.$ssn;
$query5="select * from ".$DBprefix."drcr where blnon='$blnon'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);

}
		
if($dt=='' or $cldgr=='' or $dldgr=='' or $amm=='' )
{
	?><script language="javascript">
	alert('Please Fill All The Fields.');
	window.history.go(-1);
	</script>
	<?
}
else
{
	$dt=date('Y-m-d', strtotime($dt));
	if($sl=="")
	{
	$query51="select * from ".$DBprefix."drcr where vno!='' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{
	$vnos=$rows['vno'];
}
	$vid1=substr($vnos,2,7);
	
$count6=5;
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);

$vno="SV".$vnoc;

		
	$query31 =mysqli_query($conn,"INSERT INTO main_drcr (vno,dt,nrtn,typ,dldgr,mtddtl,cldgr,amm,eby,edtm,sid,brncd,btyp,als,ssn,bill_typ,blnon) VALUES ('$vno','$dt','$nrtn','$typ','$dldgr','$refno','$cldgr','$amm','$user_currently_loged','$edt','$sid','$brncd','$btyp','$als','$ssn','$bsl','$blnon')") or die(mysqli_error($conn));
		?><script language="javascript">
		alert('Submitted Successfully. Thank You...');
	 	document.location = "crdt_note.php?bsl=<?php echo $bsl;?>";

		</script><?
	}
	else
	{
		$query31 = mysqli_query($conn,"UPDATE main_drcr set dt='$dt',nrtn='$nrtn',dldgr='$dldgr',mtddtl='$refno',cldgr='$cldgr',amm='$amm',sid='$sid',brncd='$brncd' where sl='$sl'");

		?><script language="javascript">
		alert('Updated Successfully. Thank You...');
		document.location = "crdt_note.php?bsl=<?php echo $bsl;?>";
		</script><?
	}
}