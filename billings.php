<?php

$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$cdt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$custnm=$_POST[custnm];
$addr=$_POST[addr];
$mob=$_POST[mob];
$mail=$_POST[mail];
$brncd=$_POST[brncd];
$dt=$_POST[dt];
$dis=$_POST[dis];
$car=$_POST[car];
$vat=$_POST[vat];

$vatamm=$_POST[vatamm];
$tamm=$_POST[tamm];
$dldgr=$_POST[dldgr];
$mdt=$_POST[mdt];
$pamm=$_POST[pamm];
$crfno=$_POST[crfno];
$idt=$_POST[idt];
$cbnm=$_POST[cbnm];

                                                                                                                                         
$dt=date('Y-m-d', strtotime($dt));
if($idt=="")
{
	$idt="0000-00-00";
}
else
{
$idt=date('Y-m-d', strtotime($idt));
}

$err="";
if($custnm=="")
{
	$err="Please Enter Customer Name...";
}
$query1 = "SELECT sum(ttl) as gttl FROM ".$DBprefix."slt where eby='$user_currently_loged'";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$gttl1=$R1['gttl'];

}
if($gttl==0){
$err="Please Add Some Product First";
}

$m=date('m', strtotime($dt));

$y=date('y', strtotime($dt));;
if($m>=4)
{
$yy=$branch_als."/".$y."-".($y+1)."/";	
	
}
elseif($m<=3)
{
$yy=$branch_als."/".($y-1)."-".$y."/";	
}
if($err=="")
{
$yyy=$yy."%";
$query51="select * from ".$DBprefix."billing where blno like '$yyy' order by sl";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{
	$vnos=$rows['blno'];
}
	$vid1=substr($vnos,11,5);
$count6=5;

while($count6>0){
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);

$blno=$yy.$vnoc;
$query5="select * from ".$DBprefix."billing where blno='$blno'";
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);

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

$vatamm=0;
$amm="";

if($vat>0)
{
$vatamm=($gttl*$vat)/100;
}

$totamm=$pamm;
						
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','$custnm','$dt','Sale','4','-2','$gttl','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
if($car>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','$custnm','$dt','FREIGHT','4','8','$car','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($vatamm>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','$custnm','$dt','Vat','4','6','$vatamm','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($dis>0)
{
	$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','$custnm','$dt','Over All Discount','29','4','$dis','$brncd','$user_currently_loged','$dttm')";
	$result21 = mysqli_query($conn,$query21);
}

	if($pamm>0)
	{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','$custnm','$dt','Payment','$idt','$mdt','$crfno','$dldgr','4','$pamm','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
	}
$query211 = "INSERT INTO ".$DBprefix."billing (blno,cid,amm,paid,crdtp,cbnm,dt,edt,pdts,vat,vatamm,car,dis,bcd,eby,tpoint) VALUES ('$blno','$custnm','$gttl','$pamm','$mdt','$cbnm','$dt','$cdt','$dttm','$vat','$vatamm','$car','$dis','$brncd','$user_currently_loged','$tpoint')";
$result211 = mysqli_query($conn,$query211)or die(mysqli_error($conn)); 
$ppdis=0;
$query100 = "SELECT * FROM ".$DBprefix."slt where eby='$user_currently_loged' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$cat=$R100['cat'];
$scat=$R100['scat'];
$prsl=$R100['prsl'];
$unit=$R100['unit'];
$kg=$R100['kg'];
$grm=$R100['grm'];
$pcs=$R100['pcs'];
$prc=$R100['prc'];
$ttl=$R100['ttl'];
$ret=$prc;
$query21 = "INSERT INTO ".$DBprefix."billdtls (cat,scat,prsl,unit,kg,grm,pcs,prc,ttl,blno) VALUES ('$cat','$scat','$prsl','$unit','$kg','$grm','$pcs','$prc','$ttl','$blno')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
if($unit=='1')
{
$stout=($kg*1000)+$grm;
}
elseif($unit=='2' or $unit=='3')
{
$stout=$pcs;	
}

$query21 = "INSERT INTO ".$DBprefix."stock (unit,pcd,bcd,dt,stout,nrtn,eby,dtm,stat,ret,refno,sbill) VALUES ('$unit','$scat','$brncd','$dt','$stout','Sale','$user_currently_loged','$dttm','1','$ret','$blno','$blno')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}


$query2 = "DELETE FROM ".$DBprefix."slt WHERE eby='$user_currently_loged'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));



 $query1 = "SELECT sum(ttl) as gttl FROM ".$DBprefix."billdtls where blno='$blno'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
}
if($vat!="")
{
$vat1=($gttl*$vat)/100;
$gttl1=($gttl+$vat1+$car)-$dis;
}
else
{
	$gttl1=($gttl+$car)-$dis;
}

$nw = new Numbers_Words();
$aiw=$nw->toWords($gttl1);

?>
<html>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<head>

<style>
.bor{
	
border: 1px solid #000;
  
}
.css{
	border:1px solid #000;
	padding: 0px 0px;

	font-size:14px;
	
	color: #000000;
}
#line{
    border-bottom: 1px black solid;

    height:9px;        
   
}

</style>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="advancedtable.css" rel="stylesheet" type="text/css" />




</head>
<body >
 <center>						
							
<form method="post" action="centrys.php" name="form1"  id="form1">
<table border="0" width="677px">
<tr>
<td  align="center" colspan="2">
<font size="7"><b><?=$comp_nm;?></b></font>
<br>
<font size="4"><b><?=$comp_addr;?></b></font>
</td>
</tr>
<tr>
<td  align="right" style="padding-right:10px">
<font size="5"> <b><a href="billing.php" ><u>Back</u></a></b></font>
</td>
<td  align="left">
<font size="5"> <b><a href="bill_new.php?blno=<?=rawurlencode($blno);?>" target="_blank"><font color="red"><u>Print</u></font></a></b></font>
</td>
</tr>

<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> Bill No. : <?=$blno;?></b></font>
</td>

</tr>
<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> Total Amount : <?=number_format($gttl1,2);?></b></font>
</td>

</tr>
<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> In Word : <?=$aiw;?></b></font>
</td>

</tr>
</table>


 </form>      
    </center> 
</body>
</div>
</html>
<?
}
else
{
    ?>
<Script language="JavaScript">
alert('<? echo $err;?>');
document.location="billing.php";
</script>
<?
}
?>
