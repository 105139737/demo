<?php 
include("membersonly.inc.php");
include("Numbers/Words.php");

$sl=$_REQUEST['sl'];

$get=mysqli_query($conn,"select * from main_drcr where sl='$sl'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
   $bookid=$row['bookid'] ?? "";
	$vno=$row['vno'];
	$sbill=$row['sbill'];
	$cbill=$row['cbill'];
	$sid=$row['sid'];
	$eid=$row['eid'] ?? "";
	$mnth=$row['mnth'] ?? "";
	$cid=$row['cid'];
	$dt=$row['dt'];
	$nrtn=$row['nrtn'];
	$typ=$row['typ'];
	$idt=$row['idt'];
	$blnon=$row['blnon'];
	$bill_typ=$row['bill_typ'];
	
	$mtd=$row['mtd'];
		$data3= mysqli_query($conn,"SELECT * FROM ac_paymtd where sl='$mtd'");
		while ($row3=mysqli_fetch_array($data3))
		{
		$mtd= $row3['mtd'];
		}
		$bill_adrs="";
		$data33= mysqli_query($conn,"SELECT * FROM main_billtype where sl='$bill_typ'");
		while ($row33=mysqli_fetch_array($data33))
		{
		$bill_adrs= $row33['adrs'];
		}
	
	$mtddtl=$row['mtddtl'];
	$dldgr=$row['dldgr'];
	$cldgr=$row['cldgr'];
	$amm=$row['amm'];
	$brncd=$row['brncd'];
	$eby=$row['eby'];
	$edtm=$row['edtm'];
	$pno=$row['pno'];
	$it=$row['it'];
	$stat=$row['stat'];
	$get1=mysqli_query($conn,"select * from main_ledg where sl='$dldgr'") or die(mysqli_error($conn));
	while($row1=mysqli_fetch_array($get1))
	{
		$dldgr_nm=$row1['nm'];
	}
	$getl1=mysqli_query($conn,"select * from main_ledg where sl='$cldgr'") or die(mysqli_error($conn));
	while($row1=mysqli_fetch_array($getl1))
	{
		$cldgr_nm=$row1['nm'];
	}

}

$nw = new Numbers_Words();
$aiw=$nw->toWords($amm);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Cash Receipt</title>
<script type="text/javascript">
function blprint()
{
    if(confirm('Are You Sure?'))
	{
    window.print();
	}
   
}
</script>
</head>
<body onload="blprint()">

<table align="center" style="border-collapse:collapse; width:920px; border: 1px solid black;">
<tr>
    <td colspan="5" style="text-align:center; background-color:#f2f2f2; padding:5px 0 5px 0; border-bottom:1px solid #000;">
    <b style="font-family:Verdana, Geneva, sans-serif; font-size:25px;"><?php  echo $comp_nm;?></b><br />
    <font size="3"><?php  echo $bill_adrs;?></font><br>
    </td>
</tr>
<tr>
    <td colspan="5" align="center" style="padding:5px 0 5px 0;">
    <div style="font-family:Verdana, Geneva, sans-serif; background-color:#000; padding:10px; width:200px;"><font size="4" color="#FFFFFF"><b>Debit Voucher</b></font></div>
    </td>
</tr>
<tr>
    <td colspan="5">
        <table border="1" width="100%" style="border-collapse:collapse; border:1px solid #000000;">
        <tr>
            <td style=" ">Voucher No.</td>
            <td style=" padding-left:5px;"><?php  echo $blnon;?></td>
            <td style="text-align:left;  padding-right:5px;">Date </td>
            <td style="padding-left:5px; text-align:right;"><?php  echo date('d-m-Y',strtotime($dt));?></td>
        </tr>
        <tr>
            <td style=" ">Debit A/C</td>
            <td colspan="3" style="padding-left:5px;"><?php  echo $dldgr_nm;?></td>
        </tr>
		<tr>
            <td style="text-align:left;">Cridit Ledger Name </td>
            <td style="text-align:left; padding-left:5px;"><?php  echo $cldgr_nm;?></td>
            <td style="text-align:left;">Amount</td>
            <td style="text-align:right;"><?php  echo sprintf('%0.2f', $amm);?></td>
        </tr>
		<tr>
            <td style="text-align:left;">Paid to </td>
            <td colspan="3" style="text-align:left;"><?php  echo $mtddtl;?></td>           
        </tr>
		<tr>
            <td style="">Narration</td>
            <td colspan="3" style="padding-left:5px; "><?php  echo $nrtn;?></td>
        </tr>
		<tr style="background-color:#f2f2f2;">           
            <td colspan="4" align="center">Rupees <?php  echo $aiw;?></td>
        </tr>
        </table>
    </td>
</tr>

<tr>
<td align="left" style="text-align:left;" >
        <table width="100%" style="border: 0px solid #000000;">
        <tr>           
            <td style="text-align:center; width:20%; padding-bottom:20px;"><br />_____________________ <br />Prepared by</td>
			<td style="text-align:center; width:80%;"></td>
        </tr>
        </table>
    </td>
    <td >
        <table width="100%" style="border: 0px solid #000000;">
        <tr>
            <td style="text-align:center; width:80%;"></td>
            <td style="text-align:center; width:20%; padding-bottom:20px;"><br />_____________________ <br />Payment Received by</td>
        </tr>
        </table>
    </td>
</tr>
</table>
   
</body>
</html>