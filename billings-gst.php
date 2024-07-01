<?php
//jafar 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$cdt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
$custnm=$_POST[custnm];
$addr=$_POST[addr];
$mob=$_POST[mob];
$mail=$_POST['mail'];
$brncd=$_POST[brncd];
$dt=$_POST[dt];
$dis=$_POST[dis];
$car=$_POST[car];
$vat=$_POST[dealId];
$vatamm=$_POST[vatamm];
$tamm=$_POST[tamm];
$gstam=$_POST[gst];
$payam=$_POST[pay];
$dldgr=$_POST[dldgr];
$mdt=$_POST[mdt];
$pamm=$_POST[pamm];
$crfno=$_POST[crfno];
$idt=$_POST[idt];
$cbnm=$_POST[cbnm];
$fst=$_POST[fst];
$tst=$_POST[tst];
$tmod=$_POST[tmod];
$psup=$_POST[psup];
$vno=$_POST[vno];
$lpd=$_POST[lpd];

$dur_mnth=$_POST[dur_mnth];
$no_servc=$_POST[no_servc];
$sfno=$_POST[sfno];
$dpay=$_POST[dpay];
$finam=$_POST[finam];
$emiam=$_POST[emiam];
$emi_mnth=$_POST[emi_mnth];

$cust_typ=$_POST[cust_typ];
$sale_per=$_POST[sale_per];
$bill_typ=$_POST[bill_typ];
$invto=$_POST[invto];
$order_no=$_POST[order_no];

$disl=$_POST[disl];
$remk=$_POST[remk];
$damm=$_POST[damm];
$reference=$_POST['reference'];
$mr=$_POST['mr'];
$tcs=$_POST['tcs'];
$tcsam=$_POST['tcsam'];
$ship_addr=$_POST['ship_addr'];
$ship_mob=$_POST['ship_mob'];
set_time_limit(0);                                                                                                                                        
$dt=date('Y-m-d', strtotime($dt));
$val=date_chk($dt);
	if($val==0)
	{
		die('<b><center><font color="red" size="5">Please Check Your Input Date. <a href="billing-gst.php?bsl='.$bill_typ.'&blno='.$order_no.'">Please Go Back Previous Page....</a></font></center></b>');
	}
