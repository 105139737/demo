<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cdt=date('Y-m-d');

set_time_limit(0);


$data = mysqli_query($conn,"SELECT * FROM  main_cdnr where sl>0 order by sl");
while ($row = mysqli_fetch_array($data))
{
$sup=$row['sup'];
$ssl=$row['sl'];
$sgstin=$row['sgstin'];
$name=$row['name'];
$note_no=$row['note_no'];
$dt=$row['dt'];
$inv=$row['inv'];
$note_typ=$row['note_typ'];
$amm=$row['amm'];
$styp=$row['styp'];
$invdt1=$row['invdt'];
$typ=$row['typ'];
$tax_rate=$row['tax_rate'];
$tax=$row['tax'];
$net=$row['net'];
$refno=$row['refno'];


$query51="select * from ".$DBprefix."drcr where vno!='' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{
	$vnos=$rows['vno'];
}
$vid1=substr($vnos,2,7);
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);

$vno="SV".$vnoc;

$dttm=date('Y-m-d h:i:s a').$ssl;

$state=substr($sgstin,0,2);	
if($refno!='')
{
$result2 = mysqli_query($conn,"DELETE FROM ".$DBprefix."drcr WHERE sbill='$refno' and typ='C02'")or die(mysqli_error($conn));
}
		
$query51="select * from ".$DBprefix."drcr where sbill='$refno' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
$vno=$rows['vcno'];
}
$igst=0;
$sgst=0;
$cgst=0;
if($state=='19')
{
echo $tax_rate;
$gst=($amm*$tax_rate)/100;
$cgst=$gst/2;
$sgst=$gst/2;
}
else
{
	
$igst_rt=$tax_rate;	
$igst=($amm*$tax_rate)/100;
}
if($note_typ=='C')
{
$dldgr='12';	
$cldgr='-5';	
}
elseif($note_typ=='D')
{
$dldgr='-3';	
$cldgr='12';	
}

 $query21 = "INSERT INTO ".$DBprefix."drcr(vno,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,ttyp,sbill,typ) VALUES 
('$vno','$sup','$dt','DEBIT NOTE','$dldgr','$cldgr','$amm','$branch_code','$user_currently_loged','$dttm','$typ','$refno','C02')";
$result21 = mysqli_query($conn,$query21);
if($note_typ=='D')
{
if($cgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,ttyp,sbill,typ)
 VALUES ('$vno','$sup','$dt','DEBIT C-GST','37','12','$cgst','$branch_code','$user_currently_loged','$dttm','$typ','$refno','C02')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}
if($sgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,ttyp,sbill,typ)
 VALUES ('$vno','$sup','$dt','DEBIT S-GST','38','12','$sgst','$branch_code','$user_currently_loged','$dttm','$typ','$refno','C02')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}
if($igst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,ttyp,sbill,typ)
 VALUES ('$vno','$sup','$dt','DEBIT I-GST','39','12','$igst','$branch_code','$user_currently_loged','$dttm','$typ','$refno','C02')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}
}
if($note_typ=='C')
{
if($cgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,ttyp,sbill,typ)
 VALUES ('$vno','$sup','$dt','DEBIT C-GST','12','37','$cgst','$branch_code','$user_currently_loged','$dttm','$typ','$refno','C02')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}
if($sgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,ttyp,sbill,typ)
 VALUES ('$vno','$sup','$dt','DEBIT S-GST','12','38','$sgst','$branch_code','$user_currently_loged','$dttm','$typ','$refno','C02')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}
if($igst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,ttyp,sbill,typ)
 VALUES ('$vno','$sup','$dt','DEBIT I-GST','12','39','$igst','$branch_code','$user_currently_loged','$dttm','$typ','$refno','C02')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}	
	
}
echo "<br>";
}

	
	
	

