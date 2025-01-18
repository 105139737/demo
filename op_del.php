<?php  
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
$edtm = date('d-m-Y h:i:s a', time());
$dt=date('Y-m-d');	


$data= mysqli_query($conn,"select * from  main_openingdtl where sl='$sl' limit 1")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['prsl'];
$qty=$row['qty'];
$blno1=$row['blno'];
$betno=$row['betno'];
$bcdd=$row['bcd'];



mysqli_query($conn,"delete from  main_openingdtl where sl='$sl' limit 1") or die (mysqli_error($conn));

mysqli_query($conn,"delete from  main_stock where pcd='$pcd' and bcd='$bcdd' and betno='$betno' and pbill='$blno1' limit 1") or die (mysqli_error($conn));
}
?>
<script>
show1();
</script>