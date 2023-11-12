<?php
$reqlevel = 1;
include("membersonly.inc.php");
$a=$_POST['queryString'];
$query3 = "SELECT * FROM ".$DBprefix."group WHERE nm LIKE '$a%' LIMIT 5";
   $result3 = mysqli_query($conn,$query3);
	echo "<ul class=\"ul1\">";
while ($R = mysqli_fetch_array ($result3))
{
$x=$R['nm'];
	echo '<li onClick="fill(\''.addslashes($x).'\');">'.$x.'</li>';
	         		}
				echo '</ul>';
?>