<?php 
$reqlevel = 1;
include("membersonly.inc.php");$_REQUEST['cat'] ?? ""
$cat=$_REQUEST[cat];

?>
<select name="scatt" id="scatt" onchange="product()">
<Option value="">---Select---</option>
<?php 
$get=mysqli_query($conn,"Select * from main_scat where cat='$cat' order by nm");
while($row=mysqli_fetch_array($get))
{
$sc_sl=$row['sl'];
$sc_nm=$row['nm'];
?>
<option value="<?php echo $sc_sl;?>"><?php echo $sc_nm;?></option>
<?php 
}
?>
</select>
<script>
$('#scatt').chosen({no_results_text: "Oops, nothing found!",});
</script>
