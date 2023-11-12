<?php
$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$blno=$_POST['blno'];
$ddt=$_POST['ddt'];
$dt=$_POST['dt'];
$chk=$_POST['chk'];
$dt=date('Y-m-d', strtotime($dt));
if($chk==0)
{
$d=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');

$m=date('m', strtotime($dt));
$y=date('y', strtotime($dt));;
if($m>=4)
{
$yy="PR/".$y."-".($y+1)."/";	
}
elseif($m<=3)
{
$yy="PR/".($y-1)."-".$y."/";	
}



$query51="select * from main_purchase_ret order by sl desc limit 0,1 ";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
	$vnos=$rows['blno'];
}
$vid=substr($vnos,9,5);


$count5=1;
while($count5>0){
$vid=$vid+1;
$vid=str_pad($vid, 5, '0', STR_PAD_LEFT);
$vno=$vid;

$blnon=$yy.$vno;
$query6="select * from main_purchase_ret where blno='$blnon'";
$result5 = mysqli_query($conn,$query6) or die(mysqli_error($conn));
$count5=mysqli_num_rows($result5);
}

$data1= mysqli_query($conn,"select * from  main_purchase where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$sid=$row1['sid'];
$sup=$row1['sid'];
$bcd55=$row1['bcd'];
}


$query100 = "SELECT * FROM ".$DBprefix."purchasedet where blno='$blno' order by sl";
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

$sgst_rt=$R100['sgst_rt'];

$igst_rt=$R100['igst_rt'];


$dis=$R100['dis'];
$usl=$R100['usl'];
$disp=$R100['disp'];
$bcd=$R100['bcd'];
$rate=$R100['rate'];
$eby=$R100['eby'];
$betno=$R100['betno'];

$stout=$qty;	
$qnt=$_POST['q'.$tsl];
if($qnt>0){
$total=round($mrp*$qnt,2);
if($disp>0)
{
$disa1=round(($total*$disp)/100,2);
}
$amm=$total-$disa1;
$ttl=$amm;

if($sgst_rt>0)
{
 $sgst_am=round((($amm*$sgst_rt)/100),2);
}
if($cgst_rt>0)
{
 $cgst_am=round((($amm*$cgst_rt)/100),2);
}
if($igst_rt>0)
{
 $igst_am=round((($amm*$igst_rt)/100),2);
}
$net_am=$amm+$sgst_am+$cgst_am+$igst_am;

$rate=$net_am/$qnt;
$stk_rate1=$ttl/$qnt;

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

if($unit=='sun'){$stock_in=$qnt*$smvlu;$rate1=$rate/$smvlu;$uval=$smvlu;$stk_rate=$stk_rate1/$smvlu;}
if($unit=='mun'){$stock_in=$qnt*$mdvlu;$rate1=$rate/$mdvlu;$uval=$mdvlu;$stk_rate=$stk_rate1/$smvlu;}
if($unit=='bun'){$stock_in=$qnt*$bgvlu;$rate1=$rate/$bgvlu;$uval=$bgvlu;$stk_rate=$stk_rate1/$smvlu;}

$query21 = "INSERT INTO ".$DBprefix."purchasedet_ret(sup,cat,scat,unit,uval,prsl,qty,mrp,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,amm,usl,total,disp,disa,ldis,ldisa,bcd,rate,eby,betno,dt,stk_rate,refno)
 VALUES ('$sup','$cat','$scat','$unit','$uval','$prsl','$qnt','$mrp','$ttl','$blnon','$fst','$tst','$cgst_rt','$sgst_rt','$igst_rt','$cgst_am','$sgst_am','$igst_am','$net_am','$amm','$usl','$total','$disp','$disa1','$ldis','$ldisa','$bcd','$rate1','$eby','$betno','$dt','$stk_rate','$blno')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 


//echo $query21; 
$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,unit,stout,nrtn,eby,dtm,stat,ret,refno,prbill,usl,uval,betno,rate,stk_rate)
 VALUES ('$prsl','$bcd','$dt','$unit','$stock_in','Purchase Return','$user_currently_loged','$dttm','1','$mrp','$blno','$blnon','$usl','$uval','$betno','$rate1','$stk_rate')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 


$result=mysqli_query($conn,"Update ".$DBprefix."purchasedet set rqty=('$qnt'+rqty) where sl='$tsl'") or die(mysqli_error($conn));
}
}


$query1 = "SELECT sum(ttl) as gttl,sum(net_am) as tamm FROM ".$DBprefix."purchasedet_ret where blno='$blnon'";
$result1 = mysqli_query($conn,$query1) or die(mysqli_error($conn));
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$tamm=$R1['tamm'];
}
if($gttl>0)
{
$query214 = "insert into main_purchase_ret (refno,blno,sid,amm,crdtp,edt,eby,pdts,inv,dt,lfr,lcd,bcd,vat,vatamm,sdis,tamm,fst,tst,gst,addr,tmm2,remk,sttl,cbnm,invdt)
select blno,'$blnon',sid,'$gttl',crdtp,'$d','$user_currently_loged','$dttm',inv,'$dt',lfr,lcd,bcd,vat,vatamm,sdis,'$tamm',fst,tst,gst,addr,'$tamm','','$tamm','',dt
from main_purchase where blno = '$blno'";
$result214 = mysqli_query($conn,$query214)or die (mysqli_error($conn)); 
}

/*
$query1 = "SELECT sum(amm) as gttl,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst FROM ".$DBprefix."purchasedet_ret where blno='$blnon'";
$result1 = mysqli_query($conn,$query1) or die(mysqli_error($conn));
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$cgst=$R1['cgst'];
$sgst=$R1['sgst'];
$igst=$R1['igst'];
}

if($tamm>0)
{
$query51="select * from ".$DBprefix."drcr order by sl desc limit 0,1";
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
$query21 = "INSERT INTO ".$DBprefix."drcr(vno,sbill,sid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES 
('$vcno','$blnon','$sup','$d','Purchase Return','$idt','$mdt','$crfno','12','-3','$gttl','$bcd55','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21) or die(mysqli_error($conn));
}

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
*/
 

$nw = new Numbers_Words();
$aiw=$nw->toWords($tamm);
?>
<script>
alert('Submit Successfully. Thank You...');
document.location="purchase_show.php";
</script>
<?
}
else
{
?>
<script>
alert('Please Check Quantity...');
document.location="purchase_gst_ret.php";
</script>
<?	
}
?>