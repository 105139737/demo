<?php
$reqlevel = 3;
include("membersonly.inc.php");
$blno=rawurldecode($_REQUEST[blno]);$query1 = "SELECT sum(plttl) as point FROM main_billdtls where blno='$blno'";$result1 = mysqli_query($conn,$query1);while ($R1 = mysqli_fetch_array ($result1)){$point=$R1['point'];}?>
<input type="text" name="tpiont" id="tpiont" class="form-control" value="<?=$point;?>" style="background-color:#f3f4f5;text-align:right" readonly="true"> 