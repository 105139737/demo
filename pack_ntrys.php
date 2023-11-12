<?php

/**
 * @author Nirmal Biswas
 * @copyright 2013
 */
$reqlevel = 3;
include("membersonly.inc.php");
$pack=$_POST['pack'];
$psl=$_POST['psl'];

$err="";
if($pack=='' or $psl=='')
{
	$err="Please Fill All Fields... ";
}
else
{

$query1="Select * from ".$DBprefix."pack where psl='$psl'";
   $result1 = mysqli_query($conn,$query1);
   $rcnt=mysqli_num_rows($result1);
   if($rcnt==0){
    $query21 = "INSERT INTO ".$DBprefix."pack (pack,psl) VALUES ('$pack','$psl')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));

?>
<Script language="JavaScript">
alert('Submit Successfully. Thank You...');
document.location="pack_ntry.php";
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
