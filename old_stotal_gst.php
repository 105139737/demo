<?php
$reqlevel = 3;
include("membersonly.inc.php");
$bill_typ=$_REQUEST['bill_typ'];
$query1 = "SELECT sum(tamm) as gttl,sum(net_am) as net_am FROM ".$DBprefix."old_ret_slt where eby='$user_currently_loged'  and bill_typ='$bill_typ'";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=round($R1['gttl'],2);
$net_am=$R1['net_am'];
}


?>

<input type="text" name="tamm" id="tamm" class="form-control" value="<?=$gttl;?>" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 



<input type="text" name="tamm1" id="tamm1"  hidden="true" class="sc" value="<?=$net_am;?>" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 
<script>
v();
</script>
