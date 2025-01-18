<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$pcd=P0000012;
$brncd=10;if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}

 $data= mysqli_query($conn,"select * from  main_product where sl='$pcd'")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{
	
$pname=$row['pname'];
$ret=$row['ret'];
}

?>

 <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
            <td  align="right" width="50%" ><font size="3"><b>Product Name :</b></font></td>
            <td  align="left">
			
<font size="3"><b><?php echo $pname;?></b></font>
            </td>
          </tr>
	  </table>
	   <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
			  <td  align="center" >
			<b>Sl</b>
			</td>
			 <td  align="center" >
			<b>Batch No.</b>
			</td>
          	<td  align="center" >
			<b>Expiry Date</b>
			</td>
			<td  align="center" >
			<b>Unit</b>
			</td>
			<td  align="center" >
			<b>Opening</b>
			</td>
			<td  align="center" >
			<b>In</b>
			</td>
			<td  align="center" >
			<b>Out</b>
			</td>
		   <td  align="center" >
			<b>Current</b>
			</td>
			<td  align="center" >
			<b>Sale Rate.</b>
			</td>
			<td  align="center" >
			<b>Stock Value</b>
			</td>
		     </tr>
			 <?php 
	$sln=0;	
	$stkf=0;
$stout1=0;
$stin1=0;
$open1=0;
$to1=0;	

$query3="Select * from ".$DBprefix."stock where pcd='$pcd' $brncd1  group by betno order by expdt";


$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{
$sl=$R3['sl'];
$betno=$R3['betno'];
//$ret=$R3['ret'];
$expdt=$R3['expdt'];

if($expdt!="0000-00-00")
{
$expdt=date('d-m-Y', strtotime($expdt));
}


 $datau= mysqli_query($conn,"select * from  main_product where sl='$pcd'")or die(mysqli_error($conn));
 
while ($rowu = mysqli_fetch_array($datau))
{
$c=$rowu['pkgunt'];
}

$query1="Select * from ".$DBprefix."unit where sl='$c'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$punt=$R1['pkgunt'];
$upkg=$R1['untpkg'];
$ptu=$R1['tunt'];
}


  $query41="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and betno='$betno' $brncd1 group by betno";

  
$result41 = mysqli_query($conn,$query41);
  while ($R4 = mysqli_fetch_array ($result41))
{
$stck=$R4['stck1'];
}
if($stck!=0)
{
$stkf=$stck/$ptu;
}

  $query6="Select sum(opst) as open from ".$DBprefix."stock where pcd='$pcd' and betno='$betno' $brncd1 group by betno";

  
$result6 = mysqli_query($conn,$query6);
  while ($R6 = mysqli_fetch_array ($result6))
{
$open=$R6['open'];
}
if($open!=0)
{
$open1=$open/$ptu;
}
  $query7="Select sum(stin) as stin from ".$DBprefix."stock where pcd='$pcd' and betno='$betno' $brncd1 group by betno";

$result7 = mysqli_query($conn,$query7);
  while ($R7 = mysqli_fetch_array ($result7))
{
$stin=$R7['stin'];
}
if($stin!=0)
{
$stin1=$stin/$ptu;
}
 $query8="Select sum(stout) as stout from ".$DBprefix."stock where pcd='$pcd' and betno='$betno' $brncd1 group by betno";

  
$result8 = mysqli_query($conn,$query8);
  while ($R8 = mysqli_fetch_array ($result8))
{
$stout=$R8['stout'];
}
if($stout!=0)
{
$stout1=$stout/$ptu;
}


$to=0;
$sv=0;

 
 $query4="Select sum(opst+stin-stout) as stck2 from ".$DBprefix."stock where pcd='$pcd' and betno='$betno' $brncd1 group by betno";

 
 
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck2=$R4['stck2'];
if($stck2!=0)
{
$stkf1=$stck2/$ptu;
$ret1=$ret;
$sv=$stkf1*$ret1;
}
}

$to=$to+$sv;
		 
		$sln++;	 
			 ?>
		   <tr>
		    <td  align="center" >
			<?php  echo $sln;?>
			</td>
			 <td  align="center" >
			<?php  echo $betno;?>
			</td>
            <td  align="center" >
			<?php  echo $expdt;?>
			</td>
			 <td  align="center" >
			<?php  echo $punt;?>
			</td>
			<td  align="center" >
		<?php  echo $open1;?>
			</td>
			<td  align="center" >
		<?php  echo $stin1;?>
			</td>
			<td  align="center" >
		<?php  echo $stout1;?>
			</td>
			<td  align="center" >
		<?php  echo $stkf;?>
			</td>
			<td  align="center" >
		<?php echo number_format($ret1,2);?>
			</td>
			<td   align="right" >
		<?php echo number_format($to,2);?>
			</td>
		
		     </tr>	 
<?php 
$to1=$to+$to1;
$stkf=0;
$stout1=0;
$stin1=0;
$open1=0;
}?>
<tr>
<td colspan="9" align="right">
<b>Total Value </b>
</td>
<td align="right" >
<b><?php echo number_format($to1,2);?></b>
</td>
</tr>

	  </table>