$edit_count=get_permission($dt,$bill_ent);	
	if($edit_count==0)
	{
		die('<b><center><font color="red" size="5">Please Check Your Input Date. Contact Administrator <a href="billing-gst.php?bsl='.$bill_typ.'&blno='.$order_no.'">Please Go Back Previous Page....</a></font></center></b>');
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
if($custnm=="")
{
	$err="Please Enter Ledger Name...";
}
if($bill_typ=="")
{
$err="Please Select Bill Type...";
}
if($damm>0)
{
if($disl=="")
{
$err="Please Select Discount Ledger...";
}	
}

if(strtoupper($user_currently_loged)=='ADMIN'  OR strtoupper($user_currently_loged)=='CHANDAN' OR strtoupper($user_currently_loged)=='RIYA')
{
}
else if($cust_typ==2)
{

$que45o = "SELECT * FROM main_cust where sl='$custnm'";
$resu45o = mysqli_query($conn,$que45o) or die(mysqli_error($conn));
while ($R145o = mysqli_fetch_array ($resu45o))
{
$cust_cont=$R145o['cont'];
}
$cust_over1="";
$que45o = "SELECT * FROM main_cust where cont='$cust_cont' and (brand='1' or brand='2' or brand='4' or brand='15' or brand='13' or brand='5' or brand='18' or brand='61')"; //cont='$cust_cont' sl='$custnm' LG, PANA, HAIER, CARRIER, BS, HITACHI, GODREJ,LLOYD
$resu45o = mysqli_query($conn,$que45o) or die(mysqli_error($conn));
while ($R145o = mysqli_fetch_array ($resu45o))
{
$cust_over=$R145o['sl'];
if($cust_over1=="")
{
$cust_over1=$cust_over;
}
else
{
$cust_over1=$cust_over1.",".$cust_over;    
}
}

$data11= mysqli_query($conn,"select * from  main_drcr where sl>0  and cbill!='' and retn_stat!='1' and paid='0' and FIND_IN_SET(cid, '$cust_over1')>0  group by cbill order by dt ") or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$bill_dt="";	
$blno_over=$row1['cbill'];

$data21= mysqli_query($conn,"select * from  main_drcr where cbill='$blno_over' and  FIND_IN_SET(cid, '$cust_over1')>0 and nrtn='Sale' and dldgr='4' and (cldgr='-2' or cldgr='-1') $date ")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data21))
{
$bill_dt=$row2['dt'];
}
if($bill_dt=='')
{
$data21= mysqli_query($conn,"select * from  main_drcr where cbill='$blno_over' and  FIND_IN_SET(cid, '$cust_over1')>0 and nrtn='Sale Return' and dldgr='-2' and cldgr='4'  ")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data21))
{
$bill_dt=$row2['dt'];
$blno_over_dt=$row1['dt'];
}
}
if($bill_dt=='')
{
$data22= mysqli_query($conn,"select * from  main_billing where blno='$blno_over' and cstat='0'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data22))
{
$bill_dt=$row2['dt'];
}
}
if($bill_dt=="")
{
   $bill_dt= $blno_over_dt;
}
$T=0;
$result416 = mysqli_query($conn,"SELECT  (SUM(IF(dldgr='4', amm, 0)) - SUM(IF(cldgr='4', amm, 0))) AS amm FROM main_drcr where  cbill='$blno_over' and  FIND_IN_SET(cid, '$cust_over1')>0 and  stat='1'")or die(mysqli_error($conn));
while ($R16 = mysqli_fetch_array ($result416))
{
$T=$R16['amm'];
}

if($T==0)
{
$qr=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$blno_over'") or die(mysqli_error($conn));
}
else
{
$qr=mysqli_query($conn,"update main_drcr set paid='0' where cbill='$blno_over'") or die(mysqli_error($conn));	
}

$cdt=date('Y-m-d');
if($T<1)
{
$data21= mysqli_query($conn,"select * from  main_drcr where cbill='$blno_over' and FIND_IN_SET(cid, '$cust_over1')>0 and cldgr='4' order by dt desc limit 0,1")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data21))
{
$cdt=$row2['dt'];
}	
}
$diff = (strtotime($bill_dt) - strtotime($cdt));
$over_due = (abs(floor($diff / (60*60*24))));    
 
if($over_due>100)   //120 old
{
 $err="Customer overdue 120 days exceeded";  
die('<b><center><font color="red" size="5">Customer overdue 120('.$blno_over.') days exceeded. <a href="billing-gst.php?bsl='.$bill_typ.'&blno='.$order_no.'">Please Go Back Previous Page....</a></font></center></b>');
}
}

$chkdt= date('Y-m-d', strtotime('-50 days')); 

$data112= mysqli_query($conn,"select * from  main_drcr where dt<='$chkdt'  and cbill!='' and retn_stat!='1' and paid='0' and cid='$custnm' and nrtn='Sale' and dldgr='4' and (cldgr='-2' or cldgr='-1')") or die(mysqli_error($conn));
if(mysqli_num_rows($data112)>0)
{
  while ($R112 = mysqli_fetch_array ($data112))
{  
  $blno_over=  $R112['cbill'];
    
    
 die('<b><center><font color="red" size="5">Customer overdue 50('.$blno_over.') days exceeded. <a href="billing-gst.php?bsl='.$bill_typ.'&blno='.$order_no.'">Please Go Back Previous Page....</a></font></center></b>');   
}
}

}

if($cust_typ==2)
{	
	$branch_ctag=0;
	$querybrcd = "SELECT * FROM main_branch where sl='$brncd'";
	   $resultbcd = mysqli_query($conn,$querybrcd);
	while($row123=mysqli_fetch_array($resultbcd))
	{
		$branch_ctag=$row123['ctag'];	
	} 
	
	if($branch_ctag==1)
	{
		$databcdchk= mysqli_query($conn,"SELECT * FROM main_cust_asgn WHERE spid='$sale_per' and FIND_IN_SET('$custnm',cust)>0") or die(mysqli_error($conn));
		if(mysqli_num_rows($databcdchk)==0)
		{			
		 die('<b><center><font color="red" size="5">Please Customer tag with Sales Person. <a href="billing-gst.php?bsl='.$bill_typ.'&blno='.$order_no.'">Please Go Back Previous Page....</a></font></center></b>');
		}
	}
}

