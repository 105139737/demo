<?php  
$reqlevel = 1;
include("membersonly.inc.php");
$scat=$_REQUEST['scat'];
$igst=0;
$data1 = mysqli_query($conn,"Select * from main_scat where sl='$scat'");
while ($row1 = mysqli_fetch_array($data1))
	{
	$igst=$row1['igst'];
	}
?>
<input type="text" class="form-control" id="igst" name="igst" value="<?php  echo $igst;?>" placeholder="Enter IGST" required>


