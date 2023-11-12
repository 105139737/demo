<?
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
<th style="text-align:center;">Action</th>
</tr>
<?
$hsn="";
$igst="";
$nm="";
while($row=mysqli_fetch_array($get))
{
	$cnt++;
	$ssl=$row['sl'];
	$bnm=$row['bnm'];
	$gnm=$row['gnm'];
	$addr=$row['addr'];
	
	/*	$getbrnd=mysqli_query($conn,"select * from main_branch where sl='$bnm'") or die(mysqli_error($conn));
		while($brndar=mysqli_fetch_array($getbrnd))
		{
			$bnm1=$brndar['bnm'];
		}*/
?>
<tr>
<td style="text-align:center;"><?=$cnt;?></td>
<td style="text-align:left;"><?=$gnm;?></td>
<td style="text-align:left;"><?=$addr;?></td>
<td style="text-align:center;">
<a href="godown_edit.php?sl=<?=$ssl;?>&gsl=<?=$gsl;?>" title="Click to Update"><i class="fa fa-pencil-square-o"></i></a>
</td>
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