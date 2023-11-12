<?
$reqlevel = 3;
include("membersonly.inc.php");
$brncd=$_REQUEST['brncd'];

?>
<select name="bcd" class="form-control" tabindex="10"  size="1" id="bcd" >
<?
$geti=mysqli_query($conn,"select * from main_godown where bnm='$brncd'") or die(mysqli_error($conn));
while($rowi=mysqli_fetch_array($geti))
{
	//sun	mun	bun	smvlu	mdvlu	bgvlu	
	$sl=$rowi['sl'];
	$gnm=$rowi['gnm'];


?>
<option value="<? echo $sl;?>"><? echo $gnm;?></option>
<?
}
?>
</select>

<script>
$('#bcd').chosen({
no_results_text: "Oops, nothing found!",
});	
</script>
