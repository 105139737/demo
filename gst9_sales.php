<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$sl=$_REQUEST['sl'] ?? "";
$tiamm=0;
$tttamm=0;
$tigst=0;
$tcess=0;
$ttcgst=0;
$ttsgst=0;
$amm1=0;
$cgst_am1=0;
$sgst_am1=0;
$igst_am1=0;
$gst1=0;
$todt=" and dt between '$fdt' and '$tdt' and can='0'";
$file="sale_".date('Ymdhis').".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 

?>
 <table <?php  if($sl=='1'){?>border="1"<?php  }else{?> width="100%"<?php  }?> class="advancedtable"  >
		
<tr bgcolor="#e8ecf6">
<td  align="right"  ><b>Rate (%)</b></td>
<td  align="right"><b>Taxable Value</b></td>
<td  align="center"><b>CGST </b></td>
<td  align="center"><b>SGST </b></td>
<td  align="center"><b>IGST </b></td>
<td  align="right"><b> Total Tax</b></td>
</tr>

<?php 
$data= mysqli_query($conn,"update main_billdtls,main_billing set main_billdtls.can=main_billing.cstat where main_billing.cstat>0 and  main_billing.dt between '$fdt' and '$tdt' and main_billdtls.blno=main_billing.blno")or die(mysqli_error($conn));

$tcgst=0;
$tsgst=0;
$net_am=0;
$cgst_rt=0;   
$cgst_am=0;   
$sgst_rt=0;   
$sgst_am=0; 
$igst_rt=0; 
$log=0;

$data= mysqli_query($conn,"select cgst_rt,sgst_rt,igst_rt,sum(tamm) as amm,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am,sum(igst_am) as igst_am from main_billdtls where sl>0 $todt group by (sgst_rt+cgst_rt+igst_rt) order by cgst_rt,igst_rt")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$amm=round($row['amm'],2);
$cgst_rt=round($row['cgst_rt'],2);   
$sgst_rt=round($row['sgst_rt'],2);    
$igst_rt=round($row['igst_rt'],2);  
$cgst_am=round($row['cgst_am'],2);
$sgst_am=round($row['sgst_am'],2);
$igst_am=round($row['igst_am'],2);

$ret=$cgst_rt+$sgst_rt+$igst_rt;
$gst=$cgst_am+$sgst_am+$igst_am;

?>
<tr>
            <td  align="right"  ><?php  echo $ret?></td>
            <td  align="right" ><?php  echo $amm;?></td>
            <td  align="right"><?php  echo $cgst_am?></td>
            <td  align="right" ><?php  echo $sgst_am?></td>
            <td  align="right" ><?php  echo $igst_am?></td>
            <td  align="right"><?php  echo $gst?></td>
</tr>
<?php 
$amm1+=$amm;
$cgst_am1+=$cgst_am;
$sgst_am1+=$sgst_am;
$igst_am1+=$igst_am;
$gst1+=$gst;
}
?>
<tr class="even">
            <td  align="right"  >Total : </td>
            <td  align="right" ><?php  echo $amm1;?></td>
            <td  align="right" ><?php  echo $cgst_am1?></td>
            <td  align="right" ><?php  echo $sgst_am1?></td>
            <td  align="right"><?php  echo $igst_am1?></td>
            <td  align="right"><?php  echo $gst1?></td>
</tr>
</table>


