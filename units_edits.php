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
$sl=$_POST['sl'];
$err="";
if($a=='' or $b=='' or $c=='' or $d=='')
{
	$err="Please Fill All Fields... ";
}
else
{

$query1="Select * from ".$DBprefix."unit where unitnm='$a' and pkgunt='$b' and untpkg='$c' and tunt='$d'";
   $result1 = mysqli_query($conn,$query1);
   $rcnt=mysqli_num_rows($result1);
   if($rcnt==0){
    $query21 = "Update ".$DBprefix."unit set unitnm='$a',pkgunt='$b',untpkg='$c',tunt='$d' where sl='$sl'";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));

?>
<Script language="JavaScript">
alert('Update Successfully. Thank You...');
document.location="unit_show.php";
</script>
<?php 
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
alert('<?php  echo $err;?>');
window.history.go(-1);
</script>
<?php 
   }

   
   
   
?>
