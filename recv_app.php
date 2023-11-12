<?php
$reqlevel = 3;
include("membersonly.inc.php");
$cid=$_REQUEST['cid'];
$brncd=$_REQUEST['brncd'];
?>
<h4><b>App Payment List</b></h4>
<br>
<table border="0" width="100%" class="advancedtable">
<tr class="odd">
<td align="left" ><b>Sl. </b></td>
<td align="left" ><b>Action</b></td>
<td align="left" ><b>Sales Person </b></td>
<td align="left" ><b>Date</b></td>
<td align="left" ><b>Ref. No.</b></td>
<td align="left" ><b>Narration</b></td>
<td align="left" ><b>Ledger</b></td>
<td align="left" ><b>Payment Mode</b></td>
<td align="left" ><b>Total Received Amount</b></td>

<td align="left" ><b>Bill No.</b></td>
<td align="center" ><b>Amount</b></td>
<td align="left"  ><b>Discount Ledger</b></td>
<td align="left"  ><b>Discount Am.</b></td>
<td align="left"  ><b>Discount Remark</b></td>
</tr>
<?
$sln=0;
$ttotal_am=0;
$data1=mysqli_query($conn,"SELECT * FROM main_recv_app where sl>0 and cid='$cid' and bcd='$brncd' and stat='0'")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($data1))
{
$sln++;
$sl=$row1['sl'];
$blno=$row1['blno'];
$dt=$row1['dt'];
$nrtn=$row1['nrtn'];
$tamm=$row1['tamm'];
$refno=$row1['refno'];
$paymtd=$row1['paymtd'];
$dldgr=$row1['dldgr'];
$sman=$row1['eby'];
$dt=date('d-m-Y',strtotime($dt));

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
$tdisamm=0;
$query100 = "SELECT * FROM main_recv_dtl_app where  ref='$blno' order by sl";
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


$total_am+=$amm;
$tdisamm+=$damm;
if($blno==$blno1){$asd++;}	
?>
<tr>
<?php
if($asd==1)
{
	?>
	
	<td align="center"><?=$sln;?></td>
	<td align="center"><a href="javascript:can('<?=$sl;?>')"><font color="red"><b>Cancel</b></font></a></td>
	<td align="center"><?=$sman;?></td>
	<td align="center"><a href="javascript:get_app_val('<?=$blno;?>')"><font color="red"><b><?php echo $dt;?></b></font></a></td>
	<td align="center"><?php echo $refno;?></td>
	<td align="center"><?php echo $nrtn;?></td>
	<td align="left"><?php echo $ledgr_nm;?><b></b></td>
	<td align="center"><?php echo $mtd;?></td>
	<td align="center"><?php echo $tamm;?></td>
	<?
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
	<?
}
?>

<td  align="left"  ><b><?=$bill_no;?>.</b></td>

<td  align="right"  ><b><?=round($amm,2);?></b></td>
<td align="left" ><b><?=$dislam;?></b></td>
<td align="right" ><b><?=round($damm,2);?></b></td>
<td align="left" ><b><?=$remk;?></b></td>
</tr>
<?}
if($total_am>0)
{
?>
<tr bgcolor="#e8ecf6">
<td colspan="10" align="right"><b>Total</b></td>
<td align="right"><b><?php echo $total_am;?></b></td>
<td></td>
<td align="right"><b><?php echo $tdisamm;?></b></td>
<td></td>
</tr>
<?
}
$ttotal_am+=$total_am;
$ttdisamm+=$tdisamm;
}
?>
<tr>
<td colspan="10" align="right"><b>Grand Total</b></td>
<td align="right"><b><?php echo $ttotal_am;?></b></td>
<td></td>
<td align="right"><b><?php echo $ttdisamm;?></b></td>
<td></td>
</tr>
</table>
<div id="data8">
	
</div>
<script type="text/javascript">
function can(sl)
{
if(confirm('Are You Sure To Cancel !'))	
{
$('#data8').load('app_coll_can2.php?sl='+sl).fadeIn('fast');
}

}
</script>