//die('sorry this time not working');

 $query1 = "SELECT sum(tamm) as gttl,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst,count(sl) as count_row FROM ".$DBprefix."slt where eby='$user_currently_loged' and bill_typ='$bill_typ'";
$result1 = mysqli_query($conn,$query1)or die(mysqli_error($conn));
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$gttl1=$R1['gttl'];
$cgst=$R1['cgst'];
$sgst=$R1['sgst'];
$igst=$R1['igst'];
$count_row=$R1['count_row'];
}
if($count_row==0)
{
$err="Please Add Some Product First";
}


$query = "SELECT * FROM ".$DBprefix."slt where eby='$user_currently_loged' and bill_typ='$bill_typ'";
$result = mysqli_query($conn,$query)or die(mysqli_error($conn));
while ($R = mysqli_fetch_array ($result))
{
$total_chk=$R['total'];
$cgst_am_chk=$R['cgst_am'];
$sgst_am_chk=$R['sgst_am'];
$igst_am_chk=$R['igst_am'];


if(($cgst_am_chk+$sgst_am_chk+$igst_am_chk)<0.000000000001)
{
$err="GST Amount Cat't Be Blank...";	
}
if($total_chk<0.000000000001)
{
$err="Sale Rate Cat't Be Blank...";	
}

}




$get=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$als=$row['als'];
$tp=$row['tp'];
$adrs=$row['adrs'];
$ssn=$row['ssn'];
$start_no=$row['start_no'];
$rv=$row['rv'];
}
if($pamm>0)
{
if($rv=="")
{
$err="Please Set Receive Voucher Type";		
}
}
if($err=="")
{
if($order_no!='')
{
$result2 = mysqli_query($conn,"DELETE FROM ".$DBprefix."stock WHERE sbill='$order_no'") or die(mysqli_error($conn));
}
$count6=5;
$query51="select * from ".$DBprefix."billing where als='$als' and ssn='$ssn' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
$vnos=$rows['blno'];
}
$bill=explode($als,$vnos);
$bill1=explode($ssn,$bill[1]);
$vnos=$bill1[0];
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
$query5="select * from ".$DBprefix."billing where blno='$blno'";
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
$bilamm=$gttl+$cgst+$sgst+$igst+$tcsam;
$rgttl=round($bilamm);
$roff=round($rgttl-$bilamm,2);
	
if($invto!='')
{
$cust_sl=$invto;	
}
else
{
$cust_sl=$custnm;	
}
	
$que45 = "SELECT * FROM main_cust where sl='$cust_sl'";
$resu45 = mysqli_query($conn,$que45) or die(mysqli_error($conn));
while ($R145 = mysqli_fetch_array ($resu45))
{
$cugst=$R145['gstin'];
$cust_nm=$R145['nm'];
$cust_cont=$R145['cont'];
}

$chkref=mysqli_query($conn,"SELECT * FROM main_reference where nm='$reference'") or die(mysqli_error($conn));
while ($R146 = mysqli_fetch_array ($chkref))
{
	$refnm1=$R146['nm'];
	$refsl1=$R146['sl'];
}
$refcnt=mysqli_num_rows($chkref);
if($refcnt>0)
{
	$refsl=$refsl1;
}else{
	
	$query214 = "INSERT INTO main_reference (nm,edt,edtm,eby) VALUES ('$reference','$cdt','$dttm','$user_currently_loged')";
	$result214 = mysqli_query($conn,$query214)or die(mysqli_error($conn));
	$last_id = mysqli_insert_id($conn);
	$refsl=$last_id;
	
}

$data_recv= mysqli_query($conn,"select * from  ".$DBprefix."slt where eby='$user_currently_loged' and bill_typ='$bill_typ' and betno=''")or die(mysqli_error($conn));
$sl_count=mysqli_num_rows($data_recv);

