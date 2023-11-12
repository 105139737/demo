<?php

/**
 * @author Onnet Solution
 * @copyright 2013
 */

$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");

$queryw1 = "SELECT * FROM ".$DBprefix."stock where pcd='$prsl'";
   $resultw1 = mysqli_query($conn,$queryw1);
while ($Rw1 = mysqli_fetch_array ($resultw1))
{
$stin=$Rw1['stin'];
$opst=$Rw1['opst'];
}

?>
