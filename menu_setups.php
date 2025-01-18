<?php 
$reqlevel =1;
include("membersonly.inc.php");
$err="";

$nm=$_POST['nm'];
if($nm=="") 
{
	$err="Please Fill Menu Name....!!";
}

$qr=mysqli_query($conn,"select * from main_appmenu where nm='$nm'")or die(mysqli_error($conn));
$count=mysqli_num_rows($qr);
if($count>0)
{
$err="Duplicate Menu Name...!!";
}

if($err=="")
{
$insert=mysqli_query($conn,"insert into main_appmenu(nm) values('$nm')")or die(mysqli_error($conn));
?>
<script>
alert("Submitted Successfully....");
document.location="menu_setup.php";
</script>
<?php 
}
else
{
?>
<script>
alert('<?php  echo $err;?>');
window.history.go(-1);
</script>
<?php 
}
?>