<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include("Numbers/Words.php");
$sl=$_REQUEST['sl'];
$blno=rawurldecode($_REQUEST['blno'] ?? "");

$query111 = "SELECT * FROM ".$DBprefix."drcr where sl='$blno'";
$result111 = mysqli_query($conn,$query111)or die (mysqli_error($conn));
while ($row = mysqli_fetch_array ($result111))
{
$dt= $row['dt'];
$pno= $row['pno'];
$vno= $row['vno'];
$cldgr= $row['cldgr'];
$dldgr= $row['dldgr'];
$mtd= $row['mtd'];
$mtddtl= $row['mtddtl'];
$amm= $row['amm'];
$nrtn= $row['nrtn'];
$it= $row['it'];
$cid= $row['cid'];
$brncd= $row['brncd'];
$cbill= $row['cbill'];
$sman= $row['sman'];
$bill_typ= $row['bill_typ'];

$blnon= $row['blnon'];
}
$gbit=mysqli_query($conn,"select * from main_state where sl='$tst'") or die (mysqli_error($conn));
while($GBi=mysqli_fetch_array($gbit))
{
$statnm=$GBi['sn'];
$statcd=$GBi['cd'];
}

$queryss="select * from main_cust  WHERE sl='$cid'";
		$resultss=mysqli_query($conn,$queryss);
		while($rwss=mysqli_fetch_array($resultss))
		{
			$custnm=$rwss['nm'];
			$custaddr=$rwss['addr'];
			$custmob=$rwss['cont'];
			$custgstin=$rwss['gstin'];
			$custpan=$rwss['pan'];
    }
    
$queryss=mysqli_query($conn,"select * from main_cnm  WHERE sl>0");
while($wr1=mysqli_fetch_array($queryss))
{
  	
  $cnm=$wr1['cnm'];
  $caddr=$wr1['addr'];
  $ccont=$wr1['cont'];
  $cvat=$wr1['vat'];
  $ccst=$wr1['cst'];
  $cgstin=$wr1['gstin'];
  $cbranch1=$wr1['branch1'];
  $cbranch2=$wr1['branch2'];
  $cifsc1=$wr1['ifsc1'];
  $cifsc2=$wr1['ifsc2'];
  $cac1=$wr1['ac1'];
  $cac2=$wr1['ac2'];
  $cacnm1=$wr1['acnm1'];
  $cacnm2=$wr1['acnm2'];
}
?>
<html>
<head>

</head>
<body>
  <br/><br/><br/><br/>
