<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$cdt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$sup=$_POST['sup']??"";
$brncd=$_POST['brncd']??"";
$inv=$_POST['inv']??"";
$dt=$_POST['dt']??"";
$lcd=$_POST['lcd']??"";
$lfr=$_POST['lfr']??"";
$tamm=$_POST['tamm']??"";
$dldgr=$_POST['dldgr']??"";
$mdt=$_POST['mdt']??"";
$pamm=$_POST['pamm']??"";
$crfno=$_POST['crfno']??"";
$idt=$_POST['idt']??"";
$cbnm=$_POST['cbnm']??"";
$vat=$_POST['vat']??"";
$sttl=$_POST['sttl']??"";
$tdis=$_POST['tdis']??"";
$fst=$_POST['fst']??"";
$tst=$_POST['tst']??"";
$addr=$_POST['addr']??"";

$roff=$_POST['roff']??"";
$adl=$_POST['adl']??"";
$adlv=$_POST['adlv']??"";
$tamm2=$_POST['tamm2']??"";
$remk=$_POST['remk']??"";
$blno=$_POST['blno']??"";
$tcs=$_POST['tcs']??"";
$tcsam=$_POST['tcsam']??"";
$paid=0;
$due=0;


if($dt!="")
{
$dt=date('Y-m-d', strtotime($dt));
}
else{
	$dt="0000-00-00";
}

if($idt=="")
{
	$idt="0000-00-00";
}
else
{
$idt=date('Y-m-d', strtotime($idt));
}
$err="";

if($sup==""){
    $err="Please Enter Shop Name ...";
}
$val=date_chk($dt);
if($val==0)
{
die('<b><center><font color="red" size="5">Please Check Your Input Date. Please Go Back Previous Page....</a></font></center></b>');
}

 $query1 = "SELECT sum(ttl) as gttl,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst,sum(net_am) as sttl FROM main_purchasedet_edt where eby='$user_currently_loged' and blno='$blno'";
   $result1 = mysqli_query($conn,$query1) or die(mysqli_error($conn));
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$gttl1=$R1['gttl'];
$cgst=$R1['cgst'];
$sgst=$R1['sgst'];
$igst=$R1['igst'];
$sttl=$R1['sttl'];
}

if($gttl==0)
{
    $err="Please Add Some Product First";
}
$query51="select * from ".$DBprefix."drcr where sbill='$blno'";
$result51=mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
	$vcno=$rows['vno'];
}

if($err=="")
{
$dd=mysqli_query($conn,"select * from main_purchase_edt_log where edt_blno!='' order by edt_blno") or die(mysqli_error($conn));
while($pps=mysqli_fetch_array($dd))
{	
$edt_blno1=$pps['edt_blno'];
}	
$vid1=substr($edt_blno1,2,7);	
$ssnn1=5;
while($ssnn1>0)
{
$vvid1=$vid1+1;
$vvnoc=str_pad($vvid1, 7, '0', STR_PAD_LEFT);
$edt_blno="PE".$vvnoc;
$ssnn=mysqli_query($conn,"select * from main_purchase_edt_log where edt_blno='$edt_blno'");
$ssnn1=mysqli_num_rows($ssnn);
}

	
$query_log = "insert into main_purchase_edt_log (edt_blno,blno,sid,amm,paid,crdtp,edt,eby,pdts,edttm,inv,dt,lfr,lcd,bcd,vat,vatamm,sdis,tamm,fst,tst,gst,addr,roff,adl,adlv,tmm2,remk,sttl,cbnm,bill_by)
select '$edt_blno',blno,sid,amm,paid,crdtp,'$cdt','$user_currently_loged',pdts,'$dttm',inv,dt,lfr,lcd,bcd,vat,vatamm,sdis,tamm,fst,tst,gst,addr,roff,adl,adlv,tmm2,remk,sttl,cbnm,eby
from main_purchase where blno = '$blno'";
$result_log = mysqli_query($conn,$query_log)or die (mysqli_error($conn)); 

$query_log1 = "insert into  main_purchasedet_edt_log (edt_blno,cat,scat,unit,uval,prsl,qty,mrp,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,amm,usl,total,disp,disa,ldis,ldisa,bcd,rate,betno,dt,stk_rate,sup,eby)
select '$edt_blno',cat,scat,unit,uval,prsl,qty,mrp,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,amm,usl,total,disp,disa,ldis,ldisa,bcd,rate,betno,dt,stk_rate,sup,'$user_currently_loged'
from main_purchasedet where blno = '$blno'";
$result_log1 = mysqli_query($conn,$query_log1)or die (mysqli_error($conn)); 
	
	
$query1 = "SELECT sum(ttl) as gttl,sum(net_am) as damm FROM main_purchasedet_edt where eby='$user_currently_loged' and blno='$blno'";
$result1 = mysqli_query($conn,$query1) or die(mysqli_error($conn));
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$damm=$R1['damm'];
}

$damm=$damm-($cgst+$sgst+$igst);
$damm=$damm+$roff;
if($adl=="+")
{	
$damm=$damm;
/*$damm=$damm+$adlv;*/
}
elseif($adl=="-")
{
$damm=$damm;	
/*$damm=$damm-$adlv;*/
}
$vat1=0;
$query211 = "UPDATE ".$DBprefix."purchase SET sid='$sup',amm='$gttl',paid='$pamm',crdtp='$mdt',edt='$cdt',
eby='$user_currently_loged',pdts='$dttm',inv='$inv',dt='$dt',lfr='$lfr',lcd='$lcd',bcd='$brncd',vat='$vat',
vatamm='$vat1',sdis='$tdis',tamm='$tamm',fst='$fst',tst='$tst',gst='1',addr='$addr',roff='$roff',adl='$adl',
adlv='$adlv',tmm2='$tamm2',remk='$remk',sttl='$sttl',cbnm='$cbnm',tcs='$tcs',tcsam='$tcsam' WHERE blno='$blno'";
$result211 = mysqli_query($conn,$query211)or die (mysqli_error($conn));

