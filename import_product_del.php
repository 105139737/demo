<?
$reqlevel = 3; 
include("membersonly.inc.php");
$result = mysqli_query($conn,"SELECT * FROM main_product WHERE md5(UPPER(pnm))=md5(LOWER(pnm))");
while ($R = mysqli_fetch_array ($result))
{
$pnm=$R['pnm'];
$sl=$R['sl'];

echo $sl." --- ".$pnm."<br>";
$dsql=mysqli_query($conn,"delete from main_stock where pcd='$sl' and stout=0") or die (mysqli_error($conn));	
if($dsql)
{
$dsql=mysqli_query($conn,"delete from main_product where sl='$sl' ") or die (mysqli_error($conn));	
}
}
?>