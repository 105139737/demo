<?php
$reqlevel = 3;
include("membersonly.inc.php");
$blno=$_REQUEST['blno'];
$query1 = "SELECT sum(tamm) as gttl FROM main_quo_details_edt where blno='$blno' ";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=round($R1['gttl'],2);
$net_am=$R1['net_am'];
}
?>
<input type="text" name="tamm" id="tamm" class="form-control" value="<?=$gttl;?>" style="background-color:#f3f4f5;font-size:13pt;color:blue" readonly="true"> 

