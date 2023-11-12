<?
$reqlevel = 3; 
include("membersonly.inc.php");
$mtd=$_REQUEST['mtd'];
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=$_REQUEST['snm'];
$slp=$_REQUEST['slp'];

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
if($snm!=""){$snm1=" and cust='$snm'";}else{$snm1="";}
if($slp!=""){$slp1=" and eby='$slp'";}else{$slp1="";}


$dis1=0;
?>

<div class="row">
<div class="col-md-12">
<div class="col-md-12" style="background-color:#000"><font size="5" color="#fff">Visit List</font></div>
 <table  width="100%" class="advancedtable"  >
		
			<tr bgcolor="#e8ecf6">

			
			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>Date & Time</b></td>
			<td  align="center" ><b>Sales Person</b></td>
			<td  align="center" ><b>Customer Name</b></td>	
			<td  align="center" ><b>Remark</b></td>			
			<td  align="center" ><b>Map</b></td>
			

			</tr>
			 <?
		$sln=0;

$data1= mysqli_query($conn,"select * from  main_visit where sl>0 ".$todt.$snm1.$slp1." order by sl")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$sln++;
$bsl=$row1['sl'];
$dt=$row1['dt'];
$dt=date('d-m-Y', strtotime($dt));
$sid=$row1['cust'];
$remk=$row1['remk'];
$lat=$row1['lat'];
$lon=$row1['lon'];
$edtm=$row1['edtm'];
$eby=$row1['eby'];


$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
}

?>
<tr >
<td  align="center"  ><?=$sln;?></td>
<td  align="center" ><?=$edtm;?></td>		
<td  align="left" ><?=$eby;?></td>		
<td  align="left" ><?=$nm;?></td>		
<td  align="left" ><?=$remk;?></td>		
<td  align="left" >
<a href="map.php?lat=<?=$lat?>&lng=<?=$lon;?>&nm=<?=rawurlencode($nm);?>" target="_balnk"><font color="blue"><?=$lat?>,<?=$lon;?></font></a>
</td>		

</tr>	 
<?}?>
</table>
 </div>
