<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$match=0;
?>
<div class="box box-success" style="overflow: scroll;">
<font color="red" size="4">Miss Match Model : <span id="count">4</span></font>
<table border="0" class="table table-hover table-striped table-bordered">
<?php 
$get=mysqli_query($conn,"select * from main_product_prc_temp where eby='$user_currently_loged'") or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($get);
if($rcnt>0)
{
?>
<tr style="backgound-color:#eed669;">
<td align="right" colspan="8">
<input type="button" class="btn btn-success" id="Button2" onclick="subb()" value="Final Submit" >
</td>
</tr> 
<tr>
<td><b>Sl No.</b>
<td><b>Model Name</b></td>
<td><b>Price</b></td>
<td><b>Discount</b></td>
<td><b>Discount Amount</b></td>
<td><b>OfferPrice</b></td>
<td><b>OFFERLESS%</b></td>
<td><b>LastPrice</b></td>
</tr>
<?php 
$match=0;
$cnt=0;
while($row=mysqli_fetch_array($get))
{
	$cnt++;
	$psl=$row['sl'];
	$cat=$row['cat'];
	$brand=$row['brand'];
	$pnm=$row['modelno'];
	$prc=$row['prc'];
	$dis=$row['dis'];
	$disam=$row['disam'];	
	$offprc=$row['offprc'];
	$offless=$row['offless'];
	$lprc=$row['lprc'];
	$prodduct=mysqli_query($conn,"select * from main_product where pnm='$pnm'") or die(mysqli_error($conn));
	$count=mysqli_num_rows($prodduct);	
	$msg="";
	if($count==0)
	{
		$match++;
		$msg="(Please Check Model No.)";
	}
?>
<tr>
<td style="text-align:center;"><?php  echo $cnt;?></td>
<td style="text-align:left;"><?php  echo $pnm;?><font color="red"><?php  echo $msg;?></font></td>
<td style="text-align:left;"><?php  echo $prc;?></td>
<td style="text-align:left;"><?php  echo $dis;?></td>
<td style="text-align:left;"><?php  echo $disam;?></td>
<td style="text-align:left;"><?php  echo $offprc;?></td>
<td style="text-align:left;"><?php  echo $offless;?></td>
<td style="text-align:left;"><?php  echo $lprc;?></td>


</tr>


<?php 
}

}
else
{
	?>
<tr><td align="center"><font color="red" size="4"><b>No Data Available.....</b></font></td></tr>	
	
	<?php 
}
?>

</table>
</div>

<script>
	$("#count").html("<?php  echo $match;?>");
</script>