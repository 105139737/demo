<?php
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
include('QR_BarCode.php');

$sl=rawurldecode($_REQUEST[sl]);

$data= mysqli_query($conn,"select * from main_drcr where sl='$sl'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
		$sl1= $row['sl'];
		$dt= $row['dt'];
		$pno= $row['pno'];
		$vno= $row['vno'];
		$blno= $row['blnon'];
		$cldgr= $row['cldgr'];
		$cldgr1= $row['cldgr'];
		$dldgr= $row['dldgr'];
		$dldgr1= $row['dldgr'];
		$mtd= $row['mtd'];
		$mtddtl= $row['mtddtl'];
		$amm= $row['amm'];
		$nrtn= $row['nrtn'];
		$eby= $row['eby'];
		$edt= $row['edt'];
		$sid= $row['sid'];
		$bill_typ= $row['bill_typ'];
		$brnc=$row['brncd'];
}
$get=mysqli_query($conn,"select * from main_billtype where sl='$bill_typ'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
$adrs=$row['adrs'];

}

$invdt=date("d-m-Y", strtotime($dt));	


$gbit=mysqli_query($conn,"select * from main_state where sl='$tst'") or die (mysqli_error($conn));
while($GBi=mysqli_fetch_array($gbit))
{
$statnm=$GBi['sn'];
$statcd=$GBi['cd'];
}
$gbit1=mysqli_query($conn,"select * from main_sale_per where spid='$sale_per'") or die (mysqli_error($conn));
while($GBi1=mysqli_fetch_array($gbit1))
{
$sale_nm=$GBi1['nm'];
$sale_mob=$GBi1['mob'];
}
$nw = new Numbers_Words();
$aiw=$nw->toWords($iamm);
$str = strtoupper($aiw);
if($psup=="")
{
//$psup="Krishnagar";
}
?>
<html>
<head>
<title><?php echo $bill_no?></title>
<style>
.tb
{
border-collapse: collapse;
border: 1px solid black;
border-left: none;
border-right: none;
}
.ff{
border-collapse: collapse;
border: 1px solid black;
}
#tdb
{

	border-bottom: 0px solid #FFF;
	border-top: 0px solid #FFF;
}

.tdlr
{

	border-bottom: 0px solid #FFF;
	border-top: 0px solid #FFF;
}
.tdr
{

	border-bottom: 0px solid #FFF;
	border-top: 0px solid #FFF;
	border-left: 0px solid #FFF;
	border-right: 1px solid #000;
}
</style>

</head>
<body onload="blprnt()">
<script type="text/javascript">
function blprnt(){
 /* if(confirm('Are You Sure?')){
    
   //window.print();
  }
  */ 
}

</script>


<?


 
	   $csss="page-break-after:always";

  
	?>
<div style="<?=$csss;?>">

<center>
<div  width="100%"><br><font size="10" color="#000"><b><?php echo $comp_nm;?></b></font></div><br>
<font style="font-size:20px;"><b>J O U R N A L</b></font>
</center>
<table align="center" style="border-collapse:collapse; border: 1px solid black; text-align:center;width:800px">
<tr>
<td>

<!-- Sub Table 1 Start-->
<table style="border-collapse:collapse; border: 1px solid black; width:100%;">
<tr>
<td style="text-align:center; border: 1px solid black; width:100%;">

<font style="font-size:18px;"><?=$adrs;?></font><br/>
<font style="font-size:14px;">GSTIN/UIN : <?=$gstin?></font>
</td>

</tr>
</table>
<!-- Sub Table 1 End-->

</td>
</tr>
<tr>
<td>

