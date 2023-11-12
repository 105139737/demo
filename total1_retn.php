<?php

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$blno=$_REQUEST[blno];

 $query1 = "SELECT sum(ttl) as gttl,sum(ttl) as pprc1 FROM main_purchasedet where blno='$blno' and qty>0";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$pprc1=$R1['pprc1'];

}

?>
<input type="text" name="mrp" id="mrp"  class="sc" style="background-color:#f3f4f5;text-align:right" readonly="true"  value="<?=sprintf('%0.2f', $gttl);?>" >
<script>


v();
</script>