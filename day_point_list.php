<?php 
$reqlevel = 3; 

include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$custnm=rawurldecode($_REQUEST['custnm']);

$brncd=$_REQUEST['brncd'];if($brncd==""){$brncd1="";}else{$brncd1="AND bcd='$brncd'";}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}
if($custnm!=""){$snm1=" and cid='$custnm'";}else{$snm1="";}

$dis1=0;
?>
<table  width="100%" class="advancedtable">
<tr bgcolor="#e8ecf6">
	<td  align="center" width="10%"><b>Sl</b></td>
	<td  align="center" width="25%"><b>Date</b></td>

	<td  align="center" width="25%"><b>Point</b></td>	
	<td  align="center" width="40%"><b>Customer</b></td>

</tr>
			 <?php 
		$sln=0;
		$point1=0;
	
$data1= mysqli_query($conn,"select sum(point)as point,dt,cid from  main_cust_point where sl>0 $todts $snm1 $brncd1 and stat='0' group by cid,dt ORDER BY cid,dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
	
	$edt=$row1['dt'];
	$cid=$row1['cid'];
	$point=$row1['point'];

	$point1=$point1+$point;
	if($car==""){$car=0;}
	if($dis==""){$dis=0;}
	$edt=date('d-m-Y', strtotime($edt));
	$sln++;
	
	
	$query = "SELECT * from ".$DBprefix."cust where sl='$cid'";
	$result = mysqli_query($conn,$query);
          while($row = mysqli_fetch_array($result))
		 {
                $cusl=$row['sl'];
                $cnm=$row['nm'];
               $cnt=$row['cont'];
               
                }
	
	
	
	?>
		   <tr >
			
		
			<td  align="center"><?php  echo $sln;?></td>
			<td  align="center"><?php  echo $edt;?></td>
			<td  align="center"><?php  echo $point;?></td>	
			<td  align="left"> <?php  echo $cusl;?>. <?php  echo $cnm;?> (<?php  echo $cnt;?>) </td>
			</tr>	 
<?php }?>
   <tr >
			
		
			<td colspan="2" align="right"><b>Total : </b></td>
			
			<td  align="center"><b><?php  echo $point1;?></b></td>	
			<td  align="left">  </td>
			</tr>	
 


	  </table>