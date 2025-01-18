<?php 
$reqlevel = 3;
include("membersonly.inc.php");
set_time_limit(0);

$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$brncd=$_REQUEST['brncd'];
$typ=$_REQUEST['typ'] ?? "";

if($brncd!=""){ $brncd1=" and bcd='$brncd'";}else{$brncd1="";}
if($brncd!=""){ $brcd1=" and brncd='$brncd'";}else{$brcd1="";}

if($fdt!="" and $tdt!="")
{
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$todts=" and dt between '$fdt' and '$tdt'";
}else{$todts="";}

if($typ==1)
{
$file=date('Ymdhis').".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 
}
?>
<table <?php  if($typ!=1){?> border="0" width="860px"<?php  } else{?> border="1"  <?php  }?>  class="table table-hover table-striped table-bordered">
<thead>
<tr>
<td align="left" ><b>Date</b></td>
<td align="left" ><b>Customer Name</b></td>
<td align="left" ><b>Pan No.</b></td>
<td align="left" ><b>INV No.</b></td>
<td align="right" <b>INV Value</b></td>
<td align="right"<b>TCS Amount</b></td>
</tr>
<?php 
$cnt=0;
$tcsam1=0;
$qrrr= mysqli_query($conn,"select * from main_billing where sl>0 and tcsam>0 $todts  $brncd1");
while($row1=mysqli_fetch_array ($qrrr))
{
$blno_sl=$row1['sl'];
$blno=$row1['blno'];
$dt=$row1['dt'];
$tcsam=$row1['tcsam'];
$sid=$row1['cid'];
$invto=$row1['invto'];
$amm=$row1['amm'];
$dt=date('d-m-Y', strtotime($dt));
$pan="";
$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
$pan=$rowd['pan'];
}

?>
<tr>
<td align="left"><?php  echo $dt;?></td>
<td align="left"><?php  echo $nm;?></td>
<td align="left"><?php  echo $pan;?></td>
<td align="left"><?php  echo $blno;?></td>
<td align="right"><?php  echo $amm;?></td>
<td align="right"><?php  echo $tcsam;?></td>
</tr>
<?php 
$tcsam1+=$tcsam;
}
?>
<tr>

<td align="right" colspan="5"><b>Total  : </b></td>
<td align="right"><?php  echo $tcsam1;?></td>
</tr>
<?php 
echo "</table>";	
?>