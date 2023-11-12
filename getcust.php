<?
$reqlevel = 1;
include("membersonly.inc.php");
$spid=$_REQUEST['spid'];
$data = mysqli_query($conn,"Select * from  main_cust_asgn where spid='$spid'");
while ($row = mysqli_fetch_array($data))
{
$cust=$row['cust'];
}
?>
<select name="cust[]" multiple class="form-control" size="1" id="cust" tabindex="8"  required>
<?
$c="";
$data13 = mysqli_query($conn,"Select * from main_cust where FIND_IN_SET(sl,'$cust')");
while ($row13 = mysqli_fetch_array($data13))
{
	$c++;
$sl3=$row13['sl'];
$cnm=$row13['nm'];
?>
<Option value="<?=$sl3;?>"><?=$cnm;?></option>
<?}?>
</select>
<script>
$('#cust').chosen({no_results_text: "Oops, nothing found!",});	
</script>