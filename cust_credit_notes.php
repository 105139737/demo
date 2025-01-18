<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
include("SimpleImage.php");
//catch the sent data
	$sl=0;
	
	$dt = $_POST['dt']??"";
	$dt_return = $_POST['dt']??"";
	$vno = $_POST['vno']??"";
	$proj = $_POST['proj']??"";
	$cldgr = $_POST['cldgr']??"";
	$dldgr = $_POST['dldgr']??"";
	$cbal = $_POST['cbal']??"";
	$dbal = $_POST['dbal']??"";
	$paymtd = $_POST['paymtd']??"";
	$refno = $_POST['refno']??"";
	
	//$amm = $_POST['amm'];
	
	$it = $_POST['it']??"";
	
	//$nrtn = $_POST['nrtn'];
	
	$flnm = $_POST['flnm']??"";
	$flnm1 = $_POST['flnm1']??"";
	$sl = $_POST['updt']??"";
	$cid = $_POST['cid']??"";
	$sid = $_POST['sid']??"";
	$brncd = $_POST['brncd']??"";
	$dis = $_POST['dis']??"";
	
	//$blno = $_POST['blno'];
	
	
	$sman = $_POST['sman']??"";
/*   Bill Type Details*/	
	$bsl = $_POST['bsl']??"";
	$btyp = $_POST['btyp']??"";
	$sms = $_POST['sms']??"";
	$cust = $_POST['cust']??"";
	$sup = $_POST['sup']??"";
	$cust1 = $_POST['cust1']??"";
	$sup1 = $_POST['sup1']??"";
	$pcat = $_POST['cat']??"";
	$edt="";
	$amm1=0;
	$val=date_chk($dt);
	if($val==0)
	{
		die('<b><center><font color="red" size="5">Please Check Your Input Date. Please Go Back Previous Page....</font></center></b>');
	}
$edit_count=get_permission($dt,$ccn_ent);	
	if($edit_count==0)
	{
		die('<b><center><font color="red" size="5">Please Check Your Input Date, Contact Administrator. Please Go Back Previous Page....</font></center></b>');
	}



	if($flnm=='cust_credit_note.php')
	{
	$typ='CC01';
	$chhh=" and cid='$cid'";
	//$flnm="recv_reg.php?brncd=$brncd";
	}
/* 	
$query4 = "SELECT * FROM main_drcr where pno='$proj' and cldgr='$cldgr' and dldgr='$dldgr' and dt='$dt' and amm='$amm' and mtd='$paymtd' and mtddtl='$refno' and nrtn='$nrtn' and sl='a' $chhh";
$result4 = mysqli_query($conn,$query4);
$cnt=0;
while ($R = mysqli_fetch_array ($result4))
{
$cnt++;
}
if($cnt>0)
{
?>
<script language="javascript">
alert('Sorry!! Entry Already Exist.');
window.history.go(-1);
</script>
<?php 
}
 */	
$err="";
 
	if($dt=='' or $cldgr=='' or $dldgr=='' or $paymtd=='' or $brncd=='')
	{
	 $err="Please fill all field ....";
	} 
 
$qr10=mysqli_query($conn,"select * from main_credit where eby='$user_currently_loged' and cid='$cid'") or die(mysqli_error($conn));
$qcount=mysqli_num_rows($qr10);
 if($qcount==0)
 {
	 $err="Add Bill Details First ......";
 }
if($err==""){
$get=mysqli_query($conn,"select * from main_billtype where sl='$bsl'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$als=$row['als'];
$ssn=$row['ssn'];
$start_no=$row['start_no'];
}
	$query51="select * from ".$DBprefix."drcr where sl>0 and vno!='' order by sl desc limit 0,1";
	$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
	while($rows=mysqli_fetch_array($result51))
	{	
	$vnos=$rows['vno'];
	}	
	$vid1=substr($vnos,2,7);	
	$count6=5;
	$vid1=(float)$vid1+1;
	$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
	$vcno="SV".$vnoc;
	
	
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
	$vid1=(float)$vid1+1;
	//$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);
	$vnoc=$vid1;
	$blnon=$als.$vnoc.$ssn;
	$query5="select * from ".$DBprefix."drcr where blnon='$blnon'";
	$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
	$count6=mysqli_num_rows($result5);
	}

$qr=mysqli_query($conn,"select * from main_credit where eby='$user_currently_loged' and cid='$cid'") or die(mysqli_error($conn));
while($r=mysqli_fetch_array($qr))
{
	$blno=$r['blno'];
	$amm=$r['amm'];
	$nrtn=$r['nrtn'];

	




	$dt=date('Y-m-d', strtotime($dt));	
	
	$query31 = "INSERT INTO main_drcr (pno,vno,dt,nrtn,typ,dldgr,mtd,mtddtl,cldgr,amm,eby,edtm,it,cid,sid,brncd,cbill,sman,btyp,als,ssn,bill_typ,blnon) VALUES 
	('$proj','$vcno','$dt','$nrtn','$typ','$dldgr','$paymtd','$refno','$cldgr','$amm','$user_currently_loged','$edt','$it','$cid','$sid','$brncd','$blno','$sman','$btyp','$als','$ssn','$bsl','$blnon')";
	$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));

if($nrtn!='')
{
$nrtn1=$nrtn;	
}
$amm1+=$amm;

$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where  cbill='$blno' and dldgr='4'");
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where cbill='$blno' and cldgr='4'");
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=round($t1-$t2,0);
if($T==0)
{

$qr31=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$blno'") or die(mysqli_error($conn));
}
else
{
	
$qr31=mysqli_query($conn,"update main_drcr set paid='0' where cbill='$blno'") or die(mysqli_error($conn));	
}

}
$qr31=mysqli_query($conn,"delete from main_credit where eby='$user_currently_loged' and cid='$cid'") or die(mysqli_error($conn));


if($sms==2)
{
$datad= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$cust_nm=$rowd['nm'];
$cust_cont=$rowd['cont'];
}
$dt=date('d-m-Y',strtotime($dt));
include "send_sms.php";
$message="Dear ".$cust_nm.",\nYour A/c has been credited with Rs ".number_format($amm1,2)." vide CN no ".$blnon." Dt ".$dt." on account of ".$nrtn1;
$sms=send_sms($cust_cont,$message,'1');	

$datad1= mysqli_query($conn,"select * from main_sale_per where spid='$sman'")or die(mysqli_error($conn));
while ($rowd1 = mysqli_fetch_array($datad1))
{
$mob=$rowd1['mob'];
}
$sms=send_sms($mob,$message,'1');	
}
$dt=date('d-M-Y',strtotime($dt));
?>
<script language="javascript">
alert('Added Successfully. Thank You.');
document.location = "<?php  echo $flnm;?>?bsl=<?php  echo $bsl;?>&dt=<?php  echo $dt;?>&dldgr=<?php  echo $dldgr;?>&dt=<?php  echo $dt_return;?>&pcat=<?php  echo $pcat;?>";
</script>
<?php  } else {?>

<script language="javascript">
alert('<?php  echo $err;?>');
window.history.go(-1);
</script>

<?php  } ?>