<?
$reqlevel=3; 
include("membersonly.inc.php");
include("function.php");

$cid=rawurldecode($_REQUEST['cid']);
$salper=rawurldecode($_REQUEST['salper']);
$brncd=rawurldecode($_REQUEST['brncd']);
$fdt=rawurldecode($_REQUEST['fdt']);
$tdt=rawurldecode($_REQUEST['tdt']);
$stat=rawurldecode($_REQUEST['stat']);
$vstat=rawurldecode($_REQUEST['vstat']);

if($cid!=""){$cid1=" and cid='$cid'";}else{$cid1="";}
if($salper!=""){$salper1=" and sale_per='$salper'";}else{$salper1="";}
if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($stat==""){$stat1="";}else{$stat1=" and cstat='$stat'";}
if($vstat==""){$vstat1="";}else{$vstat1=" and vstat='$vstat'";}

if($fdt!="" and $tdt!="")
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}

?>
<table width="100%" class="advancedtable">
<tr bgcolor="000">
<td colspan="26"><font size="5" color="#fff">Order Details</font></td>
</tr>		
<tr bgcolor="#e8ecf6">
<td align="center"><b>Sl</b></td>
<td align="center"><b>Action</b></td>
<td align="center"><b>Status</b></td>
<td align="center"><b>Date</b></td>
<td align="center"><b>Sales Person</b></td>
<td align="center"><b>Order No</b></td>
<td align="center"><b>Customer Name</b></td>
<td align="center"><b>Branch</b></td>
<td align="center"><b>Godown</b></td>
<td align="center"><b>Model Name</b></td>
<td align="center"><b>HSN Code</b></td>
<td align="center"><b>Quantity</b></td>
</tr>
<?
$sln=0;
//echo "SELECT * FROM main_order where sl>0 $cid1 $salper1 $brncd1 $todts $stat1 ORDER BY sl";
$data1=mysqli_query($conn,"SELECT * FROM main_order where sl>0 $cid1 $salper1 $brncd1 $todts $stat1 $vstat1 ORDER BY sl")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($data1))
{
	$sln++;
	$sl=$row1['sl'];
	$blno=$row1['blno'];
	$gst=$row1['gst'];
	$cid=$row1['cid'];
	$sale_per=$row1['sale_per'];
	$cstat=$row1['cstat'];
	$dt=$row1['dt'];
	$bcd=$row1['bcd'];
	$vstat=$row1['vstat'];
if($cstat=='0'){$cstat1="Pending";}elseif($cstat=='1'){$cstat1="Done";}elseif($cstat=='2'){$cstat1="Canceled";}
	$dt=date('d-m-Y',strtotime($dt));

	$asd=0;
	$qttl=0;
	$cust_nm="";
	$datad1= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
	while ($rowd = mysqli_fetch_array($datad1))
	{
		$cust_nm=$rowd['nm'];
	}
	$bnm="";
	$data12=mysqli_query($conn,"select * from main_branch where sl='$bcd'")or die(mysqli_error($conn));
	while ($row1=mysqli_fetch_array($data12))
	{
	$bnm=$row1['bnm'];
	}
	$pcss=0;
	$data=mysqli_query($conn,"SELECT * FROM main_orderdtls WHERE sl>0 AND blno='$blno'")or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($data))
	{
		$cat=$row['cat'];
		$scat=$row['scat'];	
		$pcd=$row['prsl'];
		$blno1=$row['blno'];
		$unit=$row['unit'];
		$pcs=$row['pcs'];
		$godown=$row['bcd'];

		$pcss=$pcss+$pcs;

		$get=mysqli_query($conn,"select * from main_unit where cat='$pcd'") or die(mysqli_error($conn));
		while($roww=mysqli_fetch_array($get))
		{
			$sun=$roww['sun'];
			$mun=$roww['mun'];
			$bun=$roww['bun'];
			$smvlu=$roww['smvlu'];
			$mdvlu=$roww['mdvlu'];
			$bgvlu=$roww['bgvlu'];
		}
		if($unit=='sun'){$unit_nm=$sun;}
		if($unit=='mun'){$unit_nm=$mun;}
		if($unit=='bun'){$unit_nm=$bun;}
	$cnm="";				
	$data12= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
	while ($row1 = mysqli_fetch_array($data12))
	{
	$cnm=$row1['cnm'];
	}
	$scat_nm="";
	$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
	while ($row1 = mysqli_fetch_array($data2))
	{
		$scat_nm=$row1['nm'];
		$hsn=$row1['hsn'];
	}
	$pnm="";
	$query6="select * from  ".$DBprefix."product where sl='$pcd'";
	$result5 = mysqli_query($conn,$query6);
	while($row=mysqli_fetch_array($result5))
	{
	$pnm=$row['pnm'];
	}
	$gnm="";
	$query6="select * from  main_godown where sl='$godown'";
	$result5 = mysqli_query($conn,$query6);
	while($row=mysqli_fetch_array($result5))
	{
	$gnm=$row['gnm'];
	}

	if($blno==$blno1){$asd++;}	
?>
<tr>
<?php
if($asd==1)
{
	?>
	<td align="center"><?=$sln;?></td>
	<td align="center">
	<?
	if($cstat==0)
	{
	?>
	<a href="javascript:del('<?=$blno;?>');"><font color="red"><b>Cancel</b></font></a>
	<a href="order_edt.php?blno=<?=$blno;?>" target="_blank"><font color="blue">Edit</font></a>
	
		<?
		if($vstat==0)
		{
		 ?><a onclick="act('<? echo $blno;?>','1')"><font color="blue">Verify</font></a><?
		}
		if($vstat==1)
		{
		 ?><font color="green"><b>Verified</b></font><?
		}
	
	}
	else
	{
		echo 'NA';
	}
	?>
	<br/>
	
	
	</td>
	<td align="center"><?php echo $cstat1;?></td>
	<td align="center"><?php echo $dt;?></td>
	<td align="center"><?php echo $sale_per;?></td>
	<?
	if($cstat==0)
	{
	?>
	<td align="center"><a href="#" onclick="view('<?=$blno;?>')" ><?=$blno;?></a></td>
	<?
	}
	else
	{
	?>
	<td align="center"><?=$blno;?></td>	
	<?
	}
	?>
	
	<td align="left"><?php echo $nm;?><b><?php echo $cust_nm;?></b></td>
	<td align="center"><?php echo $bnm;?></td>
	<?
}
else
{
	?>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<?
}
?>
<td align="center"><?php echo $gnm;?></td>
<td align="left" title="<?=$pcd;?>"><?=$pnm;?></td>
<td align="center"><?php echo $hsn;?></td>
<td align="center"><?php echo "$pcs $unit_nm";?></td>
</tr>
<?
}
if($pcss!=0)
{
	?>
	<tr bgcolor="#e8ecf6">
	<td colspan="9" align="right"><b>Total</b></td>
	<td></td>
	<td></td>

	<td align="center"><b><?php echo $pcss;?></b></td>
	</tr>
	<?
}
	$tpcss=$tpcss+$pcss;
}
?>
<tr>
<td colspan="9" align="right"><b>Grand Total</b></td>
<td></td>
<td></td>

<td align="center"><b><?php echo $tpcss;?></b></td>
</tr>
</table>