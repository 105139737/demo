<?php
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
$cy=date('Y');
$prnm=$_REQUEST[prnm];
if($prnm!="")
{
	$all1=" and pcd = '$prnm'";
}
else
{
$all1="";	
}


?>

<table  class="table table-hover table-striped table-bordered"  >	
<tr>
<th >Action</font></th>
<th >Sl</font></th>
<th >Company</font></th>
<th >Category</font></th>
<th >Pruduct Name</font></th>
<th >Unit</font></th>
<th >Quantity</font></th>
<th style="text-align:right">Rate</font></th>
<th style="text-align:right">Value</font></th>


</tr>
<?

$total=0;
$sln=0;

$data= mysqli_query($conn,"select * from main_stock where  sl>0 and nrtn='Open Stock' $all1 ")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['pcd'];
$unt=$row['unit'];
$unit=$row['unit'];
$usl=$row['usl'];

$bcd=$row['bcd'];
$mfg=$row['mfg'];
$expdt=$row['expdt'];
$betno=$row['betno'];
$opst=$row['opst'];
$pret=$row['pret'];

$geti=mysqli_query($conn,"select * from main_unit where sl='$usl'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
$unit_nm=$rowi[$unt];
}
$geti=mysqli_query($conn,"select * from main_product where sl='$pcd'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{

	$pname=$rowi['pnm'];
	$cat=$rowi['cat'];
	$scat=$rowi['scat'];
	
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
	
	
	
}


$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$pcd'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	/*$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];*/
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}






if($unit=='sun'){$stock_in=($opst/$smvlu)." ".$sun;}
if($unit=='mun'){$stock_in=($opst/$mdvlu)." ".$mun;}
if($unit=='bun'){$stock_in=($opst/$bgvlu)." ".$bun;}







$value=$stock_in*$pret;
$total=$total+$value;
$x=$row['sl'];
$sln++;   

$sll=base64_encode($x);

?>
<tr  >
<td  align="center" style="cursor:pointer" onclick="edit('<?=$sll;?>')" >
<?	if($user_current_level<0)
{?><i class="fa fa-pencil-square-o"></i>
<?}?>
</td>
<td align="center"><? echo $sln;?></td>
<td align="center"><? echo $cnm;?></td>
<td align="center"><? echo $scat_nm;?></td>
<td align="center"><? echo $pname;?></td>
<td align="center"><? echo $unit_nm;?></td>
<td align="center"><? echo $stock_in;?></td>
<td align="right"><? echo $pret;?></td>
<td align="right"><? echo $value;?></td>
</tr>	 
<?
}
?>
<tr>
<td align="center" colspan="8"><font color="red" size="4"><b>Total :</b></font></td>
<td align="right" ><font color="red" size="4"><b><? echo $total;?></b></font></td>
</tr>	 
</table>