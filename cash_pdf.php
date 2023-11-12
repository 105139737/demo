<?php
include("config.php");
date_default_timezone_set('Asia/Kolkata');
ini_set("memory_limit","780M");
set_time_limit(0);
$edt = date('d/m/Y h:i:s a', time());
ob_start();


$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
$fdt=$_REQUEST[fdt];
$tdt=$_REQUEST[tdt];
$pno1='';
if($pno1!='')
{$pno=" and pno='$pno1' $brncd1";}else{$pno=" $brncd1";}
 


if($fdt=="" or $tdt=="")
{
echo 'false';
}
else
{
date_default_timezone_set('Asia/Kolkata');
$dt3 = date('y-m-d');
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

$qry1=" and (dt between '$fdt' and '$tdt')";


$prevdt = strtotime ( "- 1 day" , strtotime ( $fdt) ) ;
$prevdt = date ( 'Y-m-d' , $prevdt );



?>
<page backtop="10mm" >
<table style="width: 100%;" >

<tr  >
<th colspan="2" align="left" style="border-bottom: 1px solid #000;border-top: 1px solid #000;" >
<font color="#000000" size="3">
Cash A/c Details <?echo $dt?> As On  <?echo $fdt?> to <?echo $tdt?>
</font>
</th>
</tr>

<?
	$data33= mysqli_query($conn,"SELECT * FROM main_ledg where gcd='2'");
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
	<td align="left" colspan="2" style="width: 100%;">
	<font color="#FFF" size="3"><?=$lnm;?>  <b> Op Bal <?=$op;?></b></font>
	</td>
	</tr>
<tr >
  <td align="center" style="width: 50%;border-bottom: 1px solid #000;border-top: 1px solid #000;">
 <font size="4" color="#000000"><b>CREDIT</b></font>
  </td>
  <td align="center" style="width: 50%;border-bottom: 1px solid #000;border-top: 1px solid #000;">
  <font size="4" color="#000000"><b>DEBIT</b></font>
  </td>
</tr>  

<?
$ctotal=0;
?>
<tr >

  <td  valign="top" style="width: 50%;">
	  <table style="width:100%;" width="100%" class="advancedtable" cellspacing="0">
  <?
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
  <tr >
  <td align="left" style="width:80%;">
  
<b><? echo $lnm2;?></b></td>
  <td align="right" style="text-align:right;width:20%;">
  <b><?
 echo sprintf('%0.2f', $ctot);
  ?></b>
  </td>
  </tr>

<?
$ctotal=$ctotal+$ctot;
}
?>
  </table>
  </td>
    <td  align="right" valign="top" style="width: 50%;">
 
    <table style="width: 100%;" class="advancedtable" cellspacing="0">
  <?
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
  <tr id="t<?=$rd;?>">
  <td align="left" style="width:80%;">
    <span id="my<?=$rd;?>"><i  class="fa fa-plus-square" ></i><b> <?  echo $lnm1;?></b></span>

  </td>
  <td align="right" style="width:20%;">
  <b><?
 echo sprintf('%0.2f', $dtot);
  ?></b>
  </td>
  </tr>

<?
 $dtotal=$dtotal+$dtot;
}
$cc=$op+($ctotal-$dtotal);
?>
  </table>
  </td>
</tr>
<tr >
<td align="right" style="border-bottom: 1px solid #000;border-top: 1px solid #000;">
<font size="3" color="red">Total Bal : <?=sprintf('%0.2f', $ctotal);?></font>
</td>
<td align="right" color="red" style="border-bottom: 1px solid #000;border-top: 1px solid #000;">
<font size="3" color="red">Total Bal : <?=sprintf('%0.2f', $dtotal);?></font>
</td>
</tr>
<tr bgcolor="#e2edfa">
<td align="Center" colspan="2">
<font size="4" color="#000000"><b>Current Bal : <?=sprintf('%0.2f', $cc);?></b></font>
</td>

</tr>

<?
}
?>
</table>
	</page>

	<?
	$file='cash';
		$content = ob_get_clean();
    // convert in PDF
		require_once('html2pdf/html2pdf.class.php');
		try
		{
        $html2pdf = new HTML2PDF('P', 'A4', 'en');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
   $html2pdf->Output($file.'.pdf','F');
		//$html2pdf->Output($path2.'/'.$flnm.'.pdf', 'F');
		}
		catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
		}
		echo 'true';
}
?>

