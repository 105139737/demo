<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$sid=$_REQUEST['sl'];
$brncd=$_REQUEST['brncd'] ?? "";
if($brncd=="")
{
$brncd1="";
}
else
{
	$brncd1=" and bcd='$brncd'";
}
 $data= mysqli_query($conn,"select * from  main_catg where sl='$sid'")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{
	
$cnm=$row['cnm'];
}

?>

 <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
            <td  align="right" width="50%" ><font size="3"><b>Category :</b></font></td>
            <td  align="left">
			
<font size="3"><b><?php echo $cnm;?></b></font>
            </td>
          </tr>
	  </table>
	   <table  class="table table-hover table-striped table-bordered"  >
		
		     <tr>
			  <td  align="center" >
			<b>Sl</b>
			</td>
			 <td  align="center" >
			<b>Product Name</b>
			</td>
          	<td  align="center" >
			<b>Co</b>
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
			<b>Stock Value</b>
			</td>
		     </tr>
			 <?php 
	$sln=0;	
$to1=0;	

$query = "SELECT * FROM ".$DBprefix."product where csl='$sid' group by pname";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$pcd=$R['sl'];
$co=$R['co'];
$pname=$R['pname'];
$c=$R['pkgunt'];
$ret=$R['ret'];

$open1=0;
$stin1=0;
$stout1=0;
$stkf=0;

$query1="Select * from ".$DBprefix."unit where sl='$c'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$punt=$R1['pkgunt'];
$upkg=$R1['untpkg'];
$ptu=$R1['tunt'];
}


$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd'".$brncd1;
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
if($ptu!=0 and $stck!=0)
{
$stkf=$stck/$ptu;
}

    $query6="Select sum(opst) as open from ".$DBprefix."stock where pcd='$pcd'".$brncd1;
 
$result6 = mysqli_query($conn,$query6);
  while ($R6 = mysqli_fetch_array ($result6))
{
$open=$R6['open'];
}
if($ptu!=0 and $open!=0)
{
$open1=$open/$ptu;
}

    $query7="Select sum(stin) as stin from ".$DBprefix."stock where pcd='$pcd'".$brncd1;
  
$result7 = mysqli_query($conn,$query7);
  while ($R7 = mysqli_fetch_array ($result7))
{
$stin=$R7['stin'];
}
if($ptu!=0 and $stin!=0)
{
$stin1=$stin/$ptu;
}

    $query8="Select sum(stout) as stout from ".$DBprefix."stock where pcd='$pcd'".$brncd1;
$result8 = mysqli_query($conn,$query8);
  while ($R8 = mysqli_fetch_array ($result8))
{
$stout=$R8['stout'];
}
if($ptu!=0 and $stout!=0)
{
$stout1=$stout/$ptu;
}


$to=0;

 
$ret1=$ret*$ptu;
$sv=$stkf*$ret1;



		 
		$sln++;	 
			 ?>
		   <tr>
		    <td  align="center" >
			<?php  echo $sln;?>
			</td>
			 <td  align="center" >
			<?php  echo $pname;?>
			</td>
            <td  align="center" >
			<?php  echo $co;?>
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
		
			<td   align="right" >
		<?php echo number_format($sv,2);?>
			</td>
		
		     </tr>	 
<?php 
$to1=$sv+$to1;
$stkf=0;
$stout1=0;
$stin1=0;
$open1=0;
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

