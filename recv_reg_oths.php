<?php
$reqlevel = 1;
include("membersonly.inc.php");
$edtm = date('d-m-Y h:i:s a', time());
$edtmm = date('Y-m-d h:i:s a');
$edt=date('Y-m-d');	
$today=date('Y-m-d');	
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
$paymtd = $_POST['paymtd'];
$tamm = $_POST['tamm'];
$refno = $_POST['refno'];
$ramm = $_POST['ramm'];
$blno_ref = $_POST['blno_ref'];
$spid = $_POST['spid'];
$sms = $_POST['sms'];

set_time_limit(0);
	
	$val=date_chk($dt);
	if($val==0)
	{
		die('<b><center><font color="red" size="5">Please Check Your Input Date. Please Go Back Previous Page....</font></center></b>');
	}
$edit_count=get_permission($dt,$recv_ent);	
	if($edit_count==0)
	{
		die('<b><center><font color="red" size="5">Please Check Your Input Date, Contact Administrator. Please Go Back Previous Page....</font></center></b>');
	}

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

$query1001 = "SELECT * FROM main_recv_reg_temp where eby='$user_currently_loged' and cid='$cid' order by sl";
$result1001 = mysqli_query($conn,$query1001) or die(mysqli_error($conn));
$ccount=mysqli_num_rows($result1001);
if($ccount==0)
{
$err="Please ADD Some Row...";	
}
if($err=="")
{
$datad= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
	$typ=$rowd['typ'];
	$type=$rowd['typ'];
}

$query511="select * from main_recv where blno!='' order by sl desc limit 0,1";
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
$blno1="RC".$vnoc1;
$query51="select * from main_recv where blno='$blno1'";
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
	$vid1=$vid1+1;
	$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
	$vcno="SV".$vnoc;	
$count6=5;
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

$query31 = "INSERT INTO main_recv (blno,bcd,dt,cid,nrtn,dldgr,paymtd,tamm,refno,bill_type,als,ssn,eby,edt,app_ref,spid) VALUES 
('$blno1','$brncd','$dt','$cid','$nrtn','$dldgr','$paymtd','$tamm','$refno','$bsl','$als','$ssn','$user_currently_loged','$edt','$blno_ref','$spid')";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));

if($blno_ref=='')
{
$query31 = "INSERT INTO main_recv_app (blno,bcd,dt,cid,nrtn,dldgr,paymtd,tamm,refno,bill_type,als,ssn,eby,edt,stat,spid) VALUES 
('$blno1','$brncd','$dt','$cid','$nrtn','$dldgr','$paymtd','$tamm','$refno','$bsl','$als','$ssn','$spid','$edt','1','$spid')";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));
}
$ym=date('Ym', strtotime($dt));	
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
if((strlen($vnos))>6)
{
$vid1=substr($vnos,6,15);
}
//$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);

while($count6>0){
$vid1=$vid1+1;
$blnon=$als.$ym.$vid1.$ssn;
$query5="select * from ".$DBprefix."drcr where blnon='$blnon'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);
}

$query100 = "SELECT * FROM main_recv_reg_temp where eby='$user_currently_loged' and cid='$cid' order by sl";
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

