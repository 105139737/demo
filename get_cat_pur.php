<?
$reqlevel = 1;
include("membersonly.inc.php");
$cat=$_REQUEST[cat];
if($cat!=""){$cat1=" and cat='$cat'";}
?>
<select name="scat" class="form-control" size="1" id="scat" tabindex="9"  onchange="get_prod()">
<Option value="">---Select---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_scat where sl>0 $cat1");

		while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$nm=$row1['nm'];
?>
<Option value="<?=$sl;?>"><?=$nm;?></option>
	<?}?>
</select>
<script>
$('#scat').chosen({
no_results_text: "Oops, nothing found!",
});
</script>
