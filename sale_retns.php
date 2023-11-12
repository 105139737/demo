<?php
$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");

include "header.php";
date_default_timezone_set('Asia/Kolkata');
$blno=$_POST['blno'];
$brncd=$_POST['brncd'];
$ddt=$_POST['dt'];
$bill_typsl=$_POST['bill_typ'];
$chk=$_POST['chk'];
if($chk==0)
{
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');

$get=mysqli_query($conn,"select * from main_billtype where sl='$bill_typsl'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$als=$row['als'];
$tp=$row['tp'];
$adrs=$row['adrs'];
$ssn=$row['ssn'];
$start_no=$row['start_no'];
}


$count6=5;
$query51="select * from ".$DBprefix."billing_ret where als='$als' and ssn='$ssn' and typ='1' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
$vnos=$rows['blno'];
}
$bill=explode($als,$vnos);
$bill1=explode($ssn,$bill[1]);
$vnos=$bill1[1];
if($start_no>$vnos)
{
$vnos=$start_no;
}
$vid1=$vnos;

while($count6>0){
$vid1=$vid1+1;
//$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);
$vnoc=$vid1;
$blnon=$als.$vnoc.$ssn;
$bill_no=$vnoc;
$query5="select * from ".$DBprefix."billing_ret where blno='$blnon'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);

}




$data1= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$sid=$row1['cid'];
$bcdd=$row1['bcd'];
$sale_per=$row1['sale_per'];
}


$query100 = "SELECT * FROM main_billdtls where blno='$blno' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$cat=$R100['cat'];
$scat=$R100['scat'];
$prsl=$R100['prsl'];
$unit=$R100['unit'];
$pcs=$R100['pcs'];
$prc=$R100['prc'];
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
$refno=$R100['refno'];
$usl=$R100['usl'];
$imei=$R100['imei'];
$total=$R100['total'];
$disp=$R100['disp'];
$disa=$R100['disa'];
$bcd=$R100['bcd'];
$betno=$R100['betno'];
$rate=$R100['rate'];
$tamm=$R100['tamm'];
$bill_typ=$R100['bill_typ'];
$cust=$R100['cust'];
$ret=$prc;
$rate=$net_am/$pcs;
$stk_rate1=$tamm/$pcs;
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




$qt=$_POST['q'.$tsl];

if($qt>0)
{
$total=round($qt*$prc,2);
if($disp>0)
{
$disa=round(($total*$disp)/100,2);	
}
$lttl=$total-$disa;
$amm=$lttl;
if($fst==$tst)
	{
		if($cgst_rt>0 and $sgst_rt>0)
		{
		$Tcgst_am=round((($cgst_rt+$sgst_rt)*$amm)/(100+$cgst_rt+$cgst_rt),4);
		$sgst_am=round($Tcgst_am/2,4);
		$cgst_am=round($Tcgst_am/2,4);
		$igst_am=0;
		$igst_rt=0;
		}
	}
	else
	{
if($sgst_rt>0){/*$sgst_am=round(($sgst_rt*$amm)/(100+$cgst_rt),2);*/}
if($igst_rt>0){$igst_am=round(($igst_rt*$amm)/(100+$igst_rt),4);}
	$sgst_rt=0;
	$cgst_rt=0;
	$sgst_am=0;
	$cgst_am=0;
	}
$net_am=$amm;
$tamm=$amm-($cgst_am+$sgst_am+$igst_am);


	
$result=mysqli_query($conn,"Update main_billdtls set rqty=('$qt'+rqty) where sl='$tsl'");

if($unit=='sun'){$stout=$qt*$smvlu;$rate1=$rate/$smvlu;$uval=$smvlu;$stk_rate=$stk_rate1/$smvlu;}
if($unit=='mun'){$stout=$qt*$mdvlu;$rate1=$rate/$mdvlu;$uval=$mdvlu;$stk_rate=$stk_rate1/$mdvlu;}
if($unit=='bun'){$stout=$qt*$bgvlu;$rate1=$rate/$bgvlu;$uval=$bgvlu;$stk_rate=$stk_rate1/$bgvlu;}




$query21 = "INSERT INTO ".$DBprefix."billdtls_ret (cat,scat,prsl,imei,unit,kg,grm,pcs,srt,adp,prc,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,refno,usl,uval,total,disp,disa,dt,betno,bcd,rate,tamm,bill_typ,stk_rate,cust,eby) 
VALUES ('$cat','$scat','$prsl','$imei','$unit','$kg','$grm','$qt','$srt','$adp','$prc','$lttl','$blnon','$fst','$tst','$cgst_rt','$sgst_rt','$igst_rt','$cgst_am','$sgst_am','$igst_am','$net_am','$refno','$usl','$uval','$total','$disp','$disa','$dt','$betno','$bcd','$rate1','$tamm','$bill_typ','$stk_rate','$cust','$$user_currently_loged')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 

$query211 = "INSERT INTO ".$DBprefix."stock (unit,pcd,bcd,dt,stin,nrtn,eby,dtm,stat,ret,refno,rbill,usl,uval,betno,rate,stk_rate) VALUES 
('$unit','$prsl','$bcd','$dt','$stout','Sale Return','$user_currently_loged','$dttm','1','$ret','$refno','$blnon','$usl','$uval','$betno','$rate1','$stk_rate')";
$result211 = mysqli_query($conn,$query211)or die (mysqli_error($conn)); 

}
}


