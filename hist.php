<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$betno1="";
$opst1=0;
$stin1=0;
$stout1=0;
$pnm=$_REQUEST['pcd'];
$betno=rawurldecode($_REQUEST['betno']);


if($betno!=""){$betno1=" and betno like '%$betno%'";}
date_default_timezone_set('Asia/Kolkata');
?>
<table  width="100%" class="advancedtable"  >
<tr bgcolor="000">
<td colspan="26"><font size="5" color="#fff">Product Details</font></td>
</tr>		
			<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>Date</b></td>
			<td  align="center" ><b>Product Name</b></td>
			<td  align="center" ><b>Open</b></td>
			<td  align="center" ><b>In</b></td>
			<td  align="center" ><b>Out</b></td>
			<td  align="center"><b>Type</b></td>
			<td  align="center"><b>Serial No</b></td>
			<td  align="center"><b>Purchase Bill No</b></td>
			<td  align="center"><b>Sell Bill No</b></td>
			<td  align="center" ><b>Purchase Return Bill No</b></td>
			<td  align="center" ><b>Sell Return Bill No</b></td>
			<td  align="center" ><b>Transfer In Bill No</b></td>
			<td  align="center" ><b>Transfer Out Bill No</b></td>
			</tr>
<?php 
$cnt=0;
$sql=mysqli_query($conn,"select * from main_stock where pcd='$pnm' $betno1 order by dt") or die (mysqli_error($conn));
while($r=mysqli_fetch_array($sql))
{
	$dt=$r['dt'];
	$pcd=$r['pcd'];
	$opst=$r['opst'];
	$stin=$r['stin'];
	$stout=$r['stout'];
	$nrtn=$r['nrtn'];
	$betno=$r['betno'];
	$pbill=$r['pbill'];
	$sbill=$r['sbill'];	
	$rbill=$r['rbill'];
	$prbill=$r['prbill'];
	$tout=$r['tout'];
	$tin=$r['tin'];
	
	if($opst>0)
	{
		$qnty=$opst;
	}
	else if($stin>0)
	{
		$qnty=$stin;
	}
	else if($stin>0)
	{
		$qnty=$stout;
	}
	$opst1+=$opst;
	$stin1+=$stin;
	$stout1+=$stout;
	
	$cnt++;
	$data1 = mysqli_query($conn,"Select * from main_product where sl='$pcd' ");
while ($row1 = mysqli_fetch_array($data1))
{

$pnm=$row1['pnm'];
}
	?>
	<tr bgcolor="">
			<td  align="center" ><b><?php echo $cnt;?></b></td>
			<td  align="center" ><b><?php echo date('d-m-Y',strtotime($dt));?></b></td>
			<td  align="center" ><b><?php echo $pnm;?></b></td>
			<td  align="center" ><b><?php echo $opst;?></b></td>
			<td  align="center" ><b><?php echo $stin;?></b></td>
			<td  align="center" ><b><?php echo $stout;?></b></td>
			<td  align="left"><b><?php echo $nrtn;?></b></td>
			<td  align="center"><b><?php echo $betno;?></b></td>
			<td  align="center"><b>
			<?php 
			if($user_current_level < 0){
			?>
			<a href="purchase_edit.php?blno=<?php  echo $pbill;?>" target="_Blank"><?php echo $pbill;?></a>
			<?php }
			else
			{
			?>
			<?php echo $pbill;?>
			<?php }?>
			</b></td>
			<td  align="center"><b><a href="billing_edit.php?blno=<?php  echo $sbill;?>" target="_Blank"><?php echo $sbill;?></a></b></td>
			<td  align="center" ><b><?php echo $rbill;?></b></td>
			<td  align="center" ><b><?php echo $prbill;?></b></td>
			<td  align="center" ><b><?php echo $tout;?></b></td>
			<td  align="center" ><b><?php echo $tin;?></b></td>
			</tr>
	<?php 
	$pbill="";
	$sbill="";	
	$rbill="";
	$prbill="";
	$tout="";
	$tin="";
	$betno="";
}
?>
<tr>
			<td  align="right" colspan="3"><b>Total : </b></td>
			<td  align="center" ><b><?php echo $opst1;?></b></td>
			<td  align="center" ><b><?php echo $stin1;?></b></td>
			<td  align="center" ><b><?php echo $stout1;?></b></td>
			<td  align="left"><b>= <?php echo ($opst1+$stin1)-$stout1?></b></td>
			<td  align="center"><b></b></td>
			<td  align="center"><b></b></td>
			<td  align="center"><b></b></td>
			<td  align="center" ><b></b></td>
			<td  align="center" ><b></b></td>
			<td  align="center" ><b></b></td>
			<td  align="center" ><b></b></td>
</tr>
			