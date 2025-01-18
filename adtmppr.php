<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$sgst_rt=0;
$cgst_rt=0;
$sgst_am=0;
$cgst_am=0;
$igst_am=0;
$igst_rt=0;
$prnm=$_REQUEST['prnm'];
$unit=$_REQUEST['unit'];
$pcs=$_REQUEST['pcs'];
$prc=$_REQUEST['prc'];
$total=$_REQUEST['total'];
$disp=$_REQUEST['disp'];
$disa=$_REQUEST['disa'];
$lttl=$_REQUEST['lttl'];
$net_amm=$_REQUEST['net_amm']??0;
$cgst_rt=$_REQUEST['cgst_rt'];
$sgst_rt=$_REQUEST['sgst_rt'];
$igst_rt=$_REQUEST['igst_rt'];
$cgst_amm=$_REQUEST['cgst_am'];
$sgst_amm=$_REQUEST['sgst_am'];
$igst_amm=$_REQUEST['igst_am'];
$brncd=$_REQUEST['brncd'];
$fst=$_REQUEST['fst'];
$tst=$_REQUEST['tst'];
$usl=$_REQUEST['usl'];
$bill_typ=$_REQUEST['bill_typ'];
$order_no=$_REQUEST['order_no']??"";
$refno=rawurldecode($_REQUEST['refno']);
$betno=rawurldecode($_REQUEST['betno']);
$bcd=$_REQUEST['bcd'];
$tsl=$_REQUEST['tsl'];
$stk=$_REQUEST['stk'];
if($betno!=''){$betno1=" and betno='$betno'";}else{$betno1="";}
if($tsl!=""){$ssl=" and sl!='$tsl'";}else{$ssl="";}
if($order_no!=''){$blno1=" and sbill!='$order_no'";}else{$blno1="";}
$err="";
if($prnm=='')
{
$err="Please Select Model...";
}
if($bill_typ=='')
{
$err="Please Select Bill Type...";
}
/*$query7="Select * from main_slt where prsl='$prnm' and eby='$user_currently_loged' and refno='$refno' $ssl";
$result7 = mysqli_query($conn,$query7);
$rowcount=mysqli_num_rows($result7);
if($rowcount>0)
{
//$err="Product Already Exists....";
}*/

if($err=='')
{
$query6="select * from  ".$DBprefix."product where sl='$prnm'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$scat=$row['scat'];
$cat=$row['cat'];
}
$tpcd="";
if($tsl=='')
{
   
   
$res=mysqli_query($conn,"select * from  main_product_to where fpcd='$prnm'");
while($row=mysqli_fetch_array($res))
{
$tpcd=$row['tpcd'];
}
}
?>
<center><font size="4" color="red"><b>Please wait, Your rquest is in process....</b></font></center> <br>

<?php 
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$prnm' and bcd='$bcd' $blno1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
	$smvlu=0;
	$mdvlu=0;
	$bgvlu=0;

$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$prnm'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu']??0;
	$mdvlu=$roww['mdvlu']??0;
	$bgvlu=$roww['bgvlu']??0;
}
$chk_stk=$pcs;
if($unit=='sun'){$chk_stk=(float)$pcs*(float)$smvlu;}
if($unit=='mun'){$chk_stk=(float)$pcs*(float)$mdvlu;}
if($unit=='bun'){$chk_stk=(float)$pcs*(float)$bgvlu;}
$total=round((float)$pcs*(float)$prc,2);
if($disp>0)
{
$disa=round(((float)$total*(float)$disp)/100,2);	
}
$lttl=(float)$total-(float)$disa;
if($stk=='1')
{
$stck=600000;
}
if((float)$stck>=(float)$chk_stk)
{
	/*
if($cgst_rt>0){$cgst_am=round(($cgst_rt*$lttl)/100,2);}
if($sgst_rt>0){$sgst_am=round(($sgst_rt*$lttl)/100,2);}
if($igst_rt>0){$igst_am=round(($igst_rt*$lttl)/100,2);}
$net_am=$lttl+$cgst_am+$sgst_am+$igst_am;
*/

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

$rate=$net_am/$pcs;

$sdt=null;
if(!empty($betno)){
$sdt=date('Y-m-d');
}

if($tsl=="")
{
$query21 = "INSERT INTO ".$DBprefix."slt (total,disp,disa,cat,scat,prsl,unit,pcs,prc,ttl,eby,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,refno,usl,bcd,betno,tamm,rate,bill_typ,sdt)
VALUES ('$total','$disp','$disa','$cat','$scat','$prnm','$unit','$pcs','$prc','$lttl','$user_currently_loged','$fst','$tst','$cgst_rt','$sgst_rt','$igst_rt','$cgst_am','$sgst_am','$igst_am','$net_am','$refno','$usl','$bcd','$betno','$tamm','$rate','$bill_typ','$sdt')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	
}
else
{
$query21 = "UPDATE ".$DBprefix."slt SET total='$total',disp='$disp',disa='$disa',cat='$cat',scat='$scat',prsl='$prnm',
unit='$unit',pcs='$pcs',prc='$prc',ttl='$lttl',eby='$user_currently_loged',fst='$fst',tst='$tst',cgst_rt='$cgst_rt',
sgst_rt='$sgst_rt',igst_rt='$igst_rt',cgst_am='$cgst_am',sgst_am='$sgst_am',igst_am='$igst_am',net_am='$net_am',
refno='$refno',usl='$usl',bcd='$bcd',betno='$betno',tamm='$tamm',rate='$rate',sdt='$sdt' WHERE sl='$tsl'";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));		
}
if($tpcd=='')
{
?>
<script>
temp();
reset();
//$('#prnm').trigger('chosen:open');
document.getElementById("prnm3").focus();
</script>
<?php 
}
if($tpcd!='')
{
$mrp=0;
$query6="select * from main_product_prc where psl='$tpcd' order by edt desc limit 0,1";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$mrp=$row['prc'];
$dis=$row['dis'];
$disam=$row['disam'];
}	
	
?>
<script>
reset();
$('#prnm').append("<option value='"+<?php  echo $tpcd;?>+"'>Auto Adding</option>");
document.getElementById('prnm').value="<?php  echo $tpcd;?>";
document.getElementById('tpcd').value="<?php  echo $tpcd;?>";
$('#prnm').trigger("chosen:updated");
document.getElementById('bcd').value="<?php  echo $bcd;?>";
document.getElementById('prc').value="<?php  echo $mrp;?>";
document.getElementById('pcs').value="<?php  echo $pcs;?>";
$('#bcd').trigger("chosen:updated");	
//get_prc();
get_gstval("autoadd");
//get_betno('');
//gtt_unt();

godown();
//get_stock();
</script>
<?php 
//sleep(1);
?>
<script>

//add1();
</script>
<?php 	
}
?>

<script>
//reset();
</script>

<?php 

}
else
{
//$err="Please Check  Quantity....";	

?>
<script>
if (confirm("Please Check  Quantity, Are Sure To Sale ?")) 
{	
add1('1');
}
else
{
temp();
}
</script>
<?php 

}
}
if($err!='')
{
?>
<script>
alert('<?php  echo $err;?>');
temp();
</script>
<?php 
}
mysqli_close($conn)
?>