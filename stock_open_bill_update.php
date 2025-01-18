<?php 
$reqlevel = 3; 

include("membersonly.inc.php");
set_time_limit(0);
$bccnt=0;
$sccnt=0;
 

$up="update ".$DBprefix."stock set pbill='Open Stock',dt='2015-04-01' where nrtn='Open Stock'";
$result=mysqli_query($conn,$up);


