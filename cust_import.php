<?
$reqlevel = 3; 
include("membersonly.inc.php");
$query="Select * from sheet1";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$Slno=$R['Slno'];	
//$clean_code = preg_replace('/[^\w]/', '', $R['Address']);	
//$adr=preg_replace('/^a-zA-Z/', '', $R['Address']);

$str =preg_replace("/[^0-9]/", '', $R['Address']);
$str=substr($str,0,10);

$sql=mysqli_query($conn,"update sheet1 set cont='$str' where Slno='$Slno'") or die (mysqli_error($conn));
echo $str."<br>";
}

?>