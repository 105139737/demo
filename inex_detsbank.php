<?php 
$reqlevel=1;
include("membersonly.inc.php");
set_time_limit(0);

$dt="";
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$pno1=$_REQUEST['pno'] ?? "";
if($pno1!='')
{$pno=" and pno='$pno1' $brncd1";}else{$pno=" $brncd1";}



if($fdt=="" or $tdt=="")
{ 
echo 'Please Enter Valid Date Range.';
}
else
{
date_default_timezone_set('Asia/Kolkata');
$dt3 = date('y-m-d');
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

$qry1=" and (dt between '$fdt' and '$tdt')";

}
$prevdt = strtotime ( "- 1 day" , strtotime ( $fdt) ) ;
$prevdt = date ( 'Y-m-d' , $prevdt );

$diff=dates_diff_month($fdt,$tdt);
if($diff>0){
?>
<script language="javascript">
alert("You have to excel export if you want to see data of more than "+30+" day");
</script>
<?php 
die('<b><center><font color="green" size="5">You have to excel export if you want to see data of more than 30 day </font></center></b>');

}

?>
<table width="100%" border="1"  >

<tr  >
<th colspan="2" align="left" >
<font color="#000000" size="3">
Bank A/c Details <?php echo $dt?> As On  <?php echo $fdt?> to <?php echo $tdt?>
</font>
</th>
</tr>

<?php 
	$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='1' or gcd='22'");
		while ($row33 = mysqli_fetch_array($data33))
		{
		$ledgr=$row33['sl'];
		$lnm=$row33['nm'];
		
$result33 = mysqli_query($conn,"SELECT sum(amm) as damm FROM main_drcr where (dt between '1970-01-01' and '$prevdt') and dldgr='$ledgr' $pno");
while ($R1 = mysqli_fetch_array ($result33))
{
$damm=$R1['damm'];
}
$result = mysqli_query($conn,"SELECT sum(amm) as camm FROM main_drcr where (dt between '1970-01-01' and '$prevdt') and cldgr='$ledgr' $pno");
while ($R1 = mysqli_fetch_array ($result))
{
$camm=$R1['camm'];
}
$op=$damm-$camm;
?>
	<tr bgcolor="#00a65a">
	<td align="left" colspan="2" width="100%">
	<font color="#FFF" size="3"><?php  echo $lnm;?>  <b> Op Bal <?php  echo $op;?></b></font>
	</td>
	</tr>
<tr >
  <td align="center" width="50%">
 <font size="4" color="#000000"><b>CREDIT</b></font>
  </td>
  <td align="center" width="50%">
  <font size="4" color="#000000"><b>DEBIT</b></font>
  </td>
</tr>  

<?php 


$ctotal=0;
?>
<tr >

  <td  valign="top" width="50%">
	  <table width="100%" class="advancedtable" cellspacing="0">
  <?php 
  $result1 = mysqli_query($conn,"SELECT sum(amm) as tot,cldgr,sl FROM main_drcr where dldgr='$ledgr' $pno $qry1 group by cldgr ");
while ($R1 = mysqli_fetch_array ($result1))
{
$ctot=$R1['tot'];
$cldgr=$R1['cldgr'];
$rd1=$R1['cldgr'];
$rd=$R1['sl'];
	$data2= mysqli_query($conn,"SELECT * FROM main_ledg where sl='$cldgr'");
		while ($row2 = mysqli_fetch_array($data2))
		{
	
		$lnm2=$row2['nm'];
		}
  ?>
  <tr id="t<?php  echo $rd;?>">
  <td align="left" width="70%">
  
  <b><span id="my<?php  echo $rd;?>"><a onclick="getdet('<?php  echo $rd1;?>','<?php  echo $rd;?>','<?php  echo $lnm2?>','1','dldgr','<?php echo base64_encode($pno);?>','<?php  echo $ledgr;?>','cldgr','<?php  echo $fdt;?>','<?php  echo $tdt;?>')"><i  class="fa fa-plus-square" ></i> <?php  echo $lnm2;?></a> </b></span>
   <?php 

  ?>
  </td>
  <td align="right" width="30%">
  <b><?php 
 echo sprintf('%0.2f', $ctot);
  ?></b>
  </td>
  </tr>
    <tr>
<td colspan="4">
<div id="<?php  echo $rd;?>">
<div id="p<?php  echo $rd;?>" class="myProgress" style="display:none">
    <div id="b<?php  echo $rd;?>" class="myBar"></div>
	Please Wait Loading Page....
</div>
</div>
</td>
</tr>
<?php 
$ctotal=$ctotal+$ctot;
}
?>
  </table>
  </td>
    <td  align="right" valign="top" width="50%">
 
    <table width="100%" class="advancedtable" cellspacing="0">
  <?php 
  $dtotal=0;
  $result = mysqli_query($conn,"SELECT sum(amm) as tot,dldgr,sl FROM main_drcr where cldgr='$ledgr' $pno $qry1 group by dldgr");
while ($R = mysqli_fetch_array ($result))
{
$dtot=$R['tot'];
$dldgr=$R['dldgr'];
$rd1=$R['dldgr'];
$rd=$R['sl'];
	$data1= mysqli_query($conn,"SELECT * FROM main_ledg where sl='$dldgr'");
		while ($row1 = mysqli_fetch_array($data1))
		{
	
		$lnm1=$row1['nm'];
		}
  ?>
  <tr id="t<?php  echo $rd;?>">
  <td align="left" width="70%">
    <b><span id="my<?php  echo $rd;?>"><a onclick="getdet('<?php  echo $rd1;?>','<?php  echo $rd;?>','<?php  echo $lnm1?>','1','cldgr','<?php echo base64_encode($pno);?>','<?php  echo $ledgr;?>','dldgr','<?php  echo $fdt;?>','<?php  echo $tdt;?>')"><i  class="fa fa-plus-square" ></i> <?php   echo $lnm1;?></a> </b></span>

  </td>
  <td align="right" width="30%">
  <b><?php 
 echo sprintf('%0.2f', $dtot);
  ?></b>
  </td>
  </tr>
  <tr>
<td colspan="4">
<div id="<?php  echo $rd;?>">
<div id="p<?php  echo $rd;?>" class="myProgress" style="display:none">
    <div id="b<?php  echo $rd;?>" class="myBar"></div>
	Please Wait Loading Page....
</div>
</div>
</td>
</tr>
<?php 
 $dtotal=$dtotal+$dtot;
}
$cc=$op+($ctotal-$dtotal);
?>
  </table>
  </td>
</tr>
<tr >
<td align="right">
<font size="3" color="red">Total Bal : <?php echo sprintf('%0.2f', $ctotal);?></font>
</td>
<td align="right" color="red">
<font size="3" color="red">Total Bal : <?php echo sprintf('%0.2f', $dtotal);?></font>
</td>
</tr>
<tr bgcolor="#e2edfa">
<td align="Center" colspan="2">
<font size="4" color="#000000"><b>Current Bal : <?php echo sprintf('%0.2f', $cc);?></b></font>
</td>

</tr>

<?php 
		
		}
	
	
	?>
	
	

</table>

