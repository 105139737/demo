<?php 
$reqlevel = 1;
include("membersonly.inc.php");


//$del=mysqli_query($conn,"TRUNCATE TABLE main_sp_target") or die (mysqli_error($conn));

$get=mysqli_query($conn,"select * from main_sale_per where sl>0 order by nm") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$spid=$row['spid'];
$sl=$row['sl'];

$get1=mysqli_query($conn,"select * from main_sp_target where spid='$spid'") or die(mysqli_error($conn));
$cnt=mysqli_num_rows($get1);

if($cnt==0){
	$sql=mysqli_query($conn,"insert into main_sp_target(spid) values('$spid')") or die (mysqli_error($conn));
}



if (isset($_POST[$sl])) {

$target=$_POST[$sl];
$starget=$_POST['s'.$sl];

	$qr=mysqli_query($conn,"update main_sp_target set target='$target',starget='$starget' where spid='$spid'")or die(mysqli_error($conn));
}

//$sql=mysqli_query($conn,"insert into main_sp_target(spid,target) values('$spid','$target')") or die (mysqli_error($conn));


}
?>
<script>
alert('Submitted Successfully. Thank You');
document.location="sales_parson_target.php";
</script>
<?php 