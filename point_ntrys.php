<?php 



/**

 * @author Nirmal Biswas

 * @copyright 2013

 */

$reqlevel = 3;

include("membersonly.inc.php");

$pack=$_POST['pack'];

$psl=$_POST['psl'];
$point=$_POST['point'];



$err="";

if($pack=='' or $psl=='' or $point=='')

{

	$err="Please Fill All Fields... ";

}

else

{



$query1="Select * from ".$DBprefix."point where pcd='$psl'";

   $result1 = mysqli_query($conn,$query1);

   $rcnt=mysqli_num_rows($result1);

   if($rcnt==0){

    $query21 = "INSERT INTO ".$DBprefix."point (pcd, pack, point) VALUES ('$psl', '$pack', '$point')";

$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));



?>

<Script language="JavaScript">

alert('Submit Successfully. Thank You...');

document.location="point_ntry.php";

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
document.location='point_ntry.php';

</script>

<?php 

   }



   

   

   

?>

