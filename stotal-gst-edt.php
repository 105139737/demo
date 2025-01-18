<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$blno=rawurldecode($_REQUEST['blno']);
$query1 = "SELECT sum(tamm) as gttl,sum(net_am) as net_am FROM main_billdtls_edt where eby='$user_currently_loged' and blno='$blno'";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=round($R1['gttl']??0,2);
$net_am=$R1['net_am'];
}


?>

<input type="text" name="tamm" id="tamm" class="form-control" value="<?php  echo $gttl;?>" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 



<input type="text" name="tamm1" id="tamm1"  hidden="true" class="sc" value="<?php  echo $net_am;?>" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 
<script>
v();
</script>
