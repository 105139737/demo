<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$gsl="";

$all=$_REQUEST['all'];
$af="%".$all."%";
if($all!=""){$all1=" and (nm like '$af' or igst like '$af' or hsn like '$af')";}else{$all1="";}

$get=mysqli_query($conn,"select * from main_scat where sl>0 $all1 order by nm") or die(mysqli_error($conn));
$total=mysqli_num_rows($get);
if($total!=0)
{
?>
<table class="table table-hover table-striped table-bordered">
<tr>
<th style="text-align:center;">Sl No</th>
<th style="text-align:center;">Brand</th>
<th style="text-align:center;">Category</th>
<th style="text-align:center;">IGST</th>
<th style="text-align:center;">HSN</th>
<th style="text-align:center;">Action</th>
</tr>
<?php 
$hsn="";
$igst="";
$nm="";
$cnt=0;
while($row=mysqli_fetch_array($get))
{
	$cnt++;
	$ssl=$row['sl'];
	$brand=$row['cat'];
	$nm=$row['nm'];
	$hsn=$row['hsn'];
	$igst=$row['igst'];
	
		$getbrnd=mysqli_query($conn,"select * from main_catg where sl='$brand'") or die(mysqli_error($conn));
		while($brndar=mysqli_fetch_array($getbrnd))
		{
			$brndnm=$brndar['cnm'];
		}
?>
<tr>
<td style="text-align:center;"><?php  echo $cnt;?></td>
<td style="text-align:center;"><?php  echo $brndnm;?></td>
<td style="text-align:left;"><?php  echo $nm;?></td>
<td style="text-align:left;"><?php  echo $igst;?></td>
<td style="text-align:left;"><?php  echo $hsn;?></td>
<td style="text-align:center;">
<a href="sub_cat_edit.php?sl=<?php  echo $ssl;?>&gsl=<?php  echo $gsl;?>" title="Click to Update"><i class="fa fa-pencil-square-o"></i></a>
</td>
</tr>
<?php 															
}
?>
</table>
<?php 
}
else
{
	?>
	<table class="table table-hover table-striped table-bordered">
	<tr>
	<td style="text-align:center;"><font size="4" color="red"><b>No Records Available</b></font></td>
	</tr>
	</table>
	<?php 
}
?>