<?php $_REQUEST['blno'] ?? ""
$reqlevel = 3;
include("membersonly.inc.php");
$blno=rawurldecode($_REQUEST[blno]);
 $query1 = "SELECT sum(ttl) as gttl FROM main_billdtls where blno='$blno'";
 $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
}
?>
<input type="text" name="tamm" id="tamm" class="form-control" value="<?php echo sprintf('%0.2f', $gttl);?>" style="background-color:#f3f4f5;text-align:right" readonly="true"> 
<input type="text" name="tamm1" id="tamm1"  hidden="true" class="sc" value="<?php echo sprintf('%0.2f', $gttl);?>" style="background-color:#f3f4f5;text-align:right" readonly="true"> 
<script>

v();

</script>