<table align="center" style="text-align:center;width:800px;">
  <tr>
    <td>
    <table style="border-collapse:collapse; border: 1px solid black; width:100%;">
        <tr>
          <td rowspan="4" style="width:40%;"><font size="+1"><b><?php  echo $cnm;?></b></font> </td>
          <td style="width:60%;"><b><?php  echo $cnm;?> Pvt. Ltd. ,</b></td>
        </tr>
        <tr>
          <td><?php  echo $cnm;?> Pvt. Ltd. ,</td>
        </tr>
        <tr>
        <td>PAN No. : AADCP9391B,  GSTIN No: <?php  echo $cgstin;?></td>
      </tr>
      <tr>
        <td><?php  echo $caddr;?></td>
      </tr>
    </table>
    <table style="text-align:center;border-collapse:collapse; border-bottom: 1px solid black;border-left:1px solid black;border-right:1px solid black;" width="100%">
      <tr>
        <td><b>CREDIT NOTE</b></td>
      </tr>
    </table>
    <table style="text-align:center;border-collapse:collapse; border-bottom: 1px solid black;border-left:1px solid black;border-right:1px solid black;" width="100%">
      <tr>
          <td style="width:25%;"><b>Credit Note Date</b></td>
          <td style="width:25%;"><b>Credit Note No.</b></td>
          <td style="width:25%;"><b>Posting Date</b></td>
          <td style="width:25%;"><b>Acc Doc No</b></td>
      </tr>    
	  <tr>
          <td style="width:25%;"><b><?php  echo date('d-m-Y',strtotime($dt));?></b></td>
          <td style="width:25%;"><b><?php  echo $blnon;?></b></td>
          <td style="width:25%;"><b><?php  echo date('d-m-Y',strtotime($dt));?></b></td>
          <td style="width:25%;"><b>Acc Doc No</b></td>
      </tr>
    </table>
    <?php 

    if($invto!='')
    {
    $cid=$invto;
    }
    else
    {
    $cid=$cid;
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
    $bvat=$GB['vatno'];
    $bpan=$GB['pan'];
    }
    ?>
    <table style="text-align:center;border-collapse:collapse;border-left:1px solid black;border-right:1px solid black;" width="100%">
      <tr style="border-bottom:1px solid black;">
        <td colspan="3" >Billed To:</td>
      </tr>

        <tr>
        <td style="width:20%;">Name <span style="float:right"><font size="2">:</font></span></td>
        <td colspan="3" style="text-align:left;vertical-align:top;"><font size="2"><b><?php  echo $custnm;?></b></font></td>
        </tr>
        <tr>
        <td style="text-align:center;vertical-align:top;">Address <span style="float:right"><font size="2">:</font></span></td>
        <td colspan="3" style="text-align:left;vertical-align:top;"><font size="2"><?php  echo $custaddr;?>
        </font>
        </td>
        </tr>
        <?php 
        if($custmob!="")
        {

        	?>
        	<tr>
        	<td>Mobile <span style="float:right"><font size="2">:</font></span></td>
        	<td colspan="3" style="text-align:left;vertical-align:top;"><?php echo $custmob;?></td>
        	</tr>
        <?php }
        ?>
        <tr>
        <td>GSTIN <span style="float:right"><font size="2">:</font></span></td><td ><font size="2"><?php  echo $custgstin;?></font></td>
        <td  colspan="2" align="right">
        State : N.A
        </td>
        </tr>
        <tr>
        <td>PAN <span style="float:right"><font size="2">:</font></span></td><td><font size="2"><?php  echo $custpan;?></font></td>
        <td colspan="2" align="right">State Code : N.A</td>
        </tr>

    </table>
    <table border="1" style="text-align:center;border-collapse:collapse; border: 1px solid black;" width="100%">
      <tr>
          <td ><b>S.No.</b></td>
          <td ><b>Credit Note No.</b></td>
          <td ><b>QTY</b></td>
          <td ><b>Net Value</b></td>
          <td >
              <table width="100%"  style="text-align:center;border-collapse:collapse;">
                <tr>
                <td colspan="2" align="center" style="border-bottom: 1px solid black;"><b>TAX</b></td>
              </tr>
              <tr>
              <td width="50%" style="border-right: 1px solid black;"><b>Rate</b></td>
              <td><b>Amount</b></td>
            </tr>
            </table>
          </td>
          <td><b>Invoice Value</b></td>
      </tr>
		<?php  
		$getamnt = mysqli_query($conn,"SELECT sum(amm) as netamnt FROM ".$DBprefix."drcr where cbill='$blno'")or die (mysqli_error($conn));
		while ($ftm = mysqli_fetch_array ($getamnt))
		{
			$netamnt=$ftm['netamnt'];
		}
			
		?>

	  
      <tr>
          <td >1</td>
          <td ><?php  echo $blnon;?></td>
          <td >1</td>
          <td ><?php  echo $amm;?></td>
          <td >
              <table width="100%" style="text-align:center;border-collapse:collapse;">
              <tr>
              <td width="50%" style="border-right: 1px solid black;"><b>0</b></td>
              <td><b>0.00</b></td>
            </tr>
            </table>
          </td>
          <td><?php  echo $amm;?></td>
      </tr>



      <tr>
          <td colspan="2"><b>Total</b></td>
          <td ></td>
          <td ><?php  echo $netamnt;?></td>
          <td >
              <table width="100%"  style="text-align:center;border-collapse:collapse; ">
              <tr>
              <td width="50%" style="border-right: 1px solid black;"><b>0</b></td>
              <td><b>0.00 </b></td>
            </tr>
            </table>
          </td>
          <td><?php  echo $netamnt;?></td>
      </tr>

      <tr>
          <td colspan="4"></td>
          <td>
              <table width="100%">
              <tr>
              <td align="center"><b>Rounding off</b></td>
              </tr>
              <tr>
              <td align="center"><b>Total Invoice Amount</b></td>
              </tr>
            </table>
          </td>
          <td>
            <table width="100%">
            <tr>
            <td align="center">0.00</td>
            </tr>
            <tr>
            <td align="center"><?php  echo $amm;?></td>
            </tr>
          </table>
          </td>
      </tr>

    </table>
    <table width="100%"  style="text-align:center;border-collapse:collapse; border-bottom:  1px solid black;border-left:1px solid black;border-right:1px solid black;">
    <tr>
    <td align="left" style="vertical-align:top;width:65%; border-right: 1px solid black;"><b>Amount in Words</b> : <?php  $nw = new Numbers_Words();$aiw=$nw->toWords(round($amm));echo $aiw;?> only</td>
    <td align="center"> For HINDUSTHAN DISTRIBUTOR PVT. LTD<br/><br/><br/><br/>
      (Authorized Signatory)
    </td>
    </tr>
    <tr>
      <td colspan="2" style="vertical-align:top; border-top: 1px solid black;text-align:left;">
        <font size="+1">Certified that the particulars given above are true and correct.</font><br/><br/>
        Terms & Conditions :- </br>
        01.	Goods once sold cannot be taken back.</br>
        02.	Any discrepancy found in the invoice should be informed immediately at Unloading time. No claim shall be </br>
        entertained thereafter.</br>
        03.	After sales any technical problems is to be attended by the service centre of the respective Company as per norms </br>
        of the Mfg. Co.
      </td>
    </tr>
    <tr>
      <td colspan="2" style="vertical-align:top; border: 1px solid black;text-align:left;"><b><font size="+1">Remarks:</font></b></td>
    <tr>
      <tr>
        <td colspan="2" style="vertical-align:top; border: 1px solid black;text-align:center;">
		<b>Registered Office :</b></br>
		<b>Website: :</b>
		</td>
      <tr>
  </table>
    </td>
  </tr>
</table></br></br></br></br>
</body>
</html>
