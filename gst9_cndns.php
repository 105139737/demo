<?
$reqlevel = 3; 
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$sl=$_REQUEST['sl'];
$note_typ=$_REQUEST['note_typ'];
$tiamm=0;
$tttamm=0;
$tigst=0;
$tcess=0;
$ttcgst=0;
$ttsgst=0;
if($note_typ!=''){$note_typ1=" and note_typ='$note_typ'";}
$todt=" and dt between '$fdt' and '$tdt'";
$file="CN/DN_".date('Ymdhis').".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 

?>
 <table <?php if($sl=='1'){?>border="1"<?php }else{?> width="100%"<?php }?> class="advancedtable"  >
		
<tr bgcolor="#e8ecf6">
<td  align="right"  ><b>Rate (%)</b></td>
<td  align="right"><b>Taxable Value</b></td>
<td  align="center"><b>CGST </b></td>
<td  align="center"><b>SGST </b></td>
<td  align="center"><b>IGST </b></td>
<td  align="right"><b> Total Tax</b></td>
</tr>

<?
$tcgst=0;
$tsgst=0;
$net_am=0;
$cgst_rt=0;   
$cgst_am=0;   
$sgst_rt=0;   
$sgst_am=0; 
$igst_rt=0; 
$log=0;

$data= mysqli_query($conn,"select tax_rate,SUM(IF(SUBSTRING(sgstin, 1, 2)='19', tax, 0)) as cgst_am,SUM(IF(SUBSTRING(sgstin, 1, 2)!='19', tax, 0)) as igst_am,sum(amm) as amm from main_cdnr where sl>0 $todt $note_typ1 group by tax_rate order by tax_rate")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$amm=round($row['amm'],2);
$ret=round($row['tax_rate'],2);   
$cgst_am=round($row['cgst_am']/2,2);
$sgst_am=round($row['cgst_am']/2,2);
$igst_am=round($row['igst_am'],2);


$gst=$cgst_am+$sgst_am+$igst_am;

?>
<tr>
            <td  align="right"  ><?=$ret?></td>
            <td  align="right" ><?=$amm;?></td>
            <td  align="right"><?=$cgst_am?></td>
            <td  align="right" ><?=$sgst_am?></td>
            <td  align="right" ><?=$igst_am?></td>
            <td  align="right"><?=$gst?></td>
</tr>
<?
$amm1+=$amm;
$cgst_am1+=$cgst_am;
$sgst_am1+=$sgst_am;
$igst_am1+=$igst_am;
$gst1+=$gst;
}
?>
<tr class="even">
            <td  align="right"  >Total : </td>
            <td  align="right" ><?=$amm1;?></td>
            <td  align="right" ><?=$cgst_am1?></td>
            <td  align="right" ><?=$sgst_am1?></td>
            <td  align="right"><?=$igst_am1?></td>
            <td  align="right"><?=$gst1?></td>
</tr>
</table>


