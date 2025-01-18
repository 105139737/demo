<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$snm=$_REQUEST['snm'];
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}
$file="GST B2CL Report $fdt to $tdt.xls";
header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); 
header("Content-Disposition: attachment; filename=$file");
$query9 = "SELECT * FROM main_billing where gstin='' and amm>=250000 and gst='1' $snm1 and  dt between '$fdt' and '$tdt'";
$result9 = mysqli_query($conn,$query9) or die(mysqli_error($conn));
?>
 <table  width="100%" border="1">
		
		<tr bgcolor="#e8ecf6">
            <td  align="right"><b>Invoice No.</b></td>
            <td  align="right"><b>Invoice Date</b></td>
            <td  align="right"><b>Invoice Value</b></td>
            <td  align="right"><b>Supply Type</b></td>
            <td  align="right"><b>Rate (%)</b></td>
            <td  align="right"><b>Taxable Value</b></td>
            <td  align="right"><b>CESS Amount(Rs.)</b></td>
</tr>
<?php 
//echo $tdt;
$ttcgst=0;
$ttsgst=0;
while ($R9 = mysqli_fetch_array ($result9))
{
$gstin_cu=$R9['gstin'];
$invno=$R9['blno'];
$invdt=$R9['dt'];	

$amm=0;
$net_am=0;
$cgst_rt=0;   
$cgst_am=0;   
$sgst_rt=0;   
$sgst_am=0; 
$data= mysqli_query($conn,"select *,sum(net_am) as net_am,sum(ttl) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am from  main_billdtls where  blno='$invno' group by sgst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$amm=$row['amm'];
$net_am=$row['net_am'];
$cgst_rt=$row['cgst_rt'];   
$tcgst=$row['cgst_am'];   
$sgst_rt=$row['sgst_rt'];   
$tsgst=$row['sgst_am'];   
	
$tiamm+=$net_am;
$tttamm+=$amm;

$ttcgst+=$tcgst;
$ttsgst+=$tsgst;
?>
<tr bgcolor="#e8ecf6">
	<td  align="right"><b><?php  echo $invno;?></b></td>
	<td  align="right"><b><?php  echo $invdt;?></b></td>
	<td  align="right"><b><?php echo number_format($net_am,2);?></b></td>
	<td  align="right"><b>19-West Bengal</b></td>
	<td  align="right"><?php  echo $cgst_rt+$sgst_rt?>%</td>
	<td  align="right"><?php echo number_format($amm,2);?></td>
	<td  align="right">0.00</td>
</tr>
<?php 
}
}
?>
</table>