if($sl_count==0){$bfl=1;}else{$bfl=0;}

$query211 = "INSERT INTO ".$DBprefix."billing (blno,refsl,cid,amm,paid,crdtp,cbnm,dt,edt,pdts,vat,vatamm,car,dis,bcd,eby,tpoint,fst,tst,gst,tmod,psup,vno,lpd,gstin,dur_mnth,no_servc,sfno,dpay,finam,emiam,emi_mnth,tamm,gstam,roff,payam,crfno,cust_typ,sale_per,bill_typ,als,tp,adrs,ssn,start_no,invto,dldgr,order_no,disl,remk,damm,rv,bill_no,bfl,mr,tcs,tcsam,ship_addr,ship_mob) 
VALUES ('$blno','$refsl','$custnm','$bilamm','$pamm','$mdt','$cbnm','$dt','$cdt','$dttm','$vat','$vatamm','$car','$dis','$brncd','$user_currently_loged','$tpoint','$fst','$tst','1','$tmod','$psup','$vno','$lpd','$cugst','$dur_mnth','$no_servc','$sfno','$dpay','$finam','$emiam','$emi_mnth','$gttl','$gstam','$roff','$payam','$crfno','$cust_typ','$sale_per','$bill_typ','$als','$tp','$adrs','$ssn','$start_no','$invto','$dldgr','$order_no','$disl','$remk','$damm','$rv','$bill_no','$bfl','$mr','$tcs','$tcsam','$ship_addr','$ship_mob')";
$result211 = mysqli_query($conn,$query211)or die(mysqli_error($conn)); 
	
$gttl=$gttl+$roff;	

