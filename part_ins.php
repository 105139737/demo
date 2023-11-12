<?php
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
date_default_timezone_set('Asia/Kolkata');

$edt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s');
$rmk=$_POST['rmk'];
$brncd=$_POST['branch'];
$dt=$_POST['dt'];


$sup=$_POST[sup];

$inv=$_POST[inv];

$lcd=$_POST[lcd];
$lfr=$_POST[lfr];
$vat=$_POST[vat];
$vatamm=$_POST[vatamm];
$tamm=$_POST[tamm];
$dldgr=$_POST[dldgr];
$mdt=$_POST[mdt];
$pamm=$_POST[pamm];
$crfno=$_POST[crfno];
$idt=$_POST['idt'];
$cbnm=$_POST[cbnm];


if($dt=="")
{
$err="Please Fill Up Fields...";
}


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



 $query100 = "SELECT * FROM main_partemp where eby='$user_currently_loged' order by sl";
   $result100 = mysqli_query($conn,$query100);
   $count = mysqli_num_rows($result100);
 if($count==0)
 {
		 $err="Please Add Product First...";
 
 }



  if($err=="")
  {
	$m=date('m');

$y=date('y');

if($m>=4)

{
$yy="PP".$y."".($y+1);	
}
elseif($m<=3)
{
$yy="PP".($y-1)."".$y;	
}  

$query51="select * from main_part_inout order by sl";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{
	$refno=$rows['refno'];
}
	$vid1=substr($vnos,12,8);
$count6=5;

while($count6>0){
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 8, '0', STR_PAD_LEFT);

$refno=$yy.$vnoc;
$query5="select * from main_part_inout where refno='$refno'";
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);
}

$relt= mysqli_query($conn,"SELECT sum(ttl)as alttl FROM main_partemp where eby='$user_currently_loged' order by sl");	
while ($ret = mysqli_fetch_array ($relt))
{
$alttl=$ret['alttl'];/*Total Amount  */
}

$vatamm=($alttl*$vat)/100;

$amm=$alttl-$lfr-$lcd;

$query21 = "INSERT INTO main_part_inout (refno,attl,dt,rmk,edt,edtm,eby,vat,vatamm,lfr,lcd,bcd,sid) VALUES ('$refno','$amm','$dt','$rmk','$edt','$edtm','$user_currently_loged','$vat','$vatamm','$lfr','$lcd','$brncd','$sup')";
$result21 = mysqli_query($conn,$query21);



$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$refno','$sup','$dt','Part Purchase','-4','12','$amm','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));

if($vatamm>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$refno','$sup','$dt','Part Purchase Vat','10','12','$vatamm','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}
if($pamm>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,sbill,sid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$refno','$sup','$dt','Part Purchase Payment','$idt','$mdt','$crfno','12','$dldgr','$pamm','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
}
	

while ($R100 = mysqli_fetch_array ($result100))
{
	
$tsl=$R100['sl'];
$pnm=$R100['pnm'];
$pcd=$R100['pcd'];
$qnty=$R100['qnty'];
$prate=$R100['prate'];
$ttl=$R100['ttl'];
$betno=$R100['betno'];
$iwa=$R100['iwa'];
$owa=$R100['owa'];
	
	
$result21 = mysqli_query($conn,"INSERT INTO main_partdtl (refno,pcd,pnm,qnty,prate,ttl,eby,edt,edtm,betno,iwa,owa) 
VALUES ('$refno','$pcd','$pnm','$qnty','$prate','$ttl','$user_currently_loged','$edt','$edtm','$betno','$iwa','$owa')")or die(mysqli_error($conn));

$query33 = "INSERT INTO main_pstock (pcd,bcd,dt,stin,nrtn,dtm,eby,refno,pbill,betno,iwa,owa)
VALUES ('$pcd','$brncd','$dt','$qnty','Stock In','$edtm','$user_currently_loged','$refno','$refno','$betno','$iwa','$owa')";
$result33 = mysqli_query($conn,$query33); 
 
}

$query2 = "DELETE FROM main_partemp WHERE eby='$user_currently_loged'";
$result2 = mysqli_query($conn,$query2);


?>

<Script language="JavaScript">

alert('Submitted Successfully...');

document.location="part_in.php";

</script>

<?



}
else
{
?>

<Script language="JavaScript">
alert('<?=$err;?>');
window.history.go(-1);
</script>
<?

}


?>

