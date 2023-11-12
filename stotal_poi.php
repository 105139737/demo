<?php
$reqlevel = 3;
include("membersonly.inc.php");$query1 = "SELECT sum(plttl) as point FROM ".$DBprefix."slt where eby='$user_currently_loged'";$result1 = mysqli_query($conn,$query1);while ($R1 = mysqli_fetch_array ($result1)){$point=$R1['point'];}?>
<input type="text" name="cpnt" id="cpnt" class="form-control" value="<?=$point;?>" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> <script>
v();
</script>