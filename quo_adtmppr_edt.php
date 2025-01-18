<?php 
$reqlevel = 1;
include("membersonly.inc.php");

$blno=$_REQUEST['blno'];

$prnm=$_REQUEST['prnm'];
$description=rawurldecode($_REQUEST['desc']);
$pcs=$_REQUEST['pcs'];
$prc=$_REQUEST['prc'];
$total=$_REQUEST['total'];
$disp=$_REQUEST['disp'];
$disa=$_REQUEST['disa'];
$lttl=$_REQUEST['lttl'];
$net_amm=$_REQUEST['net_amm'];
$cgst_rt=$_REQUEST['cgst_rt'];
$sgst_rt=$_REQUEST['sgst_rt'];
$igst_rt=$_REQUEST['igst_rt'];
$cgst_amm=$_REQUEST['cgst_am'];
$sgst_amm=$_REQUEST['sgst_am'];
$igst_amm=$_REQUEST['igst_am'];
$brncd=$_REQUEST['brncd'];
$fst=$_REQUEST['fst'];
$tst=$_REQUEST['tst'];

$tsl=$_REQUEST['tsl'];
if($prnm=='')
{
$err="Please Select Model...";
}
$query7="Select * from  main_quo_details_edt where prsl='$prnm' and  blno='$blno' and  sl!='$tsl'";
$result7 = mysqli_query($conn,$query7);
$rowcount=mysqli_num_rows($result7);
if($rowcount>0)
{
$err="Product Already Exists....";
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
if($tsl==""){
$query21 = "INSERT INTO main_quo_details_edt (total,disp,disa,cat,scat,prsl,description,pcs,prc,ttl,blno,fst,tst,cgst_rt,sgst_rt,igst_rt,cgst_am,sgst_am,igst_am,net_am,bcd,tamm,rate,eby)
VALUES ('$total','$disp','$disa','$cat','$scat','$prnm','$description','$pcs','$prc','$lttl','$blno','$fst','$tst','$cgst_rt','$sgst_rt','$igst_rt','$cgst_am','$sgst_am','$igst_am','$net_am','$brncd','$tamm','$rate','$user_currently_loged')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	
}
else{
$query21 = "update main_quo_details_edt set total='$total',disp='$disp',disa='$disa',cat='$cat',scat='$scat',prsl='$prnm',description='$description',pcs='$pcs',prc='$prc',ttl='$lttl',blno='$blno',fst='$fst',tst='$tst',cgst_rt='$cgst_rt',sgst_rt='$sgst_rt',igst_rt='$igst_rt',cgst_am='$cgst_am',sgst_am='$sgst_am',igst_am='$igst_am',net_am='$net_am',bcd='$brncd',tamm='$tamm',rate='$rate',eby='$user_currently_loged' where sl='$tsl'";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	
}
?>
<script>
temp();
$('#prnm').trigger('chosen:open');
reset();
</script>
<?php 
}
else
{
?>
<script>
alert('<?php  echo $err;?>');
temp();
</script>
<?php 
}
?>