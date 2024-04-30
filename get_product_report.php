<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "function.php";
$cat=$_REQUEST[cat];
$scat=$_REQUEST[scat];
$cat1="";
$scat1="";
if($cat!=""){$cat1=" and cat='$cat'";}
if($scat!=""){$scat1=" and scat='$scat'";}
?>
<select  id="prnm" name="prnm[]" multiple class="form-control" tabindex="10">
<option value="">---Select---</option>
<?php
$data1 = mysqli_query($conn,"Select * from main_product where sl>0 and FIND_IN_SET(cat, '$cat')>0 and FIND_IN_SET(scat, '$scat')>0 order by pnm");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
	$pcd=$row1['pcd'];
?>
<option value="<?php echo $sl;?>"><?php echo reformat($pcd." ".$pnm);?> </option>
<?php }?>
</select>
<script>
  $('#prnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
  $('#prnm').css('width','100%');	
</script>
