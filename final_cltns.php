<?php 
$reqlevel=3; 
include("membersonly.inc.php");
include("function.php");
$tamm1=0;
$ttotal_adj_am=0;
$ttotal_crdt_amm=0;
$ttdisamm=0;

$cid=rawurldecode($_REQUEST['cid']);
$salper=rawurldecode($_REQUEST['salper']);
$brncd=rawurldecode($_REQUEST['brncd']);
$fdt=rawurldecode($_REQUEST['fdt']);
$tdt=rawurldecode($_REQUEST['tdt']);
$stat=rawurldecode($_REQUEST['stat']);
$als=rawurldecode($_REQUEST['als']);

$ledg=$_REQUEST['ledg'];
$mdt=$_REQUEST['mdt'];
$blno=$_REQUEST['blno'];

$cust_array=[0,831,833,841,18774,33243,33818,37578,828,835,842,844,847,898,26442,33244,33245,33246,33817,33819,33820,37039,37192,37579,37729,40287,41358,43605,44750];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$diff=dates_diff($fdt,$tdt);
if($salereport-1<$diff and ($cid=='' or array_search($cid,$cust_array))){
	?>
	<script language="javascript">
	alert("You have to excel export if you want to see data of more than "+<?php  echo $salereport; ?>+" day");
	</script>
	<?php 
	die('<b><center><font color="green" size="5">You have to excel export if you want to see data of more than '.$salereport.' day </font></center></b>');
	
	}
/* dldgr	paymtd */

if($mdt!=""){$mdt1=" and paymtd='$mdt'";}else{$mdt1="";}
if($ledg!=""){$ledg1=" and dldgr='$ledg'";}else{$ledg1="";}
if($blno!=""){$blno11=" and blno='$blno'";}else{$blno11="";}

if($cid!=""){$cid1=" and cid='$cid'";}else{$cid1="";}
if($salper!=""){$salper1=" and spid='$salper'";}else{$salper1="";}
if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($stat==""){$stat1="";}else{$stat1=" and cstat='$stat'";}
if($als==""){$als1="";}else{$als1=" and als='$als'";}

if($fdt!="" and $tdt!="")
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}


	$mdays=0;
	$get_days= mysqli_query($conn,"select * from main_edit_days where sl>0")or die(mysqli_error($conn));
	while ($get_days_row = mysqli_fetch_array($get_days))
	{
		$mdays=$get_days_row['days'];
	}

?>
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td align="left" ><b>Sl. </b></td>
<td align="center" ><b>Action </b></td>
<td align="center" ><b>Cancel </b></td>
<td align="left" ><b>Voucher No. </b></td>
<td align="left" ><b>Sales Person </b></td>
<td align="left" ><b>Customer Name</b></td>
<td align="left" ><b>Date</b></td>
<td align="left" ><b>Ref. No.</b></td>
<td align="left" ><b>Narration</b></td>
<td align="left" ><b>Ledger</b></td>
<td align="left" ><b>Payment Mode</b></td>
<td align="left" ><b>Total Received Amount</b></td>

