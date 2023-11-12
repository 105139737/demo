<?
$reqlevel = 3;
include("membersonly.inc.php");
$query100 = "SELECT * FROM ".$DBprefix."slt where eby='$user_currently_loged' order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$fst=$R100['fst'];	
}
$fst1="";
if($fst!=""){$fst1=" and sl='$fst'";}
?>
<select id="fst" data-placeholder="Choose Your Supplier" name="fst" class="form-control" onchange="get_gst()" >

	<?
	$sql="SELECT * FROM main_state WHERE sl>0 $fst1 ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($result))
		{
	?>
    <option value="<?=$row['sl'];?>"<?if($row['sl']=='1'){echo 'selected';}?>><?=$row['sn'];?> - <?=$row['cd'];?></option>
<?}?>
</select>
<script>
  $('#fst').chosen({
  no_results_text: "Oops, nothing found!",

  });
</script>
