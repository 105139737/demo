<?php $_REQUEST['blno'] ?? ""
$reqlevel = 3;
include("membersonly.inc.php");
$blno=$_REQUEST[blno];
$query1 = "SELECT sum(ttl) as gttl,sum(net_am) as net_am FROM main_billdtls where blno='$blno' ";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$net_am=$R1['net_am'];
}


?>

<input type="text" name="tamm" id="tamm" class="form-control" value="<?php  echo $gttl;?>" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 



<input type="text" name="tamm1" id="tamm1"  hidden="true" class="sc" value="<?php  echo $net_am;?>" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 
<script>
v();
</script>
