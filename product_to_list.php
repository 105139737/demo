<?php
$reqlevel = 1;
include("membersonly.inc.php");
include "function.php";
$cat=$_REQUEST['cat'];
$scat=$_REQUEST['scat'];
$fpcd=$_REQUEST['fpcd'];

if($cat!=""){$cat1=" and (cat='$cat' or tcat='$cat')";}else{$cat1="";}
if($scat!=""){$scat1=" and scat='$scat' or tscat='$scat'";}else{$scat1="";}
if($fpcd!=''){$fpcd1=" and  fpcd='$fpcd' or tpcd='$fpcd' ";}else{$a2='';}


$cnt=0;
$sl=0;


?>


<table class="table table-hover table-striped table-bordered">
<tr>
<th style="text-align:center;">Sl No</th>
<th style="text-align:center;">Brand</th>
<th style="text-align:center;">Category</th>
<th style="text-align:center;">From Product</th>

<th style="text-align:center;">Brand</th>
<th style="text-align:center;">Category</th>
<th style="text-align:center;">To Product</th>

<th style="text-align:center;">Action</th>

</tr>
<?
$get=mysqli_query($conn,"select * from main_product_to where sl>0 $cat1 $scat1 $fpcd1  order by sl ") or die(mysqli_error($conn));

while($row=mysqli_fetch_array($get))
{
	$cnt++;
	$sl++;
	$psl=$row['sl'];
	$cat1=$row['cat'];
	$scat1=$row['scat'];
	$fpcd=$row['fpcd'];
	$tcat1=$row['tcat'];
	$tscat1=$row['tscat'];
	$tpcd=$row['tpcd'];
	
	$pnm="";
	$get1=mysqli_query($conn,"select * from main_product where sl='$fpcd'") or die(mysqli_error($conn));
	while($row1=mysqli_fetch_array($get1))
	{
	$pnm=$row1['pnm'];
	$pcd=$row1['pcd'];
	}
	$tpnm="";
	$get1=mysqli_query($conn,"select * from main_product where sl='$tpcd'") or die(mysqli_error($conn));
	while($row1=mysqli_fetch_array($get1))
	{
	$tpnm=$row1['pnm'];
	$tpcd=$row1['pcd'];
	}
	
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
		$tcat="";
	$get1=mysqli_query($conn,"select * from main_catg where sl='$tcat1'") or die(mysqli_error($conn));
	while($row1=mysqli_fetch_array($get1))
	{
	$tcat=$row1['cnm'];
	}
	$tscat="";
	$get2=mysqli_query($conn,"select * from main_scat where sl='$tscat1'") or die(mysqli_error($conn));
	while($row2=mysqli_fetch_array($get2))
	{
	$tscat=$row2['nm'];
	}

	
?>
<tr bgcolor="<?=$color;?>">
<td style="text-align:center;"><?=$sl;?></td>
<td style="text-align:left;"><?=$cat;?></td>
<td style="text-align:left;"><?=$scat;?></td>
<td style="text-align:left;"><?=reformat($pnm);?> (<?php echo $pcd;?> )</td>
<td style="text-align:left;"><?=$tcat;?></td>
<td style="text-align:left;"><?=$tscat;?></td>
<td style="text-align:left;"><?=reformat($tpnm);?>  (<?php echo $tpcd;?> )</td>

<td style="text-align:center;">
<a class="btn btn-danger btn-xs"  onclick="if(confirm('Are you Sure?')){del('<?=$psl;?>')}" title="Click to Delete">Delete</a> 
</td>





</tr>
<?															
}
?>
</table>
