<?php
$reqlevel = 1;
include("membersonly.inc.php");

$cat=$_REQUEST['cat'];
$scat=$_REQUEST['scat'];
$pnm=rawurldecode($_REQUEST['pnm']);
$ean=$_REQUEST['ean'];
if($cat!=""){$cat1=" and cat='$cat'";}else{$cat1="";}
if($scat!=""){$scat1=" and scat='$scat'";}else{$scat1="";}
if($ean=="1"){$ean1=" and ean=''";}elseif($ean=="0"){$ean1=" and ean!=''";}
$af="%".$pnm."%";
if($pnm!=''){$a2=" and (pnm LIKE '$af')";}else{$a2='';}

 

$file = "Product_Price_List.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 

$cnt=0;
$get=mysqli_query($conn,"select * from main_product where sl>0 $cat1 $scat1 $ean1 $a2 order by sl") or die(mysqli_error($conn));
$total=mysqli_num_rows($get);
if($total!=0)
{
?>

<table width="60%" border="1">
<tr>
<th style="text-align:center;">Sl No</th>
<th style="text-align:center;">Brand</th>
<th style="text-align:center;">Category</th>
<th style="text-align:center;">Model Name</th>
<th style="text-align:center;">HSN</th>
<th style="text-align:center;">Price</th>
<th style="text-align:center;">Discount</th>
<th style="text-align:center;">Discount Amount</th>
</tr>
<?
while($row=mysqli_fetch_array($get))
{
	$cnt++;
	$sl++;
	$psl=$row['sl'];
	$cat1=$row['cat'];
	$scat1=$row['scat'];
	$pnm=$row['pnm'];
	$hsn=$row['hsn'];
	$unit1=$row['unit'];
	$mrp=$row['mrp'];
	$smvlu=$row['smvlu'];
	$mdvlu=$row['mdvlu'];
	$bgvlu=$row['bgvlu'];
	$cat="";
	$get1=mysqli_query($conn,"select * from main_catg where sl='$cat1'") or die(mysqli_error($conn));
	while($row1=mysqli_fetch_array($get1))
	{
	$cat=$row1['cnm'];
	}
	$scat="";
	$get2=mysqli_query($conn,"select * from main_scat where sl='$scat1'") or die(mysqli_error($conn));
	while($row2=mysqli_fetch_array($get2))
	{
	$scat=$row2['nm'];
	}
	

	
?>
<tr>
<td style="text-align:center;"><?=$cnt;?></td>
<td style="text-align:left;"><?=$cat;?></td>
<td style="text-align:left;"><?=$scat;?></td>
<td style="text-align:left;"><?=$pnm;?></td>
<td style="text-align:left;"><?=$hsn;?></td>
<td style="text-align:left;"><? echo '0';?></td>
<td style="text-align:left;"><? echo '0';?></td>
<td style="text-align:left;"><? echo '0';?></td>

</tr>
<?															
}
?>
</table>
<?
}
else
{
?>
<table class="table table-hover table-striped table-bordered">
<tr>
<td style="text-align:center;"><font size="4" color="red"><b>No Records Available</b></font></td>
</tr>
</table>
<?
}
?>