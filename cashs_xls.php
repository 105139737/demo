<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
		$fdt=$_REQUEST['fdt'];
		$tdt=$_REQUEST['tdt'];
		$snm=$_REQUEST[snm];
	$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($fdt=="" or $tdt==""){$ftdt="";}else{$fdt=date('Y-m-d', strtotime($fdt));$tdt=date('Y-m-d', strtotime($tdt));$ftdt=" and dt between '$fdt' and '$tdt'";}

if($snm!="")
{
	$snm1=" and cid='$snm'";

}
else
{
$snm1="";

}
$file="CASH/CREDIT SALE (".$fdt." To ".$tdt.").xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 

?>

<table width="60%" class="advancedtable" border="1" >
<tr>
<td  align="center">
<font color="red" size="3">Cash</font>
</td>
<td  align="center">
<font color="red" size="3">Credit</font>
</td>

</tr>

  <tr >
<td valign="top">
<table width="100%" class="advancedtable" border="1">
<tr bgcolor="#000">
   <td align="center">
     <b><font color="#FFF">Sl No.</font></b>
  </td>
    <td align="center">
     <b><font color="#FFF">Bill No.</font></b>
  </td>

  <td align="center">
     <b><font color="#FFF">Shop Name</font></b>
  </td>

     <td align="center">
     <b><font color="#FFF">Date</font></b>
  </td>
       <td align="center">
     <b><font color="#FFF">Amount</font></b>
	   </td>
	 

  </tr>
  
  <?php 

  $cnt=0;
$tin=0;
$slno=0;
   $g1=mysqli_query($conn,"select cbill,sl from main_drcr where nrtn='Sale' $snm1 $ftdt $brncd1 GROUP BY vno,cbill HAVING ( COUNT(vno) > 1 and  COUNT(cbill) > 1) order by dt");
    while($x=mysqli_fetch_array($g1))
    {
        $cbill=$x['cbill'];
		$sl=$x['sl'];
		
$cr1=mysqli_query($conn,"select * from main_billing where blno='$cbill'");
while($r=mysqli_fetch_array($cr1))
{
$blno=$r['blno'];

$cid=$r['cid'];

$caddr=$r['caddr'];
$cnt=$r['cnt'];
$edt=$r['edt'];
$vat=$r['vat'];
$amm=$r['amm'];

}

 $data4= mysqli_query($conn,"select * from  main_suppl where sid='$cid'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data4))
{

$spn=$row['spn'];
$cnm=$row['nm'];
}
	$slno++;		
  ?>
    <tr >

  <td align="center" title="<?php echo $sl?>">
  <font color="#000"><?php  echo $slno;?></font>
  </td>
  <td align="center">
<b><?php  echo $blno;?></b>
  </td>

  <td align="left">
  <font color="#000"><?php  echo $spn;?></font>
  </td>
    <td align="left">
  <font color="#000"><?php  echo $edt;?></font>
  </td>
  <td align="right">
  <font color="#000"><?php  echo $amm;?></font>
  </td>



  </tr>
  <?php 
$tin+=$amm;
	}
							
	
  ?>
<tr>
<td Colspan="4" align="right">
<b>Total Cash Sale:</b>
</td>
<td align="right">
<b><?php  echo $tin;?></b>
</td>
</tr>
  </table>
  </td>
  
  <td valign="top">
<table width="100%" class="advancedtable" border="1">
<tr bgcolor="#000">
   <td align="center">
     <b><font color="#FFF">Sl No.</font></b>
  </td>
    <td align="center">
     <b><font color="#FFF">Bill No.</font></b>
  </td>

  <td align="center">
     <b><font color="#FFF">Shop Name</font></b>
  </td>

     <td align="center">
     <b><font color="#FFF">Date</font></b>
  </td>
       <td align="center">
     <b><font color="#FFF">Amount</font></b>
	   </td>
	 

  </tr>
  
 <?php 

  $cnt=0;
$tin1=0;
$slno=0;
   $g=mysqli_query($conn,"select cbill,sl from main_drcr where nrtn='Sale' $snm1 $ftdt $brncd1 GROUP BY vno,cbill HAVING ( COUNT(vno) = 1 and  COUNT(cbill) = 1) order by dt");
    while($x=mysqli_fetch_array($g))
    {
        $cbill=$x['cbill'];
		$sl=$x['sl'];
		
$cr1=mysqli_query($conn,"select * from main_billing where blno='$cbill'");
while($r=mysqli_fetch_array($cr1))
{
$blno=$r['blno'];

$cid=$r['cid'];

$caddr=$r['caddr'];
$cnt=$r['cnt'];
$edt=$r['edt'];
$vat=$r['vat'];
$amm1=$r['amm'];

}

 $data4= mysqli_query($conn,"select * from  main_suppl where sid='$cid'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data4))
{

$spn=$row['spn'];
$cnm=$row['nm'];
}
	$slno++;		
  ?>
    <tr >

  <td align="center" title="<?php echo $sl?>">
  <font color="#000"><?php  echo $slno;?></font>
  </td>
  <td align="center">
<b><?php  echo $blno;?></b>
  </td>

  <td align="left">
  <font color="#000"><?php  echo $spn;?></font>
  </td>
    <td align="left">
  <font color="#000"><?php  echo $edt;?></font>
  </td>
  <td align="right">
  <font color="#000"><?php  echo $amm1;?></font>
  </td>



  </tr>
  <?php 
$tin1+=$amm1;
	}
							
	
  ?>
<tr>
<td Colspan="4" align="right">
<b>Total Credit Sale:</b>
</td>
<td align="right">
<b><?php  echo $tin1;?></b>
</td>
</tr>
  </table>
  </td>
  </tr>

  </table>
  