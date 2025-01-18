<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "function.php";

$scat=$_REQUEST['scat'] ?? "";
$cat=$_REQUEST['cat'] ?? "";

?>
<select name="prnm" id="prnm" class="form-control" tabindex="8">
<Option value="">---Select---</option>
<?php 
$get=mysqli_query($conn,"Select * from main_product where cat='$cat' and scat='$scat' and typ='0' order by pnm");
while($row=mysqli_fetch_array($get))
{
	$sc_sl=$row['sl'];
	$pnm=$row['pnm'];
	$pcd=$row['pcd'];
	?>
	<option value="<?php echo $sc_sl;?>"><?php echo reformat($pcd." ".$pnm);?></option>
	<?php 
}
?>
</select>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>
$('#prnm').chosen({
no_results_text: "Oops, nothing found!",
});
</script>