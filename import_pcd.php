<?
$reqlevel = 3; 
include("membersonly.inc.php");
$result = mysqli_query($conn,"SELECT * FROM main_product where pcd IS NULL order by sl ");
while ($R = mysqli_fetch_array ($result))
{
$pnm=$R['pnm'];
$sl=$R['sl'];
$cat=$R['cat'];

$get1=mysqli_query($conn,"select * from main_catg where sl='$cat'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get1))
{
$cnm=$row['cnm'];
}
$cnm=substr($cnm,0,2);

$query511="select * from main_product where pcd IS NOT NULL order by sl desc limit 0,1";
$result511 = mysqli_query($conn,$query511) or die(mysqli_error($conn));
while($rows1=mysqli_fetch_array($result511))
{	
$vnos1=$rows1['pcd'];
}	
$vid11=substr($vnos1,4,6);	
$count66=5;
while($count66>0)
{
$vid11=$vid11+1;
$vnoc1=str_pad($vid11, 6, '0', STR_PAD_LEFT);
$pcd="HD".$cnm.$vnoc1;
$query51="select * from main_product where pcd='$pcd'";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
$count66=mysqli_num_rows($result51);
}	


echo $sl." --- ".$pcd."<br>";

$dsql=mysqli_query($conn,"update  main_product set pcd='$pcd' where sl='$sl' ") or die (mysqli_error($conn));	

}
?>