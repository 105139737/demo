<?php
$reqlevel = 1;
include("membersonly.inc.php");
$prnm=$_REQUEST['prnm'];
$unit=$_REQUEST['unit'];
$pcs=$_REQUEST['pcs'];
$prc=$_REQUEST['prc'];
$total=$_REQUEST['total'];
$disp=$_REQUEST['disp'];
$disa=$_REQUEST['disa'];
$lttl=$_REQUEST['lttl'];
$net_am=$_REQUEST['net_amm'];
$cgst_rt=$_REQUEST['cgst_rt'];
$sgst_rt=$_REQUEST['sgst_rt'];
$igst_rt=$_REQUEST['igst_rt'];
$cgst_am=$_REQUEST['cgst_am'];
$sgst_am=$_REQUEST['sgst_am'];
$igst_am=$_REQUEST['igst_am'];
$brncd=$_REQUEST['brncd'];
$fst=$_REQUEST['fst'];
$tst=$_REQUEST['tst'];
$usl=$_REQUEST['usl'];
$bill_typ=$_REQUEST['bill_typ'];

$refno=rawurldecode($_REQUEST['refno']);
$betno=rawurldecode($_REQUEST['betno']);
$bcd=$_REQUEST['bcd'];
$tsl=$_REQUEST['tsl'];
if($betno!=''){$betno1=" and betno='$betno'";}else{$betno1="";}
if($tsl!=""){$ssl=" and sl!='$tsl'";}else{$ssl="";}
if($prnm=='')
{
$err="Please Select Model...";
}
if($bill_typ=='')
{
$err="Please Select Bill Type...";
}
$query7="Select * from main_old_ret_slt where prsl='$prnm' and eby='$user_currently_loged' and refno='$refno' $ssl";
$result7 = mysqli_query($conn,$query7);
$rowcount=mysqli_num_rows($result7);
if($rowcount>0)
{
//$err="Product Already Exists....";
}

if($err=='')
{
$query6="select * from  ".$DBprefix."product where sl='$prnm'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$scat=$row['scat'];
$cat=$row['cat'];
}
/*
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$prnm' and bcd='$bcd' and refno='$refno'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
*/
$stck=600000;
$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$prnm'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}
$chk_stk=$pcs;
if($unit=='sun'){$chk_stk=$pcs*$smvlu;}
if($unit=='mun'){$chk_stk=$pcs*$mdvlu;}
if($unit=='bun'){$chk_stk=$pcs*$bgvlu;}
/*
$total=round($pcs*$prc,2);
if($disp>0)
{
$disa=round(($total*$disp)/100,2);	
}
$lttl=$total-$disa;
*/
if($stck>=$chk_stk)
{
	/*
if($cgst_rt>0){$cgst_am=round(($cgst_rt*$lttl)/100,2);}
if($sgst_rt>0){$sgst_am=round(($sgst_rt*$lttl)/100,2);}
if($igst_rt>0){$igst_am=round(($igst_rt*$lttl)/100,2);}
$net_am=$lttl+$cgst_am+$sgst_am+$igst_am;
*/

$amm=$lttl;
/*
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
if($sgst_rt>0){$sgst_am=round(($sgst_rt*$amm)/(100+$cgst_rt),2);}
if($igst_rt>0){$igst_am=round(($igst_rt*$amm)/(100+$igst_rt),4);}
	$sgst_rt=0;
	$cgst_rt=0;
	$sgst_am=0;
	$cgst_am=0;
	}
	$net_am=$amm;
	*/

$tamm=$amm-($cgst_am+$sgst_am+$igst_am);

$rate=$net_am/$pcs;	
if($tsl=="")
{
$query21 = "INSERT INTO main_old_ret_slt (total,disp,disa,cat,scat,prsl,unit,pcs,prc,ttl,eby,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,refno,usl,bcd,betno,tamm,rate,bill_typ)
VALUES ('$total','$disp','$disa','$cat','$scat','$prnm','$unit','$pcs','$prc','$lttl','$user_currently_loged','$fst','$tst','$cgst_rt','$sgst_rt','$igst_rt','$cgst_am','$sgst_am','$igst_am','$net_am','$refno','$usl','$bcd','$betno','$tamm','$rate','$bill_typ')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	
}
else
{
$query21 = "UPDATE main_old_ret_slt SET total='$total',disp='$disp',disa='$disa',cat='$cat',scat='$scat',prsl='$prnm',
unit='$unit',pcs='$pcs',prc='$prc',ttl='$lttl',eby='$user_currently_loged',fst='$fst',tst='$tst',cgst_rt='$cgst_rt',
sgst_rt='$sgst_rt',igst_rt='$igst_rt',cgst_am='$cgst_am',sgst_am='$sgst_am',igst_am='$igst_am',net_am='$net_am',
refno='$refno',usl='$usl',bcd='$bcd',betno='$betno',tamm='$tamm',rate='$rate' WHERE sl='$tsl'";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));		
}
?>
<script>
temp();
$('#prnm').trigger('chosen:open');
$('#prnm').val('');
reset();

</script>
<?
}
else
{
$err="Please Check  Quantity....";		
}
}
if($err!='')
{
?>
<script>
alert('<?=$err;?>');
temp();
</script>
<?
}
?>