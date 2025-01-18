<?php 

$reqlevel = 1;
include("membersonly.inc.php");
//include("Numbers/Words.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$cdt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$custnm=$_POST['custnm']??"";
$addr=$_POST['addr']??"";
$mob=$_POST['mob']??"";
$mail=$_POST['mail']??"";
$brncd=$_POST['brncd']??"";
$dt=$_POST['dt']??"";
$dis=$_POST['dis']??"";
$car=$_POST['car']??"";
$vat=$_POST['vat']??"";
$vatamm=$_POST['vatamm']??"";
$tamm=$_POST['tamm']??"";
$gstam=$_POST['gst']??"";
$payam=$_POST['pay']??"";
$dldgr=$_POST['dldgr']??"";
$mdt=$_POST['mdt']??"";
$pamm=$_POST['pamm']??"";
$crfno=$_POST['crfno']??"";
$idt=$_POST['idt']??"";
$cbnm=$_POST['cbnm']??"";
$fst=$_POST['fst']??"";
$tst=$_POST['tst']??"";
$tmod=$_POST['tmod']??"";
$psup=$_POST['psup']??"";
$vno=$_POST['vno']??"";
$lpd=$_POST['lpd']??"";

$dur_mnth=$_POST['dur_mnth']??"";
$no_servc=$_POST['no_servc']??"";
$sfno=$_POST['sfno']??"";
$dpay=$_POST['dpay']??"";
$finam=$_POST['finam']??"";
$emiam=$_POST['emiam']??"";
$emi_mnth=$_POST['emi_mnth']??"";

$cust_typ=$_POST['cust_typ']??"";
$sale_per=$_POST['sale_per']??"";
$bill_typ=$_POST['bill_typ']??"";
$invto=$_POST['invto']??"";
$invno=$_POST['invno']??"";
$invdt=$_POST['invdt']??"";
$invdt=date('Y-m-d',strtotime($invdt));
                                                                                                                                         
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
	$err="Please Enter Ledger Name...";
}
if($bill_typ=="")
{
$err="Please Select Bill Type...";
}

$query1 = "SELECT sum(tamm) as gttl,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst FROM ".$DBprefix."old_ret_slt where eby='$user_currently_loged'";
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
if($count_row==0)
{
$err="Please Add Some Product First";
}
$get=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$als=$row['als'];
$tp=$row['tp'];
$adrs=$row['adrs'];
$ssn=$row['ssn'];
$start_no=$row['start_no'];
}

if($err=="")
{
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
$blno=$als.$vnoc.$ssn;
$query5="select * from ".$DBprefix."billing_ret where blno='$blno'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);
$bill_no=$vnoc;
}
   
   
$query51="select * from ".$DBprefix."drcr where vno!='' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['vno'];
}	
$vid1=substr($vnos,2,7);
	$vid1=$vid1+1;
	$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
	$vcno="SV".$vnoc;
/*	
$count6=5;
while($count6>0)
{
	$vid1=$vid1+1;
	$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
	$vcno="SV".$vnoc;
	$query5="select * from ".$DBprefix."drcr where vno='$vcno'";
	$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
	$count6=mysqli_num_rows($result5);
}
*/

$totamm=$pamm;
$bilamm=$gttl+$cgst+$sgst+$igst;
$rgttl=round($bilamm);
$roff=round($rgttl-$bilamm,2);
	

	
$que45 = "SELECT * FROM main_cust where sl='$custnm'";
$resu45 = mysqli_query($conn,$que45) or die(mysqli_error($conn));
while ($R145 = mysqli_fetch_array ($resu45))
{
$cugst=$R145['gstin'];
}



$tpoint=0;

$query211 = "INSERT INTO ".$DBprefix."billing_ret (blno,cid,amm,paid,crdtp,cbnm,dt,edt,pdts,vat,vatamm,car,dis,bcd,eby,tpoint,fst,tst,gst,tmod,psup,vno,lpd,gstin,dur_mnth,no_servc,sfno,dpay,finam,emiam,emi_mnth,tamm,gstam,roff,payam,crfno,cust_typ,sale_per,bill_typ,als,tp,adrs,ssn,start_no,invto,dldgr,refno,typ,invdt,bill_no) 
VALUES ('$blno','$custnm','$bilamm','$pamm','$mdt','$cbnm','$dt','$cdt','$dttm','$vat','$vatamm','$car','$dis','$brncd','$user_currently_loged','$tpoint','$fst','$tst','1','$tmod','$psup','$vno','$lpd','$cugst','$dur_mnth','$no_servc','$sfno','$dpay','$finam','$emiam','$emi_mnth','$gttl','$gstam','$roff','$payam','$crfno','$cust_typ','$sale_per','$bill_typ','$als','$tp','$adrs','$ssn','$start_no','$invto','$dldgr','$invno','1','$invdt','$bill_no')";
$result211 = mysqli_query($conn,$query211)or die(mysqli_error($conn)); 
	
