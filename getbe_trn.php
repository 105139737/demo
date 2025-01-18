<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$pcd=$_REQUEST['pcd'];
$fbcd=$_REQUEST['fbcd'];

$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$pcd'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}

?>
<select name="sih" id="sih" class="sc1" style="width:100%" tabindex="1">
<?php 
$data1 = mysqli_query($conn,"SELECT * FROM main_stock WHERE pcd='$pcd' and bcd='$fbcd' group by refno order by dt,sl desc");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$refno1=$row1['refno'];
$unit=$row1['unit'];
$queryx = "SELECT * FROM main_purchasedet where blno='$refno1' and prsl='$pcd'";
$resultx = mysqli_query($conn,$queryx)or die(mysqli_error($conn));
while ($rowx = mysqli_fetch_array ($resultx))
{
$mrp=round($rowx['mrp'],4);
}
$queryx = "SELECT * FROM main_purchase where blno='$refno1'";
$resultx = mysqli_query($conn,$queryx)or die(mysqli_error($conn));
while ($rowx = mysqli_fetch_array ($resultx))
{
$inv=$rowx['inv'];
$dt=$rowx['dt'];
$dt=date('d-m-Y', strtotime($dt));
}
if($inv==""){$inv=$refno1;}
$stck=0;
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and bcd='$fbcd' and refno='$refno1'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
if($stck=="")
{
$stck=0;	
}
else
{
if($stck>0)	
{
if($unit=='sun'){$stock_in=($stck/$smvlu)." ".$sun;}
if($unit=='mun'){$stock_in=($stck/$mdvlu)." ".$mun;}
if($unit=='bun'){$stock_in=($stck/$bgvlu)." ".$bun;}
}
}
	if($stck>0)	
	{
	?>
	<option value="<?php  echo $refno1?>"><?php  echo $stock_in;?> -- P.Rate <?php  echo $mrp;?> --- <?php  echo $inv?> -- <?php  echo $dt?></option>
	<?php 
	}
}
	
?>
</select>



