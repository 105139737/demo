<?php
$reqlevel = 3;
set_time_limit(0);
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$all=rawurldecode($_REQUEST[all]);
$al="%".$all."%";
if($all!="")
{
	/*brand	cat		modelno	prc*/
	$all1=" and brand LIKE '$al' or cat LIKE '$al' or modelno LIKE '$al' or prc LIKE '$al'";
}
else
{
	$all1="";	
}


?>
<style>
.advancedtable tbody tr td
{
border:1px solid #000;
padding: 2px 2px;
}
.advancedtable thead tr th
{
border:1px solid #000;
padding: 0px 0px;
}
.advancedtable
{
border-collapse: collapse;
}
</style>

<table class="advancedtable"  cellspacing="0" width="100%">	
<thead>
<tr>
<td align="center" colspan="7" style="font-size:150%;"><b>Price Details</b></td>
</tr>
<tr>
<th style="text-align:center;width:50px;">Sl</th>
<th style="text-align:center;width:140px;">Brand</th>
<th style="text-align:center;width:130px;">Category</th>
<th style="text-align:center;width:130px;">Product</th>
<th style="text-align:center;width:70px;">Discount(%)</th>
<th style="text-align:center;width:70px;">Discount Amount</th>
<th style="text-align:right;width:130px;">Price</th>
</tr>
</thead>
<tbody>
<?
$sl=$start;
$sln=0;
$data=mysqli_query($conn,"select * from main_product_prc where  sl>0 $all1 order by sl")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
	$x=$row['sl'];
	$brand=$row['brand'];
	$cat=$row['cat'];
	$modelno=$row['modelno'];
	$prc=$row['prc'];
	$dis=$row['dis'];
	$disam=$row['disam'];
	$sln++;   
	$sl++; 
?>
<tr>
<td align="center"><? echo $sl;?></td>
<td align="left"><? echo $brand;?></td>
<td align="left"><? echo $cat;?></td>
<td align="left"><? echo $modelno;?></td>
<td align="right"><? echo $prc;?></td>
<td align="right"><? echo $dis;?></td>
<td align="right"><? echo $disam;?></td>
</tr>	 
<?
}
?>
</tbody>
</table>