<?
$query6="select * from  main_suppl where sl='$sid'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$cnm=$row['spn'];
}
$data1= mysqli_query($conn,"SELECT * FROM main_ledg where sl='$cldgr'");
while ($row1 = mysqli_fetch_array($data1))
{
	$cldgr= $row1['nm'];
}
$nm="";
$data2= mysqli_query($conn,"SELECT * FROM main_ledg where sl='$dldgr'");
while ($row2 = mysqli_fetch_array($data2))
{
	$dldgr= $row2['nm'];
}
$gbt=mysqli_query($conn,"select * from main_suppl where sl='$sid'")or die (mysqli_error($conn));
while($GB=mysqli_fetch_array($gbt))
{
$bto=$GB['spn'];
$baddr=$GB['addr'];
$bmob=$GB['mob1'];
$bvat=$GB['vatno'];
$pan=$GB['pan'];
}
$gbt=mysqli_query($conn,"select * from main_suppl_gst where spn='$sid'")or die (mysqli_error($conn));
while($GB=mysqli_fetch_array($gbt))
{
$pan1=$GB['pan'];
}
if($pan=="")
{
$pan=$pan1;
}
if($cldgr1=='12')
{
$cldgr="<b>".$cnm."</b><br>PAN : ".$pan."<br>Address : ".$baddr;	
}
if($dldgr1=='12')
{

$dldgr="<b>".$cnm."</b><br>Pan : ".$pan."<br>Address : ".$baddr;	
}

?>

<!-- Sub Table 3 Start-->
<table style="border-collapse:collapse; border: 1px solid black; width:100%;">

<tr>
<td style="text-align:left; border: 1px solid black; width:50%;">
<table style="width:100%;">
<tr>
<td style="width:20%;"><font size="2">Ref. No.  </font><span style="float:right"><font size="2">:</font></span></td><td colspan="3"><font size="2"><b><?=$blno;?></b></font></td>
</tr>
</table>
</td>
<td style="text-align:left; border: 1px solid black; width:50%;" valign="top">

<table style="width:100%;">
<td style="text-align:left;vertical-align:top;"><font size="2">Date </font><span style="float:right"><font size="2">:</font></span></td>
<td  valign="top"><font size="2"><?=$invdt;?>
</font>
</td>
</tr>
</table>
</td>
</tr>
</table>
<!-- Sub Table 3 End-->

</td>
</tr>
<tr>
<td>

<!-- Sub Table 4 Start-->
<table border="1" class="ff" style="width:100%;">
<tr bgcolor="#e4e4e4">
<td rowspan="1" style="text-align:center; border: 1px solid black;" ><font size="2">Particulars</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;"><font size="2">Debit(Rs.)</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;"><font size="2">Credit(Rs.)</font></td>
</tr>

<?
$height="260";
?>
<tr id="tdb">
<td style="text-align:left;" valign="top" ><font size="2"><?php echo "<b>Dr.</b> ".$dldgr;?>

</font></td>
<td style="text-align:right; " valign="top"><font size="2"><?php echo $amm;?></font></td>
<td style="text-align:right; " valign="top"><font size="2"></font></td>
</tr>
<tr id="tdb">
<td style="text-align:left;" valign="top" ><font size="2">&nbsp;

</font>
</td>
<td style="text-align:right; " valign="top"><font size="2"></font></td>
<td style="text-align:right; " valign="top"><font size="2">&nbsp;</font></td>
</tr>
<tr id="tdb">
<td style="text-align:left;" valign="top" ><font size="2"><?php echo "<b>Cr. </b>".$cldgr;?>

</font>
</td>
<td style="text-align:right; " valign="top"><font size="2"></font></td>
<td style="text-align:right; " valign="top"><font size="2"><?php echo $amm;?></font></td>
</tr>
<tr style="height:<?=$height;?>px;">
<td style="text-align:left;"><font size="2"></font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
</tr>
<tr >
<td style="text-align:left;"><font size="2">Narration : <?php echo $nrtn;?></font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
</tr>
<tr id="tdb">
<td style="text-align:right;" valign="top" ><font size="2">Total 

</font></td>
<td style="text-align:right; " valign="top"><?php echo $amm;?><font size="2"></font></td>
<td style="text-align:right; " valign="top"><font size="2"><?php echo $amm;?></font></td>
</tr>
</table>


<table width="100%">
<tr align="center" >
<td><font style="font-size:16px;"></font></td>
</tr>
<tr >
<td ></td>
</tr>
<tr align="center" style="vertical-align:bottom;">
<td >
<br>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td>

<td><font style="font-size:14px;"><b>For, <?=$comp_nm;?></b></font><br>
<img src="stmp/<?php echo $brnc;?>.png" width="72" height="70">
</td>
</tr>
<tr align="center" style="vertical-align:bottom;">
<td >
</td >
<td >

Authorised Signatory
</td>
</tr>
</table>




   </div>

</body>
</html>