<?php 
$reqlevel = 3;
include("config.php");
include("Numbers/Words.php");
$blno=rawurldecode($_REQUEST['blno']);

function get_branch_name_godown($current_branch_code)
{
    
 $query1111 = "SELECT * FROM main_godown where sl='$current_branch_code'";
   $result1111 = mysqli_query($conn,$query1111);
while($rw1111=mysqli_fetch_array($result1111))
{
    $current_branch_name=$rw1111['gnm'];

}  
}
$damm=0;
$emiam="";
/* branch details*/
$data1= mysqli_query($conn,"select * from  main_quo where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$bcdsl=$row1['bcd'];
}
$data2= mysqli_query($conn,"select * from main_branch where sl='$bcdsl'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$bcdaddr=$row1['addr'];
$bcnt=$row1['bcnt'];
}

$query1="Select * from main_cnm ";		 
 $result1 = mysqli_query($conn,$query1);
while ($R = mysqli_fetch_array ($result1))
{
$comp_nm=$R['cnm'];
$comp_addr=$R['addr'];
$comp_cont=$R['cont'];
$comp_gstin=$R['gstin'];
$branch1=$R['branch1'];
$branch2=$R['branch2'];
$ifsc1=$R['ifsc1'];
$ifsc2=$R['ifsc2'];
$ac1=$R['ac1'];
$ac2=$R['ac2'];
$acnm1=$R['acnm1'];
$acnm2=$R['acnm2'];
}

$query111 = "SELECT * FROM ".$DBprefix."quo where blno='$blno'";
$result111 = mysqli_query($conn,$query111)or die (mysqli_error($conn));
while ($R111 = mysqli_fetch_array ($result111))
{
$invdt=$R111['dt'];
$fst=$R111['fst'];
$tst=$R111['tst'];
$cust_nm=$R111['cust_nm'];
$cont=$R111['cont'];
$adrs=$R111['adrs'];
$gstin=$R111['gstin'];
$tamm=$R111['tamm'];

}

$invdt=date("d-m-Y", strtotime($invdt));	


$gbit=mysqli_query($conn,"select * from main_state where sl='$tst'") or die (mysqli_error($conn));
while($GBi=mysqli_fetch_array($gbit))
{
$statnm=$GBi['sn'];
$statcd=$GBi['cd'];
}
$nw = new Numbers_Words();
$aiw=$nw->toWords($tamm);
$str = strtoupper($aiw);

