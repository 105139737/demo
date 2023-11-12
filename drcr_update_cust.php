<?php
$reqlevel = 1;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
set_time_limit(0);
 $query111 = "SELECT * FROM ".$DBprefix."billing order by sl";
   $result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$blno=$R111['blno'];
$d=$R111['edt'];
$cnm=$R111['cnm'];
$caddr=$R111['caddr'];
$cnt=$R111['cnt'];
$vat=$R111['vat'];
$car=$R111['car'];
$dis=$R111['dis'];
$fid=$R111['fid'];
$gttl=$R111['amm'];
$sid=$R111['cid'];


$query6="select * from  main_suppl where sid='$sid'";
								$result5 = mysqli_query($conn,$query6);
								while($row=mysqli_fetch_array($result5))
								{
								$ssl=$row['sl'];
								}
if($vat!="")
{
$vat1=($gttl*$vat)/100;
}

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

$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,cbill,sid,cid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm,pno) VALUES ('$vcno','','$blno','','$ssl','$d','Sale','$idt','$h','$crfno','4','-2','$gttl','$branch_code','$user_currently_loged','$dttm','$cc')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
if($car>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,cbill,sid,cid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','','$blno','','$ssl','$d','FREIGHT','$idt','$h','$crfno','4','8','$car','$branch_code','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21);
}
if($vat1>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,cbill,sid,cid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','','$blno','','$ssl','$d','Vat','$idt','$h','$crfno','4','6','$vat1','$branch_code','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21);
}
echo $blno." : ".$gttl." : ".$gttl1."<br>";
}
?>
