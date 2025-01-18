<?php 



/**

 * @author Onnet Solution

 * @copyright 2013

 */$_REQUEST['blno'] ?? ""



$reqlevel = 3;

include("membersonly.inc.php");

include("Numbers/Words.php");

$blno=$_REQUEST[blno];



 $query1 = "SELECT sum(ttl) as gttl,sum(ttl) as pprc1 FROM main_purchasedet where blno='$blno'";

   $result1 = mysqli_query($conn,$query1);

while ($R1 = mysqli_fetch_array ($result1))

{

$gttl=$R1['gttl'];

$pprc1=$R1['pprc1'];



}



?>

<input type="text" name="tamm" id="tamm" class="sc" value="<?php echo sprintf('%0.2f', $pprc1);?>" style="background-color:#f3f4f5;text-align:right" readonly="true"> 



<input type="text" name="tamm1" id="tamm1"  hidden="true" class="sc" value="<?php echo sprintf('%0.2f', $pprc1);?>" style="background-color:#f3f4f5;text-align:right" readonly="true"> 