?>
<html>
<head>
<title>QUOTATION</title>
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
<body>
<?php 
   for($CNT=0;$CNT<1;$CNT++){

   if($CNT==0){$cp="Orginal Buyer's Copy";}
   if($CNT==1){$cp='Saler Copy';}
   if($CNT==2){$cp='Transportation Copy';}
   $csss="";
   if($CNT!=2)
   {
	   $csss="page-break-after:always";
   }
	?>
<div style="<?php  echo $csss;?>">

<center>
<br>
<br>
<br>
<br>
<br>
<br>

<font style="font-size:20px;"><b>QUOTATION</b></font>
</center>
<table align="center" style="border-collapse:collapse; border: 1px solid black; text-align:center;width:800px">
<tr>
<td>

<!-- Sub Table 1 Start-->
<table style="border-collapse:collapse; border: 1px solid black; width:100%;">
<tr>
<td style="text-align:center; border: 1px solid black; width:70%;">

<font style="font-size:28px;"><b><?php //=$current_branch_name;?></b></font><br/>
<font style="font-size:18px;"><?php  echo $bcdaddr;?></font><br/>
<font style="font-size:14px;"><b>Contact No. : </b><?php  echo $bcnt?></font>,<font style="font-size:14px;"><b>GSTIN/UIN : </b><?php  echo $comp_gstin?></font>
</td>
<td style="border: 1px solid black; width:15%;text-align:center">
<?php  echo $cp;?>
</td>
</tr>
</table>
<!-- Sub Table 1 End-->

</td>
</tr>
<tr>
<td>

<!-- Sub Table 2 Start-->
<table style="border-collapse:collapse; border: 1px solid black; width:100%;">
<tr>
<td style="text-align:left; border: 1px solid black; width:100%;" colspan="2">
<table style="width:100%;">
<tr>
<td style="width:30%;"><font size="2">Quotation No. </font><span style="float:right"><font size="2">:</font><span></td><td><font size="2"><?php  echo $blno;?></font></td>
</tr>
<tr>
<td ><font size="2">Quotation Date </font><span style="float:right"><font size="2">:</font></span></td><td><font size="2"><?php  echo $invdt;?></font></td>
</tr>

</table>
</td>

</tr>
</table>
<!-- Sub Table 2 End-->

</td>
</tr>
<tr>
<td>


<!-- Sub Table 3 Start-->
<table style="border-collapse:collapse; border: 1px solid black; width:100%;">
<tr bgcolor="#e4e4e4">
<td style="text-align:left; border: 1px solid black;"><font size="3"><b>Customer Details :</b></font></td>
</tr>
<tr>
<td style="text-align:left; border: 1px solid black; width:50%;">
<table style="width:100%;">
<tr>
<td style="width:20%;"><font size="2">Name </font><span style="float:right"><font size="2">:</font></span></td>
<td><font size="2"><b><?php  echo $cust_nm;?></b></font></td>
<td align="right"><font size="2">State : <?php  echo $statnm;?></font></td>
</tr>
<tr>
<td style="text-align:left;vertical-align:top;"><font size="2">Address </font><span style="float:right"><font size="2">:</font></span></td>
<td ><font size="2"><?php  echo $adrs;?></font></td>
<td align="right"><font size="2">State Code : <?php  echo $statcd;?></font></td>
</tr>
<?php 
if($cont!="")
{
?>
<tr>
<td><font size="2">Contact No. </font><span style="float:right"><font size="2">:</font></span></td>
<td colspan="2"><font size="2"><?php echo $cont;?></font></td>
</tr>
<?php 
}
?>
<tr>
<td ><font size="2">GSTIN </font><span style="float:right"><font size="2">:</font></span></td>
<td colspan="2"><font size="2"><?php  echo $gstin;?></font></td>
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
<td rowspan="1" style="text-align:center; border: 1px solid black;"><font size="2">S.No</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;" ><font size="2">Description of Goods</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;"><font size="2">HSN Code<br>(GST)</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;"><font size="2">Quantity</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;"><font size="2">Rate</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;"><font size="2">Total<br>Am.</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;"><font size="2">Disc.<br>%</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;"><font size="2">Disc.<br>Am.</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;" colspan=""><font size="2">Taxable<br>Am.</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;"><font size="2">Tax Rate</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;"><font size="2">Tax Value</font></td>
<td rowspan="1" style="text-align:center; border: 1px solid black;" ><font size="2">Net<br>Amount</font></td>

</tr>
<?php 

$height="230";
$sln=0;
$pcs1=0;
$cgst_rt1=0;   
$cgst_am1=0;   
$sgst_rt1=0;   
$sgst_am1=0;   
$igst_rt1=0;   
$igst_am1=0;  
$rsmm1=0;
$tamm1=0;
$gttl=0;
$gttl2=0;
$pcs1=0;
$tasqm=0;
$total_amm=0;
$disa_amm=0;
$total_amm=0;
$disa_amm=0;
$gttl=0;
$tgst=0;
$pnm1="";
$total_qty=0;
$data= mysqli_query($conn,"select * from  main_quo_details where sl>0 and blno='$blno'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$cat=$row['cat'];
$scat=$row['scat'];	
$pcd=$row['prsl'];
$description=$row['description'];
$prc=$row['prc'];
$total=$row['total'];
$ttl=$row['ttl'];
$blno1=$row['blno'];
$pcs=$row['pcs'];
$cgst_rt=$row['cgst_rt'];   
$cgst_am=$row['cgst_am'];   
$sgst_rt=$row['sgst_rt'];   
$sgst_am=$row['sgst_am'];   
$igst_rt=$row['igst_rt'];   
$igst_am=$row['igst_am'];   
$net_am=$row['net_am'];  
$disp=$row['disp'];  
if($disp==''){$disp=0;}
$disa1=$row['disa'];  
$bcd=$row['bcd'];  
$pgst=$cgst_am+$sgst_am+$igst_am;
$pgstr=$cgst_rt+$sgst_rt+$igst_rt;
$cgst_am1=$cgst_am1+$cgst_am;   
$sgst_am1=$sgst_am1+$sgst_am;   
$igst_am1=$igst_am1+$igst_am; 
$sln++;
$total_qty+=$pcs;
$cnm="";				
$data12= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$cnm=$row1['cnm'];
}
$scat_nm="";				
$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$scat_nm=$row1['nm'];
}
$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
$hsn=$row['hsn'];
}

