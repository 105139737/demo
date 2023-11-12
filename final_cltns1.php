<?
$reqlevel=3; 
include("membersonly.inc.php");
include("function.php");

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

/* dldgr	paymtd */
if($blno!=""){$blno11=" and blno='$blno'";}else{$blno11="";}
if($mdt!=""){$mdt1=" and paymtd='$mdt'";}else{$mdt1="";}
if($ledg!=""){$ledg1=" and dldgr='$ledg'";}else{$ledg1="";}

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

$file="Final Collection Report Details (".$fdt." To ".$tdt.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 

?>
<table border="1" width="100%" class="advancedtable">
<tr class="odd">
<td align="left" ><b>Sl. </b></td>
<td align="left" ><b>Voucher Type </b></td>
<td align="left" ><b>Voucher No. </b></td>
<td align="center"><b>Branch</b></td>
<td align="left" ><b>Sales Person </b></td>
<td align="left" ><b>Customer Name</b></td>
<td align="left" ><b>Date</b></td>
<td align="left" ><b>Ref. No.</b></td>
<td align="left" ><b>Narration</b></td>
<td align="left" ><b>Ledger</b></td>
<td align="left" ><b>Payment Mode</b></td>

<td align="left" ><b>Total Received Amount</b></td>
<td align="left" ><b>Adj.Am</b></td>
<td align="center" ><b>Credit-Note</b></td>


</tr>
<?
$sln=0;
$ttotal_am=0;
$data1=mysqli_query($conn,"SELECT * FROM main_recv where sl>0 $als1 $mdt1 $ledg1 $cid1 $salper1 $brncd1 $todts $stat1 ORDER BY sl")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($data1))
{

$sl=$row1['sl'];
$msl=$row1['sl'];
$blno=$row1['blno'];
$dt=$row1['dt'];
$nrtn=$row1['nrtn'];
$tamm=$row1['tamm'];
$refno=$row1['refno'];
$paymtd=$row1['paymtd'];
$dldgr=$row1['dldgr'];
$sman=$row1['spid'];
$cid=$row1['cid'];
$cstat=$row1['cstat'];
$bcd=$row1['bcd'];
$als=$row1['als'];
$dt=date('d-m-Y',strtotime($dt));

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



$vchno="";				
$data110= mysqli_query($conn,"select * from main_drcr where blno='$blno'")or die(mysqli_error($conn));
while ($row10 = mysqli_fetch_array($data110))
{
$vchno=$row10['blnon'];
}
$tamm=0;
$query100 = "SELECT sum(amm) as amm FROM main_recv_dtl where  ref='$blno' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{

$tamm=$R100['amm'];
}
$adj_amm=0;
if($dldgr==7)
{
$adj_amm=$tamm;
$tamm=0;
}
$crdt_amm=0;
if($dldgr=='5')
{
$crdt_amm=$tamm;
$tamm=0;
}


$sln++;
$ttamm+=$tamm;
$tadj_amm+=$adj_amm;
$tcrdt_amm+=$crdt_amm;
?>
<tr>
<td align="center"><?=$sln;?></td>
<td align="left"><?=$als;?></td>
<td align="left"><?=$vchno;?></td>
<td align="center"><?php echo $bnm;?></td>
<td align="left"><?=$sman;?></td>
<td align="left"><?=$cust_nm;?></td>
<td align="center">
<b><?php echo $dt;?></b>
</td>
<td align="center"><?php echo $refno;?></td>
<td align="left"><?php echo $nrtn;?></td>
<td align="left"><?php echo $ledgr_nm;?><b></b></td>
<td align="center"><?php echo $mtd;?></td>
<td align="center"><?php echo $tamm;?></td>
<td align="center"><?php echo $adj_amm;?></td>
<td align="center"><?php echo $crdt_amm;?></td>
</tr>
<?}
/*
if($total_am+$total_adj_am+$damm>0 and $a!=1)
{
?>
<tr bgcolor="#e8ecf6">
<td colspan="11" align="right"><b>Total</b></td>
<td align="right"><b><?php echo $total_am;?></b></td>
<td align="right"><b><?php echo $total_adj_am;?></b></td>
<td></td>
<td align="right"><b><?php echo $tdisamm;?></b></td>
<td></td>
<td></td>
</tr>
<?

}
*/



?>
<tr>
<td colspan="11" align="right"><b>Grand Total</b></td>
<td align="right"><b><?php echo $ttamm;?></b></td>
<td align="right"><b><?php echo $tadj_amm;?></b></td>
<td align="right"><b><?php echo $tcrdt_amm;?></b></td>

</tr>
</table>