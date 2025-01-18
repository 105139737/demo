<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$dt=date('Y-m-d');

$dttm=date('d-m-Y H:i:s');
$b=$_POST['cat'];
$sl=$_POST['sl'];
$hsn="NA";

$err="";

if($b=="" )
{
$err="Please Enter All Field...";	
}	

$query = "SELECT * FROM ".$DBprefix."catg where cnm='$b' and sl!='$sl'";
$result = mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
if($count>0)
{
$err="Data Already Exists...";
}
if($err=="")
{
$query2 = "Update ".$DBprefix."catg set cnm='$b',hsn='$hsn' where sl='$sl'";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));
$msg="Update Successfully. Thank You..!";
?>
<script language="javascript">
alert('<?php  echo $msg;?>');
document.location="pcat.php";
</script>
<?php 
}
else
{
?>
<script language="javascript">
alert('<?php  echo $err;?>');
window.history.go(-1);
</script>
<?php 	
}
?>