if($disp==0)
{
 if($disa1>0)  
{
$disp=round(($disa1*100)/$total,2);
}
}


$gst=$cgst_rt+$sgst_rt+$igst_rt;
$gst_rate=round($prc/($gst+100),4);
$rate=round($gst_rate*100,2);
$total=round($rate*$pcs,2);


$disa=round(($total*$disp)/100,2);

$ttl=round($total-$disa,2);

$net_am=$ttl+$pgst;
if($pnm1==$pnm){$pnm2="";$pnm2="<b>".$pnm."</b><br>";}else{$pnm2="<b>".$pnm."</b><br>";}
$height=$height-20;
?>
<tr id="tdb">
<td style="text-align:center; width:2%;" valign="top"><font size="2"><?php  echo $sln;?></font></td>
<td style="text-align:left;" valign="top" ><font size="2"><?php  echo $pnm2;?>
<?php  echo $description;?><br></font></td>
<td style="text-align:center; " valign="top"><font size="2"><?php  echo $hsn;?></font></td>
<td style="text-align:center; width:8%;" valign="top"><font size="2"><?php  echo $pcs;?></font></td>

<td style="text-align:right; " valign="top"><font size="2"><?php echo number_format($rate,2);?></font></td>
<td style="text-align:right; " valign="top"><font size="2"><?php echo number_format($total,2);?></font></td>
<td style="text-align:right; " valign="top" ><font size="2"><?php echo number_format($disp,2);?></font></td>
<td style="text-align:right; " valign="top"><font size="2"><?php echo number_format($disa,2);?></font></td>
<td style="text-align:right; " valign="top" ><font size="2"><?php echo number_format($ttl,2);?></font></td>
<td style="text-align:right; " valign="top" ><font size="2"><?php  echo $pgstr;?>%</font></td>
<td style="text-align:right; " valign="top"><font size="2"><?php echo number_format($pgst,2);?></font></td>
<td style="text-align:right; " valign="top"><font size="2"><?php echo number_format($net_am,2);?></font></td>



</tr>
<?php 
$total_amm+=$total;
$disa_amm+=$disa;
$gttl=$gttl+$ttl;
$tgst+=$pgst;
$pnm1=$pnm;
}


$gttl2=round($gttl,2)+$tgst;


$rgttl=round($gttl2);
$roff=round($rgttl-$gttl2,2);



?>
<tr style="height:<?php  echo $height;?>px;">
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>
<td style="text-align:center;"><font size="2">&nbsp;</font></td>

</tr>
<tr bgcolor="#e4e4e4">
<td colspan="5" style="text-align:center; border: 1px solid black;"><font size="2">Sub Total</font></td>
<td style="text-align:right; border: 1px solid black;"><font size="2"><?php echo number_format($total_amm,2);?></font></td>
<td style="text-align:right; border: 1px solid black;"><font size="2"></font></td>
<td style="text-align:right; border: 1px solid black;"><font size="2"><?php echo number_format($disa_amm,2);?></font></td>
<td style="text-align:right; border: 1px solid black;"><font size="2"><?php echo number_format($gttl,2);?></font></td>
<td style="text-align:right; border: 1px solid black;"><font size="2"></font></td>
<td style="text-align:right; border: 1px solid black;"><font size="2"><?php echo number_format(round($tgst,2),2);?></font></td>
<td  style="text-align:right; border: 1px solid black;" colspan=""><font size="2"><?php echo number_format($gttl+$tgst,2);?></font></td>
</tr>


