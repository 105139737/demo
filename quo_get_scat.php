<?php
$reqlevel = 1;
include("membersonly.inc.php");
$cat=$_REQUEST[cat];
$scat=$_REQUEST[scat];

?>
<select name="scat" id="scat" class="form-control" tabindex="8" onchange="get_prod()">
<Option value="">---Category---</option>
<?
$get=mysqli_query($conn,"Select * from main_scat where cat='$cat'  order by nm");
while($row=mysqli_fetch_array($get))
{
	$sc_sl=$row['sl'];
	$sc_nm=$row['nm'];
	?>
	<option value="<?echo $sc_sl;?>"><?echo $sc_nm;?></option>
	<?
}
?>
</select>
<script>
$('#scat').chosen({no_results_text: "Oops, nothing found!",});
</script>