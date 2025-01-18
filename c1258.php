<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
include('QR_BarCode.php');

$sl=rawurldecode($_REQUEST['sl']);

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
		$cid= $row['cid'];
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
<title><?php  echo $bill_no?></title>
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


<?php 


 
	   $csss="page-break-after:always";

  
	?>
<div style="<?php  echo $csss;?>">

<center>
<div  width="100%"><br><font size="10" color="#000"><b><?php  echo $comp_nm;?></b></font></div><br>
<font style="font-size:20px;"><b>Credit Note</b></font>
</center>
<table align="center" style="border-collapse:collapse; border: 1px solid black; text-align:center;width:800px">
<tr>
<td>

<!-- Sub Table 1 Start-->
<table style="border-collapse:collapse; border: 1px solid black; width:100%;">
<tr>
<td style="text-align:center; border: 1px solid black; width:100%;">

<font style="font-size:18px;"><?php  echo $adrs;?></font><br/>
<font style="font-size:14px;">GSTIN/UIN : <?php  echo $gstin?></font>
</td>

</tr>
</table>
<!-- Sub Table 1 End-->

</td>
</tr>
<tr>
<td>

<?php 
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
$gbt=mysqli_query($conn,"select * from main_cust where sl='$cid'")or die (mysqli_error($conn));
while($GB=mysqli_fetch_array($gbt))
{
$bto=$GB['nm'];
$nmp=$GB['nmp'];
$baddr=$GB['addr'];
$baddr1=$GB['addr1'];
$baddr2=$GB['addr2'];
$bmob=$GB['cont'];
$st=$GB['fst'];
$bpan=$GB['pan'];
$bgstin=$GB['gstin'];
}
if($nmp!='')
{
$bto=$nmp;	
}
$gbit=mysqli_query($conn,"select * from main_state where sl='$st'") or die (mysqli_error($conn));
while($GBi=mysqli_fetch_array($gbit))
{
$statnm=$GBi['sn'];
$statcd=$GBi['cd'];
}

?>

<!-- Sub Table 3 Start-->
<table style="border-collapse:collapse; border: 1px solid black; width:100%;">
<tr bgcolor="#e4e4e4">
<td style="text-align:center; border: 1px solid black;"><font size="2">Party’s Name :</font></td>
<td style="text-align:center; border: 1px solid black;"><font size="2"></font></td>
</tr>
<tr>
<td style="text-align:left; border: 1px solid black; width:50%;">
<table style="width:100%;">
<tr>
<td style="width:20%;"><font size="2">Name </font><span style="float:right"><font size="2">:</font></span></td><td colspan="3"><font size="2"><b><?php  echo $bto;?></b></font></td>
</tr>
<tr>
<td style="text-align:left;vertical-align:top;"><font size="2">Address </font><span style="float:right"><font size="2">:</font></span></td>
<td colspan="3"><font size="2"><?php  echo $baddr;?>
</font>
</td>
</tr>
<?php 
if($bmob!="")
{

	?>
	<tr>
	<td><font size="2">Mobile </font><span style="float:right"><font size="2">:</font></span></td>
	<td colspan="3"><font size="2"><?php echo $bmob;?></font></td>
	</tr>
<?php }
?>
<tr>
<td><font size="2">GSTIN </font><span style="float:right"><font size="2">:</font></span></td><td ><font size="2"><?php  echo $bgstin;?></font></td>
<td  colspan="2" align="right">
<font size="2">State : <?php  echo $statnm;?></font>
</td>
</tr>
<tr>
<td><font size="2">PAN </font><span style="float:right"><font size="2">:</font></span></td><td><font size="2"><?php  echo $bpan;?></font></td>

</tr>
</table>
</td>
<td style="text-align:left; border: 1px solid black; width:50%;" valign="top">

<table style="width:100%;">
<tr>
<td style="width:20%;"><font size="2">Ref. No. </font><span style="float:right"><font size="2">:</font></span></td><td ><font size="2"><b><?php  echo $blno;?></b></font></td>
</tr>
<tr>
<td style="text-align:left;vertical-align:top;"><font size="2">Date </font><span style="float:right"><font size="2">:</font></span></td>
<td  valign="top"><font size="2"><?php  echo $invdt;?>
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
<td rowspan="1" width="10%" style="text-align:center; border: 1px solid black;"><font size="2">Amount(Rs.)</font></td>
</tr>

<?php 
$height="260";
?>
<tr id="tdb">
<td style="text-align:left;" valign="top" ><font size="2"><?php  echo $dldgr;?>

</font></td>
<td style="text-align:right; " valign="top"><font size="2"><?php  echo $amm;?></font></td>
</tr>
<tr id="tdb">
<td style="text-align:left;" valign="top" ><font size="2">&nbsp;

</font>
</td>
<td style="text-align:right; " valign="top"><font size="2">&nbsp;</font></td>

</tr>
<tr id="tdb">
<td style="text-align:left;" valign="top" ><font size="2">Narration : <?php  echo $nrtn;?>
</font>
</td>
<td style="text-align:right; " valign="top"><font size="2"></font></td>

</tr>
<tr style="height:<?php  echo $height;?>px;">
<td style="text-align:left;"><font size="2"></font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>

</tr>
<tr >
<td style="text-align:left;"><font size="2"><?php  echo "<b>Amount (in words) : </b>";?>
<?php  $nw = new Numbers_Words();$aiw=$nw->toWords(round($amm));echo $aiw;?> only</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>

</tr>
<tr id="tdb">
<td style="text-align:right;" valign="top" ><font size="2">Total 

</font></td>
<td style="text-align:right; " valign="top"><?php  echo $amm;?><font size="2"></font></td>

</tr>
</table>


<table width="100%">
<tr align="center" style="vertical-align:bottom;">
<td><font style="font-size:16px;"></font></td>
</tr>
<tr style="vertical-align:bottom;">
<td align="center">For <?php  echo $bto?></td>
</tr>
<tr align="center" style="vertical-align:bottom;">
<td >


</td>

<td><font style="font-size:14px;"><b>For, <?php  echo $comp_nm;?></b></font><br>
<img src="stmp/<?php  echo $brnc;?>.png" width="72" height="70">
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