<tr bgcolor="#e4e4e4">
<td colspan="5" style="text-align:center; border: 1px solid black;"><font size="2">Invoice Value (In Words) : <b> <?php  $nw = new Numbers_Words();$aiw=$nw->toWords(round($rgttl));echo $aiw;?> only</font></b></td>
<td colspan="5" style="text-align:right; border: 1px solid black;"><font size="2">Total Amount Before Tax</font></td>
<td colspan="2" style="text-align:right; border: 1px solid black;" colspan=""><font size="2"><?php echo number_format(round($gttl,2),2);?></font></td>
</tr>
<tr>
<td colspan="5" rowspan="5" style="text-align:left; border: 1px solid black;"><font size="2">
<font size="2">Bank Details&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font size="3">: <?php  echo $comp_nm;?> :</font>
<table width="100%">



<tr>
<td><font size="2"><b>Bank Name</b></font></td>
<td class="tdr"><font size="2">: <?php  echo $acnm1;?></font></td>
<td><font size="2"><b>Bank Name</b></font></td>
<td><font size="2">: <?php  echo $acnm2;?></font></td>
</tr>
<tr>
<td><font size="2"><b>A/C No.</b></font></td>
<td class="tdr"><font size="2">: <b><?php  echo $ac1;?></b></font></td>
<td><font size="2"><b>A/C No.</b></font></td>
<td><font size="2">: <b><?php  echo $ac2;?></b></font></td>
</tr>
<tr>
<td><font size="2"><b>IFSC</b></font></td>
<td class="tdr"><font size="2">: <b><?php  echo $ifsc1;?></b></font></td>
<td><font size="2"><b>IFSC</b></font></td>
<td><font size="2">: <b><?php  echo $ifsc2;?></b></font></td>
</tr>
<tr>
<td><font size="2"><b>Branch</b></font></td>
<td class="tdr"><font size="2">: <?php  echo $branch1;?></font></td>
<td><font size="2"><b>Branch</b></font></td>
<td><font size="2">: <?php  echo $branch2;?></font></td>
</tr>
</table>
</td>
<td colspan="5" style="text-align:right; border: 1px solid black;"><font size="2">Add : CGST </font></td>
<td colspan="2" style="text-align:right; border: 1px solid black;"><font size="2"><?php echo number_format(round($cgst_am1,2),2);?></font></td>
</tr>
<tr>

<td colspan="5" style="text-align:right; border: 1px solid black;"><font size="2">Add : SGST </font></td>
<td colspan="2" style="text-align:right; border: 1px solid black;"><font size="2"><?php echo number_format(round($sgst_am1,2),2);?></font></td>
</tr>

<tr>

<td colspan="5" style="text-align:right; border: 1px solid black;"><font size="2">Add : IGST </font></td>
<td colspan="2" style="text-align:right; border: 1px solid black;"><font size="2"><?php echo number_format(round($igst_am1,2),2);?></font></td>
</tr>

<tr>

<td colspan="5" style="text-align:right; border: 1px solid black;"><font size="2">Tax Amount : GST</font></td>
<td colspan="2" style="text-align:right; border: 1px solid black;"><font size="2"><?php echo number_format(round($tgst,2),2);?></font></td>
</tr>
<tr bgcolor="#e4e4e4">

<td colspan="5" style="text-align:right; border: 1px solid black;"><font size="2">Total</font></td>
<td colspan="2" style="text-align:right; border: 1px solid black;"><font size="2"><?php echo number_format(round($gttl2,2),2);?></font></td>
</tr>

<tr>
<td colspan="5" rowspan="4" style="text-align:left; border: 1px solid black;">
<font size="2"><center>Certified that the particulars given above are true and correct.</center></font>
<font size="1">
Term and Conditions :-<br/>
01.	100% Payment should be made in advance.<br/>
02.	For Air Conditioner: Above rates are including free standard Installation with Bracket.<br/>
03.	The above rates & Models are on Current Price List.  Price & Model can be change as per Company Price List and availability of Stock.<br/>
04.	 Goods once sold cannot be taken back.<br/>
05.	Any discrepancy found in the invoice should be informed immediately at Unloading time. No claim shall be entertained thereafter.<br/>
06.	After sales any technical problems is to be attended by the service centre of the respective Company as per norms of the Mfg. Co.
</font>

