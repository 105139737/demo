<?php
$reqlevel = 1;
include("membersonly.inc.php");
$edtm = date('d-m-Y h:i:s a', time());
$edt=date('Y-m-d');	
$brncd=$_REQUEST['brncd'];
$dt=$_REQUEST['dt'];
$cldgr=$_REQUEST['cldgr'];
$cid=$_REQUEST['cid'];
$nrtn=$_REQUEST['nrtn'];
$proj=$_REQUEST['proj'];
$it=$_REQUEST['it'];
$bsl = $_POST['bsl'];
$btyp = $_POST['btyp'];
$dldgr = $_POST['dldgr'];
$tamm = $_POST['tamm'];
$refno = $_POST['refno'];
$ramm = $_POST['ramm'];
$spid = $_POST['sman'];
$sms = $_POST['sms'];
$blno1 = $_POST['blno1'];
$vcno = $_POST['vno'];
$blnon = $_POST['blnon'];

$get=mysqli_query($conn,"select * from main_billtype where sl='$bsl'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$als=$row['als'];
$ssn=$row['ssn'];
$start_no=$row['start_no'];
}


if($dt=='' or $cldgr=='' or $cid=='' or $tamm<1)
{
$err="Please Fill All The Fields..!!";	
}

if($dt=="")
{
	$dt="0000-00-00";
}
else if($dt=="00-00-0000")
{
	$dt="0000-00-00";
}
else
{
	$dt=date('Y-m-d',strtotime($dt));
}

$query1001 = "SELECT * FROM main_credit_note_temp where eby='$user_currently_loged' and cid='$cid' order by sl";
$result1001 = mysqli_query($conn,$query1001) or die(mysqli_error($conn));
$ccount=mysqli_num_rows($result1001);
if($ccount==0)
{
$err="Please ADD Some Row...";	
}
if($err=="")
{
	


$h=mysqli_query($conn,"delete from main_recv_dtl_credit_note where ref='$blno1'") or die (mysqli_error($conn));
$h=mysqli_query($conn,"delete from main_drcr where blno='$blno1'") or die (mysqli_error($conn));

$query31 = "update main_recv_credit_note set dt='$dt',cid='$cid',nrtn='$nrtn',dldgr='$dldgr',spid='$spid' where blno='$blno1'";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));



$query100 = "SELECT * FROM main_credit_note_temp where eby='$user_currently_loged' and cid='$cid' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$blno=$R100['blno'];
$blno_add=$R100['blno'];
$amm=$R100['amm'];
$sman=$R100['sman'];
$cid=$R100['cid'];
$disl=$R100['disl'];
$damm=$R100['damm'];
$remk=$R100['remk'];



$query21 = "INSERT INTO main_recv_dtl_credit_note(ref,blno,amm,sman,cid,eby,brncd,disl,damm,remk)
VALUES ('$blno1','$blno','$amm','$spid','$cid','$user_currently_loged','$brncd','$disl','$damm','$remk')";
$result313 = mysqli_query($conn,$query21)or die (mysqli_error($conn));

$query31 = "INSERT INTO main_drcr (vno,dt,nrtn,typ,dldgr,mtd,mtddtl,cldgr,amm,eby,edtm,cid,brncd,cbill,sman,btyp,als,ssn,bill_typ,blnon,blno) VALUES 
('$vcno','$dt','$nrtn','$typ','$dldgr','$paymtd','$refno','$cldgr','$amm','$user_currently_loged','$edtm','$cid','$brncd','$blno','$spid','$btyp','$als','$ssn','$bsl','$blnon','$blno1')";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));


}

mysqli_query($conn,"DELETE FROM main_credit_note_temp WHERE eby='$user_currently_loged'") or die(mysqli_error($conn));


if($sms==2)
{
$datad= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$cust_nm=$rowd['nm'];
$cust_cont=$rowd['cont'];
}


include "send_sms.php";
$message="Dear ".$cust_nm.",\nwe have received of Rs. ".number_format($tamm,2)."\non ".$dt." through Voucher No ".$vcno." against ".$mtd;
$sms=send_sms($cust_cont,$message,'1');	
}
?>
<script language="javascript">
alert('updated Successfully. Thank You..!');
document.location = "credit_note_report.php";
</script>
<?	
}
else
{
?>
<script language="javascript">
alert('<?=$err;?>');
document.location = "credit_note_report.php";
</script>
<?	
}