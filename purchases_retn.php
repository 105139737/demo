<?php

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$a=$_REQUEST[custid];
$blno=$_REQUEST[blno];
$d=$_REQUEST[ddt];
if($d!="")
{
$d=date('Y-m-d', strtotime($d));
}
$err="";
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
if($err=="")
{
$vat="";
 $query111 = "SELECT * FROM ".$DBprefix."purchase where blno='$blno'";
   $result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$vat=$R111['vat'];
}


$result=mysqli_query($conn,"Update main_purchase set rdt='$d',rstat='1' where blno='$blno'")or die (mysqli_error($conn));

	$rprc=0;
	$vatt=0;
	$cart=0;
	$pprc1=0;
	$pprc2=0;

	
	 $query100 = "SELECT * FROM main_purchasedet where blno='$blno'";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
	$vat1="";
	$car1="";
$tsl=$R100['sl'];
$prc=$R100['prc'];
$pprc=$R100['prc'];
$qnty=$_REQUEST[rqty.$tsl];
if($qnty>0)
{
$rprc=$prc*$qnty;
$pprc1=$pprc*$qnty;
if($vat!="")
{
$vat1=($rprc*$vat)/100;

}

$vatt=$vat1+$vatt;

$pprc2=$rprc+$pprc2;
}
}
  
$query51="select * from ".$DBprefix."drcr order by vno";
$result51 = mysqli_query($conn,$query51);
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
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);

}
	$query6="select * from  main_suppl where sl='$a'";
								$result5 = mysqli_query($conn,$query6);
								while($row=mysqli_fetch_array($result5))
								{
								$ssl=$row['sl'];
								}
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','$ssl','$d','Purchase Return','$h','$crfno','12','-3','$pprc2','$branch_code','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));

//$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,cbill,sid,cid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','','$ssl','','$d','Vat','$idt','$h','$crfno','12','10','$vatt','$branch_code','$user_currently_loged','$dttm')";
//$result21 = mysqli_query($conn,$query21);




$log=0;
$qnty="";
 $query100 = "SELECT * FROM main_purchasedet where blno='$blno'";
   $result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$prsl=$R100['prsl'];
$prnm=$R100['prnm'];

$prc=$R100['prc'];
$ttl=$R100['ttl'];
$rmk=$R100['rmk'];
$unt=$R100['unt'];
$betno=$R100['betno'];
$expdt=$R100['expdt'];
$pprc=$R100['pprc'];
$ppt=$R100['ppt'];
$ret=$R100['prc'];

$qnty=$_REQUEST[rqty.$tsl];

if($qnty>0)
{
$rprc='-'.$prc*$qnty;
$pprc1='-'.$prc*$qnty;
}

	
$ret1=$ret;




	

$pstk=0;


$queryw1 = "SELECT * FROM ".$DBprefix."stock where pcd='$prsl'";
   $resultw1 = mysqli_query($conn,$queryw1);
while ($Rw1 = mysqli_fetch_array ($resultw1))
{
$stin=$Rw1['stin'];
$opst=$Rw1['opst'];
}

$stout=$qnty;	

$stout1='-'.$stout;
$clst=(($stin+$opst)+$stout);

if($qnty>0)
{
$query21 = "INSERT INTO ".$DBprefix."purchasedet (prsl,pnm,qty,prc,ttl,blno,rmk,rdt)
 VALUES ('$prsl','$prnm','$stout1','$ret1','$rprc','$blno','Purchase Return','$d')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 

$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,stout,nrtn,eby,dtm,lef,stat,ret,clst,pret,refno,prbill)
 VALUES ('$prsl','$branch_code','$d','$stout','Purchase Return','$user_currently_loged','$dttm','$clst','1','$ret1','$clst','$pprc','$blno','$blno')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}
}




?>
<Script language="JavaScript">
alert('Submit Successfully. Thank You...<?=$inv;?>');
document.location="retn_purchase.php";
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