<td align="left" ><b>Bill No.</b></td>
<td align="center" ><b>Amount</b></td>
<td align="center" ><b>Adj. Amount</b></td>
<td align="center" ><b>Credit-Note</b></td>
<td align="left"  ><b>Discount Ledger</b></td>
<td align="left"  ><b>Discount Am.</b></td>
<td align="left"  ><b>Discount Remark</b></td>
<td align="center"><b>Branch</b></td>
</tr>
<?php 
$sln=0;
$ttotal_am=0;
$data1=mysqli_query($conn,"SELECT * FROM main_recv where sl>0 $als1 $mdt1 $ledg1 $cid1 $salper1 $brncd1 $todts $stat1 ORDER BY sl")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($data1))
{
$sln++;
$sl=$row1['sl'];
$msl=$row1['sl'];
$blno=$row1['blno'];
$dt=$row1['dt'];
$pay_dt=$row1['dt'];
$nrtn=$row1['nrtn'];
$tamm=$row1['tamm'];
$refno=$row1['refno'];
$paymtd=$row1['paymtd'];
$dldgr=$row1['dldgr'];
$sman=$row1['spid'];
$cid=$row1['cid'];
$cstat=$row1['cstat'];
$bcd=$row1['bcd'];
$dt=date('d-m-Y',strtotime($dt));

$last_edit_date = date('Y-m-d', strtotime($pay_dt. ' + '.$mdays.' days')); 


$edit_count=get_permission($dt,$recv_edt);

$cdt=date('Y-m-d');


if($cstat==1){$cstat1="Canceled";}

	$cust_nm="";
	$datad1= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
	while ($rowd = mysqli_fetch_array($datad1))
	{
		$cust_nm=$rowd['nm'];
	}
	$bnm="";
	$data12=mysqli_query($conn,"select * from main_branch where sl='$bcd'")or die(mysqli_error($conn));
	while ($row1=mysqli_fetch_array($data12))
	{
	$bnm=$row1['bnm'];
	}
	
$data2= mysqli_query($conn,"select * from main_ledg where sl='$dldgr'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$ledgr_nm=$row1['nm'];
}
$mtd="";				
$data2= mysqli_query($conn,"select * from ac_paymtd where sl='$paymtd'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$mtd=$row2['mtd'];
}

$asd=0;
$qttl=0;

$total_am=0;
$total_adj_am=0;
$total_crdt_amm=0;
$tdisamm=0;
$query100 = "SELECT * FROM main_recv_dtl where  ref='$blno' $blno11 order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$tsl=$R100['sl'];
$blno1=$R100['ref'];
$bill_no=$R100['blno'];
$amm=$R100['amm'];
$cldgr=$R100['cldgr'];
$disl=$R100['disl'];
$damm=$R100['damm'];
$remk=$R100['remk'];
$dislam="";				
$data11= mysqli_query($conn,"select * from main_ledg where sl='$disl'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$dislam=$row1['nm'];
}

$vchno="";				
$data110= mysqli_query($conn,"select * from main_drcr where blno='$blno'")or die(mysqli_error($conn));
while ($row10 = mysqli_fetch_array($data110))
{
$vchno=$row10['blnon'];
}
$adj_amm=0;
if($dldgr==7)
{
$adj_amm=$amm;
$amm=0;
}
$crdt_amm=0;
if($dldgr=='5')
{
$crdt_amm=$amm;
$amm=0;
}

$total_am+=$amm;
$total_adj_am+=$adj_amm;
$total_crdt_amm+=$crdt_amm;

$tdisamm+=$damm;
if($blno==$blno1){$asd++;}	
?>
<tr>
<?php 
if($asd==1)
{
	
	?>
	
	<td align="center"><?php  echo $sln;?></td>

<?php  if($edit_count>0){ ?>

	<td align="center">
	<a href="recv_reg_oth_edt.php?blno=<?php  echo $blno;?>" target="_blank" ><i class="fa fa-pencil-square-o"></i></a><br/>
	</td>
	<td align="center">
	<?php 
	if($edit_count>0){
	if($cstat==0)	{	?>
	<a href="javascript:if(confirm('Are you sure to Cancel...')){cncl('<?php  echo $msl;?>')}"><font color="red"><b>Cancel</b></font></a>
	
	<?php  }
elseif($cstat==1){echo $cstat1;}
	?>
	</td>

<?php  
}
}
else 
{
?>
<td></td>
<td></td>
<?php 
} 
?>



	<td align="left"><?php  echo $vchno;?></td>
	<td align="left"><?php  echo $sman;?></td>
	<td align="left"><?php  echo $cust_nm;?></td>
	<td align="center">
	<b><?php  echo $dt;?></b>
	</td>
	<td align="center"><?php  echo $refno;?></td>
	<td align="left"><?php  echo $nrtn;?></td>
	<td align="left"><?php  echo $ledgr_nm;?><b></b></td>
	<td align="center"><?php  echo $mtd;?></td>
	<td align="center"><?php  echo $tamm;?></td>
	<?php 
	$tamm1+=$tamm;
}
else
{
	?>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<?php 
}
?>

<td  align="left"  ><b><?php  echo $bill_no;?></b></td>

<td  align="right"  ><b><?php echo round($amm,2);?></b></td>
<td  align="right"  ><b><?php echo round($adj_amm,2);?></b></td>
<td  align="right"  ><b><?php echo round($crdt_amm,2);?></b></td>
<td align="left" ><b><?php  echo $dislam;?></b></td>
<td align="right" ><b><?php echo round($damm,2);?></b></td>
<td align="left" ><b><?php  echo $remk;?></b></td>
<td align="center"><?php  echo $bnm;?></td>
</tr>
<?php }
if($total_am+$total_adj_am+$tdisamm+$total_crdt_amm>0)
{
	
?>
<tr bgcolor="#e8ecf6">
<td colspan="13" align="right"><b>Total</b></td>
<td align="right"><b><?php  echo $total_am;?></b></td>
<td align="right"><b><?php  echo $total_adj_am;?></b></td>
<td align="right"><b><?php  echo $total_crdt_amm;?></b></td>
<td align="right"><b><?php  echo $tdisamm;?></b></td>
<td></td>
<td align="right"><b><?php  echo $tdisamm;?></b></td>
<td></td>
<td></td>
</tr>
<?php 
$ttotal_am+=$total_am;
$ttotal_adj_am+=$total_adj_am;
$ttotal_crdt_amm+=$total_crdt_amm;
$ttdisamm+=$tdisamm;
}

}
?>
<tr>
<td colspan="11" align="right"><b>Grand Total</b></td>
<td align="right"><b><?php  echo $tamm1;?></b></td>
<td align="right"><b></b></td>
<td align="right"><b><?php  echo $ttotal_am;?></b></td>
<td align="right"><b><?php  echo $ttotal_adj_am;?></b></td>
<td align="right"><b><?php  echo $ttotal_crdt_amm;?></b></td>
<td></td>
<td align="right"><b><?php  echo $ttdisamm;?></b></td>
<td></td>
<td></td>
</tr>
</table>