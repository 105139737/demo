<?php
$reqlevel = 1;
include("membersonly.inc.php");
$err="";

$sl=$_POST['sl'];
$nm=$_POST['nm']; 
if($nm=="")
{
	$err="Please Fill Menu Name....!!";
}

$qr=mysqli_query($conn,"select * from main_appmenu where nm='$nm' and sl!='$sl'")or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0)
{
$err="Duplicate Menu Name...!!";
}

if($err=="")
{
$result=mysqli_query($conn,"update main_appmenu set nm='$nm' where sl='$sl'");
?>
<script>
alert("Update Successfully....");
document.location="menu_setup.php";
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