<?php
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');

$custnm=$_REQUEST[custnm];
$blno=$_REQUEST[blno];
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$m=date('m', strtotime($dt));

$y=date('y', strtotime($dt));;
if($m>=4)
{
$yy="R-BSS".$y.($y+1);	
	
}
elseif($m<=3)
{
$yy="R-BSS".($y-1).$y;	
}
if($err=="")
{
	
$query51="select * from main_billdtls order by sl";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
	$vnos=$rows['retno'];
}
	$vid1=substr($vnos,9,5);
$count6=5;

while($count6>0){
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);

$retno=$yy.$vnoc;
$query5="select * from main_billdtls where retno='$retno'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);
}	
$data1= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$bcd=$row1['bcd'];
}	
$vat="";
$rprc=0;
$tpoint=0;
$query100 = "SELECT * FROM main_billdtls where blno='$blno'";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
	$vat1="";
	$car1="";
$tsl=$R100['sl'];
$fprc=$R100['fprc'];
$qnty=$_REQUEST[rqty.$tsl];
if($qnty>0)
{
$rprc=($fprc*$qnty)+$rprc;
}
}

$query51="select * from ".$DBprefix."drcr order by vno";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
	$vnos=$rows['vno'];
}
	$vid1=substr($vnos,2,7);
	
$count6=5;

while($count6>0){
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);

$vcno="SV".$vnoc;
$query5="select * from ".$DBprefix."drcr where vno='$vcno'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);

}

$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$retno','$custnm','$dt','Sale Return','-2','4','$rprc','$bcd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));


 $query100 = "SELECT * FROM main_billdtls where blno='$blno'";
   $result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$prsl=$R100['prsl'];
$tsl=$R100['sl'];
$prnm=$R100['prnm'];
$prc=$R100['prc'];
$pdis=$R100['pdis'];
$pvat=$R100['pvat'];
$fprc=$R100['fprc'];
$betno=$R100['betno'];
$sid=$R100['sid'];
$ttl=$R100['ttl'];
$point=$R100['point'];

$ret=$prc;
$qnty=$_REQUEST[rqty.$tsl];
$qnty1='-'.$qnty;
$ttl='-'.$qnty*$fprc;
$plttl=$point*$qnty;
if($qnty>0)
{
$tpoint=$plttl+$tpoint;
$plttl='-'.$plttl;
$query21 = "INSERT INTO ".$DBprefix."billdtls (prsl,prnm,qty,prc,ttl,blno,retno,fprc,rdt,pdis,point,plttl) VALUES ('$prsl','$prnm','$qnty1','$prc','$ttl','$blno','$retno','$fprc','$dt','$pdis','$point','$plttl')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 

$stout=$qnty;
$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,stin,nrtn,eby,dtm,stat,ret,refno,rbill,betno) VALUES ('$prsl','$bcd','$dt','$stout','Sale Return','$user_currently_loged','$dttm','1','$ret','$retno','$retno','$betno')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}
}
$tpoint='-'.$tpoint;
$qr1=mysqli_query($conn,"insert into main_cust_point(refno,dt,cid,point,edtm,eby,typ) values('$retno','$dt','$custnm','$tpoint','$dttm','$user_currently_loged','1')")or die(mysqli_error($conn));


$gttl1=$rprc;


$nw = new Numbers_Words();
$aiw=$nw->toWords($gttl1);

?>
<Script language="JavaScript">
document.location="billing_retns1.php?blno=<?echo $retno;?>";

</script>
<?
}
else
{
?>
<Script language="JavaScript">
alert('<? echo $err;?>');
document.location="sale_return.php";
</script>
<?
}
?>
