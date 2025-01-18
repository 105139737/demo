<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "function.php";

$cat=$_REQUEST['cat'] ?? "";
$scat=$_REQUEST['scat'] ?? "";
$cat1="";
$scat1="";
if($cat!=""){$cat1=" and cat='$cat'";}
if($scat!=""){$scat1=" and scat='$scat'";}
?>
<select id="prnm" name="prnm" class="form-control" onchange="gtt_godwn();gtt_unt();getstock();gtt_godwn()" >
<option value="">---Select---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_product where sl>0 and typ='0' and stat=0 $cat1 $scat1 order by pnm");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
	$pcd=$row1['pcd'];
/*	
$stck=0;
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$sl' ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}	
*/	
?>
<Option value="<?php  echo $sl;?>"><?php echo reformat($pcd." ".$pnm);?> </option>
<?php }?>
</select>


<script>

  $('#prnm').chosen({
  no_results_text: "Oops, nothing found!",

  });
</script>
