<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$snm=$_REQUEST['snm'];
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}

$query9 = "SELECT * FROM main_billing where gstin='' and amm>=250000 and gst='1' and fst!=tst $snm1 and  dt between '$fdt' and '$tdt'  and cstat='0'";
$result9 = mysqli_query($conn,$query9) or die(mysqli_error($conn));
?>
 <table  width="100%" class="advancedtable"  >
		
		<tr bgcolor="#e8ecf6">
            <td  align="center" style="padding-top:15px"><b>Invoice No.</b></td>
            <td  align="center" style="padding-top:15px"><b>Invoice Date</b></td>
            <td  align="center" style="padding-top:15px"><b>Invoice Value</b></td>
            <td  align="center" style="padding-top:15px"><b>Supply Type</b></td>
            <td  align="center" style="padding-top:15px"><b>Rate (%)</b></td>
			<td  align="center" style="padding-top:15px"><b>CGST Rate</b></td>
			<td  align="center" style="padding-top:15px"><b>SGST Rate</b></td>
			<td  align="center" style="padding-top:15px"><b>IGST Rate</b></td>
            <td  align="center" style="padding-top:15px"><b>Taxable Value</b></td>
            <td  align="center" style="padding-top:15px"><b>CESS Amount(Rs.)</b></td>
            <td  align="center" style="padding-top:15px"><b>E-Commerce GSTIN</b></td>
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
$igst_rt=0; 
$data= mysqli_query($conn,"select *,sum(net_am) as net_am,sum(tamm) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am from  main_billdtls where  blno='$invno' group by sgst_rt,sgst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$amm=$row['amm'];
$net_am=$row['net_am'];
$cgst_rt=$row['cgst_rt'];   
$tcgst=$row['cgst_am'];   
$sgst_rt=$row['sgst_rt'];   
$tsgst=$row['sgst_am'];   
$igst_rt=$row['igst_rt'];   
	
$tiamm+=$net_am;
$tttamm+=$amm;

$ttcgst+=$tcgst;
$ttsgst+=$tsgst;
?>
<tr bgcolor="#e8ecf6">
	<td  align="right" style="padding-top:15px"><b><?php  echo $invno;?></b></td>
	<td  align="right" style="padding-top:15px"><b><?php  echo $invdt;?></b></td>
	<td  align="right" style="padding-top:15px"><b><?php echo number_format($net_am,2);?></b></td>
	<td  align="right" style="padding-top:15px"><b>19-West Bengal</b></td>
	<td  align="right" style="padding-top:15px"><?php  echo $cgst_rt+$sgst_rt+$igst_rt?>%</td>
	<td  align="right" style="padding-top:15px"><?php  echo $cgst_rt?>%</td>
	<td  align="right" style="padding-top:15px"><?php  echo $sgst_rt?>%</td>
	<td  align="right" style="padding-top:15px"><?php  echo $igst_rt?>%</td>
	<td  align="right" style="padding-top:15px"><?php echo number_format($amm,2);?></td>
	<td  align="right" style="padding-top:15px">0.00</td>
	<td  align="right" style="padding-top:15px"></td>
</tr>
<?php 
}
}
?>
</table>