</td>
<td colspan="5" style="text-align:right; border: 1px solid black;"><font size="2">ROUND OFF</font></td>
<td colspan="2" style="text-align:right; border: 1px solid black;"><?php 
if($roff==""){$roff=0;}
if($damm==""){$damm=0;}
?>
<font size="2" ><?php  echo $roff;?></font></td>
</tr>
<tr>
<td colspan="5" style="text-align:right; border: 1px solid black;"><font size="2"><?php if($damm>0){echo $dislam;}?></font></td>
<td colspan="2" style="text-align:right; border: 1px solid black;">
<font size="2" ><?php if($damm>0){echo number_format($damm,2);}?></font></td>
</tr>
<tr>



<td colspan="5" bgcolor="#e4e4e4" style="text-align:right; border: 1px solid black;"><font size="2">Net Payable</font></td>
<td colspan="2" style="text-align:right; border: 1px solid black;" bgcolor="#e4e4e4"><font size="2"><?php echo number_format($rgttl-$damm,2);?></font></td>
</tr>
<tr>



<td colspan="5" style="text-align:right; border: 1px solid black;"><font size="2">GST Payable on Reverse Charge</font></td>
<td colspan="2" bgcolor="#e4e4e4" style="text-align:center; border: 1px solid black;"><font size="2">N.A.</font></td>
</tr>


<tr>
<td colspan="5"   valign="top">

<?php 
if($emiam>0)
{
?>
<table width="100%">
<tr>
<td>
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
Customer Signatory
</td>
</tr>
</table>
</td>
<td>
<table width="100%">
<tr align="center" >
<td><font style="font-size:14px;"><b>For, <?php  echo $comp_nm;?></b></font></td>
</tr>
<tr >
<td ></td>
</tr>
<tr align="center" style="vertical-align:bottom;">
<td >
<br>
Authorised Signatory
</td>
</tr>
</table>
</td>
</tr>
</table>
<?php }
else
{
?>
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
Customer Signatory
</td>
</tr>
</table>
<?php }?>
</td>
<td colspan="7"   valign="top">

<?php 
if($emiam>0)
{
?>
<table width="100%" style="border-collapse:collapse; border: 1px solid black;">
<tr>
<td style="border-collapse:collapse; border: 1px solid black;text-align:center" colspan="2">
<b>Finance Details</b>
</td>
</tr>
<tr>
<td style="border-collapse:collapse; border: 1px solid black;" width="50%">
Down Payment : 
</td>
<td style="border-collapse:collapse; border: 1px solid black;" width="50%">
<?php  echo $dpay?>
</td>
</tr>
<tr>
<td style="border-collapse:collapse; border: 1px solid black;">
Finance Amount :
</td>
<td style="border-collapse:collapse; border: 1px solid black;">
<?php  echo $finam?>
</td>
</tr>
<tr>
<td style="border-collapse:collapse; border: 1px solid black;">
EMI Amount : 
</td>
<td style="border-collapse:collapse; border: 1px solid black;">
<?php  echo $emiam?>
</td>
</tr>
<tr>
<td style="border-collapse:collapse; border: 1px solid black;">
EMI Month : 
</td>
<td style="border-collapse:collapse; border: 1px solid black;">
<?php  echo $emi_mnth?>
</td>
</tr>
</table>
<?php }
else
{

?>
<table width="100%">
<tr align="center" >
<td><font style="font-size:14px;"><b>For, <?php  echo $comp_nm;?></b></font><br>
<img src="stmp/<?php  echo $bcdsl;?>.png" width="72" height="70">
</td>
</tr>
<tr align="center" style="vertical-align:bottom;">
<td >

Authorised Signatory
</td>
</tr>
</table>

<?php }?>
</td>
</tr>


</table>
<!-- Sub Table 4 End-->

</td>
</tr>
</table>

   </div><?php }?>

</body>
</html>