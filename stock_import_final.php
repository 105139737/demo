<?php
$reqlevel = 3;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dtm=date('Y-m-d h:i:s a');
set_time_limit(0);
$brncd=$_REQUEST['brncd'];
$get=mysqli_query($conn,"select * from main_stk_tmp where eby='$user_currently_loged' and modelno!='' group by brnd") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	$brnd=$row['brnd'];
	$chk1=mysqli_query($conn,"select * from main_catg where cnm='$brnd'") or die(mysqli_error($conn));
	if((mysqli_num_rows($chk1))==0)
	{
	$sql = mysqli_query($conn,"INSERT INTO main_catg (cnm,dt) VALUES ('$brnd','$dt')") or die(mysqli_error($conn));
	}
	else
	{
		$sql1 = mysqli_query($conn,"Update main_catg set dt='$dt' where cnm='$brnd'") or die(mysqli_error($conn));	
	}
}

$get1=mysqli_query($conn,"select * from main_stk_tmp where eby='$user_currently_loged' and modelno!='' group by cat") or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($get1))
{
	$cat=$row1['cat'];
	$brnd1=$row1['brnd'];
	$get2=mysqli_query($conn,"select * from main_catg where cnm='$brnd1'") or die(mysqli_error($conn));
	while($row2=mysqli_fetch_array($get2))
	{
	$cnmsl=$row2['sl'];
	}
	$chk2=mysqli_query($conn,"select * from main_scat where cat='$cnmsl' and nm='$cat'") or die(mysqli_error($conn));
	if((mysqli_num_rows($chk2))==0)
	{
	$sql2 = mysqli_query($conn,"INSERT INTO main_scat (cat,nm,dt) VALUES ('$cnmsl','$cat','$dt')") or die(mysqli_error($conn));
	}
	else
	{
	$sql1 = mysqli_query($conn,"Update main_scat set dt='$dt' where cat='$cnmsl' and nm='$cat'") or die(mysqli_error($conn));		
	}
	
}

	
$get4=mysqli_query($conn,"select * from main_stk_tmp where eby='$user_currently_loged' and modelno!='' group by modelno") or die(mysqli_error($conn));
while($row4=mysqli_fetch_array($get4))
{
	$modelno=$row4['modelno'];
	$brand=$row4['brnd'];
	$catnm=$row4['cat'];
	$get22=mysqli_query($conn,"select * from main_catg where cnm='$brand'") or die(mysqli_error($conn));
	while($row22=mysqli_fetch_array($get22))
	{
	$bb=$row22['sl'];
	}
	$get3=mysqli_query($conn,"select * from main_scat where cat='$bb' and nm='$catnm'") or die(mysqli_error($conn));
	while($row3=mysqli_fetch_array($get3))
	{
	$cc=$row3['sl'];
	}
	
	$chk3=mysqli_query($conn,"select * from main_product where cat='$bb' and scat='$cc' and pnm='$modelno'") or die(mysqli_error($conn));
	if((mysqli_num_rows($chk3))==0)
	{
	$sql3 = mysqli_query($conn,"INSERT INTO main_product (cat,scat,pnm,cdt) VALUES ('$bb','$cc','$modelno','$dt')") or die(mysqli_error($conn));
	}
	else
	{
		mysqli_query($conn,"UPDATE main_product SET cdt='$dt' where cat='$bb' and scat='$cc' and pnm='$modelno'") or die(mysqli_error($conn));
	}
	
	

}

	
	mysqli_query($conn,"UPDATE main_stock SET sstat='1' WHERE pstat='1' and bcd='$brncd'") or die(mysqli_error($conn));
	mysqli_query($conn,"UPDATE main_stk_in SET sstat='1' WHERE pstat='1'  and brncd='$brncd'") or die(mysqli_error($conn));
	


$get9=mysqli_query($conn,"select * from main_stk_tmp where eby='$user_currently_loged'  and modelno!=''") or die(mysqli_error($conn));
while($row9=mysqli_fetch_array($get9))
{
	$stk=$row9['stk'];
	$modelno=$row9['modelno'];
	$brand=$row9['brnd'];
	$catnm=$row9['cat'];
	
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
	
$yyy=$yy."%";
$query51="select * from ".$DBprefix."stk_in where blno like '$yyy' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51);
while($rows=mysqli_fetch_array($result51))
{
	$vnos=$rows['blno'];
}
	$vid=substr($vnos,8,6);

$count5=1;
while($count5>0)
{
$vid=$vid+1;
$vno=str_pad($vid, 6, '0', STR_PAD_LEFT);
$blno=$yy.'-P'.$vno;
$query5="select * from ".$DBprefix."stk_in where blno='$blno'";
$result5 = mysqli_query($conn,$query5);
$count5=mysqli_num_rows($result5);
}	
	
	
	$get99=mysqli_query($conn,"select * from main_catg where cnm='$brand'") or die(mysqli_error($conn));
	while($row99=mysqli_fetch_array($get99))
	{
	$brndsl=$row99['sl'];
	}
	$get91=mysqli_query($conn,"select * from main_scat where cat='$brndsl' and nm='$catnm'") or die(mysqli_error($conn));
	while($row91=mysqli_fetch_array($get91))
	{
	$catsl=$row91['sl'];
	}
	$get911=mysqli_query($conn,"select * from main_product where cat='$brndsl' and scat='$catsl' and pnm='$modelno'") or die(mysqli_error($conn));
	while($row911=mysqli_fetch_array($get911))
	{
	$pcd=$row911['sl'];
	}
	

	
	mysqli_query($conn,"INSERT INTO main_stk_in (blno,brnd,cat,modelno,stk,eby,edt,edtm,brncd,pstat,sstat) VALUES ('$blno','$brand','$catnm','$modelno','$stk','$user_currently_loged','$dt','$dtm','$brncd','1','0')") or die(mysqli_error($conn));

	mysqli_query($conn,"INSERT INTO main_stock (brnd,cat,pcd,bcd,dt,stin,nrtn,dtm,eby,refno,pbill,pstat,sstat) VALUES ('$brndsl','$catsl','$pcd','$brncd','$dt','$stk','Purchase','$dtm','$user_currently_loged','$blno','$blno','1','0')") or die(mysqli_error($conn));
	
	
	}

	mysqli_query($conn,"DELETE FROM main_stk_tmp WHERE eby='$user_currently_loged'") or die(mysqli_error($conn));

?>
<script>
alert('Upload Data From Excel...!!');
showw();
</script>