$query1 = "SELECT sum(tamm) as gttl,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst FROM ".$DBprefix."billdtls_ret where blno='$blnon'";
$result1 = mysqli_query($conn,$query1);
$count_row = mysqli_num_rows($result1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$gttl1=$R1['gttl'];
$cgst=$R1['cgst'];
$sgst=$R1['sgst'];
$igst=$R1['igst'];
}
$gstam=$cgst+$sgst+$igst;
$bilamm=$gttl+$cgst+$sgst+$igst;
$rgttl=round($bilamm);
$roff=round($rgttl-$bilamm,2);
$query214 = "insert into main_billing_ret (refno,blno,cid,amm,paid,crdtp,cbnm,dt,edt,pdts,vat,vatamm,car,dis,bcd,eby,tpoint,fst,tst,gst,tmod,psup,vno,lpd,gstin,dur_mnth,no_servc,sfno,dpay,finam,emiam,emi_mnth,tamm,gstam,roff,payam,crfno,cust_typ,sale_per,bill_typ,als,tp,adrs,ssn,start_no,invto,invdt,bill_no)
select blno,'$blnon',cid,'$bilamm','','','','$dt','$dt','$dttm',vat,vatamm,car,dis,bcd,eby,tpoint,fst,tst,gst,tmod,psup,vno,lpd,gstin,dur_mnth,no_servc,sfno,dpay,finam,emiam,emi_mnth,'$gttl','$gstam','$roff','$bilamm',crfno,cust_typ,sale_per,'$bill_typsl',als,tp,adrs,ssn,start_no,invto,dt,'$bill_no'
from main_billing where blno = '$blno'";
$result214 = mysqli_query($conn,$query214)or die (mysqli_error($conn)); 

$gttl=$gttl+$roff;	

$query51="select * from ".$DBprefix."drcr where vno!='' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['vno'];
}	
$vid1=substr($vnos,2,7);	
$count6=5;
	$vid1=$vid1+1;
	$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
	$vcno="SV".$vnoc;

$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,retn_stat,sman) VALUES 
('$vcno','$blnon','$sid','$dt','Credit-Note','-4','5','$gttl','$brncd','$user_currently_loged','$dttm','1','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));

if($cgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,retn_stat,sman) VALUES 
('$vcno','$blnon','$sid','$dt','C-GST','37','5','$cgst','$brncd','$user_currently_loged','$dttm','1','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($sgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,retn_stat,sman) VALUES 
('$vcno','$blnon','$sid','$dt','S-GST','38','5','$sgst','$brncd','$user_currently_loged','$dttm','1','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($igst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,retn_stat,sman) VALUES 
('$vcno','$blnon','$sid','$dt','I-GST','39','5','$igst','$brncd','$user_currently_loged','$dttm','1','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}

$nw = new Numbers_Words();
$aiw=$nw->toWords($rgttl);
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
<table border="1" width="677px">
<tr>
<td  align="right" style="padding-right:10px">
<font size="5"> <b><a href="sale_show.php" ><u>Back</u></a></b></font>
</td>
<td  align="center">
<font size="5"> <b><a href="bill_new_gst_ret.php?blno=<?=rawurlencode($blnon);?>" target="_blank"><font color="red"><u>Print</u></font></a></b></font>
</td>

</tr>

<tr>
<td  align="center" colspan="3" >
<font size="4" color="red"> <b> Return  No. : <?=$blnon;?></b></font>
</td>

</tr>
<tr>
<td  align="center" colspan="3" >
<font size="4" color="red"> <b> Total Amount : <?=number_format($rgttl,2);?></b></font>
</td>

</tr>
<tr>
<td  align="center" colspan="3" >
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
<script>
alert('Please Check Quantity...');
document.location="billing_gst_ret.php";
</script>
<?	
}
?>
