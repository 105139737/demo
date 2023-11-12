<?php
$reqlevel = 3;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$cdt=date('Y-m-d');
$edtm=date('Y-m-d h:i:s a');
set_time_limit(0);
$lot='1';

$get=mysqli_query($conn,"select * from main_suppl_data where sl>0 order by spn") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	$spn=$row['spn'];
	$Debit=$row['Debit'];
	$Credit=$row['Credit'];
	$GSTIN_UIN=$row['gst'];
	$addr=$row['addr'];
	$mob1=$row['mob1'];

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
	
$queryx="select * from ".$DBprefix."suppl where spn='$spn'";
$resultx = mysqli_query($conn,$queryx) or die(mysqli_error($conn));
$cntx=mysqli_num_rows($resultx);

if($cntx==0)
{
$query6 = "INSERT INTO ".$DBprefix."suppl (spn,nm,addr,mob1,mob2,email,edt,edtm,eby,gstin,pan) VALUES ('$spn','$cprsn','$addr','$mob1','$mob2','$email','$dt','$edtm','$user_currently_loged','$GSTIN_UIN','$pan')";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));

}
$data191= mysqli_query($conn,"select * from ".$DBprefix."suppl order by sl desc limit 0,1")or die(mysqli_error($conn));
while ($row19 = mysqli_fetch_array($data191))
{
$spn_sl=$row19['sl'];
}


$query6 = "INSERT INTO ".$DBprefix."suppl_gst (spn,addr,edt,edtm,eby,gstin,pan,st)
 VALUES ('$spn_sl','$addr','$dt','$edtm','$user_currently_loged','$GSTIN_UIN','$pan','$fst')";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));	
$dt="2018-03-31";
$query51="select * from ".$DBprefix."drcr order by vno";
$result51 = mysqli_query($conn,$query51);
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
	$result5 = mysqli_query($conn,$query5);
	$count6=mysqli_num_rows($result5);
}
$obal=0;
$ldgr=12;
	if($Credit>0)
    {
        $dldgr="-1";
        $cldgr=$ldgr;
		$obal=$Credit;
    }
    elseif($Debit>0)
    {
        $cldgr="-1";
        $dldgr=$ldgr;
		$obal=$Debit;
    }
	if($obal>0)
	{
$query21 = "INSERT INTO ".$DBprefix."drcr (pno,typ,vno,sid,dt,nrtn,dldgr,cldgr,amm,brncd,eby,edtm) VALUES ('$proj','11','$vcno','$spn_sl','$dt','Opening Balance','$dldgr','$cldgr','$obal','1','$user_currently_loged','$edt')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));
	}
}

