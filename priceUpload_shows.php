<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
include "function.php";

ini_set('display_errors',0);
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$cat=$_REQUEST['cat'];
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
?>
<table  class="advancedtable" width="100%" >
	<tr  bgcolor="#e8ecf6">	
	<td  align="center" ><b>Sl</b></td>	
	<td  align="left" ><b>Date & Time</b></td>	
	<td  align="center" ><b>Export</b></td>	
	
	</tr>
	<?php 
$sln=0;
$sln1=0;
$data= mysqli_query($conn,"select * from  main_priceupload where sl>0 $todt  group by edtm")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$sl=$row['sl'];
$edtm=$row['edtm'];

$sln1++;
	?>
	<tr>	
	<td align="center" ><b><font ><?php  echo $sln1;?></font></b></td>
	<td  align="left" ><b><font ><?php  echo $edtm;?></font></b></td>
	<td  align="center" ><b><a  href="priceUpload_show_xls.php?edtm=<?php  echo $edtm;?>&cat=<?php  echo $cat;?>" >Export To Excel</a></b> </td>
	</tr>
	
<?php 
}
?>
</table>

<style>.no-print{
display: none;
}</style>
