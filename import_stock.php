<?php
$reqlevel = 3;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dtm=date('Y-m-d h:i:s a');
set_time_limit(0);


$get=mysqli_query($conn,"select * from lg_distributor group by BRAND") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$BRAND=$row['BRAND'];
$get5=mysqli_query($conn,"select * from main_catg where cnm='$BRAND'") or die(mysqli_error($conn));
if((mysqli_num_rows($get5))==0)
{
mysqli_query($conn,"INSERT INTO main_catg (cnm) VALUES ('$BRAND')") or die(mysqli_error($conn));
}

}

$get1=mysqli_query($conn,"select * from lg_distributor where CATEGORY!='' group by CATEGORY") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get1))
{
	$CATEGORY=$row['CATEGORY'];
	$BRAND=$row['BRAND'];
	$HSN=$row['HSN'];
	$GST_RATE=$row['GST_RATE'];
	
	$brndsl="";
	$get6=mysqli_query($conn,"select * from main_catg where cnm='$BRAND'") or die(mysqli_error($conn));
	while($row5=mysqli_fetch_array($get6))
	{
	$brndsl=$row5['sl'];
	}
	$cgst=$GST_RATE/2;
	$sgst=$GST_RATE/2;
	$chk1=mysqli_query($conn,"select * from main_scat where cat='$brndsl' and nm='$CATEGORY'") or die(mysqli_error($conn));
	if((mysqli_num_rows($chk1))==0)
	{
	$sql = mysqli_query($conn,"INSERT INTO main_scat (cat,nm,hsn,igst,cgst,sgst,fdt,tdt) VALUES ('$brndsl','$CATEGORY','$HSN','$GST_RATE','$cgst','$sgst','2018-07-09','2030-12-31')") or die(mysqli_error($conn));
	}
	else
	{
	$sql = mysqli_query($conn,"update main_scat set cat='$brndsl',nm='$CATEGORY',hsn='$HSN',igst='$GST_RATE',cgst='$cgst',sgst='$sgst' where cat='$brndsl' and nm='$CATEGORY'") or die(mysqli_error($conn));		
	}
	
}


$get4=mysqli_query($conn,"select * from lg_distributor ") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get4))
{
	$CATEGORY=$row['CATEGORY'];
	$BRAND=$row['BRAND'];
	$HSN=$row['HSN'];
	$GST_RATE=$row['GST_RATE'];
	$MODEL_NO=$row['MODEL_NO'];
	$GODOWN_NAME=$row['GODOWN_NAME'];
	$Rate=$row['Rate'];
	
	$cgst=$GST_RATE/2;
	$sgst=$GST_RATE/2;
	$brndsl="";
	$get6=mysqli_query($conn,"select * from main_catg where cnm='$BRAND'") or die(mysqli_error($conn));
	while($row5=mysqli_fetch_array($get6))
	{
	$brndsl=$row5['sl'];
	}
	$catsl="";
	$get7=mysqli_query($conn,"select * from main_scat where cat='$brndsl' and nm='$CATEGORY'") or die(mysqli_error($conn));
	while($row5=mysqli_fetch_array($get7))
	{
	$catsl=$row5['sl'];
	}
$chk3=mysqli_query($conn,"select * from main_product where pnm='$MODEL_NO'") or die(mysqli_error($conn));
if((mysqli_num_rows($chk3))==0)
{	
echo $query2 = "INSERT INTO ".$DBprefix."product (cat,scat,pnm,smvlu,mdvlu,bgvlu,hsn,mrp) 
VALUES ('$brndsl','$catsl','$MODEL_NO','$sret','$mret','$bret','$HSN','$ret')";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));	
$data= mysqli_query($conn,"select * from  ".$DBprefix."product order by sl desc LIMIT 1")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['sl'];
}
$sun='PCS';
$smvlu='1';

$ins=mysqli_query($conn,"INSERT INTO main_unit (sun,mun,bun,smvlu,mdvlu,bgvlu,cat)
VALUE ('$sun','$mun','$bun','$smvlu','$mdvlu','$bgvlu','$pcd')") or die(mysqli_error($conn));
 
$result=mysqli_query($conn,"INSERT INTO main_gst(cgst,sgst,igst,cat,fdt,tdt) VALUES ('$cgst','$sgst','$GST_RATE','$pcd','2018-07-09','2030-12-31')") or die(mysqli_error($conn));

//mysqli_query($conn,"INSERT INTO main_product_prc (brand,cat,modelno,prc,dis,disam,edt,edtm,eby,psl) VALUES ('$brndsl','$catsl','$MODEL_NO','$Rate','$dis','$disam','$dt','$edtm','$user_currently_loged','$pcd')") or die(mysqli_error($conn));
echo "<br>";	
}
}


$get4=mysqli_query($conn,"select * from lg_distributor ") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get4))
{
	$CATEGORY=$row['CATEGORY'];
	$BRAND=$row['BRAND'];
	$HSN=$row['HSN'];
	$GST_RATE=$row['GST_RATE'];
	$MODEL_NO=$row['MODEL_NO'];
	$GODOWN_NAME=$row['GODOWN_NAME'];
	$Rate=$row['Rate'];
	$stk_Rate=$row['stk_Rate'];
	$QTY=$row['QTY'];
	$betno=$row['betno'];


$brncd=$GODOWN_NAME;	
$data= mysqli_query($conn,"select * from  ".$DBprefix."product where pnm='$MODEL_NO'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['sl'];
}	
$unit='sun';
$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$pcd'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$usl=$roww['sl'];
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}

if($unit=='sun'){$stock_in=$QTY*$smvlu;$rate1=$rate/$smvlu;$uval=$smvlu;}
if($unit=='mun'){$stock_in=$QTY*$mdvlu;$rate1=$rate/$mdvlu;$uval=$mdvlu;}
if($unit=='bun'){$stock_in=$QTY*$bgvlu;$rate1=$rate/$bgvlu;$uval=$bgvlu;}	
$dt="2018-03-31";
 echo $query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,unit,opst,nrtn,eby,dtm,stat,ret,refno,usl,uval,betno,rate,stk_rate,lot)
VALUES ('$pcd','$brncd','$dt','$unit','$stock_in','Opening','$user_currently_loged','$dttm','1','$Rate','Opening','$usl','$uval','$betno','$Rate','$stk_Rate','13-10-2018')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
echo "<br>";
}	


	
	
	

