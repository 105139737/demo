<?php
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edtm=date('y-m-d H:i:s a');

$dt1=$_POST['dt'];
$dt=date('Y-m-d', strtotime($dt1));
$brncd=$_POST['brncd'];
$cldgr=$_POST['cldgr'];

$dldgr=$_POST['dldgr'];

$cid=$_POST['cid'];
$cbill=$_POST['cbill'];
$amm=$_POST['amm'];
$nrtn=$_POST['nrtn'];
$sms = $_POST['sms'];

if($dt1=="" or $brncd=="" or $cldgr=="" or $cid=="" or $nrtn=="")
{
	?>
	<script>
	alert('Please Fill All The Field');
	history.go(-1);
	</script>
	<?
}
else
{	
$result = mysqli_query($conn,"SELECT * from main_cust_asgn where sl>0 and typ='0' and FIND_IN_SET('$cid', cust)>0 ");
while($row = mysqli_fetch_array($result))
{
$sman=$row['spid'];
}

mysqli_query($conn,"insert into main_drcr(dt,brncd,cldgr,dldgr,cid,cbill,amm,nrtn,eby,edtm,typ,sman) values('$dt','$brncd','$cldgr','$dldgr','$cid','$cbill','$amm','$nrtn','$user_currently_loged','$edtm','BC01','$sman')") or die (mysqli_error($conn));

if($cbill!='')
{
$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where  cbill='$cbill' and dldgr='4'");
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where cbill='$cbill' and cldgr='4'");
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=round($t1-$t2,0);
if($T==0)
{

$qr=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$cbill'") or die(mysqli_error($conn));
}
else
{
	
$qr=mysqli_query($conn,"update main_drcr set paid='0' where cbill='$cbill'") or die(mysqli_error($conn));	
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

include "send_sms.php";
$message="Dear ".$cust_nm.",\nYour A/c has been debited by Rs ".number_format($amm,2).". Against  ".$nrtn;
$sms=send_sms($cust_cont,$message,'1');	



$datad1= mysqli_query($conn,"select * from main_sale_per where spid='$sman'")or die(mysqli_error($conn));
while ($rowd1 = mysqli_fetch_array($datad1))
{
$mob=$rowd1['mob'];
}
$sms=send_sms($mob,$message,'1');	
}


			?>
			<script>
			alert('Submitted Successfully. Thank You');
			document.location="customer_fine.php";
			</script>
			<?
}
?>