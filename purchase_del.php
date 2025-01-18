<?php 
$_REQUEST['blno'] ?? "";
$reqlevel = 1;
include("membersonly.inc.php");

$blno=$_REQUEST['blno'];
$cdt=date('Y-m-d');
$pdts=date('d-m-Y H:i:s a');
if($blno!='')
{
$dt=date('Y-m-d');
$m=date('m', strtotime($dt));

$y=date('y', strtotime($dt));;
if($m>=4)
{
$yy=$y."-".($y+1)."/";	
	
}
elseif($m<=3)
{
$yy=($y-1)."-".$y."/";	
}

	
$vid=0;
$count5=1;

$query51="select * from main_purchase_del order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['refno'];
}	
$vid=substr($vnos,8,6);	

while($count5>0){
$vid=$vid+1;
$vno=str_pad($vid, 6, '0', STR_PAD_LEFT);

$refno=$yy.'DE'.$vno;
$query5="select * from main_purchase_del where refno='$refno'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count5=mysqli_num_rows($result5);
}

$Select=mysqli_query($conn,"select * from main_purchase where blno='$blno'")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($Select))
{
$blno=$row['blno'];
$fst=$row['fst'];
$tst=$row['tst'];
$gst=$row['gst'];
$sid=$row['sid'];
$addr=$row['addr'];
$inv=$row['inv'];
$sttl=$row['sttl'];
$tmm2=$row['tmm2'];
$amm=$row['amm'];
$sdis=$row['sdis'];
$tamm=$row['tamm'];
$paid=$row['paid'];
$due=$row['due'];
$roff=$row['roff'];
$adl=$row['adl'];
$adlv=$row['adlv'];
$remk=$row['remk'];
$lfr=$row['lfr'];
$lcd=$row['lcd'];
$crdtp=$row['crdtp'];
$cbnm=$row['cbnm'];
$dt=$row['dt'];
$edt=$row['edt'];
$rdt=$row['rdt'];

$vat=$row['vat'];
$vatamm=$row['vatamm'];
$bcd=$row['bcd'];
$eby=$row['eby'];
$rstat=$row['rstat'];
$app=$row['app'];
$vstat=$row['vstat'];
$typ="";
$result=mysqli_query($conn,"insert into main_purchase_del(blno,refno,typ,fst,tst,gst,sid,addr,inv,sttl,tmm2,amm,sdis,tamm,paid,due,roff,adl,adlv,remk,lfr,lcd,crdtp,cbnm,dt,edt,rdt,pdts,vat,vatamm,bcd,eby,rstat )values
('$blno','$refno','$typ','$fst','$tst','$gst','$sid','$addr','$inv','$sttl','$tmm2','$amm','$sdis','$tamm','$paid','$due','$roff','$adl','$adlv','$remk','$lfr','$lcd','$crdtp','$cbnm','$dt','$edt','$rdt','$pdts','$vat','$vatamm','$bcd','$eby','$rstat')")or die(mysqli_error($conn));
}

$Select=mysqli_query($conn,"select * from main_purchasedet where blno='$blno'")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($Select))
{
$sup=$row['sup'];
$cat=$row['cat'];
$scat=$row['scat'];
$unit=$row['unit'];
$betno=$row['betno'];
$usl=$row['usl'];
$uval=$row['uval'];
$pck=$row['pck'];
$prsl=$row['prsl'];
$qty=$row['qty'];
$prc=$row['prc'];
$ttl=$row['ttl'];
$dis=$row['dis'];
$amm=$row['amm'];
$total=$row['total'];
$disp=$row['disp'];
$disa=$row['disa'];
$ldis=$row['ldis'];
$ldisa=$row['ldisa'];
$fst=$row['fst'];
$tst=$row['tst'];
$cgst_rt=$row['cgst_rt'];
$cgst_am=$row['cgst_am'];
$sgst_rt=$row['sgst_rt'];
$sgst_am=$row['sgst_am'];
$igst_rt=$row['igst_rt'];
$igst_am=$row['igst_am'];
$net_am=$row['net_am'];
$mrp=$row['mrp'];
$bcd=$row['bcd'];
$rate=$row['rate'];
$stk_rate=$row['stk_rate'];
$blno=$row['blno'];
$rdt=$row['rdt'];
$dt=$row['dt'];
$eby=$row['eby'];
$rqty=$row['rqty'];
$result=mysqli_query($conn,"insert into main_purchasedet_del(refno,sup,cat,scat,unit,betno,usl,uval,pck,prsl,qty,prc,ttl,dis,amm,total,disp,disa,ldis,ldisa,fst,tst,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,mrp,bcd,rate,stk_rate,blno,rdt,dt,eby,rqty )values
('$refno','$sup','$cat','$scat','$unit','$betno','$usl','$uval','$pck','$prsl','$qty','$prc','$ttl','$dis','$amm','$total','$disp','$disa','$ldis','$ldisa','$fst','$tst','$cgst_rt','$cgst_am','$sgst_rt','$sgst_am','$igst_rt','$igst_am','$net_am','$mrp','$bcd','$rate','$stk_rate','$blno','$rdt','$dt','$eby','$rqty')")or die(mysqli_error($conn));		

}


$query="delete from main_stock where pbill='$blno' and pbill!=''";
$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
$query1="delete from main_drcr where sbill='$blno' AND sbill!=''";
$result1 = mysqli_query($conn,$query1) or die(mysqli_error($conn));
$query2="delete from main_purchasedet where blno='$blno' and blno!=''";
$result2 = mysqli_query($conn,$query2) or die(mysqli_error($conn));
$query3="delete from main_purchase where blno='$blno' and blno!=''";
$result3 = mysqli_query($conn,$query3) or die(mysqli_error($conn));
}

?>
<script>
//show1();
</script>
