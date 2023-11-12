<?php
$reqlevel = 3;
include("membersonly.inc.php");
include("function.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');

$sl=$_REQUEST[sl];

$brncd='';
$data=mysqli_query($conn,"select * from main_cust where  sl='$sl'")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
	$x=$row['sl'];
	$nm=$row['nm'];
	$nmp=$row['nmp'];
	$addr=$row['addr'];
	$cont=$row['cont'];
	$email=$row['mail'];
	$vat_no=$row['vat_no'];
	$gstin=$row['gstin'];
	$pan=$row['pan'];
	$typ=$row['typ'];
	$gstdt1=$row['gstdt'];
	$brand=$row['brand'];
	$sale_per=$row['sale_per'];
	$pin=$row['pin'];
	$town=$row['town'];
	$distn=$row['distn'];
	$brncd=$row['brncd'];
}
$cust_sl="";
$brand_sl="";
$data=mysqli_query($conn,"select * from main_cust where  cont='$cont'")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
	$sl=$row['sl'];
	$brand=$row['brand'];
	if($cust_sl==""){$cust_sl=$sl;}else{$cust_sl.=",".$sl;}
	if($brand_sl==""){$brand_sl=$brand;}else{$brand_sl.=",".$brand;}
}

if($brand_sl!='')
{
if($cont!='')	
{
//$get=mysqli_query($conn,"delete from main_signup where username='$cont'") or die(mysqli_error($conn));
$get=mysqli_query($conn,"delete from main_slp_brnd where spsl='$cont'") or die(mysqli_error($conn));
$get=mysqli_query($conn,"delete from main_cust_asgn where spid='$cont'") or die(mysqli_error($conn));
}
$data1=mysqli_query($conn,"select * from main_signup where  username='$cont'")or die(mysqli_error($conn));
$count=mysqli_num_rows($data1);
if($count==0)
{
$sqll=mysqli_query($conn,"insert into main_signup(username,name,mob,addr,password,actnum,userlevel,brncd) values('$cont','$nm','$cont','$addr','123','0','20','$brncd')") or die (mysqli_error($conn));
}
$sql=mysqli_query($conn,"insert into main_slp_brnd(spsl,catsl) values('$cont','$brand_sl')") or die (mysqli_error($conn));

$sql=mysqli_query($conn,"insert into main_cust_asgn(spid,cust,edt,eby,typ) values('$cont','$cust_sl','$edt','$user_currently_loged','1')") or die (mysqli_error($conn));

$get=mysqli_query($conn,"update main_cust set app='1' where sl='$sl'") or die(mysqli_error($conn));
?>
<script>
alert('App Permission Success....');
show();
</script>
<?
}
else
{
?>
<script>
alert('Please Check Customer Barnd....');
show();
</script>
<?
}
		

