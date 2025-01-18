<?php  
$reqlevel = 1;
include("membersonly.inc.php");
$scat=$_REQUEST['scat'];
$hsn="";
$data3 = mysqli_query($conn,"Select * from main_scat where sl='$scat'");
while ($row3 = mysqli_fetch_array($data3))
	{
	$hsn=$row3['hsn'];
	}
?>
<input type="text" class="form-control" id="hsn" name="hsn" value="<?php  echo $hsn;?>" placeholder="Enter HSN" required>


