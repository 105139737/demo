<?php
$reqlevel = 1;
include("membersonly.inc.php");
$err="";

$sl=$_POST['sl'];
$username=$_POST['username'];
$nm=implode(",",$_POST['nm']);
if($username=="")
{
	$err="Please Fill Menu Name....!!";
}

$qr=mysqli_query($conn,"select * from main_approll where msl='$nm' and sl!='$sl'")or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0)
{ 
//$err="Duplicate Menu Name...!!";
}

if($err=="")
{
$result=mysqli_query($conn,"update main_approll set username='$username',msl='$nm' where sl='$sl'");
?>
<script>
alert("Update Successfully....");
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