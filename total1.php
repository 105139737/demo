<?php 

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");

 $query1 = "SELECT sum(ttl) as gttl,sum(ppt) as pprc1 FROM ".$DBprefix."ptemp where eby='$user_currently_loged'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$pprc1=$R1['pprc1'];

}

?>
<input type="text" name="mrp" id="mrp"  class="form-control" style="background-color:#f3f4f5;text-align:right" readonly="true"  value="<?php echo sprintf('%0.2f', $gttl);?>" >