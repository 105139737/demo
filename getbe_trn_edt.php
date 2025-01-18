<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$pcd=$_REQUEST[pcd];
$fbcd=$_REQUEST[fbcd];
$stck=0;
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and bcd='$fbcd'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
if($stck=="")
{
$stck=0;	
}
?>
<input type="text" class="sc" id="sih" readonly name="sih" value="<?php  echo $stck;?>"  size="12">
