<?php
$reqlevel = 1;
include("membersonly.inc.php");
$dt=$_REQUEST['dt'];
$dt=date("Y-m-d", strtotime($dt));
$m=date('m', strtotime($dt));
$y=date('y', strtotime($dt));;
if($m>=4)
{
$yy=$y."-".($y+1)."/";	
	
}
elseif($m<=3)
{
$yy=($y-1)."-".$y."/";	
}
$yy1="CD".$yy."%";
$query51="select * from main_cdnr where refno!='' and refno like '$yy1' order by sl";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['refno'];
}	
$vid1=substr($vnos,8,5);	
$count6=5;
while($count6>0)
{
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);
$refno="CD".$yy.$vnoc;
$query5="select * from main_cdnr where refno='$refno'";
$result5 = mysqli_query($conn,$query5);
$count6=mysqli_num_rows($result5);
}
?>
<input type="text" name="refno" id="refno" class="form-control" value="<?=$refno;?>" readonly required>
