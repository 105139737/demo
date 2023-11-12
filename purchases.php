<?php

/**
 * @author Onnet Solution
 * @copyright 2013
 */

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
$sdis=$_POST[sdis];

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


 $query1 = "SELECT sum(ttl) as gttl FROM ".$DBprefix."ptemp where eby='$user_currently_loged'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$gttl1=$R1['gttl'];
}

if($gttl==0)
{
    $err="Please Add Some Product First";
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

while($count5>0){
$vid=$vid+1;
$vno=str_pad($vid, 6, '0', STR_PAD_LEFT);

$blno=$yy.'-P'.$vno;
$query5="select * from ".$DBprefix."purchase where blno='$blno'";
$result5 = mysqli_query($conn,$query5);
$count5=mysqli_num_rows($result5);
}
  
$query51="select * from ".$DBprefix."drcr order by vno";
$result51 = mysqli_query($conn,$query51);
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
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);
}

 $query1 = "SELECT sum(ttl) as gttl FROM ".$DBprefix."ptemp where eby='$user_currently_loged'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
}
$vat1=($gttl*$vat)/100;
$amm=$gttl-$lfr-$lcd;


$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','$sup','$dt','Purchase','-3','12','$tamm','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));

if($vat1>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','$sup','$dt','Vat','10','12','$vat1','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}
if($pamm>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','$sup','$dt','Purchase Payment','$idt','$mdt','$crfno','12','$dldgr','$pamm','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}

 $query211 = "INSERT INTO ".$DBprefix."purchase (blno,sid,amm,paid,crdtp,edt,eby,pdts,inv,dt,lfr,lcd,bcd,vat,vatamm,sdis,tamm) VALUES ('$blno','$sup','$gttl','$pamm','$mdt','$cdt','$user_currently_loged','$dttm','$inv','$dt','$lfr','$lcd','$brncd','$vat','$vat1','$sdis','$tamm')";
$result211 = mysqli_query($conn,$query211)or die (mysqli_error($conn));

 $query100 = "SELECT * FROM ".$DBprefix."ptemp where eby='$user_currently_loged' order by sl";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$cat=$R100['cat'];
$scat=$R100['scat'];
$unit=$R100['unit'];
$pck=$R100['pck'];
$prsl=$R100['prsl'];
$qty=$R100['qty'];
$mrp=$R100['mrp'];
$ttl=$R100['ttl'];
$query21 = "INSERT INTO ".$DBprefix."purchasedet(cat,scat,unit,pck,prsl,qty,mrp,ttl,blno) VALUES ('$cat','$scat','$unit','$pck','$prsl','$qty','$mrp','$ttl','$blno')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
if($unit=='1'){$stock_in=$qty*1000;}
if($unit=='2'){$stock_in=$pck*$qty;}
if($unit=='3'){$stock_in=$qty;}
$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,unit,stin,nrtn,eby,dtm,stat,ret,refno,pbill) VALUES ('$scat','$brncd','$dt','$unit','$stock_in','Purchase','$user_currently_loged','$dttm','1','$mrp','$blno','$blno')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}


$query2 = "DELETE FROM ".$DBprefix."ptemp WHERE eby='$user_currently_loged'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));

?>
<Script language="JavaScript">
alert('Submit Successfully. Thank You...');
document.location="purchase.php";
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
