<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$brncd=$_REQUEST['brncd'];

?>
<select name="godown" class="form-control" size="1" id="godown" >
<option value="">---All---</option>
<?php 
$geti=mysqli_query($conn,"select * from main_godown where bnm='$brncd'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
	//sun	mun	bun	smvlu	mdvlu	bgvlu	
	$sl=$rowi['sl'];
	$gnm=$rowi['gnm'];


?>
<option value="<?php  echo $sl;?>"><?php  echo $gnm;?></option>
<?php 
}
?>
</select>

<script>
$('#bcd').chosen({
no_results_text: "Oops, nothing found!",
});	
</script>
