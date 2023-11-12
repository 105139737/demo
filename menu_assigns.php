<?php
$reqlevel =1;
include("membersonly.inc.php");
$err="";

$username=$_POST['username'];
$nm=implode(",",$_POST['nm']);
if($username=="")
{
	$err="Please Fill Menu Name....!!";
}

$qr=mysqli_query($conn,"select * from main_approll where username='$username'")or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0)
{
$err="Duplicate Menu Name...!!";
}

if($err=="")
{
$insert=mysqli_query($conn,"insert into main_approll(username,msl) values('$username','$nm')")or die(mysqli_error($conn));
?> 
<script>
alert("Submitted Successfully....");
document.location="menu_assign.php";
</script>
<?php
}
else
{
?>
<script>
alert('<?php echo $err;?>');
window.history.go(-1);
</script>
<?php
}
?>