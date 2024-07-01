<?
$reqlevel = 3;
include("membersonly.inc.php");
include "function.php";

$cat=$_REQUEST[cat];
$scat=$_REQUEST[scat];
$psl=$_REQUEST[psl];
$prnm3=rawurldecode($_REQUEST[prnm3]);
$cat1="";
$scat1="";
if($cat!=""){$cat1=" and cat='$cat'";}
if($scat!=""){$scat1=" and scat='$scat'";}
if($prnm3!=""){$prnm31=" and (pnm like '%$prnm3%' or pcd like '%$prnm3%')";}
?>
<select id="prnm" name="prnm" tabindex="9"  onchange="godown()" style="width:100%">
<option value="">---Select---</option>
<option value="Add">---Add New---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_product where typ='0' and stat='0' and cat='$cat' $scat1 $prnm31 order by pnm ");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
	$pcd=$row1['pcd'];
/*$stck=0;
	$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$sl' ";
	$result4 = mysqli_query($conn,$query4);
	while ($R4 = mysqli_fetch_array ($result4))
	{
		$stck=$R4['stck1'];
	}	*/
?>
<Option value="<?=$sl;?>"<?if($psl==$sl){echo 'selected';}?>><?=reformat($pcd." ".$pnm);?></option>
<?}?>
</select>


<script>

$('#prnm').chosen({
  no_results_text: "Oops, nothing found!",
  });
  $('#prnm_chosen .chosen-drop').click(function(e) {
  e.stopPropagation();
});
$("#prnm").trigger("chosen:open");
document.getElementById('prnm_chosen').className+=' chosen-with-drop chosen-container-active'
document.getElementById("prnm3").focus();
</script>
