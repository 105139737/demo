<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dtm=date('Y-m-d h:i:s a');
set_time_limit(0);

	 
$get4=mysqli_query($conn,"select * from main_product_prc_temp where eby='$user_currently_loged'") or die(mysqli_error($conn));
while($row4=mysqli_fetch_array($get4))
{
	$modelno=$row4['modelno'];
	$prc=$row4['prc'];
	$dis=$row4['dis'];
	$disam=$row4['disam'];
	$edt=$row4['edt'];
	$edtm=$row4['edtm'];
	$offprc=$row4['offprc'];
	$offless=$row4['offless'];
	$lprc=$row4['lprc'];
	$psl="";
	$brand="";
	$cat="";
	$stat=0;
	$get11=mysqli_query($conn,"select * from main_product where pnm='$modelno'") or die(mysqli_error($conn));
	$count=mysqli_num_rows($get11);	
	while($row1=mysqli_fetch_array($get11))
	{
	$psl=$row1['sl'];
	$brand=$row1['cat'];
	$cat=$row1['scat'];
	$stat=$row1['stat'];
	}
if($count>0)
{
	mysqli_query($conn,"INSERT INTO main_product_prc (brand,cat,modelno,prc,dis,disam,offprc,offless,lprc,edt,edtm,eby,psl,status) VALUES ('$brand','$cat','$modelno','$prc','$dis','$disam','$offprc','$offless','$lprc','$edt','$edtm','$user_currently_loged','$psl','$stat')") or die(mysqli_error($conn));
}
}


	mysqli_query($conn,"DELETE FROM main_product_prc_temp WHERE eby='$user_currently_loged'") or die(mysqli_error($conn));

?>
<script>
alert('Upload Data From Excel...!!');
showw();
</script>


