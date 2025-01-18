<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$query="Select * from bills_receivable";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$Slno=$R['sl'];	
//$clean_code = preg_replace('/[^\w]/', '', $R['Address']);	
//$adr=preg_replace('/^a-zA-Z/', '', $R['Address']);

$str =preg_replace("/[^0-9]/", '', $R['addr']);
$str=substr($str,0,10);

$sql=mysqli_query($conn,"update bills_receivable set cont='$str' where sl='$Slno'") or die (mysqli_error($conn));
echo $str."<br>";
}

?>