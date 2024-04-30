<?php
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$cdt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$sup=$_POST[sup];
$brncd=$_POST[brncd];
$inv=$_POST[inv];
$dt=$_POST[dt];
$lcd=$_POST[lcd];
$lfr=$_POST[lfr];
$tamm=$_POST[tamm];
$dldgr=$_POST[dldgr];
$mdt=$_POST[mdt];
$pamm=$_POST[pamm];
$crfno=$_POST[crfno];
$idt=$_POST[idt];
$cbnm=$_POST[cbnm];
$vat=$_POST[vat];
$sttl=$_POST[sttl];
$tdis=$_POST[tdis];
$fst=$_POST[fst];
$tst=$_POST[tst];
$addr=$_POST[addr];

$roff=$_POST[roff];
$adl=$_POST['adl'];
$adlv=$_POST['adlv'];
$tamm2=$_POST['tamm2'];
$remk=$_POST['remk'];
$typ=$_POST['typ'];
$blno=$_POST['blno'];


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
$size=filesize($_FILES['fileToUpload1']['tmp_name']);

if($size>700000)
{
 //$err="Please Check Upload File Size ...";    
}

$query1 = "SELECT sum(ttl) as gttl,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst,sum(net_am) as sttl FROM ".$DBprefix."ser_purchasedet_edt where blno='$blno'";
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
    $err="Please Add Some Service First..!";
}


if($err=="")
{
$m=date('m', strtotime($dt));

$y=date('y', strtotime($dt));;
if($m>=4)
{
$yy=$y."-".($y+1)."/";	
	
}
elseif($m<=3)
{
$yy=($y-1)."-".$y."/";	
}
	

$query51="select * from ".$DBprefix."drcr where sbill='$blno'";
$result51=mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
	$vcno=$rows['vno'];
}


if($blno!='')
{
$result2 = mysqli_query($conn,"DELETE FROM ".$DBprefix."drcr WHERE sbill='$blno'")or die(mysqli_error($conn));

$query2 = "DELETE FROM main_ser_purchasedet WHERE  blno='$blno'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));
}



$query1 = "SELECT sum(ttl) as gttl,sum(net_am) as damm FROM ".$DBprefix."ser_purchasedet_edt where blno='$blno'";
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
$damm=$damm+$adlv;
}
elseif($adl=="-")
{
$damm=$damm-$adlv;	
}


$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm)
 VALUES ('$vcno','$blno','$sup','$dt','Purchase','$typ','12','$damm','$brncd','$user_currently_loged','$dttm')";
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

if($pamm>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm)
 VALUES ('$vcno','$blno','$sup','$dt','Purchase Payment','$idt','$mdt','$crfno','12','$dldgr','$pamm','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}



$query211 = "UPDATE ".$DBprefix."ser_purchase  SET sid='$sup',amm='$gttl',paid='$pamm',crdtp='$mdt',edt='$cdt',eby='$user_currently_loged',pdts='$dttm',inv='$inv',dt='$dt',lfr='$lfr',lcd='$lcd',bcd='$brncd',vat='$vat',vatamm='$vat1',sdis='$tdis',tamm='$tamm',fst='$fst',tst='$tst',gst='1',addr='$addr',roff='$roff',adl='$adl',adlv='$adlv',tmm2='$tamm2',remk='$remk',sttl='$sttl',cbnm='$cbnm',typ='$typ' WHERE blno='$blno'"; 
$result211 = mysqli_query($conn,$query211)or die (mysqli_error($conn));

/* ----------File upload--------- */
$qqq=mysqli_query($conn,"select * from ".$DBprefix."ser_purchase where blno='$blno'");
while($r=mysqli_fetch_array($qqq))
{
	$bilsl=$r['sl'];
}
	
$dirnm="service_bill";
$path5="img/".$dirnm;
if (!file_exists($path5)) {
mkdir($path5);
}

$target_dir="img/";
$target_file = $target_dir . basename($_FILES["fileToUpload1"]["name"]);
$ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$path="img/".$dirnm."/".$bilsl.".".$ext;
if (file_exists($_FILES['fileToUpload1']['tmp_name'])) {
move_uploaded_file($_FILES['fileToUpload1']['tmp_name'], $path);
}
	
/* ---------------- */


$query100 = "SELECT * FROM ".$DBprefix."ser_purchasedet_edt where blno='$blno' order by sl";
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
$eby=$R100['eby'];
$betno=$R100['betno'];
$rate=$net_am/$qty;
$stk_rate1=$ttl/$qty;
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

if($unit=='sun'){$stock_in=$qty*$smvlu;$rate1=$rate/$smvlu;$uval=$smvlu;$stk_rate=$stk_rate1/$smvlu;}
if($unit=='mun'){$stock_in=$qty*$mdvlu;$rate1=$rate/$mdvlu;$uval=$mdvlu;$stk_rate=$stk_rate1/$smvlu;}
if($unit=='bun'){$stock_in=$qty*$bgvlu;$rate1=$rate/$bgvlu;$uval=$bgvlu;$stk_rate=$stk_rate1/$smvlu;}

$query21 = "INSERT INTO ".$DBprefix."ser_purchasedet(cat,scat,unit,uval,prsl,qty,mrp,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,amm,usl,total,disp,disa,ldis,ldisa,bcd,rate,eby,betno,dt,stk_rate)
 VALUES ('$cat','$scat','$unit','$uval','$prsl','$qty','$mrp','$ttl','$blno','$fst','$tst','$cgst_rt','$sgst_rt','$igst_rt','$cgst_am','$sgst_am','$igst_am','$net_am','$amm','$usl','$total','$disp','$disa','$ldis','$ldisa','$bcd','$rate1','$eby','$betno','$dt','$stk_rate')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 

}

$query2 = "DELETE FROM ".$DBprefix."ser_purchasedet_edt where blno='$blno'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));

?>
<Script language="JavaScript">
alert('Updated Successfully. Thank You...');
document.location="ser_purchase_show.php";
</script>
<?
}

else
{
    ?>
<Script language="JavaScript">
alert('<? echo $err;?>');
window.history.go(-1);
</script>
<?
}
?>
