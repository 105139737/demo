<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$cdt=date('Y-m-d');
$edtm=date('Y-m-d h:i:s a');
set_time_limit(0);


$get2=mysqli_query($conn,"select * from main_drcr where nrtn='Payment' and typ='77' and blno='' order by dt") or die(mysqli_error($conn));
while($row2=mysqli_fetch_array($get2))
{
$blno=$row2['cbill'];
$brncd=$row2['brncd'];
$dt=$row2['dt'];
$custnm=$row2['cid'];
$dldgr=$row2['dldgr'];
$mdt=$row2['mtd'];
$pamm=$row2['amm'];
$crfno=$row2['mtddtl'];
$user_currently_loged=$row2['eby'];
$sale_per=$row2['sman'];
$blnon=$row2['blnon'];
$dsl=$row2['sl'];
$nrtn='';

$get1=mysqli_query($conn,"select * from main_billing where blno='$blno'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get1))
{
$bill_typ=$row['bill_typ'];
$disl=$row['disl'];
$remk=$row['remk'];
$damm=$row['damm'];
}

$get3=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get3))
{
$als=$row['als'];
$tp=$row['tp'];
$adrs=$row['adrs'];
$ssn=$row['ssn'];
$start_no=$row['start_no'];
$rv=$row['rv'];
}


$get=mysqli_query($conn,"select * from main_billtype where sl='$rv'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$als1=$row['als'];
$tp1=$row['tp'];
$adrs1=$row['adrs'];
$ssn1=$row['ssn'];
$start_no1=$row['start_no'];
}	


$count6=5;
$query51="select * from ".$DBprefix."drcr where als='$als1' and ssn='$ssn1' and blnon!='' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
$vnos=$rows['blnon'];
}

$bill=explode($als1,$vnos);
$bill1=explode($ssn1,$bill[1]);

$vnos=$bill1[0];

if($start_no1>$vnos)
{
$vnos=$start_no1;
}

$vid1=$vnos;

while($count6>0){
$vid1=$vid1+1;
//$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);
$vnoc=$vid1;
$blnon=$als1.$vnoc.$ssn1;
$query5="select * from ".$DBprefix."drcr where blnon='$blnon'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);
}

$query511="select * from main_recv where blno!='' order by sl desc limit 0,1";
$result511 = mysqli_query($conn,$query511) or die(mysqli_error($conn));
while($rows1=mysqli_fetch_array($result511))
{	
$vnos1=$rows1['blno'];
}	
$vid11=substr($vnos1,2,7);	
$count66=5;
while($count66>0)
{
$vid11=$vid11+1;
$vnoc1=str_pad($vid11, 7, '0', STR_PAD_LEFT);
$blno1="RC".$vnoc1;
$query51="select * from main_recv where blno='$blno1'";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
$count66=mysqli_num_rows($result51);
}	


echo $query31 = "INSERT INTO main_recv (blno,bcd,dt,cid,nrtn,dldgr,paymtd,tamm,refno,bill_type,als,ssn,eby,edt,app_ref,spid,lot) VALUES 
('$blno1','$brncd','$dt','$custnm','$nrtn','$dldgr','$mdt','$pamm','$crfno','$rv','$als1','$ssn1','$user_currently_loged','$cdt','$blno_ref','$sale_per','1')";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));

echo '<br>';
$query31 = "INSERT INTO main_recv_app (blno,bcd,dt,cid,nrtn,dldgr,paymtd,tamm,refno,bill_type,als,ssn,eby,edt,stat,spid,lot) VALUES 
('$blno1','$brncd','$dt','$custnm','$nrtn','$dldgr','$mdt','$pamm','$crfno','$rv','$als1','$ssn1','$sale_per','$cdt','1','$sale_per','1')";
$result31 = mysqli_query($conn,$query31)or die (mysqli_error($conn));


$query21 = "INSERT INTO main_recv_dtl(ref,blno,amm,sman,cid,eby,brncd,disl,damm,remk,lot)
VALUES ('$blno1','$blno','$pamm','$sale_per','$custnm','$user_currently_loged','$brncd','$disl','$damm','$remk','1')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	


$query21 = "INSERT INTO main_recv_dtl_app(ref,blno,amm,sman,cid,eby,brncd,disl,damm,remk,lot)
VALUES ('$blno1','$blno','$pamm','$sale_per','$custnm','$user_currently_loged','$brncd','$disl','$damm','$remk','1')";
$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));	
mysqli_query($conn,"UPDATE main_billing SET blno1='$blno1',blnon='$blnon' WHERE blno='$blno'");
mysqli_query($conn,"UPDATE main_drcr SET als='$als1',ssn='$ssn1',bill_typ='$rv',blnon='$blnon',blno='$blno1' WHERE sl='$dsl'");

}

	
	
	

