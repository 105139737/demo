<?
$reqlevel = 3; 
include("membersonly.inc.php");
$get1=mysqli_query($conn,"select * from bills_receivable where Party_Name='BFL MBO ALL' order by sl") or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($get1))
{
	$sl=$row1['sl'];
	$dsl=$row1['dsl'];
	$Ref_No=$row1['Ref_No'];

$sql=mysqli_query($conn,"delete from main_drcr where sl='$dsl' and cbill='$Ref_No'") or die (mysqli_error($conn));
echo "1. delete from main_drcr where sl='$dsl' and cbill='$Ref_No'";
if($sql)
{
echo "2. delete from bills_receivable where sl='$sl'";	
$sql=mysqli_query($conn,"delete from bills_receivable where sl='$sl'") or die (mysqli_error($conn));
}
echo "<br>";
}

?>