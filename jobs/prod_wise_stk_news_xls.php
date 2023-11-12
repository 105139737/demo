<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("memory_limit", "-1");
set_time_limit(0);
include("../config.php");
include("../function.php");
date_default_timezone_set('Asia/Kolkata');
$cy=date('Y');

$pnm=$_REQUEST['prnm'];
$catsl=$_REQUEST['cat'];
$scatsl=$_REQUEST['scat'];
$dt=$_REQUEST['dt'];

$cat1="";
if($catsl!=""){$cat1=" and cat='$catsl'";}
$scat1="";
if($scatsl!=""){$scat1=" and scat='$scatsl'";}
if($pnm!=""){$all1=" and sl='$pnm'";}else{$all1="";	}
$dt=date('Y-m-d', strtotime($dt));
ob_start();
/*
$file="Product Wise Stock Details As on ".$dt.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file");*/
?>
<table border="1">
<tr>
<td align="center"><b>Sl</b></td>
<td align="center"><b>Brand</b></td>
<td align="center"><b>Category</b></td>
<td align="center"><b>Model Code</b></td>
<td align="center"><b>Product Name</b></td>
<td align="center"><b>MAIN LOCATION</b></td>
<td align="center"><b>RANAGHAT</b></td>
<td align="center"><b>DAMAGE GODOWN</b></td>
<td align="center"><b>MBO KGR</b></td>
<td align="center"><b>SHOPPE</b></td>
<td align="center"><b>BETHUA</b></td>
<td align="center"><b>BURDWAN SHOWROOM</b></td>
<td align="center"><b>KARIMPUR</b></td>
<td align="center"><b>BALANCE</b></td>
</tr>
<?php
$cntc=0;
$data=mysqli_query($conn,"select * from main_product where sl>0 and stat='0' and typ='0' $cat1  $scat1  $all1 order by pnm")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
	$cntc++;
	$pcd=$row['sl'];
	$unit=$row['unit'];
	$nm=$row['pnm'];
	$p_cd=$row['pcd'];
	$cat=$row['cat'];
	$scat=$row['scat'];
	$hsn=$row['hsn'];
	$pcode=$row['pcd'];

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
	}
	
	$balance=0;
	$gwn1=0;
	$query="SELECT SUM(opst+stin-stout) AS stck1 FROM ".$DBprefix."stock WHERE pcd='$pcd' AND dt<='$dt' AND bcd='1'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn1=$R['stck1'];
	}
	$gwn2=0;
    $gwn3=0;
	/*
	
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='2'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn2=$R['stck1'];
	}

	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='3'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn3=$R['stck1'];
	}
	*/
	$gwn4=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='4'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn4=$R['stck1'];
	}
	$gwn5=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='5'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn5=$R['stck1'];
	}
	$gwn6=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='6'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn6=$R['stck1'];
	}
	$gwn7=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='7'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn7=$R['stck1'];
	}
		$gwn8=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='8'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn8=$R['stck1'];
	}
	
	$gwn9=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='9'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn9=$R['stck1'];
	}
	$gwn10=0;
	/*

	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='10'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn10=$R['stck1'];
	}
	*/
	$gwn11=0;
	$query="SELECT sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt' AND bcd='11'";
	$result=mysqli_query($conn,$query);
	while($R=mysqli_fetch_array($result))
	{
		$gwn11=$R['stck1'];
	}
	$balance=$gwn1+$gwn4+$gwn5+$gwn6+$gwn7+$gwn8+$gwn9+$gwn10+$gwn11;
	
	if($gwn1==''){$gwn1=0;}
	if($gwn2==''){$gwn2=0;}
	if($gwn3==''){$gwn3=0;}
	if($gwn4==''){$gwn4=0;}
	if($gwn5==''){$gwn5=0;}
	if($gwn6==''){$gwn6=0;}
	if($gwn7==''){$gwn7=0;}
	if($gwn8==''){$gwn8=0;}
	if($gwn9==''){$gwn9=0;}
	if($gwn10==''){$gwn10=0;}
	if($gwn11==''){$gwn11=0;}
	?>
	<tr title="<?=$pcd;?>, Stocksl :<?=$ssl;?>">
	<td align="center"><?php echo $cntc;?></td>
	<td align="left"><?php echo $cnm;?></td>
	<td align="left"><?php echo $scat_nm;?></td>
	<td align="left"><?php echo $p_cd;?></td>
	<td align="left"><?php echo $nm;?></td>
	<td align="center"><?php echo $gwn1;?></td>
	<td align="center"><?php echo $gwn4;?></td>
	<td align="center"><?php echo $gwn5;?></td>
	<td align="center"><?php echo $gwn6;?></td>
	<td align="center"><?php echo $gwn7;?></td>
	<td align="center"><?php echo $gwn8;?></td>
	<td align="center"><?php echo $gwn9;?></td>
	<td align="center"><?php echo $gwn11;?></td>
	<td align="center"><?php echo $balance;?></td>
	</tr>	 

	<?php
}
?>
</table>
<?php
$imgbinary = ob_get_clean();
$filename="jobs_report/".$_GET['file_name'].".xls";
file_put_contents($filename, $imgbinary);
?>