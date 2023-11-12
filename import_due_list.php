<?php
$reqlevel = 3;
include("membersonly.inc.php");
$edt=date('Y-m-d');
$cdt=date('Y-m-d');
$edtm=date('Y-m-d h:i:s a');
set_time_limit(0);
$lot='1';
$get1=mysqli_query($conn,"select * from bills_receivable where lot='$lot' group by SALES_PERSON") or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($get1))
{
$SALES_PERSON=strtoupper($row1['SALES_PERSON']);
$chk2=mysqli_query($conn,"select * from main_sale_per where spid='$SALES_PERSON'") or die(mysqli_error($conn));
if((mysqli_num_rows($chk2))==0)
{
$sql1 = mysqli_query($conn,"INSERT INTO main_sale_per (spid,typ,dt) VALUES ('$SALES_PERSON','4','$cdt')") or die(mysqli_error($conn));
$sql1 = mysqli_query($conn,"INSERT INTO main_signup(username,name,mob,addr,password,actnum,userlevel,brncd) VALUES('$SALES_PERSON','$nm','$mob','$addr','123','0','4','1')") or die (mysqli_error($conn));
}
}
$get=mysqli_query($conn,"select * from bills_receivable where lot='$lot' group by BRAND") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$BRAND=$row['BRAND'];
$get5=mysqli_query($conn,"select * from main_catg where cnm='$BRAND'") or die(mysqli_error($conn));
if((mysqli_num_rows($get5))==0)
{
mysqli_query($conn,"INSERT INTO main_catg (cnm) VALUES ('$BRAND')") or die(mysqli_error($conn));
}
}


$get=mysqli_query($conn,"select * from bills_receivable where lot='$lot' group by Party_Name") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	$partynm=$row['Party_Name'];
	$BRAND=$row['BRAND'];
	$addr=$row['addr'];
	$cont=$row['cont'];
	$GSTIN_UIN=$row['gst'];
	$brncd=$row['brncd'];
	
	$SALES_PERSON=strtoupper($row['SALES_PERSON']);
	
	$get6=mysqli_query($conn,"select * from main_catg where cnm='$BRAND'") or die(mysqli_error($conn));
	while($row5=mysqli_fetch_array($get6))
	{
	$brndsl=$row5['sl'];
	}
	
	$pan=substr($GSTIN_UIN,2,10);
$gstdt="2017-07-01";
$state=substr($GSTIN_UIN,0,2);	
$fst="1";
	$sql1="SELECT * FROM main_state WHERE cd='$state'";
	$result1 = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result1))
	{
	$fst=$row['sl'];	
	}
	
	if($BRAND=='Retail'){$typ='1';}else{$typ='2';}
	
	$chk1=mysqli_query($conn,"select * from main_cust where nm='$partynm'") or die(mysqli_error($conn));
	if((mysqli_num_rows($chk1))==0)
	{
	/*$sql = mysqli_query($conn,"INSERT INTO main_cust (nm,sale_per,brand,typ,fst,addr,cont,) VALUES ('$partynm','$SALES_PERSON','$brndsl','$typ','1')") or die(mysqli_error($conn));*/
	
$sql=mysqli_query($conn,"insert into main_cust(typ,nm,addr,cont,edt,edtm,eby,gstin,pan,gstdt,fst,brand,nmp,sale_per,pin,town,distn,brncd)
values('$typ','$partynm','$addr','$cont','$edt','$dttm','$user_currently_loged','$GSTIN_UIN','$pan','$gstdt','$fst','$brndsl','$nmp','$SALES_PERSON','$pin','$town','$distn','$brncd')") or die (mysqli_error($conn));
	}
	else
	{
	if($addr!='')	
	{
$sql = mysqli_query($conn,"update main_cust set addr='$addr',brand='$brndsl',cont='$cont' where nm='$partynm'") or die(mysqli_error($conn));	
	}
	}
	
$data19= mysqli_query($conn,"select * from main_cust order by sl desc limit 0,1")or die(mysqli_error($conn));
while ($row19 = mysqli_fetch_array($data19))
{
$csl=$row19['sl'];
}

$dsql=mysqli_query($conn,"select * from main_cust_asgn where spid='$SALES_PERSON'") or die (mysqli_error($conn));
$drcnt=mysqli_num_rows($dsql);
if($drcnt>0)
{

$sql=mysqli_query($conn,"update main_cust_asgn set cust=CONCAT(cust,',$csl') where spid='$SALES_PERSON'") or die (mysqli_error($conn));
}
else
{
$sql=mysqli_query($conn,"insert into main_cust_asgn(spid,cust,edt,eby) values('$SALES_PERSON','$csl','$dt','$user_currently_loged')") or die (mysqli_error($conn));
	
}

}

$get1=mysqli_query($conn,"select * from bills_receivable where lot='$lot' order by Date") or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($get1))
{
$SALES_PERSON=strtoupper($row1['SALES_PERSON']);
$dt=$row1['Date'];
$Ref_No=$row1['Ref_No'];
$Party_Name=$row1['Party_Name'];
$Pending=$row1['Pending'];
$brncd=$row1['brncd'];	
$sl=$row1['sl'];	
$query51="select * from ".$DBprefix."drcr order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['vno'];
}	
$vid1=substr($vnos,2,7);	
$count6=5;
while($count6>0)
{
$vid1=$vid1+1;
$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
$vcno="SV".$vnoc;
$query5="select * from ".$DBprefix."drcr where vno='$vcno'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);
}
$custnm="";
$get6=mysqli_query($conn,"select * from main_cust where nm='$Party_Name'") or die(mysqli_error($conn));
while($row5=mysqli_fetch_array($get6))
{
$custnm=$row5['sl'];
}

echo $query21 = "INSERT INTO ".$DBprefix."drcr (vno,cbill,cid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm,pay,sman) VALUES ('$vcno','$Ref_No','$custnm','$dt','Sale','4','-2','$Pending','$brncd','$user_currently_loged','$edtm','0','$SALES_PERSON')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));


$data191= mysqli_query($conn,"select * from ".$DBprefix."drcr order by sl desc limit 0,1")or die(mysqli_error($conn));
while ($row19 = mysqli_fetch_array($data191))
{
$dsl=$row19['sl'];
}
$sql = mysqli_query($conn,"update bills_receivable set dsl='$dsl' where sl='$sl'") or die(mysqli_error($conn));	

echo "<br>";
}



