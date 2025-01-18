<?php 

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");

 $query1 = "SELECT sum(ttl) as gttl FROM ".$DBprefix."ptemp where eby='$user_currently_loged'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{$gttl=$R1['gttl'];}

?>
<input type="text" name="tamm" id="tamm" class="form-control" value="<?php echo sprintf('%0.2f', $gttl);?>" style="text-align:right;font-size:14pt" readonly="true"> 

<input type="text" name="tamm1" id="tamm1"  hidden="true" class="sc" value="<?php echo sprintf('%0.2f', $gttl);?>" style="background-color:#f3f4f5;text-align:right" readonly="true"> 
