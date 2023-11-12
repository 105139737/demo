<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$dttm=date('d-m-Y H:i:s a');
$sl=$_POST['sl'];
$sup=$_POST['sup'];
$sgstin=$_POST['sgstin'];
$name=$_POST['name'];
$note_no=$_POST['note_no'];
$dt=$_POST['dt'];
$inv=$_POST['inv'];
$invdt=$_POST['invdt'];
$note_typ=$_POST['note_typ'];
$amm=$_POST['amm'];
$styp=$_POST['styp'];
$edt=$_POST['edt'];
$typ=$_POST['typ'];
$tax_rate=$_POST['tax_rate'];
$tax=$_POST['tax'];
$net=$_POST['net'];
$refno=$_POST['refno'];
$dsl=$_POST['dsl'];
	
$err="";
if($sup==''){$err="Please Select Supplier ...";}
if($sgstin==''){$err="Please Select GSTIN ...";}
/*$query1="select * from main_cdnr where note_no='$note_no' and sl!='$sl'";
$result1 = mysqli_query($conn,$query1);
$connt=mysqli_num_rows($result1);
if($connt>0)
{
$err="Note No. Already Exists...";	
}*/
$query12="select * from main_cdnr where refno='$refno' and sl!='$sl'";
$result12 = mysqli_query($conn,$query12);
$conn1=mysqli_num_rows($result12);
if($conn1>0)
{
$err="Refno. Already Exists...";	
}
$state=substr($sgstin,0,2);	
if($err=="")
{
$dt=date("Y-m-d", strtotime($dt));	
$invdt=date("Y-m-d", strtotime($invdt));	
$edt=date('Y-m-d');

$igst=0;
$sgst=0;
$cgst=0;

if($state=='19')
{

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

if($refno!='')
{
$result2 = mysqli_query($conn,"DELETE FROM ".$DBprefix."drcr WHERE sbill='$refno' and typ='C02'")or die(mysqli_error($conn));
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

mysqli_query($conn,"update main_cdnr set sup='$sup',sgstin='$sgstin',name='$name',note_no='$note_no',dt='$dt',inv='$inv',invdt='$invdt',note_typ='$note_typ',amm='$amm',styp='$styp',typ='$typ',tax_rate='$tax_rate',tax='$tax',net='$net' where sl='$sl'");

$err="Update Successfully. Thank You...";
}
?>
<Script language="JavaScript">
alert('<?=$err;?>');
document.location="credit_note_gst_list.php";
</script>