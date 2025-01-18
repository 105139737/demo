<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$spid=$_REQUEST['spid'];
$cust="";
$data = mysqli_query($conn,"Select * from  main_cust_asgn where spid='$spid'");
while ($row = mysqli_fetch_array($data))
{
$cust=$row['cust'];
}
?>
<select name="cust[]" multiple class="form-control" size="1" id="cust" tabindex="8"  required>
<?php 
$c="";
$data13 = mysqli_query($conn,"Select * from main_cust where FIND_IN_SET(sl,'$cust')");
while ($row13 = mysqli_fetch_array($data13))
{
	$c++;
$sl3=$row13['sl'];
$cnm=$row13['nm'];
?>
<Option value="<?php  echo $sl3;?>"><?php  echo $cnm;?></option>
<?php }?>
</select>
<script>
$('#cust').chosen({no_results_text: "Oops, nothing found!",});	
</script>