$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES ('$vcno','$blno','$custnm','$dt','Sale','4','-2','$gttl','$brncd','$user_currently_loged','$dttm','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));

if($cgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES ('$vcno','$blno','$custnm','$dt','C-GST','4','37','$cgst','$brncd','$user_currently_loged','$dttm','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($sgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES ('$vcno','$blno','$custnm','$dt','S-GST','4','38','$sgst','$brncd','$user_currently_loged','$dttm','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($igst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES ('$vcno','$blno','$custnm','$dt','I-GST','4','39','$igst','$brncd','$user_currently_loged','$dttm','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($tcsam>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES ('$vcno','$blno','$custnm','$dt','TCS','4','183','$tcsam','$brncd','$user_currently_loged','$dttm','1','$sale_per')";
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
*/

$chk_amm=$pamm+$damm;
if($chk_amm>0)
{
	
$get=mysqli_query($conn,"select * from main_billtype where sl='$rv'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$als1=$row['als'];
$tp1=$row['tp'];
$adrs1=$row['adrs'];
$ssn1=$row['ssn'];
$start_no1=$row['start_no'];
}	
$ym=date('Ym', strtotime($dt));
$count6=5;
$query51="select * from ".$DBprefix."drcr where als='$als1' and ssn='$ssn1' and blnon!='' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
$vnos=$rows['blnon'];
}
$bill=explode($als1,$vnos);
$bill1=explode($ssn1,$bill[1]);
$vnos=$bill1[0];
if($start_no>$vnos)
{
$vnos=$start_no;
}
$vid1=$vnos;

//$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);
if((strlen($vnos))>6)
{
$vid1=substr($vnos,6,15);
}

while($count6>0){
$vid1=$vid1+1;
$blnon=$als1.$ym.$vid1.$ssn1;
$query5="select * from ".$DBprefix."drcr where blnon='$blnon'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);
}


$query511="select * from main_recv where blno!='' order by sl desc limit 0,1";
$result511 = mysqli_query($conn,$query511) or die(mysqli_error($conn));
while($rows1=mysqli_fetch_array($result511))
{	
$vnos1=$rows1['blno'];
}	
$vid11=substr($vnos1,2,7);	
$count66=5;
while($count66>0)
{
$vid11=$vid11+1;
$vnoc1=str_pad($vid11, 7, '0', STR_PAD_LEFT);
$blno1="RC".$vnoc1;
$query51="select * from main_recv where blno='$blno1'";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
$count66=mysqli_num_rows($result51);
}
if($pamm>0)	
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,idt,mtd,mtddtl,dldgr,cldgr,amm,brncd,eby,edtm,typ,pay,sman,btyp,als,ssn,bill_typ,blnon,blno) VALUES 
('$vcno','$blno','$custnm','$dt','Payment','$idt','$mdt','$crfno','$dldgr','4','$pamm','$brncd','$user_currently_loged','$dttm','77','1','$sale_per','77','$als1','$ssn1','$rv','$blnon','$blno1')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($damm>0)
{
$query31 = "INSERT INTO main_drcr (vno,dt,nrtn,typ,dldgr,cldgr,amm,eby,edtm,cid,brncd,cbill,sman,btyp,als,ssn,bill_typ,blnon,blno,pay) VALUES 
('$vcno','$dt','$remk','CC01','$disl','4','$damm','$user_currently_loged','$dttm','$custnm','$brncd','$blno','$sale_per','77','$als1','$ssn1','$rv','$blnon','$blno1','1')";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));
}

$query31 = "INSERT INTO main_recv (blno,bcd,dt,cid,nrtn,dldgr,paymtd,tamm,refno,bill_type,als,ssn,eby,edt,app_ref,spid) VALUES 
('$blno1','$brncd','$dt','$custnm','$nrtn','$dldgr','$mdt','$pamm','$crfno','$rv','$als1','$ssn1','$user_currently_loged','$cdt','$blno_ref','$sale_per')";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));


$query31 = "INSERT INTO main_recv_app (blno,bcd,dt,cid,nrtn,dldgr,paymtd,tamm,refno,bill_type,als,ssn,eby,edt,stat,spid) VALUES 
('$blno1','$brncd','$dt','$custnm','$nrtn','$dldgr','$mdt','$pamm','$crfno','$rv','$als1','$ssn1','$sale_per','$cdt','1','$sale_per')";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));


$query21 = "INSERT INTO main_recv_dtl(ref,blno,amm,sman,cid,eby,brncd,disl,damm,remk)
VALUES ('$blno1','$blno','$pamm','$sale_per','$custnm','$user_currently_loged','$brncd','$disl','$damm','$remk')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	


$query21 = "INSERT INTO main_recv_dtl_app(ref,blno,amm,sman,cid,eby,brncd,disl,damm,remk)
VALUES ('$blno1','$blno','$pamm','$sale_per','$custnm','$user_currently_loged','$brncd','$disl','$damm','$remk')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	
mysqli_query($conn,"UPDATE main_billing SET blno1='$blno1',blnon='$blnon' WHERE blno='$blno'");

if(round($pamm+$damm)==round($bilamm)){
	$qr=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$blno'") or die(mysqli_error($conn));
}

}


$ppdis=0;
$query100 = "SELECT * FROM ".$DBprefix."slt where eby='$user_currently_loged' and bill_typ='$bill_typ' order by sl";
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

$tbcd="";
$fbcd="";
$tstat=0;
$tout="";
$datag= mysqli_query($conn,"SELECT * FROM main_a_sale_chln where sl>0 and branch='$brncd' and  FIND_IN_SET('$bcd', bill_godown)>0  and stat='0'") or die(mysqli_error($conn));
$count=mysqli_num_rows($datag);
while($rowg=mysqli_fetch_array($datag))
{
$stk_godown=$rowg['stk_godown'];

$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$prsl' and bcd='$bcd'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}   
if($stck>=$pcs)
{
    
}
else
{
    
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$prsl' and bcd='$stk_godown'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}    
if($stck>=$pcs)
{
   
$tbcd=$bcd;
$fbcd=$stk_godown;
$tstat=1;   
$tout=uniqid().date('ymdhis');
$query21 = "INSERT INTO ".$DBprefix."stock (unit,pcd,bcd,dt,stout,nrtn,eby,dtm,stat,ret,refno,sbill,usl,uval,betno,rate,stk_rate,bd_sl,tout) VALUES 
('$unit','$prsl','$fbcd','$dt','$stout','Transfer','$user_currently_loged','$dttm','1','$ret','$refno','$blno','$usl','$uval','$betno','$rate1','$stk_rate','$bd_sl','$tout')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
   
    
}
}


}


$query21 = "INSERT INTO ".$DBprefix."billdtls (cat,scat,prsl,imei,unit,kg,grm,pcs,srt,adp,prc,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,refno,usl,uval,total,disp,disa,dt,betno,bcd,rate,tamm,bill_typ,stk_rate,cust,fbcd,tbcd,tstat,tout) 
VALUES ('$cat','$scat','$prsl','$imei','$unit','$kg','$grm','$pcs','$srt','$adp','$prc','$ttl','$blno','$fst','$tst','$cgst_rt','$sgst_rt','$igst_rt','$cgst_am','$sgst_am','$igst_am','$net_am','$refno','$usl','$uval','$total','$disp','$disa','$dt','$betno','$bcd','$rate1','$tamm','$bill_typ','$stk_rate','$custnm','$fbcd','$tbcd','$tstat','$tout')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
	
$get1=mysqli_query($conn,"select * from ".$DBprefix."billdtls order by sl desc limit 0,1") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get1))
{
$bd_sl=$roww['sl'];
}	
	
$query21 = "INSERT INTO ".$DBprefix."stock (unit,pcd,bcd,dt,stout,nrtn,eby,dtm,stat,ret,refno,sbill,usl,uval,betno,rate,stk_rate,bd_sl) VALUES 
('$unit','$prsl','$bcd','$dt','$stout','Sale','$user_currently_loged','$dttm','1','$ret','$refno','$blno','$usl','$uval','$betno','$rate1','$stk_rate','$bd_sl')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 







}


