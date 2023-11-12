<?php

/**
 * @author Nirmal Biswas
 * @copyright 2013
 */
$reqlevel = 3;
include("membersonly.inc.php");
$a=$_POST['unm'];
$b=$_POST['pun'];
$c=$_POST['sunt'];
$d=$_POST['unp'];
$err="";
if($a=='' or $b=='' or $c=='' or $d=='')
{
	$err="Please Fill All Fields... ";
}
else
{

$query1="Select * from ".$DBprefix."unit where unitnm='$a'";
   $result1 = mysqli_query($conn,$query1);
   $rcnt=mysqli_num_rows($result1);
   if($rcnt==0){
    $query21 = "INSERT INTO ".$DBprefix."unit (unitnm,pkgunt,untpkg,tunt) VALUES ('$a','$b','$c','$d')";
$result21 = mysqli_query($conn,$query21);

?>
<Script language="JavaScript">
alert('Submit Successfully. Thank You...');
document.location="unit.php";
</script>
<?
   }
   else
   {
	 $err="Data Already Exists...";  
	 
	 }
   }
   if($err!='')
   {
	       ?>
<Script language="JavaScript">
alert('<? echo $err;?>');
window.history.go(-1);
</script>
<?
   }

   
   
   
?>
