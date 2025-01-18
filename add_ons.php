<?php 
include("membersonly.inc.php");
$edt = date('Y-m-d');	
$edtm = date('d-m-Y h:i:s a');	
	$brncd = $_POST['brncd'];
	$cldgr = $_POST['cldgr'];
	$dldgr = $_POST['dldgr'];
	$amm = $_POST['amm'];
	$nrtn = $_POST['nrtn'];
	$dt = $_POST['dt'];
	$cid = $_POST['cid'];
	$refno = $_POST['refno'];
	$sl = $_POST['updt'];
if($sl!="")	{$ssl=" and sl!='$sl'";}else{$ssl="";}
if($brncd=="" or $amm==0 or $amm=="" or $dt=="" or $cid=="")
	{
		$err="Please Fill All The Fields..!!";
	}
	$queryr=mysqli_query($conn,"select * from ".$DBprefix."addon where cid='$cid' and brncd='$brncd' $ssl");
	$ccnn=mysqli_num_rows($queryr);
	
	
if($err=="")
{
	if($dt=="" or $dt=="1970-01-01")
	{
	$dt="0000-00-00";	
	}
	else
	{
	$dt=date('Y-m-d',strtotime($dt));	
	}
	
	if($sl=="")
	{
	$m=date('m', strtotime($dt));
	$y=date('y', strtotime($dt));;
	if($m>=4)
	{
	$yy=$y."-".($y+1)."/";	
	}
	elseif($m<=3)
	{
	$yy=($y-1)."-".$y."/";	
	}
	$vid=0;
	$count5=1;
	while($count5>0)
	{
	$vid=$vid+1;
	$vno=str_pad($vid, 6, '0', STR_PAD_LEFT);

	$blno=$yy.'AD'.$vno;
	$query5="select * from ".$DBprefix."addon where blno='$blno'";
	$result5 = mysqli_query($conn,$query5);
	$count5=mysqli_num_rows($result5);
	}
		
	$query51="select * from ".$DBprefix."drcr order by vno";
	$result51 = mysqli_query($conn,$query51);
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
	$result5 = mysqli_query($conn,$query5);
	$count6=mysqli_num_rows($result5);
	}
	
	$querys = "INSERT INTO ".$DBprefix."addon (cid,brncd,dt,dldgr,cldgr,amm,nrtn,edt,edtm,eby,refno,blno) VALUES ('$cid','$brncd','$dt','$dldgr','$cldgr','$amm','$nrtn','$edt','$edtm','$user_currently_loged','$vcno','$blno')";
	mysqli_query($conn,$querys)or die (mysqli_error($conn));

	$query = "INSERT INTO ".$DBprefix."drcr (pno,typ,vno,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,cbill) VALUES ('0','A11','$vcno','$cid','$dt','$nrtn','$dldgr','$cldgr','$amm','$brncd','$user_currently_loged','$edtm','$blno')";
	mysqli_query($conn,$query)or die (mysqli_error($conn));
	
	$msg="Submitted Successfully. Thank You...";
	$pg="add_on.php";
	}
	else
	{
	$query31 = "UPDATE main_addon SET nrtn='$nrtn',amm='$amm',cid='$cid',brncd='$brncd',dt='$dt' WHERE sl='$sl'";
	mysqli_query($conn,$query31)or die (mysqli_error($conn));
	
	$query33 = "UPDATE main_drcr SET nrtn='$nrtn',amm='$amm',cid='$cid',brncd='$brncd',dt='$dt' WHERE vno='$refno'";
	mysqli_query($conn,$query33)or die (mysqli_error($conn));
	
	$msg="Updated Successfully. Thank You...";
	$pg="add_on_list.php";
	}
?>
<script language="javascript">
alert('<?php  echo $msg;?>');
document.location = "<?php  echo $pg;?>";
</script>
<?php 
}
else
{
?>
<script language="javascript">
alert('<?php  echo $err;?>');
window.history.go(-1);
</script>
<?php 	
}
?>

