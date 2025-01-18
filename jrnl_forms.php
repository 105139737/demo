<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
include("SimpleImage.php");
//catch the sent data
	$sl=0;
	
	$dt = $_POST['dt'] ?? "";
	$vno = $_POST['vno'] ?? "";
	$proj = $_POST['proj'] ?? "";
	$cldgr = $_POST['cldgr'] ?? "";
	$dldgr = $_POST['dldgr'] ?? "";
	$cbal = $_POST['cbal'] ?? "";
	$dbal = $_POST['dbal'] ?? "";
	$paymtd = $_POST['paymtd'] ?? "";
	$refno = $_POST['refno'] ?? "";
	$amm = $_POST['amm'] ?? "";
	$it = $_POST['it'] ?? "";
	$nrtn = $_POST['nrtn'] ?? "";
	$flnm = $_POST['flnm'] ?? "";
	$flnm1 = $_POST['flnm1'] ?? "";
	$sl = $_POST['updt'] ?? 0;
	$cid = $_POST['cid'] ?? "";
	$sid = $_POST['sid'] ?? "";
	$brncd = $_POST['brncd'] ?? "";
	$dis = $_POST['dis'] ?? "";
	$blno = $_POST['blno'] ?? "";
	$sman = $_POST['sman'] ?? "";
/*   Bill Type Details*/	
	$bsl = $_POST['bsl'] ?? "";
	$btyp = $_POST['btyp'] ?? "";
	$sms = $_POST['sms'] ?? "";
	$cust = $_POST['cust'] ?? "";
	$sup = $_POST['sup'] ?? "";
	$cust1 = $_POST['cust1'] ?? "";
	$sup1 = $_POST['sup1'] ?? "";
	
	$val=date_chk($dt);
	if($val==0)
	{
		die('<b><center><font color="red" size="5">Please Check Your Input Date. Please Go Back Previous Page....</font></center></b>');
	}
	if($flnm=="income.php")
	{
	$dirnm="income";
	}
	else if($flnm=="expense.php")
	{
	$dirnm="expense";
	}
	else{
	$dirnm="jrnl_form";
	}
	
	
    $chhh="";
    if($flnm=='pur.php')
	{
	$typ='55';
    $paymtd='0';
	}
	if($flnm=='sale_ser.php')
	{
	$typ='22';
    $paymtd='0';
	}
	if($flnm=='jrnl_form.php')
	{
	$typ='2';
		if($cust!="")
		{
			$cid=$cust;
		}
		else
		{
			$cid=$cust1;
		}
		if($sup!="")
		{
			$sid=$sup;
		}
		else
		{
			$sid=$sup1;
		}
	
	//$flnm="bill_typ_acc.php";
	}
	if($flnm=='income.php')
	{
	$typ='33';
	//$flnm="bill_typ_acc.php";
	}
	
	if($flnm=='expense.php')
	{
	$typ='44';
	$edit_count = get_permission($dt, $exp_edt);
	if ($edit_count == 0) {
		die('<b><center><font color="red" size="5">Please Check Your Input Date, Contact Administrator. Please Go Back Previous Page....</font></center></b>');
	}
	//$flnm="bill_typ_acc.php";
	}
	if($flnm=='recv_reg.php')
	{
	$typ='77';
	$chhh=" and cid='$cid'";
	//$flnm="recv_reg.php?brncd=$brncd";
	}
	if($flnm=='pay_reg.php')
	{
	$typ='88';
	$chhh=" and sid='$sid'";
	//$flnm="pay_reg.php?brncd=$brncd";
	}
	if($flnm=='refund.php')
	{
	$typ='99';
	}
	if($flnm=='contra.php')
	{
	$typ='3';
	//$flnm="contra.php?brncd=$brncd";
	$edit_count = get_permission($dt, $contra);
	if ($edit_count == 0) {
		die('<b><center><font color="red" size="5">Please Check Your Input Date, Contact Administrator. Please Go Back Previous Page....</font></center></b>');
	}
	}
	if($flnm=='cust_credit_note.php')
	{
	$typ='CC01';
	$chhh=" and cid='$cid'";
	$paymtd='0';
	//$flnm="recv_reg.php?brncd=$brncd";
	}

	$get=mysqli_query($conn,"select * from main_billtype where sl='$bsl'") or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($get))
	{
	$als=$row['als'];
	$ssn=$row['ssn'];
	$start_no=$row['start_no'];
	}
	if($flnm=='refund.php')
	{
$m=date('m', strtotime($dt));
$y=date('y', strtotime($dt));;
if($m>=4)
{
$yy="/".$y."-".($y+1);	
	
}
elseif($m<=3)
{
$yy="/".($y-1)."-".$y;	
}	
	$als='RF/';
	$ssn=$yy;
	$start_no=0;
	
if($blno=="ADVANCE-PAYMENT"){$blno="ADVANCE-PAYMENT-REFUND";$dldgr='7';}
}
$ym=date('Ym', strtotime($dt));	
$count6=5;
$vnos=0;
$query51="select * from ".$DBprefix."drcr where als='$als' and ssn='$ssn' and blnon!='' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
$vnos=$rows['blnon'];
}
if(!empty($vnos))
{
$bill=explode($als,$vnos);
$bill1=explode($ssn,$bill[1]);
$vnos=$bill1[0];
}
else{
   $vnos=0; 
}
if($start_no>$vnos)
{
$vnos=$start_no;
}
$vid1=$vnos;