$query21 = "INSERT INTO main_recv_dtl(ref,blno,amm,sman,cid,eby,brncd,disl,damm,remk)
VALUES ('$blno1','$blno','$amm','$spid','$cid','$user_currently_loged','$brncd','$disl','$damm','$remk')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	
if($blno_ref=='')
{
$query21 = "INSERT INTO main_recv_dtl_app(ref,blno,amm,sman,cid,eby,brncd,disl,damm,remk)
VALUES ('$blno1','$blno','$amm','$spid','$cid','$user_currently_loged','$brncd','$disl','$damm','$remk')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	
}
if($blno=="ADVANCE-PAYMENT"){$blno="";$cldgr='7';$typ="ADV77";}else{$typ="77";}
if($blno_add=='ADVANCE-PAYMENT' && $dldgr=='7')
{
	
}
else
{
//discount -----------------------------------------------
	$amm1=0;
	$a=0;
	$b=0;
	$amm1=$amm;
	if($type=='2')
	{
	
		$data2= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
		while ($row2t = mysqli_fetch_array($data2))
		{
			$bdt=$row2t['dt'];
		}

		$diff = abs(strtotime($today) - strtotime($bdt));
		$day=($diff/60/60/24);
		
		/*	$result = mysqli_query($conn,"SELECT * FROM main_discount where custid='$cid' and days>'$day' order by days limit 0,1");
			if(mysqli_num_rows($result)>0)
			{
		while ($rowt = mysqli_fetch_array($result))
		{
			$custid=$rowt['custid'];
			$days=$rowt['days'];
			$percent=$rowt['prefnd'];
		}

		
			$a=$amm*$percent;
			$b=$a/100;
		
		$query31 = "INSERT INTO main_drcr (vno,dt,nrtn,typ,dldgr,cldgr,amm,eby,edtm,cid,brncd,cbill,sman,btyp,als,ssn,bill_typ,blno,blnon) VALUES 
		('$vcno','$dt','Discount','CC01','46','4','$b','$user_currently_loged','$edtm','$cid','$brncd','$blno','$spid','$btyp','$als','$ssn','$bsl','$blno1','$blnon')";
		$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));		
		
		mysqli_query($conn,"insert into main_discountdtls(blnon,typ,sman,btyp,bno,bill_typ,ssn,als,brncd,vno,vdt,cid,blno,bdt,pdt,difdt,prc,pamm,damm,stat,eby,edt,edtm )
					values('$blnon','$typ','$spid','$btyp','$blno1','$bsl','$ssn','$als','$brncd','$vcno','$dt','$cid','$blno','$dt','$edt','$day','$percent','$amm','$b','1','$user_currently_loged','$edt','$edtmm')");	
			}*/
	}	
//discount -----------------------------------------------
$query31 = "INSERT INTO main_drcr (vno,dt,nrtn,typ,dldgr,mtd,mtddtl,cldgr,amm,eby,edtm,cid,brncd,cbill,sman,btyp,als,ssn,bill_typ,blnon,blno) VALUES 
('$vcno','$dt','$nrtn','$typ','$dldgr','$paymtd','$refno','$cldgr','$amm','$user_currently_loged','$edtm','$cid','$brncd','$blno','$spid','$btyp','$als','$ssn','$bsl','$blnon','$blno1')";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn)); 
}
if($damm>0)
{
$query31 = "INSERT INTO main_drcr (vno,dt,nrtn,typ,dldgr,cldgr,amm,eby,edtm,cid,brncd,cbill,sman,btyp,als,ssn,bill_typ,blnon,blno) VALUES 
('$vcno','$dt','$remk','CC01','$disl','$cldgr','$damm','$user_currently_loged','$edtm','$cid','$brncd','$blno','$spid','$btyp','$als','$ssn','$bsl','$blnon','$blno1')";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));
}

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
if($T<0.01)
{

$qr=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$blno'") or die(mysqli_error($conn));
}
else
{
	
$qr=mysqli_query($conn,"update main_drcr set paid='0' where cbill='$blno'") or die(mysqli_error($conn));	
}
if($blno!='')
{
$data1_s= mysqli_query($conn,"select * from main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1_s))
{
$invto=$row1['invto'];	
}
}
}

mysqli_query($conn,"DELETE FROM main_recv_reg_temp WHERE eby='$user_currently_loged'") or die(mysqli_error($conn));

if($blno_ref!='')
{
$query21 = "UPDATE main_recv_app SET stat='1' WHERE blno='$blno_ref'";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	
}

if($sms==2)
{
if($invto!=''){$cid=$invto;}	
	
$datad= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$cust_nm=$rowd['nm'];
$cust_cont=$rowd['cont'];
}
$datad1= mysqli_query($conn,"select * from ac_paymtd where sl='$paymtd'")or die(mysqli_error($conn));
while ($rowd1 = mysqli_fetch_array($datad1))
{
$mtd=$rowd1['mtd'];
}

include "send_sms.php";
echo $message="Dear ".$cust_nm.",\nwe have received of Rs. ".number_format($tamm,2)."\non ".$dt." through V0ucher No ".$vcno." against ".$mtd." ".$refno;
$sms=send_sms($cust_cont,$message,'1');	

$datad1= mysqli_query($conn,"select * from main_sale_per where spid='$spid'")or die(mysqli_error($conn));
while ($rowd1 = mysqli_fetch_array($datad1))
{
$mob=$rowd1['mob'];
}
$sms=send_sms($mob,$message,'1');	
}

?>
<script language="javascript">
alert('Added Successfully. Thank You..!');
document.location = "recv_reg_oth.php?bsl=<?php echo $bsl;?>&dt=<?php echo $dt;?>&brncd1=<?php echo $brncd;?>";
</script>
<?	
}
else
{
?>
<script language="javascript">
alert('<?=$err;?>');
document.location = "recv_reg_oth.php?bsl=<?php echo $bsl;?>&dt=<?php echo $dt;?>&brncd1=<?php echo $brncd;?>";
</script>
<?	
}