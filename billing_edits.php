<?php
$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$cdt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
ini_set('display_errors', 1);
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
$invto=$_POST[invto];
$blno=$_POST[blno];

$cust_typ=$_POST[cust_typ];
$sale_per=$_POST[sale_per];
$bill_typ=$_POST[bill_typ];
$invto=$_POST[invto];

$disl=$_POST[disl];
$remk=$_POST[remk];
$damm=$_POST[damm];
$reference=$_POST[reference];
$mr=$_POST[mr]; 
$tcs=$_POST['tcs'];
$tcsam=$_POST['tcsam'];
$ship_addr=$_POST['ship_addr'];
$ship_mob=$_POST['ship_mob'];
$data18= mysqli_query($conn,"select * from main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data18))
{
$rv_chk=$row1['rv'];
} 
if($rv_chk=="")
{
$get222=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get222))
{
$rv=$row['rv'];
}	
}

  
$dt=date('Y-m-d', strtotime($dt));

$val=date_chk($dt);
	if($val==0)
	{
		die('<b><center><font color="red" size="5">Please Check Your Input Date. Please Go Back Previous Page....</a></font></center></b>');
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

if(strtoupper($user_currently_loged)=='ADMIN'  OR strtoupper($user_currently_loged)=='CHANDAN'   OR strtoupper($user_currently_loged)=='ANANDA')
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
$que45o = "SELECT * FROM main_cust where sl='$custnm'"; //cont='$cust_cont'
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
 
if($over_due>50)   //120 old
{
 $err="Customer overdue 50 days exceeded";  
die('<b><center><font color="red" size="5">Customer overdue 50('.$blno_over.') days exceeded. <a href="billing-gst.php?bsl='.$bill_typ.'&blno='.$order_no.'">Please Go Back Previous Page....</a></font></center></b>');
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

$query1 = "SELECT sum(tamm) as gttl,sum(cgst_am) as cgst,sum(sgst_am) as sgst,sum(igst_am) as igst FROM main_billdtls_edt where eby='$user_currently_loged' and blno='$blno'";
$result1 = mysqli_query($conn,$query1)or die(mysqli_error($conn));

while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$gttl1=$R1['gttl'];
$cgst=$R1['cgst'];
$sgst=$R1['sgst'];
$igst=$R1['igst'];
}
if($gttl==0)
{
$err="Please Add Some Product First";
}

$query = "SELECT * FROM main_billdtls_edt where eby='$user_currently_loged' and blno='$blno'";
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

if($err=="")
{

$dd=mysqli_query($conn,"select * from main_billing_edt_log order by sl desc limit 0,1") or die(mysqli_error($conn));
while($pps=mysqli_fetch_array($dd))
{	
$edt_blno1=$pps['edt_blno'];
}	
$vvid1=substr($edt_blno1,2,7);	
$ssnn1=5;
while($ssnn1>0)
{
$vvid1=$vid1+1;
$vvnoc=str_pad($vvid1, 7, '0', STR_PAD_LEFT);
$edt_blno="BE".$vvnoc;
$ssnn=mysqli_query($conn,"select * from main_billing_edt_log where edt_blno='$edt_blno'");
$ssnn1=mysqli_num_rows($ssnn);
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

	
 $query_log = "insert into  main_billing_edt_log (blno,refsl,cid,amm,paid,crdtp,cbnm,dt,edt,pdts,vat,vatamm,car,dis,bcd,eby,tpoint,fst,tst,gst,tmod,psup,vno,lpd,gstin,dur_mnth,no_servc,sfno,dpay,finam,emiam,emi_mnth,tamm,gstam,roff,payam,crfno,cust_typ,sale_per,bill_typ,als,tp,adrs,ssn,start_no,invto,bill_by,cstat,order_no,rv,blno1,disl,remk,damm,blnon)
select blno,refsl,cid,amm,paid,crdtp,cbnm,dt,edt,pdts,vat,vatamm,car,dis,bcd,eby,tpoint,fst,tst,gst,tmod,psup,vno,lpd,gstin,dur_mnth,no_servc,sfno,dpay,finam,emiam,emi_mnth,tamm,gstam,roff,payam,crfno,cust_typ,sale_per,bill_typ,als,tp,adrs,ssn,start_no,invto,eby,cstat,order_no,rv,blno1,disl,remk,damm,blnon
from main_billing where blno = '$blno'";
$result_log = mysqli_query($conn,$query_log)or die (mysqli_error($conn)); 

$query_log1 = "insert into  main_billdtls_edt_log (cat,scat,prsl,imei,unit,kg,grm,pcs,srt,adp,prc,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,refno,usl,uval,total,disp,disa,dt,betno,bcd,rate,tamm,bill_typ,stk_rate,cust,eby)
select cat,scat,prsl,imei,unit,kg,grm,pcs,srt,adp,prc,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,refno,usl,uval,total,disp,disa,dt,betno,bcd,rate,tamm,bill_typ,stk_rate,cust,'$user_currently_loged'
from main_billdtls where blno = '$blno'";
$result_log1 = mysqli_query($conn,$query_log1)or die (mysqli_error($conn)); 


	
$query51="select * from ".$DBprefix."drcr where cbill='$blno'";
$result51=mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
	$vcno=$rows['vno'];
}

if($blno!='')
{
$result2 = mysqli_query($conn,"DELETE FROM ".$DBprefix."drcr WHERE cbill='$blno' and pay='1'")or die(mysqli_error($conn));


}

$totamm=$pamm;
$bilamm=$gttl+$cgst+$sgst+$igst+$tcsam;
$rgttl=round($bilamm);
$roff=round($rgttl-$bilamm,2);	

$gttl=$gttl+$roff;	

$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES
 ('$vcno','$blno','$custnm','$dt','Sale','4','-2','$gttl','$brncd','$user_currently_loged','$dttm','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));

if($cgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES 
('$vcno','$blno','$custnm','$dt','C-GST','4','37','$cgst','$brncd','$user_currently_loged','$dttm','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($sgst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES 
('$vcno','$blno','$custnm','$dt','S-GST','4','38','$sgst','$brncd','$user_currently_loged','$dttm','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($igst>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES
('$vcno','$blno','$custnm','$dt','I-GST','4','39','$igst','$brncd','$user_currently_loged','$dttm','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}
if($tcsam>0)
{
$query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES 
('$vcno','$blno','$custnm','$dt','TCS','4','183','$tcsam','$brncd','$user_currently_loged','$dttm','1','$sale_per')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));
}




$chk_amm=$pamm+$damm;
if($chk_amm>0)
{

$data1= mysqli_query($conn,"select * from main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$blno1=$row1['blno1'];
$blnon=$row1['blnon'];
$rv=$row1['rv'];
}

if($rv=="")
{
$get222=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get222))
{
$rv=$row['rv'];
}	
}
if($blno1!='')
{
$result2 = mysqli_query($conn,"DELETE FROM main_recv WHERE blno='$blno1'")or die(mysqli_error($conn));
$result2 = mysqli_query($conn,"DELETE FROM main_recv_app WHERE blno='$blno1'")or die(mysqli_error($conn));
$result2 = mysqli_query($conn,"DELETE FROM main_recv_dtl WHERE ref='$blno1'")or die(mysqli_error($conn));
$result2 = mysqli_query($conn,"DELETE FROM main_recv_dtl_app WHERE ref='$blno1'")or die(mysqli_error($conn));
	
}

$get=mysqli_query($conn,"select * from main_billtype where sl='$rv'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$als1=$row['als'];
$tp1=$row['tp'];
$adrs1=$row['adrs'];
$ssn1=$row['ssn'];
$start_no1=$row['start_no'];
}

if($blno1=='')
{
$count6=5;
$query51="select * from ".$DBprefix."drcr where als='$als1' and ssn='$ssn1' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
$vnos=$rows['blnon'];
}
$bill=explode($als1,$vnos);
$bill1=explode($ssn1,$bill[1]);
$vnos=$bill1[1];
if($start_no1>$vnos)
{
$vnos=$start_no1;
}
$vid1=$vnos;

while($count6>0){
$vid1=$vid1+1;
//$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);
$vnoc=$vid1;
$blnon=$als1.$vnoc.$ssn1;
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
}





if($invto!='')
{
$cust_sl=$invto;	
}
else
{
$cust_sl=$custnm;	
}
	
$que45 = "SELECT * FROM main_cust where sl='$cust_sl' and  gstdt<='$dt'";
$resu45 = mysqli_query($conn,$que45) or die(mysqli_error($conn));
while ($R145 = mysqli_fetch_array ($resu45))
{
$cugst=$R145['gstin'];
}

$query211 = "UPDATE ".$DBprefix."billing SET cid='$custnm',refsl='$refsl',amm='$bilamm',paid='$pamm',crdtp='$mdt',cbnm='$cbnm',
dt='$dt',edt='$cdt',pdts='$dttm',dis='$dis',bcd='$brncd',eby='$user_currently_loged',tpoint='$tpoint',fst='$fst',
tst='$tst',gst='1',tmod='$tmod',psup='$psup',vno='$vno',lpd='$lpd',dur_mnth='$dur_mnth',no_servc='$no_servc',
sfno='$sfno',dpay='$dpay',finam='$finam',emiam='$emiam',emi_mnth='$emi_mnth',tamm='$tamm',gstam='$gstam',roff='$roff',ship_addr='$ship_addr',ship_mob='$ship_mob',
payam='$payam',crfno='$crfno',invto='$invto',dldgr='$dldgr',gstin='$cugst',sale_per='$sale_per',disl='$disl',remk='$remk',damm='$damm',rv='$rv',vat='$vat',mr='$mr',tcs='$tcs',tcsam='$tcsam' WHERE blno='$blno'";
$result211 = mysqli_query($conn,$query211)or die(mysqli_error($conn)); 

$result2 = mysqli_query($conn,"DELETE FROM ".$DBprefix."billdtls WHERE blno='$blno'") or die(mysqli_error($conn));
$result2 = mysqli_query($conn,"DELETE FROM ".$DBprefix."stock WHERE sbill='$blno'") or die(mysqli_error($conn));




$ppdis=0;
$query100 = "SELECT * FROM main_billdtls_edt where eby='$user_currently_loged' and blno='$blno' order by sl";
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
$tamm=$R100['tamm'];
$bill_typ=$R100['bill_typ'];
$tstat=$R100['tstat'];
$fbcd=$R100['fbcd'];
$tbcd=$R100['tbcd'];
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

if($tstat!=2)
{
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

$query2 = "DELETE FROM main_billdtls_edt WHERE eby='$user_currently_loged' and blno='$blno'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));

 $query1 = "SELECT sum(net_am) as gttl FROM ".$DBprefix."billdtls where blno='$blno'";
 $result1 = mysqli_query($conn,$query1) or die(mysqli_error($conn));
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
}


$nw = new Numbers_Words();
$aiw=$nw->toWords($gttl1);

?>
<Script language="JavaScript">
alert('Updated Successfully..!');
document.location="sale_show.php";
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
