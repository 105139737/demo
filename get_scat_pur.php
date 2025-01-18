<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$cat=$_REQUEST['cat'] ?? "";
$scat=$_REQUEST['scat'] ?? "";

?>
<select name="scat1" id="scat1" class="form-control" tabindex="8" onchange="get_prod()">
<Option value="">---Select---</option>
<?php 
$get=mysqli_query($conn,"Select * from main_scat where cat='$cat' order by nm");
while($row=mysqli_fetch_array($get))
{
	$sc_sl=$row['sl'];
	$sc_nm=$row['nm'];
	?>
	<option value="<?php echo $sc_sl;?>"<?php if($scat==$sc_sl){echo 'selected';}?>><?php echo $sc_nm;?></option>
	<?php 
}
?>
</select>
<script>
  $('#scat1').chosen({
  no_results_text: "Oops, nothing found!",

  });
</script>