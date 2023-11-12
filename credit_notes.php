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
	
$query511="select * from main_recv_credit_note where blno!='' order by sl desc limit 0,1";
$result511 = mysqli_query($conn,$query511) or die(mysqli_error($conn));
while($rows1=mysqli_fetch_array($result511))
{	
$vnos1=$rows1['blno'];
}	
$vid11=substr($vnos1,2,7);	
$count66=5;
while($count66>0)
{
$vid11=$vid11+1;
$vnoc1=str_pad($vid11, 7, '0', STR_PAD_LEFT);
$blno1="CS".$vnoc1;
$query51="select * from main_recv_credit_note where blno='$blno1'";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
$count66=mysqli_num_rows($result51);
}

$query51="select * from ".$DBprefix."drcr where vno!='' order by sl desc limit 0,1";
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




$count6=5;
$query51="select * from ".$DBprefix."drcr where als='$als' and ssn='$ssn' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
$vnos=$rows['blnon'];
}
$bill=explode($als,$vnos);
$bill1=explode($ssn,$bill[1]);
$vnos=$bill1[1];
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

$query31 = "INSERT INTO main_recv_credit_note (blno,bcd,dt,cid,nrtn,dldgr,paymtd,tamm,refno,bill_type,als,ssn,eby,edt,app_ref,spid,vno,blnon) VALUES 
('$blno1','$brncd','$dt','$cid','$nrtn','$dldgr','$paymtd','$tamm','$refno','$bsl','$als','$ssn','$user_currently_loged','$edt','$blno_ref','$spid','$vno','$blnon')";
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
alert('Added Successfully. Thank You..!');
document.location = "cust_credit_note.php?bsl=<?php echo $bsl;?>&dt=<?php echo $dt;?>";
</script>
<?	
}
else
{
?>
<script language="javascript">
alert('<?=$err;?>');
document.location = "cust_credit_note.php?bsl=<?php echo $bsl;?>&dt=<?php echo $dt;?>";
</script>
<?	
}