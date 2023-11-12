<?php
$reqlevel = 3;
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$ldgr=$_REQUEST['ldgr'];
$brsdt=$_REQUEST['brsdt'];
$fdt=date('Y-m-d',strtotime($fdt));
$tdt=date('Y-m-d',strtotime($tdt));
$brs_dtt="";
if($brsdt=="YES")
{
$brs_dtt=" and brs_dt>'2000-01-01'";
}
elseif($brsdt=="NO")
{
$brs_dtt=" and brs_dt<'2000-01-01'";
}

$data123= mysqli_query($conn,"SELECT sum(amm) as odr FROM main_drcr where dldgr='$ldgr' and dt<='$tdt' ")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data123))
{
$ssspdr=$row2['odr'];
}

$data223= mysqli_query($conn,"SELECT sum(amm) as tcr FROM main_drcr where cldgr='$ldgr' and dt<='$tdt'")or die(mysqli_error($conn));
while ($row22 = mysqli_fetch_array($data223))
{
$ssopcr=$row22['tcr'];
}

$sys_total=$ssspdr-$ssopcr;


$data12= mysqli_query($conn,"SELECT sum(amm) as odr FROM main_drcr where dldgr='$ldgr' and dt<'$fdt' and brs_dt>'2000-01-01'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data12))
{
$opdr=$row2['odr'];
}

$data22= mysqli_query($conn,"SELECT sum(amm) as tcr FROM main_drcr where cldgr='$ldgr' and dt<'$fdt' and brs_dt>'2000-01-01'")or die(mysqli_error($conn));
while ($row22 = mysqli_fetch_array($data22))
{
$opcr=$row22['tcr'];
}


$data1= mysqli_query($conn,"SELECT sum(amm) as odr FROM main_drcr where dldgr='$ldgr' and (dt between '$fdt' and '$tdt') and brs_dt>'2000-01-01'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
 $total_dr=$row1['odr'];
}

$data11= mysqli_query($conn,"SELECT sum(amm) as tcr FROM main_drcr where cldgr='$ldgr' and (dt between '$fdt' and '$tdt') and brs_dt>'2000-01-01'")or die(mysqli_error($conn));
while ($row11 = mysqli_fetch_array($data11))
{
 $total_cr=$row11['tcr'];
}
$tdr=round($total_dr+$opdr,2);
$tcr=round($total_cr+$opcr,2);
$bal=round($tdr-$tcr,2);

if($bal>0)
{
$bal1=$bal." Dr";	
}
elseif($bal<0)
{
$bal1=$bal*(-1)." Cr";		
}
$sys_total1=round($sys_total-$bal,2);
echo $tdr."@@".$tcr."@@".$bal1."@@".$bal;
?>
