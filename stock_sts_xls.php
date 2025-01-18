<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$pnm=$_REQUEST[pnm];
$y=$_REQUEST[y];
$m=$_REQUEST[m];
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$tdt=$y."-".$m."-01";
$fdt=$y."-".$m."-31";
if($pnm!="")
{
	$all1=" and sl='$pnm'";
}
else
{
$all1="";	
}
$mm=date('M', strtotime($m));

$file="Stock_Statement_as_On_".$mm.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 



?>


  <table border="1" >

		
	

		     <tr>

			  <td  align="center" >

			<b>Sl</b>

			</td>

			 <td  align="center" >

			<b>Product Name</b>

			</td>

			<td  align="center" >

			<b>Opening Balance</b>

			</td>

			<td  align="center" >

			<b>IN</b>

			</td>

			<td  align="center" >

			<b>OUT</b>

			</td>
				<td  align="center" >

			<b>In Transit</b>

			</td>

		   <td  align="center" >

			<b>Balance</b>

			</td>

			<td  align="right" >

			<b>Rate</b>

			</td>

			<td  align="right" >

			<b>Value (Rs.)</b>

			</td>

		     </tr>

<?php 



$sl=$start;

$c1='odd';

$c3=0;

$sln=0;

$open1=0;

$stkf=0;

$stin1=0;

$stout1=0;

 $data= mysqli_query($conn,"select * from  main_product where sl!='' $all1 order by pnm")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	$c3++;
$slno=$row['sl'];
$pcd=$row['sl'];
$pnm=$row['pnm'];
$cat=$row['cat'];
$bnm=$row['bnm'];
$mnm=$row['mnm'];

$sln++;

$cnm="";				
$data1= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$cnm=$row1['cnm'];
}
$brand="";
$data2= mysqli_query($conn,"select * from main_brand where sl='$bnm'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$brand=$row1['brand'];
}
$ptu="1"; 
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$fdt'".$brncd1;

$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
$stkf=$stck;
$open=0;
  $query6="Select sum(opst+stin-stout) as open from ".$DBprefix."stock where pcd='$pcd' and dt<'$tdt'".$brncd1;
$result6 = mysqli_query($conn,$query6);
  while ($R6 = mysqli_fetch_array ($result6))
{
$open=$R6['open'];
}
$open1=$open;

 $query7="Select sum(stin) as stin from ".$DBprefix."stock where pcd='$pcd' and dt between '$tdt' and '$fdt'".$brncd1;

$result7 = mysqli_query($conn,$query7);
  while ($R7 = mysqli_fetch_array ($result7))
{
$stin=$R7['stin'];
}
$stin1=$stin;
$stout="0";
$query8="Select sum(stout) as stout from ".$DBprefix."stock where pcd='$pcd' and dt between '$tdt' and '$fdt'  and stat='1'".$brncd1;

$result8 = mysqli_query($conn,$query8);
while ($R8 = mysqli_fetch_array ($result8))
{
$stout=$R8['stout'];
}
$stout1=$stout;
$it=0;
$query8="Select sum(stout) as it from ".$DBprefix."stock where pcd='$pcd' and dt between '$tdt' and '$fdt' and stat='0'".$brncd1;

$result8 = mysqli_query($conn,$query8);
while ($R8 = mysqli_fetch_array ($result8))
{
$it=$R8['it'];
}
if($it=="")
{
	$it=0;
}

$to=0;
$ret="";
 $query3="Select * from ".$DBprefix."stock where pcd='$pcd' order by ret";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{
$ret=$R3['ret'];
}	


if($stkf!=0)

{

$stkf1=$stkf;

$ret1=$ret;

$sv=$stkf1*$ret1;

}





$to=$to+$sv;

		 

		

			 ?>

		   <tr  >

		   

		    <td  align="center" >

			<?php  echo $sln;?>

			</td>

			 <td  align="left" style="cursor:pointer" >

	<?php  echo $pnm;?> - <?php  echo $cnm;?> - <?php  echo $brand;?> - <?php  echo $mnm;?>

			</td>

			 <td  align="center" >

			<?php echo $open1;?>

			</td>

            <td  align="center" >

			<?php  echo $stin1;?>

			</td>

			 <td  align="center" >

			<?php  echo $stout1;?>

			</td>
			 <td  align="center" >

			<?php  echo $it;?>

			</td>

			<td  align="center" >

		<?php  echo $stkf;?>

			</td>

			<td  align="right" >

		<?php echo number_format($ret,2);;?>

			</td>

			<td  align="right" >

		<?php echo number_format($sv,2);?>

			</td>

	

		

		     </tr>	 

<?php 

$to1=$to+$to1;

$stkf=0;

$stout1=0;

$stin1=0;

$open1=0;

  $sv=0;   

}?>

<tr>

<td colspan="8" align="right">

<b>Total Value </b>

</td>

<td align="right" >

<b><?php echo number_format($to1,2);?></b>

</td>

</tr>



	  </table>

