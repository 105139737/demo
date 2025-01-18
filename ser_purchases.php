<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$cdt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$sup=$_POST['sup'] ?? "";
$brncd=$_POST['brncd'] ?? "";
$inv=$_POST['inv'] ?? "";
$dt=$_POST['dt'] ?? 0;
$lcd=$_POST['lcd'] ?? "";
$lfr=$_POST['lfr'] ?? "";
$tamm=$_POST['tamm'] ?? 0;
$dldgr=$_POST['dldgr'] ?? "";
$mdt=$_POST['mdt'] ?? "";
$pamm=$_POST['pamm'] ?? "";
$crfno=$_POST['crfno'] ?? 0;
$idt=$_POST['idt'] ?? "";
$cbnm=$_POST['cbnm'] ?? "";
$vat=$_POST['vat'] ?? 0;
$sttl=$_POST['sttl'] ?? "";
$tdis=$_POST['tdis'] ?? "";
$fst=$_POST['fst'] ?? "";
$tst=$_POST['tst'] ?? "";
$addr=$_POST['addr'] ?? "";

$roff=$_POST['roff'] ?? "";
$adl=$_POST['adl'] ?? "";
$adlv=$_POST['adlv'] ?? 0;
$tamm2=$_POST['tamm2'] ?? 0;
$remk=$_POST['remk'] ?? "";
$typ=$_POST['typ'] ?? "";
$vat1="";
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

 $query1 = "SELECT sum(ttl) as gttl,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst,sum(net_am) as sttl FROM ".$DBprefix."ser_ptemp where eby='$user_currently_loged'";
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
	
    $vid=0;
$count5=1;
$query51="select * from ".$DBprefix."ser_purchase order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['blno'];
}	
$vid=substr($vnos,9,6);		

while($count5>0){
$vid=$vid+1;
$vno=str_pad($vid, 6, '0', STR_PAD_LEFT);

$blno=$yy.'-SP'.$vno;
$query5="select * from ".$DBprefix."ser_purchase where blno='$blno'";
$result5 = mysqli_query($conn,$query5);
$count5=mysqli_num_rows($result5);
}
  
$query51="select * from ".$DBprefix."drcr where vno!=''  order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['vno'];
}	
$vid1=substr($vnos,2,7);	
$count6=5;
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
$vcno="SV".$vnoc;

$query1 = "SELECT sum(ttl) as gttl,sum(net_am) as damm FROM ".$DBprefix."ser_ptemp where eby='$user_currently_loged'";
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
$damm=(float)$damm+(float)$adlv;
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

$query211 = "INSERT INTO ".$DBprefix."ser_purchase (blno,sid,amm,paid,crdtp,edt,eby,pdts,inv,dt,lfr,lcd,bcd,vat,vatamm,sdis,tamm,fst,tst,gst,addr,roff,adl,adlv,tmm2,remk,sttl,cbnm,typ) 
VALUES ('$blno','$sup','$gttl','$pamm','$mdt','$cdt','$user_currently_loged','$dttm','$inv','$dt','$lfr','$lcd','$brncd','$vat','$vat1','$tdis','$tamm','$fst','$tst','1','$addr','$roff','$adl','$adlv','$tamm2','$remk','$sttl','$cbnm','$typ')";
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


$query100 = "SELECT * FROM ".$DBprefix."ser_ptemp where eby='$user_currently_loged' order by sl";
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

$query2 = "DELETE FROM ".$DBprefix."ser_ptemp WHERE eby='$user_currently_loged'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));

?>
<Script language="JavaScript">
alert('Submit Successfully. Thank You...');
document.location="ser_purchase.php";
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
