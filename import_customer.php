<?php 
include "config.php";
$edt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');

$result = mysqli_query($conn,"SELECT * FROM sheet1 order by slno");
while ($R = mysqli_fetch_array ($result))
{
$SALES_PERSON=strtoupper($R['SALES_PERSON']);
$Particulars=$R['Particulars'];
$Address=$R['Address'];
$cont=$R['cont'];
$State=$R['State'];
$GSTIN_UIN=$R['GSTIN_UIN'];
$catg=$R['catg'];
$brndsl="";
$get6=mysqli_query($conn,"select * from main_catg where cnm='$catg'") or die(mysqli_error($conn));
while($row5=mysqli_fetch_array($get6))
{
$brndsl=$row5['sl'];
}

$chk2=mysqli_query($conn,"select * from main_sale_per where spid='$SALES_PERSON'") or die(mysqli_error($conn));
if((mysqli_num_rows($chk2))==0)
{
$sql1 = mysqli_query($conn,"INSERT INTO main_sale_per (spid,typ,dt) VALUES ('$SALES_PERSON','4','$cdt')") or die(mysqli_error($conn));
$sql1 = mysqli_query($conn,"INSERT INTO main_signup(username,name,mob,addr,password,actnum,userlevel,brncd) VALUES('$SALES_PERSON','$nm','$mob','$addr','123','0','4','1')") or die (mysqli_error($conn));
}
$pan=substr($GSTIN_UIN,2,10);
$gstdt="2017-07-01";
$state=substr($GSTIN_UIN,0,2);	
$fst="1";
	$sql="SELECT * FROM main_state WHERE cd='$state'";
	$result1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result1))
	{
	$fst=$row['sl'];	
	}
	
$dsql=mysqli_query($conn,"select * from main_cust where cont='$cont' and nm='$Particulars'") or die (mysqli_error($conn));
$drcnt=mysqli_num_rows($dsql);
if($drcnt==0)
{	
$sql=mysqli_query($conn,"insert into main_cust(typ,nm,addr,cont,edt,edtm,eby,gstin,pan,gstdt,fst,brand,nmp,sale_per,pin,town,distn)
values('2','$Particulars','$Address','$cont','$edt','$dttm','$user_currently_loged','$GSTIN_UIN','$pan','$gstdt','$fst','$brndsl','$nmp','$SALES_PERSON','$pin','$town','$distn')") or die (mysqli_error($conn));


echo "insert into main_cust(typ,nm,addr,cont,edt,edtm,eby,gstin,pan,gstdt,fst,brand,nmp,sale_per,pin,town,distn)values('2','$Particulars','$Address','$cont','$edt','$dttm','$user_currently_loged','$GSTIN_UIN','$pan','$gstdt','$fst','$brndsl','$nmp','$SALES_PERSON','$pin','$town','$distn')<br>";
}
	}