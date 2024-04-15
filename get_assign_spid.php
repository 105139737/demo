<?
$reqlevel = 1;
include("membersonly.inc.php");
$spid=$_REQUEST['spid'];

$user_array=array();

$data1 = mysqli_query($conn,"Select * from main_signup where username='$spid'");
while ($row1 = mysqli_fetch_array($data1))
{
$assign_spid=$row1['assign_spid'];
$brand=$row1['brand'];
}

$user_array=explode(',',$assign_spid);


?>
<select name="assign_spid[]"  multiple class="form-control" id="assign_spid" required>
<?
$data13 = mysqli_query($conn,"Select * from main_sale_per order by spid");
while ($row13 = mysqli_fetch_array($data13))
{
$sl2=$row13['sl'];
$spid2=$row13['spid'];
?>
<Option value="<?php echo $spid2;?>" <?php if(in_array($spid2,$user_array)){echo 'selected';}?>><?php echo $spid2;?></option>
<?php } ?>
</select>

<script>
$('#assign_spid').chosen({no_results_text: "Oops, nothing found!",});	
$('#brand').val('<?php echo $brand;?>');
</script>