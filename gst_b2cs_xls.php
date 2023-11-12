<?
$reqlevel = 3; 
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$file="GST B2CS Report $fdt to $tdt.xls";
header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); 
header("Content-Disposition: attachment; filename=$file");

$tiamm=0;
$tttamm=0;
$tigst=0;
$tcess=0;
$ttcgst=0;
$ttsgst=0;
?>
 <table  width="100%" border="0">
		
		<tr>
          <td  align="right" colspan="2"><b>Type</b></td>
            <td  align="right" colspan="2"><b>Place Of Supply</b></td>
            <td  align="right"><b>Rate (%)</b></td>
			<td  align="right"><b>Taxable Value</b></td>
            <td  align="right"><b>CESS Amount</b></td>
</tr>

<?
//echo $tdt;
$tcgst=0;
$tsgst=0;
$net_am=0;
$cgst_rt=0;   
$cgst_am=0;   
$sgst_rt=0;   
$sgst_am=0; 
$log=0;
$data= mysqli_query($conn,"select main_billdtls.cgst_rt,main_billdtls.sgst_rt,sum(main_billdtls.net_am) as net_am,sum(main_billdtls.ttl) as amm,sum(main_billdtls.cgst_am) as cgst_am,sum(main_billdtls.sgst_am) as sgst_am from main_billdtls INNER JOIN main_billing ON main_billdtls.blno=main_billing.blno where main_billing.gstin='' and main_billing.amm<250000 and main_billing.dt between '$fdt' and '$tdt' and main_billing.gst='1' group by sgst_rt order by sgst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$amm=$row['amm'];
$net_am=$row['net_am'];
$cgst_rt=$row['cgst_rt'];   
$tcgst=$row['cgst_am'];   
$sgst_rt=$row['sgst_rt'];   
$tsgst=$row['sgst_am'];   
	
$tiamm+=$net_am;
$tttamm=$amm;
$ttcgst+=$tcgst;
$ttsgst+=$tsgst;

?>
<tr class="even">
            <td  align="right" colspan="2">Other than E-Commerce</td>
            <td  align="right" colspan="2">19-West Bengal</td>
            <td  align="right"><?=$cgst_rt+$sgst_rt?>%</td>
            <td  align="right"><?=number_format($tttamm,2);?></td>
            <td  align="right">0.00</td>
</tr>
<?
}
?>
</table>
