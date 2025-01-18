<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cont=$_REQUEST['cont'];
$pin=$_REQUEST['pin'];
$distn=$_REQUEST['distn'];

$query21 = "UPDATE main_cust SET pin='$pin',distn='$distn' WHERE cont='$cont'";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 	

?>
<script>
show();
$('#compose-modal').modal('hide');	
</script>
