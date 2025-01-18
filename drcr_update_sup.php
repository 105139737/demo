<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
set_time_limit(0);
 $query111 = "SELECT * FROM main_purchase order by sl";
   $result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$blno=$R111['blno'];
$d=$R111['ddt'];
$vat=$R111['vat'];
$lfr=$R111['lfr'];
$pprc1=$R111['amm'];
$sid=$R111['sid'];



$amm="";
$query6="select * from  main_suppl where sid='$sid'";
								$result5 = mysqli_query($conn,$query6);
								while($row=mysqli_fetch_array($result5))
								{
								$ssl=$row['sl'];
								}
$vat1="";
$amm="";
 $query1 = "SELECT sum(ttl) as gttl,sum(ppt) as pprc1 FROM main_purchasedet where blno='$blno'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$pprc1=$R1['pprc1'];
}
if($vat!="")
{
$vat1=($gttl*$vat)/100;
}

$amm=$pprc1-$lfr;

  $vid1=0;
$count6=5;

while($count6>0){
$vid1=$vid1+1;
$vno=str_pad($vid1, 7, '0', STR_PAD_LEFT);

$vcno="SV".$vno;
$query5="select * from ".$DBprefix."drcr where vno='$vcno'";
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);

}


$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,cbill,sid,cid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','','$ssl','','$d','Purchase','$idt','$h','$crfno','-3','12','$amm','$branch_code','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21);
if($vat1>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,cbill,sid,cid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','','$ssl','','$d','Vat','$idt','$h','$crfno','10','12','$vat1','$branch_code','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21);
}
echo $blno." : ".$amm." : ".$vat1."<br>";
}
?>
