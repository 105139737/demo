<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$cat=$_REQUEST['cat'];
$sscat=$_REQUEST['sscat'] ?? "";

?>
<select name="tscat" id="tscat" class="form-control" tabindex="8" onchange="tproduct()">
<Option value="">---Select---</option>
<?php 
$get=mysqli_query($conn,"Select * from main_scat where cat='$cat' order by nm");
while($row=mysqli_fetch_array($get))
{
	$sc_sl=$row['sl'];
	$sc_nm=$row['nm'];
	?>
	<option value="<?php echo $sc_sl;?>" <?php  if($sscat ==$sc_sl){?> selected <?php  } ?>><?php echo $sc_nm;?></option>
	<?php 
}
?>
</select>
<script>
$('#tscat').chosen({
no_results_text: "Oops, nothing found!",
});

</script>