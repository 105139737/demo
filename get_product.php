<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cat=$_REQUEST['cat'] ?? "";
$scat=$_REQUEST['scat'] ?? "";
$cat1="";
$scat1="";
if($cat!=""){$cat1=" and cat='$cat'";}
if($scat!=""){$scat1=" and scat='$scat'";}
?>
<select id="prnm" name="prnm" class="form-control" onchange="get_gstval()" tabindex="10">
<option value="">---Select---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_product where sl>0 $cat1 $scat1 order by pnm");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
?>
<Option value="<?php  echo $sl;?>"><?php  echo $pnm;?></option>
<?php }?>
</select>
<script>
  $('#prnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
</script>
