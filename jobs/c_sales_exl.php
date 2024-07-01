<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set("memory_limit", "-1");
include("../config.php");
include("../function.php");
include("../Numbers/Words.php");
date_default_timezone_set('Asia/Kolkata');
ob_start();
set_time_limit(0);

$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=$_REQUEST['snm'];
$btyp=$_REQUEST['btyp'];
$brncd=$_REQUEST['brncd'];
$snm1="";$brncd1="";$brcd1="";
if($snm!=""){ $snm1=" and cont='$snm'";}else{$snm1="";}
if($brncd!=""){ $brncd1=" and bcd='$brncd'";}else{$brncd1="";}
if($brncd!=""){ $brcd1=" and brncd='$brncd'";}else{$brcd1="";}
$todts="";
if($fdt!="" and $tdt!="")
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$todts=" and dt between '$fdt' and '$tdt'";
}else{$todts="";}
$btyp1="";
if($btyp!=""){ $btyp1=" and bill_typ='$btyp'";}

?>

<table border="1">
<thead>
<tr>
<td align="left" width="10%"><b>Sl.No.</b></td>
<td align="left" width="40%"><b>Name</b></td>
<td align="center" width="30%"><b>Mobile</b></td>
<td align="right" width="20%"><b>Amount</b></td>
</tr>
<?php
$cnt=0;

$query10="Select * from  main_cust where sl>0 $snm1 $brcd1 group by cont";
$result10 = mysqli_query($conn,$query10);
while ($R10 = mysqli_fetch_array ($result10))
{
$q="";
$cont=$R10['cont'];	
$nmp=$R10['nmp'];	
$nm=$R10['nm'];
if($nmp==""){$nm1=$nm;}else{$nm1=$nmp;}
/*--------*/	

$query="Select * from  main_cust where cont='$cont' $brcd1";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$csl=$R['sl'];
if($q=="")
{
$q=" and ( cid='$csl'";
}
else
{
$q.=" or cid='$csl'";	
}
}

if($q!="")
{
$q.=')';
}
$tamm=0;
$qrrr= mysqli_query($conn,"select cid,sum(amm) as tamm,bill_typ from main_billing where sl>0 $todts $btyp1 $brncd1 $q ");
while($r1=mysqli_fetch_array ($qrrr))
{
$tamm=$r1['tamm'];	
}
if($tamm>0)
{
$cnt++;		
?>
<tr>
<td align="left"><?php echo $cnt;?></td>
<td align="left"><?php echo $nm;?></td>
<td align="left"><?php echo $cont;?></td>
<td align="right"><?php echo $tamm;?></td>
</tr>
<?
}
}
echo "</table>";	

$imgbinary = ob_get_clean();
$filename="jobs_report/".$_GET['file_name'].".xls";
file_put_contents($filename, $imgbinary);
?>