<?php 
$reqlevel = 1;
include("membersonly.inc.php");

$all=$_REQUEST['all'];
$af="%".$all."%";
if($all!=""){$all1=" and (gnm like '$af' or addr like '$af')";}else{$all1="";}

$get=mysqli_query($conn,"select * from main_godown where sl>0 $all1 order by bnm,gnm") or die(mysqli_error($conn));
$total=mysqli_num_rows($get);
if($total!=0)
{
?>
<table class="table table-hover table-striped table-bordered">
<tr>
<th style="text-align:center;">Sl No</th>
<th style="text-align:center;">Godown</th>
<th style="text-align:center;">Address</th>
<th style="text-align:center;">District</th>
<th style="text-align:center;">Pin</th>
<th style="text-align:center;">Action</th>
</tr>
<?php 
$hsn="";
$igst="";
$nm="";
$cnt=0;
$gsl="";
while($row=mysqli_fetch_array($get))
{
	$cnt++;
	$ssl=$row['sl'];
	$bnm=$row['bnm'];
	$gnm=$row['gnm'];
	$addr=$row['addr'];
	$dist=$row['dist'];
	$pin=$row['pin'];
	
	/*	$getbrnd=mysqli_query($conn,"select * from main_branch where sl='$bnm'") or die(mysqli_error($conn));
		while($brndar=mysqli_fetch_array($getbrnd))
		{
			$bnm1=$brndar['bnm'];
		}*/
?>
<tr>
<td style="text-align:center;"><?php  echo $cnt;?></td>
<td style="text-align:left;"><?php  echo $gnm;?></td>
<td style="text-align:left;"><?php  echo $addr;?></td>
<td style="text-align:left;"><?php  echo $dist;?></td>
<td style="text-align:left;"><?php  echo $pin;?></td>
<td style="text-align:center;">
<a href="godown_edit.php?sl=<?php  echo $ssl;?>&gsl=<?php  echo $gsl;?>" title="Click to Update"><i class="fa fa-pencil-square-o"></i></a>
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