$gttl=$gttl+$roff;	

$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,retn_stat,sman) VALUES 
('$vcno','$blno','$custnm','$dt','Credit-Note OLD','-4','5','$gttl','$brncd','$user_currently_loged','$dttm','1','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));

/*

$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES ('$vcno','$blno','$custnm','$dt','Sale Return','-2','4','$gttl','$brncd','$user_currently_loged','$dttm','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
*/
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


/*
if($roff!="")
{
if($roff<0)
{
$roff=($roff*(-1));
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','$custnm','$dt','Round Off','$idt','$mdt','$crfno','40','4','$roff','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	
}
else
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$vcno','$blno','$custnm','$dt','Round Off','$idt','$mdt','$crfno','4','40','$roff','$brncd','$user_currently_loged','$dttm')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	
}
}

if($pamm>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm,typ,pay) VALUES ('$vcno','$blno','$custnm','$dt','Payment','$idt','$mdt','$crfno','4','$dldgr','$pamm','$brncd','$user_currently_loged','$dttm','77','1')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
*/



$ppdis=0;
$query100 = "SELECT * FROM ".$DBprefix."old_ret_slt where eby='$user_currently_loged' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
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


if($unit=='sun'){$stout=$pcs*$smvlu;$rate1=$rate/$smvlu;$uval=$smvlu;$stk_rate=$stk_rate1/$smvlu;}
if($unit=='mun'){$stout=$pcs*$mdvlu;$rate1=$rate/$mdvlu;$uval=$mdvlu;$stk_rate=$stk_rate1/$mdvlu;}
if($unit=='bun'){$stout=$pcs*$bgvlu;$rate1=$rate/$bgvlu;$uval=$bgvlu;$stk_rate=$stk_rate1/$bgvlu;}
$kg="";
$grm="";
$srt="";
$adp="";
$query21 = "INSERT INTO ".$DBprefix."billdtls_ret (cat,scat,prsl,imei,unit,kg,grm,pcs,srt,adp,prc,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,refno,usl,uval,total,disp,disa,dt,betno,bcd,rate,tamm,bill_typ,stk_rate,cust) 
VALUES ('$cat','$scat','$prsl','$imei','$unit','$kg','$grm','$pcs','$srt','$adp','$prc','$ttl','$blno','$fst','$tst','$cgst_rt','$sgst_rt','$igst_rt','$cgst_am','$sgst_am','$igst_am','$net_am','$refno','$usl','$uval','$total','$disp','$disa','$dt','$betno','$bcd','$rate1','$tamm','$bill_typ','$stk_rate','$custnm')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
	
$query21 = "INSERT INTO ".$DBprefix."stock (unit,pcd,bcd,dt,stin,nrtn,eby,dtm,stat,ret,refno,rbill,usl,uval,betno,rate,stk_rate) VALUES 
('$unit','$prsl','$brncd','$dt','$stout','Old Sale Return','$user_currently_loged','$dttm','1','$ret','$refno','$blno','$usl','$uval','$betno','$rate1','$stk_rate')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
}


$query2 = "DELETE FROM ".$DBprefix."old_ret_slt WHERE eby='$user_currently_loged'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));

$query1 = "SELECT sum(net_am) as gttl FROM ".$DBprefix."billdtls_ret where blno='$blno'";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
}



?>
<html>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
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
<font size="7"><b><?php  echo $comp_nm;?></b></font>
<br>
<font size="4"><b><?php  echo $comp_addr;?></b></font>
</td>
</tr>
<tr>
<td  align="right" style="padding-right:10px">
<font size="5"> <b><a href="old_bill_typ.php" ><u>Back</u></a></b></font>
</td>
<td  align="left">
<font size="5"> <b><a href="bill_new_gst_ret.php?blno=<?php echo rawurlencode($blno);?>" target="_blank"><font color="red"><u>Print</u></font></a></b></font>
</td>
</tr>

<tr>
<td  align="center" colspan="2" >
<font size="4" color="red"> <b> Bill No. : <?php  echo $blno;?></b></font>
</td>

</tr>
</table>


 </form>      
    </center> 
</body>
</div>
</html>
<?php 
}
else
{
    ?>
<Script language="JavaScript">
alert('<?php  echo $err;?>');
//document.location="billing_ret_old-gst.php";
</script>
<?php 
}
?>
