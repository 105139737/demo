<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "function.php";
$scatt=$_REQUEST[scatt];
?>
<select id="prnm" name="prnm" class="form-control"  tabindex="1" onchange="get_betno('');gtt_unt();get_gstval();godown()">
<option value="">---Select---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_product where typ='0' and scat='$scatt'  order by pnm");
while ($row1 = mysqli_fetch_array($data1))
{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
	$stck=0;
	$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$sl' ";
	$result4 = mysqli_query($conn,$query4);
	while ($R4 = mysqli_fetch_array ($result4))
	{
		$stck=$R4['stck1'];
	}	

	?>
	<Option value="<?php  echo $sl;?>"><?php echo reformat($pnm);?> (Stock : <?php  echo $stck;?> )</option>
	<?php 
}
?>
</select>
<script>
$('#prnm').chosen({no_results_text: "Oops, nothing found!",});
</script>