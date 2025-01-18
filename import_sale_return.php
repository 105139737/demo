<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cdt=date('Y-m-d');
$dttm=date('Y-m-d h:i:s a');
set_time_limit(0);


$data1= mysqli_query($conn,"select * from  main_billing_ret where sl>0 order by sl ")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$blno=$row1['blno'];
$dt=$row1['dt'];
$custnm=$row1['cid'];
$brncd=$row1['brncd'];
$sale_per=$row1['sale_per'];

$gttl=0;
$gttl1=0;
$cgst=0;
$sgst=0;
$igst=0;

$query1 = "SELECT sum(tamm) as gttl,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst FROM main_billdtls_ret where blno='$blno'";
$result1 = mysqli_query($conn,$query1)or die(mysqli_error($conn));
$count_row = mysqli_num_rows($result1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$gttl1=$R1['gttl'];
$cgst=$R1['cgst'];
$sgst=$R1['sgst'];
$igst=$R1['igst'];
}
$bilamm=$gttl+$cgst+$sgst+$igst;
$rgttl=round($bilamm);
$roff=round($rgttl-$bilamm,2);

$gttl=$gttl+$roff;	

$query51="select * from ".$DBprefix."drcr where cbill='$blno' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
$vcno=$rows['vcno'];
}

if($blno!='')
{
$result2 = mysqli_query($conn,"DELETE FROM ".$DBprefix."drcr WHERE cbill='$blno' and dldgr='-2' and cldgr='5' and retn_stat='1'")or die(mysqli_error($conn));
}


echo $query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,retn_stat,sman) VALUES 
('$vcno','$blno','$custnm','$dt','Credit-Note OLD','-4','5','$gttl','$brncd','$user_currently_loged','$dttm','1','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));

if($cgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman,retn_stat) VALUES 
('$vcno','$blno','$custnm','$dt','C-GST Return','37','5','$cgst','$brncd','$user_currently_loged','$dttm','1','$sale_per','1')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($sgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman,retn_stat) VALUES 
('$vcno','$blno','$custnm','$dt','S-GST Return','38','5','$sgst','$brncd','$user_currently_loged','$dttm','1','$sale_per','1')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($igst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman,retn_stat) VALUES 
('$vcno','$blno','$custnm','$dt','I-GST Return','39','5','$igst','$brncd','$user_currently_loged','$dttm','1','$sale_per','1')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
echo "<br>";
}

	
	
	

