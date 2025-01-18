<?php 
$reqlevel = 3; 
include("membersonly.inc.php");

ini_set('display_errors',0);
$edtm=$_REQUEST['edtm'];
$catsl=$_REQUEST['cat'];
if($catsl==""){$catsl1="";}else{$catsl1=" and cat='$catsl'";}

$file="Price_".$edtm."_.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file");  

?>
<table  border="1" >
	<tr  bgcolor="#e8ecf6">	
	<td  align="center" ><b>Date</b></td>	
	<td  align="center" ><b>Inv No.</b></td>	
	<td  align="center" ><b>CompanyName</b></td>	
	<td  align="center" ><b>ModelName</b></td>
	<td  align="center" ><b>Rate</b></td>
	<td  align="center" ><b>DPROFIT%</b></td>
	<td  align="center" ><b>DLRCAL</b></td>
	<td  align="center" ><b>DLR-NLC</b></td>
	<td  align="center" ><b>Dis%</b></td>
	<td  align="center" ><b>DisAm</b></td>
	<td  align="center" ><b>InvPrc</b></td>
	<td  align="center" ><b>RPROFIT%</b></td>
	<td  align="center" ><b>RTLCal</b></td>
	<td  align="center" ><b>OfferPrice</b></td>
	<td  align="center" ><b>OFFERLESS%</b></td>
	<td  align="center" ><b>LastPrice</b></td>
	</tr>
	<?php 
$sln=0;
$sln1=0;
$data= mysqli_query($conn,"select * from  main_priceupload where edtm='$edtm' $catsl1 order by sl")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	$sl=$row['sl'];
	$dt=$row['dt'];
	$pdt=$row['pdt'];
	$blno=$row['blno'];
	$sup=$row['sup'];
	$cat=$row['cat'];
	$scat=$row['scat'];
	$pcd=$row['pcd'];
	$rate=$row['rate'];
	$dp=$row['dp'];
	$dnlc=$row['dnlc'];
	$pldnlc=$row['pldnlc'];
	$dpdisp=$row['dpdisp'];
	$dpdisam=$row['dpdisam'];
	$invprc=$row['invprc'];
	$rprft=$row['rprft'];
	$retoff=$row['retoff'];
	$offprc=$row['offprc'];
	$offless=$row['offless'];
	$lprc=$row['lprc'];
	$edtm=$row['edtm'];
	$eby=$row['eby'];
	$spn="";
	$nm="";
	$datad= mysqli_query($conn,"select * from main_suppl where sl='$sup'")or die(mysqli_error($conn));
	while ($rowd = mysqli_fetch_array($datad))
	{
	$spn=$rowd['spn'];
	$nm=$rowd['nm'];
	}
	
	$pnm="";
	$query6="select * from  ".$DBprefix."product where sl='$pcd'";
	$result5 = mysqli_query($conn,$query6);
	while($row=mysqli_fetch_array($result5))
	{
	$pnm=$row['pnm'];
	}
	$datad111= mysqli_query($conn,"select * from main_purchase where blno='$blno'")or die(mysqli_error($conn));
	while ($rowd = mysqli_fetch_array($datad111))
	{
	$inv=$rowd['inv'];
	}
	$pdt=date('d-m-Y', strtotime($pdt));
$sln++;
	?>
	<tr>	
	<td align="left" ><b><font ><?php  echo $pdt;?></font></b></td>
	<td align="left" ><b><font  ><?php  echo $inv;?></font></b></td>
	<td  align="left" ><b><font  ><?php  echo $spn;?></font></b></td>
	<td  align="left" ><b><?php  echo $pnm;?></b> </td>
	<td  align="right" ><?php echo round($rate,2);?></td>
	<td  align="right" ><?php echo round($dp,2);?></td>
	<td  align="right" ><?php echo round($dnlc,2);?></td>
	<td  align="right" ><?php echo round($pldnlc,2);?></td>
	<td  align="right" ><?php echo round($dpdisp,2);?></td>
	<td  align="right" ><?php echo round($dpdisam,2);?></td>
	<td  align="right" ><?php echo round($invprc,2);?></td>
	<td  align="right" ><?php echo round($rprft,2);?></td>
	<td  align="right" ><?php echo round($retoff,2);?></td>
	<td  align="right" ><?php echo round($offprc,2);?></td>
	<td  align="right" ><?php echo round($offless,2);?></td>
	<td  align="right" ><?php echo round($lprc,2);?></td>
	</tr>
<?php 
}
?>
</table>

<style>.no-print{
display: none;
}</style>