/*DELETE FROM BILL DETAILS & STOCK & DRCR*/

 mysqli_query($conn,"DELETE FROM ".$DBprefix."purchasedet WHERE blno='$blno'") or die(mysqli_error($conn));
 mysqli_query($conn,"DELETE FROM ".$DBprefix."stock WHERE pbill='$blno'") or die(mysqli_error($conn));

if($blno!='')
{
$result2 = mysqli_query($conn,"DELETE FROM ".$DBprefix."drcr WHERE sbill='$blno'") or die(mysqli_error($conn));
}

/*DELETE FROM BILL DETAILS & STOCK*/



$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm)
 VALUES ('$vcno','$blno','$sup','$dt','Purchase','-3','12','$damm','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));

if($cgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm)
 VALUES ('$vcno','$blno','$sup','$dt','C-GST','37','12','$cgst','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}
if($sgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm)
 VALUES ('$vcno','$blno','$sup','$dt','S-GST','38','12','$sgst','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}
if($igst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm)
 VALUES ('$vcno','$blno','$sup','$dt','I-GST','39','12','$igst','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}

if($tcsam>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm)
 VALUES ('$vcno','$blno','$sup','$dt','TCS','182','12','$tcsam','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}


if($remk!='')
{
if($adlv>0)
{
if($adl=="+")
{	
$damm=$damm+$adlv;

$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm)
 VALUES ('$vcno','$blno','$sup','$dt','Purchase ADD Charge','$remk','12','$adlv','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}
elseif($adl=="-")
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm)
 VALUES ('$vcno','$blno','$sup','$dt','Purchase Less Charge','12','$remk','$adlv','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
	
}	
}
}


if($pamm>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm,typ)
 VALUES ('$vcno','$blno','$sup','$dt','Purchase Payment','$idt','$mdt','$crfno','12','$dldgr','$pamm','$brncd','$user_currently_loged','$dttm','88')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}


$query100 = "SELECT * FROM main_purchasedet_edt where eby='$user_currently_loged' and blno='$blno' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$cat=$R100['cat'];
$scat=$R100['scat'];
$unit=$R100['unit'];
$prsl=$R100['prsl'];
$qty=$R100['qty'];
$mrp=$R100['mrp'];
$ttl=$R100['ttl'];
$fst=$R100['fst'];
$tst=$R100['tst'];
$cgst_rt=$R100['cgst_rt'];
$cgst_am=$R100['cgst_am'];
$sgst_rt=$R100['sgst_rt'];
$sgst_am=$R100['sgst_am'];
$igst_rt=$R100['igst_rt'];
$igst_am=$R100['igst_am'];
$net_am=$R100['net_am'];
$dis=$R100['dis'];
$amm=$R100['amm'];
$usl=$R100['usl'];

$total=$R100['total'];
$disp=$R100['disp'];
$disa=$R100['disa'];
$ldis=$R100['ldis'];
$ldisa=$R100['ldisa'];
$bcd=$R100['bcd'];
$rate=$R100['rate'];
$rate=$net_am/$qty;
$stk_rate1=$ttl/$qty;
$eby=$R100['eby'];
$betno=$R100['betno'];

$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$prsl'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}
if($unit=='sun'){$stock_in=$qty*$smvlu;$uval=$smvlu;$rate1=$rate/$smvlu;$uval=$smvlu;$stk_rate=$stk_rate1/$smvlu;}
if($unit=='mun'){$stock_in=$qty*$mdvlu;$uval=$mdvlu;$rate1=$rate/$mdvlu;$uval=$mdvlu;$stk_rate=$stk_rate1/$smvlu;}
if($unit=='bun'){$stock_in=$qty*$bgvlu;$uval=$bgvlu;$rate1=$rate/$bgvlu;$uval=$bgvlu;$stk_rate=$stk_rate1/$smvlu;}

$query21 = "INSERT INTO ".$DBprefix."purchasedet(cat,scat,unit,uval,prsl,qty,mrp,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,amm,usl,total,disp,disa,ldis,ldisa,bcd,rate,eby,betno,stk_rate,sup,dt)
 VALUES ('$cat','$scat','$unit','$uval','$prsl','$qty','$mrp','$ttl','$blno','$fst','$tst','$cgst_rt','$sgst_rt','$igst_rt','$cgst_am','$sgst_am','$igst_am','$net_am','$amm','$usl','$total','$disp','$disa','$ldis','$ldisa','$bcd','$rate1','$eby','$betno','$stk_rate','$sup','$dt')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 

$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,unit,stin,nrtn,eby,dtm,stat,ret,refno,pbill,usl,uval,betno,rate,stk_rate)
 VALUES ('$prsl','$bcd','$dt','$unit','$stock_in','Purchase','$user_currently_loged','$dttm','1','$mrp','$blno','$blno','$usl','$uval','$betno','$rate1','$stk_rate')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}

$query2 = "DELETE FROM main_purchasedet_edt WHERE eby='$user_currently_loged'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));

?>
<Script language="JavaScript">
alert('Updated Successfully. Thank You...');
document.location="purchase_show.php";
</script>
<?php 
}

else
{
    ?>
<Script language="JavaScript">
alert('<?php  echo $err;?>');
window.history.go(-1);
</script>
<?php 
}
?>