$query2 = "DELETE FROM ".$DBprefix."slt WHERE eby='$user_currently_loged' and bill_typ='$bill_typ'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));

$query1 = "SELECT sum(net_am) as gttl FROM ".$DBprefix."billdtls where blno='$blno'";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
}


if($order_no!="")
{
$query21 = "UPDATE main_order SET cstat='1' WHERE blno='$order_no'";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));		
}




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
<table border="0" width="100%">
<tr>
<td  align="center" colspan="2">
<font size="7"><b><?=$comp_nm;?></b></font>
<br>
<font size="4"><b><?=$comp_addr;?></b></font>
</td>
</tr>
<tr>
<td  align="right" style="padding-right:10px">

</td>
<td  align="center">
    <font size="3"> <b><a href="bill_typ.php?rv=1" ><u>Back</u></a> || </b></font>
<font size="3"> <b><a href="bill_new_gst.php?blno=<?=rawurlencode($blno);?>" target="_blank"><font color="red"><u>Without Header Print</u></font></a> || </b></font>
<font size="3"> <b><a href="bill_new_gst.php?blno=<?=rawurlencode($blno);?>&typ=1" target="_blank"><font color="red"><u>With Header Print</u></font></a> || </b></font>
<font size="3"> <b><a href="coupon_print.php?blno=<?=rawurlencode($blno);?>&typ=1" target="_blank"><font color="red"><u>Coupon Print</u></font></a></b></font>
</td>
</tr>

<tr>
<td align="center"  colspan="2" >
<a href="javascript:sms('<?=$blno;?>')"><font size="3" color="blue"> <b><u>Send SMS</u></b></font></a>
</td>
</tr>

<tr>
<td  align="center"  colspan="2">
<font size="3" color="red"> <b> Bill No. : <?=$blno;?></b></font>
</td>
</tr>
</table>

<div id="sms">
</div>
 </form>      
    </center> 
</body>
</div>
</html>
<script>
function sms(blno)
{
$("#sms").load("sms.php?blno="+blno).fadeIn('fast');	
}
</script>
<?
}
else
{
?>
<Script language="JavaScript">
alert("<? echo $err;?>");
//history.go(-1);
document.location="billing-gst.php?bsl=<?=$bill_typ;?>"+"&blno=<?=$order_no;?>";
</script>
<?
}
?>