if((strlen($vnos))>6)
{
$vid1=substr($vnos,6,15);
}

while($count6>0){
$vid1=(float)$vid1+1;
//$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);
$vnoc=$vid1;
$blnon=$als.$ym.$vnoc.$ssn;
$query5="select * from ".$DBprefix."drcr where blnon='$blnon'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);
}
	
	
/*   Bill Type Details*/	
	
$err="";
if(!empty($_FILES['fileToUpload1']['tmp_name'])){
$size=filesize($_FILES['fileToUpload1']['tmp_name']);

if($size>700000)
{
// $err="Please Check Upload File Size ...";    
}

$size=filesize($_FILES['fileToUpload']['tmp_name']);

if($size>700000)
{
// $err="Please Check Upload File Size ...";    
}
}
	
if($err=="")
{
	
	if($sl!=0)
	{
	if($dt=='' or $cldgr=='' or $dldgr=='' or $paymtd=='' or $amm=='' or $brncd=='')
	{
	?>
<script language="javascript">
alert('Please Fill All The Fields.');
window.history.go(-1);
</script>
<?php 	}
	else
	{
	$dt=date('Y-m-d', strtotime($dt));	
$query31 = "UPDATE main_drcr set dt='$dt',nrtn='$nrtn',dldgr='$dldgr',mtd='$paymtd',mtddtl='$refno',cldgr='$cldgr',amm='$amm',cid='$cid',sid='$sid',brncd='$brncd',sman='$sman',cbill='$blno' where sl='$sl'";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));

if($blno!='')
{
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

$qr=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$blno'") or die(mysqli_error($conn));
}
else
{
	
$qr=mysqli_query($conn,"update main_drcr set paid='0' where cbill='$blno'") or die(mysqli_error($conn));	
}
}
if(!empty($_FILES['fileToUpload1']['tmp_name'])){
$path5="img/".$dirnm;
if (!file_exists($path5)) {
mkdir($path5);
}
//echo $ext = pathinfo($_FILES['fileToUpload'], PATHINFO_EXTENSION);
$target_dir="img/";
$target_file = $target_dir . basename($_FILES["fileToUpload1"]["name"]);
$ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$path="img/".$dirnm."/".$vno.".".$ext;
if (file_exists($_FILES['fileToUpload1']['tmp_name'])) {
move_uploaded_file($_FILES['fileToUpload1']['tmp_name'], $path);
}
$qrupdt =mysqli_query($conn, "UPDATE main_drcr set path='$path' where sl='$sl'")or die (mysqli_error($conn));
}

