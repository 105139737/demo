<?php 

$reqlevel = 3;
include("membersonly.inc.php");
$dt=date('Y-m-d');

date_default_timezone_set('Asia/Kolkata');
$dttm=date('Y-m-d H:i:s');
$prnm=$_POST['prnm'];
$prid=$_POST['prid'];
$from=$_POST['from'];
$to=$_POST['to'];
$unt=$_POST['unt'];
$qunt=$_POST['qunt'];

$betno1=$_POST['betno'];

 $query3="Select * from ".$DBprefix."stock where sl='$betno1'";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{

$betno=$R3['betno'];
$expdt=$R3['expdt'];
$ret=$R3['ret'];
}



if($prid=='' or $from=='' or $to=='' or $unt=='' or $qunt=='' or $qunt=='0')
{

	?>
<script language="javascript">
alert('Please Fill All The Fields.');
window.history.go(-1);
</script>
<?php 
}
else
{

$data2= mysqli_query($conn,"select * from main_unit where pkgunt='$unt' or untpkg='$unt'");
while ($row2 = mysqli_fetch_array($data2))
{
  $tunt=$row2['tunt'];
}
$stout=$qunt*$tunt;

 $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$prid' and betno='$betno' and bcd='$branch_code' group by betno";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
if($stout>$stck)
{
	?>
<script language="javascript">
alert('Please Check Quantity...');
window.history.go(-1);
</script>
<?php 	
}	
else
{
$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,stout,nrtn,eby,dtm,betno,expdt,ret) VALUES ('$prid','$from','$dt','$stout','Stock Transfer','$user_currently_loged','$dttm','$betno','$expdt','$ret')";
$result21 = mysqli_query($conn,$query21); 

$data3= mysqli_query($conn,"select * from main_stock order by sl");
while ($row3 = mysqli_fetch_array($data3))
{
  $sl=$row3['sl'];
}

$query21 = "INSERT INTO main_trn(stsl,bcd) VALUES ('$sl','$to')";
$result21 = mysqli_query($conn,$query21); 



?>
<script language="javascript">
alert('Product Transfer Completed. Thank You.....');
document.location="stk_trn.php";
</script>
<?php   
}  

}    