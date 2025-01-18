<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$val_invto="";
$refsl="";
set_time_limit(0);

include("function.php");
$fdt=$_REQUEST['fdt'] ?? "";
$tdt=$_REQUEST['tdt'] ?? "";
$snm=$_REQUEST['snm'] ?? "";
$brncd=$_REQUEST['brncd'] ?? "";
$sman=$_REQUEST['sman'] ?? "";
$val=$_REQUEST['val'] ?? "";
$dt=$_REQUEST['dt'] ?? "";
$invto=$_REQUEST['invto'] ?? "";
$order_by=$_REQUEST['order_by'] ?? "";
$cat=$_REQUEST['cat'] ?? "";
$day=$_REQUEST['day'] ?? "";

$btyp=rawurldecode($_REQUEST['btyp'] ?? "");
$btyp=str_replace("@","'",$btyp);
$blno=rawurldecode($_REQUEST['blno']);if($blno!=""){$blno1=" and cbill like '%$blno%' ";}else{$blno1="";}
if($btyp==""){$btyp1="";}else{$btyp1=" and ($btyp)";}
if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($sman==""){$sman1="";}else{$sman1=" and sman='$sman'";}
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}
if($refsl!=""){$refsl1=" and refsl='$refsl'";}else{$refsl1="";}

//if($btyp!=""){$btyp1=" and cbill like '$btyp%'";}else{$btyp1="";}

if($order_by!=""){$order_by1="cid,dt";}else{$order_by1="dt";}

if($dt!="" ){$dt=date('Y-m-d', strtotime($dt));$dt_q=date('Y-m-d', strtotime($dt));$date=" and dt<='$dt'";}else{$date="";}
$qury="";
if($cat!='')
{
$query="select * from main_cust WHERE sl>0 and brand='$cat' and typ='2' order by nm";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$cid=$rw['sl'];
if($qury=="")
{
$qury=" and (cid='$cid'	";
}
else
{
$qury.=" or cid='$cid'";	
}
}
if($qury!=""){$qury.=")";}
}

$qury_cust="";
if($sman!='')
{
$query="select * from main_cust_asgn WHERE sl>0 and spid='$sman'";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$cust=$rw['cust'];
if($cust!="")
{
$qury_cust="  and FIND_IN_SET(cid, '$cust')>0";
}

}

}
if($day!="")
{
  $tskdt=date("Y-")."%";
  $cust="";
  if($sman==""){$spid1="";}else{$spid1=" and spid='$sman'";}
   $data_day = mysqli_query($conn,"Select * from main_task where sl in (select max(sl) from main_task where day='$day' and dt like '$tskdt' $spid1 group by spid) ");
	while ($row1 = mysqli_fetch_array($data_day))
	{
	 $sl=$row1['sl'];
	$cust1=$row1['cust'];
  if($cust=="")
  {
    $cust=$cust1;
  }
  else
  {
    $cust.=",".$cust1; 
  }
  }
  $qury_cust="  and FIND_IN_SET(cid, '$cust')>0";
}


if($invto!='' or $refsl!='')
{
$val_invto="";
if($invto!=""){$invto1=" and invto='$invto'";}else{$invto1="";}	
$data2= mysqli_query($conn,"select * from  main_billing where sl>0 $invto1 $refsl1 $date")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$blno_s=$row2['blno'];
if($val_invto=="")
{
$val_invto=" and (cbill='$blno_s'";
}
else
{
$val_invto.="or cbill='$blno_s'";	
}
}
if($val_invto!="")
{
$val_invto.=")";
}
}




$cdt=$dt;
$dis1=0;
if($val=='1')
{
$file="Due_List.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 	
$broder="border='1'";
}

$due_stat=$_REQUEST['due_stat'];

$gbt=mysqli_query($conn,"select * from main_cust where sl='$snm'");
while($GB=mysqli_fetch_array($gbt))
{
$bto=$GB['nm'];
$nmp=$GB['nmp'];
$baddr=$GB['addr'];
$bmob=$GB['cont'];
$i=1;
}

$data11= mysqli_query($conn,"select * from  main_drcr where sl>0  and cbill!='' and retn_stat!='1'  and paid='0' $brncd1  $snm1 $qury_cust $btyp1 $date $blno1 $val_invto $qury group by cbill order by $order_by1 ") or die(mysqli_error($conn));
$count=mysqli_num_rows($data11);
?>
<span><font size="3" color="red"><b>Total Bill : <?php  echo $count;?></b></font></span>