?>
<script language="javascript">
alert('Updated Successfully. Thank You...');
document.location ="<?php  echo $flnm;?>?bsl=<?php  echo $bsl;?>";
</script>
<?php 
/*
$path5="img/".$dirnm;
if (!file_exists($path5)) {
mkdir($path5);
}
$path="img/".$dirnm."/".$vno.".jpg";
move_uploaded_file($_FILES['fileToUpload1']['tmp_name'], $path);
*/


	}
	}
	else
	{
if($dt==''  or $cldgr=='' or $dldgr=='' or $paymtd=='' or $amm=='' )
	{
	?>
<script language="javascript">
alert('Please Fill All The Fields.');
<?php 
if($flnm1=="")
{
?>
window.history.go(-1);
<?php 
}
else
{
?>
document.location = "<?php  echo $flnm;?>?bsl=<?php  echo $bsl;?>";
<?php 
}
?>
</script>
<?php 	}
	else
	{
	date_default_timezone_set('Asia/Kolkata');
	$edt = date('d/m/Y h:i:s a', time());
	$dt=date('Y-m-d', strtotime($dt));	
	if($cldgr==$dldgr)
	{
	?>
<script language="javascript">
alert('Sorry!! Credit Ledger & Debit Ledger Can not be Same.');
<?php 
if($flnm1=="")
{
?>
window.history.go(-1);
<?php 
}
else
{
?>
document.location = "<?php  echo $flnm;?>?bsl=<?php  echo $bsl;?>";
<?php 
}
?>
</script>
<?php 
	}
	else
	{
	
	
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
else
{

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
/*	
while($count6>0)
{
	$vid1=$vid1+1;
	$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
	$vcno="SV".$vnoc;
	$query5="select * from ".$DBprefix."drcr where vno='$vcno'";
	$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
	$count6=mysqli_num_rows($result5);
}

	*/	
		
		$query31 = "INSERT INTO main_drcr (pno,vno,dt,nrtn,typ,dldgr,mtd,mtddtl,cldgr,amm,eby,edtm,it,cid,sid,brncd,cbill,sman,btyp,als,ssn,bill_typ,blnon) VALUES 
		('$proj','$vcno','$dt','$nrtn','$typ','$dldgr','$paymtd','$refno','$cldgr','$amm','$user_currently_loged','$edt','$it','$cid','$sid','$brncd','$blno','$sman','$btyp','$als','$ssn','$bsl','$blnon')";
		$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));
		/*
		if($flnm=='recv_reg.php')
	{
		
if($dis>0)
{
$query31 = "INSERT INTO main_drcr (pno,vno,dt,nrtn,typ,dldgr,mtd,mtddtl,cldgr,amm,eby,edtm,it,cid,sid,brncd,cbill,sman) VALUES 
('$proj','$vcno','$dt','Discount','D$typ','29','$paymtd','$refno','4','$dis','$user_currently_loged','$edt','$it','$cid','$sid','$brncd','$blno','$sman')";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));
}

	}
*/
$last_sl=0;
if($typ==44)
{
	$datad= mysqli_query($conn,"select * from main_drcr order by sl desc limit 0,1")or die(mysqli_error($conn));
	while ($rowd = mysqli_fetch_array($datad))
	{
	$last_sl=$rowd['sl'];
	}
}
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
$message="Dear ".$cust_nm.",\nYour A/c has been credited with Rs ".number_format($amm,2)." vide CN no ".$blnon." Dt ".$dt." on account of ".$nrtn;
$sms=send_sms($cust_cont,$message,'1');	
}
$dt=date('d-M-Y',strtotime($dt));
if($typ==44)
{

?>
<script>
window.open("expense_cash_report_new.php?sl=<?php  echo $last_sl;?>","_blank").focus();
</script>
<?php 
}
?>
<script language="javascript">
alert('Added Successfully. Thank You.');
document.location = "<?php  echo $flnm;?>?bsl=<?php  echo $bsl;?>&dt=<?php  echo $dt;?>";
</script>
<?php 
if(!empty($_FILES['fileToUpload']['tmp_name'])){
$path5="img/".$dirnm;
if (!file_exists($path5)) {
mkdir($path5);
}
//echo $ext = pathinfo($_FILES['fileToUpload'], PATHINFO_EXTENSION);
$target_dir="img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$path="img/".$dirnm."/".$vcno.".".$ext;
if (file_exists($_FILES['fileToUpload']['tmp_name'])) {
move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path);

$qrupdt =mysqli_query($conn, "UPDATE main_drcr set path='$path' where vno='$vcno'")or die (mysqli_error($conn));
}
}
}}}}

}
else
{
	?>
<script language="javascript">
alert('<?php  echo $err;?>');
<?php 
if($flnm1=="")
{
?>
window.history.go(-1);
<?php 
}
else
{
?>
document.location = "<?php  echo $flnm;?>?bsl=<?php  echo $bsl;?>";
<?php 
}
?>
</script>	
<?php 
} 
?>

