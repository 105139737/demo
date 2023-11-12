<?php
$reqlevel = 3;
include("membersonly.inc.php");

$blno=rawurldecode($_REQUEST['blno']);
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$brncd=$_REQUEST['brncd'];
if($blno!=""){$blno_scarch=" and B1.blno like '%$blno%'";}else{$blno_scarch="";}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($fdt!="" && $tdt!=""){$todts=" and B1.dt between '$fdt' and '$tdt'";}else{$todts="";}
if($brncd==""){$brncd1="";}else{$brncd1=" and B1.bcd='$brncd'";}
date_default_timezone_set('Asia/Kolkata');
?>
<table  width="100%" class="advancedtable"  >

<?php
$cnt=0;
$select=mysqli_query($conn,"select B1.* from main_billing B1 INNER JOIN main_billing_edt_log B2 ON B1.blno=B2.blno where B1.sl>0".$blno_scarch.$todts.$brncd1);
while($row=mysqli_fetch_array($select))
{
$sl=$row['sl'];
$refsl=$row['refsl'];
$bill_typ=$row['bill_typ'];
$als=$row['als'];
$tp=$row['tp'];
$adrs=$row['adrs'];
$ssn=$row['ssn'];
$start_no=$row['start_no'];
$blno=$row['blno'];
$bill_no=$row['bill_no'];
$fst=$row['fst'];
$tst=$row['tst'];
$gst=$row['gst'];
$cid=$row['cid'];
$invto=$row['invto'];
$ship=$row['ship'];
$amm=$row['amm'];
$tamm=$row['tamm'];
$gstam=$row['gstam'];
$tcs=$row['tcs'];
$tcsam=$row['tcsam'];
$roff=$row['roff'];
$payam=$row['payam'];
$tpoint=$row['tpoint'];
$paid=$row['paid'];
$due=$row['due'];
$dldgr=$row['dldgr'];
$crdtp=$row['crdtp'];
$crfno=$row['crfno'];
$cbnm=$row['cbnm'];
$dt=$row['dt'];
$ddt=$row['ddt'];
$edt=$row['edt'];
$pdts=$row['pdts'];
$vat=$row['vat'];
$vatamm=$row['vatamm'];
$car=$row['car'];
$dis=$row['dis'];
$bcd=$row['bcd'];
$tmod=$row['tmod'];
$psup=$row['psup'];
$vno=$row['vno'];
$lpd=$row['lpd'];
$dur_mnth=$row['dur_mnth'];
$no_servc=$row['no_servc'];
$sfno=$row['sfno'];
$dpay=$row['dpay'];
$finam=$row['finam'];
$emiam=$row['emiam'];
$emi_mnth=$row['emi_mnth'];
$cust_typ=$row['cust_typ'];
$sale_per=$row['sale_per'];
$gstin=$row['gstin'];
$eby=$row['eby'];
$rstat=$row['rstat'];
$cstat=$row['cstat'];
$cu=$row['cu'];
$order_no=$row['order_no'];
$rv=$row['rv'];
$blno1=$row['blno1'];
$disl=$row['disl'];
$dstat=$row['dstat'];
$remk=$row['remk'];
$damm=$row['damm'];
$blnon=$row['blnon'];
$download=$row['download'];

$query="Select * from main_branch where sl='$bcd'";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];
}
$datad= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
}
$invnm="";
$datad1= mysqli_query($conn,"select * from main_cust where sl='$invto'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad1))
{
$invnm="(".$rowd['nm'].")";
$mob1=$rowd['cont'];
}
$gbit=mysqli_query($conn,"select * from main_state where sl='$tst'") or die (mysqli_error($conn));
while($GBi=mysqli_fetch_array($gbit))
{
$statnm=$GBi['sn'];
$statcd=$GBi['cd'];
}
?>
<tr bgcolor="#fd6a2a">
<td colspan="26"><font size="5" color="#FFF">Current Bill Details : <?echo $blno;?></font></td>
</tr>		
			<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Date</b></td>
			<td  align="center" ><b>Branch</b></td>
			<td  align="center" ><b>Customer</b></td>
			<td  align="center" ><b>To ST</b></td>
			<td  align="center" ><b>Amount</b></td>
			<td  align="center" ><b>Tax am</b></td>
			<td  align="center"><b>GST Am</b></td>
			<td  align="center"><b>TCS Am</b></td>
			<td  align="center"><b>Round</b></td>
			<td  align="center" ><b>Discount</b></td>
			<td  align="center"><b>Payable</b></td>
			<td  align="center" ><b>Paid</b></td>			
			<td  align="center" ><b>By</b></td>
			<td  align="center" ><b>Time</b></td>
			</tr>
	<tr bgcolor="">			
			<td  align="center" ><b><?echo date('d-m-Y',strtotime($dt));?></b></td>
			<td  align="center" ><b><?echo $bnm;?></b></td>
			<td  align="center" ><b><?=$nm;?> <b><?=$invnm;?></b></b></td>
			<td  align="center" ><b><?echo $statnm;?></b></td>
			<td  align="left"><b><?echo $amm;?></b></td>
			<td  align="center"><b><?echo $tamm;?></b></td>
			<td  align="center" ><b><?echo $gstam;?></b></td>
			<td  align="center" ><b><?echo $tcsam;?></b></td>
			<td  align="center" ><b><?echo $roff;?></b></td>
			<td  align="center" ><b><?echo $damm;?></b></td>
			<td  align="center" ><b><?echo $payam;?></b></td>
			<td  align="center" ><b><?echo $paid;?></b></td>
			<td  align="center" ><b><?echo $eby;?></b></td>
			<td  align="center" ><b><?echo $pdts;?></b></td>
			</tr>
	<?
	$pbill="";
	$sbill="";	
	$rbill="";
	$prbill="";
	$tout="";
	$tin="";
	$betno="";

?>

<tr bgcolor="#b9b9b9">
<td colspan="26"><font size="5" color="#FFF">Edit Bill Details : <?php echo $blno?></font></td>
</tr>		
			<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Date</b></td>
			<td  align="center" ><b>Branch</b></td>
			<td  align="center" ><b>Customer</b></td>
			<td  align="center" ><b>To ST</b></td>
			<td  align="center" ><b>Amount</b></td>
			<td  align="center" ><b>Tax am</b></td>
			<td  align="center"><b>GST Am</b></td>
			<td  align="center"><b>TCS Am</b></td>
			<td  align="center"><b>Round</b></td>
			<td  align="center" ><b>Discount</b></td>
			<td  align="center"><b>Payable</b></td>
			<td  align="center" ><b>Paid</b></td>			
			<td  align="center" ><b>By</b></td>
			<td  align="center" ><b>Time</b></td>
			</tr>
<?
$cnt=0;
$select1=mysqli_query($conn,"select * from main_billing_edt_log  where blno='$blno'");
while($row=mysqli_fetch_array($select1))
{
$sl=$row['sl'];
$refsl=$row['refsl'];
$bill_typ=$row['bill_typ'];
$als=$row['als'];
$tp=$row['tp'];
$adrs=$row['adrs'];
$ssn=$row['ssn'];
$start_no=$row['start_no'];
$blno=$row['blno'];
$bill_no=$row['bill_no'];
$fst=$row['fst'];
$tst=$row['tst'];
$gst=$row['gst'];
$cid=$row['cid'];
$invto=$row['invto'];
$ship=$row['ship'];
$amm=$row['amm'];
$tamm=$row['tamm'];
$gstam=$row['gstam'];
$tcs=$row['tcs'];
$tcsam=$row['tcsam'];
$roff=$row['roff'];
$payam=$row['payam'];
$tpoint=$row['tpoint'];
$paid=$row['paid'];
$due=$row['due'];
$dldgr=$row['dldgr'];
$crdtp=$row['crdtp'];
$crfno=$row['crfno'];
$cbnm=$row['cbnm'];
$dt=$row['dt'];
$ddt=$row['ddt'];
$edt=$row['edt'];
$pdts=$row['pdts'];
$vat=$row['vat'];
$vatamm=$row['vatamm'];
$car=$row['car'];
$dis=$row['dis'];
$bcd=$row['bcd'];
$tmod=$row['tmod'];
$psup=$row['psup'];
$vno=$row['vno'];
$lpd=$row['lpd'];
$dur_mnth=$row['dur_mnth'];
$no_servc=$row['no_servc'];
$sfno=$row['sfno'];
$dpay=$row['dpay'];
$finam=$row['finam'];
$emiam=$row['emiam'];
$emi_mnth=$row['emi_mnth'];
$cust_typ=$row['cust_typ'];
$sale_per=$row['sale_per'];
$gstin=$row['gstin'];
$eby=$row['eby'];
$rstat=$row['rstat'];
$cstat=$row['cstat'];
$cu=$row['cu'];
$order_no=$row['order_no'];
$rv=$row['rv'];
$blno1=$row['blno1'];
$disl=$row['disl'];
$dstat=$row['dstat'];
$remk=$row['remk'];
$damm=$row['damm'];
$blnon=$row['blnon'];
$download=$row['download'];

$query="Select * from main_branch where sl='$bcd'";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];
}
$datad= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
}
$invnm="";
$datad1= mysqli_query($conn,"select * from main_cust where sl='$invto'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad1))
{
$invnm="(".$rowd['nm'].")";
$mob1=$rowd['cont'];
}
$gbit=mysqli_query($conn,"select * from main_state where sl='$tst'") or die (mysqli_error($conn));
while($GBi=mysqli_fetch_array($gbit))
{
$statnm=$GBi['sn'];
$statcd=$GBi['cd'];
}
?>

	<tr bgcolor="">			
			<td  align="center" ><b><?echo date('d-m-Y',strtotime($dt));?></b></td>
			<td  align="center" ><b><?echo $bnm;?></b></td>
			<td  align="center" ><b><?=$nm;?> <b><?=$invnm;?></b></b></td>
			<td  align="center" ><b><?echo $statnm;?></b></td>
			<td  align="left"><b><?echo $amm;?></b></td>
			<td  align="center"><b><?echo $tamm;?></b></td>
			<td  align="center" ><b><?echo $gstam;?></b></td>
			<td  align="center" ><b><?echo $tcsam;?></b></td>
			<td  align="center" ><b><?echo $roff;?></b></td>
			<td  align="center" ><b><?echo $damm;?></b></td>
			<td  align="center" ><b><?echo $payam;?></b></td>
			<td  align="center" ><b><?echo $paid;?></b></td>
			<td  align="center" ><b><?echo $eby;?></b></td>
			<td  align="center" ><b><?echo $pdts;?></b></td>
			</tr>
	<?
	$pbill="";
	$sbill="";	
	$rbill="";
	$prbill="";
	$tout="";
	$tin="";
	$betno="";
}
}
?>
</table>
			