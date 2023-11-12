<?php
include("membersonly.inc.php");
include("Numbers/Words.php");

$sl=$_REQUEST['sl'];

$get=mysqli_query($conn,"select * from main_drcr where sl='$sl'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	//bookid vno	sbill	cbill	sid	eid	mnth	cid	dt	nrtn	typ	idt	mtd	mtddtl	dldgr	cldgr	amm	brncd	eby	edtm	pno	it	stat
	$bookid=$row['bookid'];
	$vno=$row['vno'];
	$sbill=$row['sbill'];
	$cbill=$row['cbill'];
	$sid=$row['sid'];
	$eid=$row['eid'];
	$mnth=$row['mnth'];
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
	/*
	$get1=mysqli_query($conn,"select * from main_cust where sl='$cid'") or die(mysqli_error($conn));
	while($row1=mysqli_fetch_array($get1))
	{
		$nm=$row1['nm'];
		$addr=$row1['addr'];
	}
	*/
	$get1=mysqli_query($conn,"select * from main_ledg where sl='$dldgr'") or die(mysqli_error($conn));
	while($row1=mysqli_fetch_array($get1))
	{
		$nm=$row1['nm'];
		//$addr=$row1['addr'];
	}
	
	
/*    */
	
$T=0;
$t1=0;
$t2=0;
if($pno=='0')
{
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where dldgr='4' and stat='1' and cid='$cid' and cbill='$cbill'");
}
else
{
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where dldgr='4' and pno='$pno' and stat='1' and cid='$cid' and cbill='$cbill'");
}
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
if($pno=='0')
{
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where cldgr='4' and stat='1' and cid='$cid'  and cbill='$cbill'");
}
else
{
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where cldgr='4' and pno='$pno' and stat='1' and cid='$cid' and cbill='$cbill'");
}
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=$t1-$t2;	
	
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
    <b style="font-family:Verdana, Geneva, sans-serif; font-size:25px;"><?=$comp_nm;?></b><br />
    <font size="3"><?=$bill_adrs;?></font><br>
    </td>
</tr>
<tr>
    <td colspan="5" align="center" style="padding:5px 0 5px 0;">
    <div style="font-family:Verdana, Geneva, sans-serif; background-color:#000; padding:10px; width:200px;"><font size="4" color="#FFFFFF"><b>Cash Receipt</b></font></div>
    </td>
</tr>
<tr>
    <td colspan="5">
        <table border="1" width="100%" style="border-collapse:collapse; border:1px solid #000000;">
        <tr>
            <td style="width:10%; font-size:22px; padding-left:5px;">Voucher No.</td>
            <td style="width:20%; padding-left:5px;"><b><?=$blnon;?></b></td>
            <td style="text-align:right; width:10%; font-size:22px; padding-right:5px;">Date </td>
            <td style="width:10%; padding-left:5px; padding-left:5px;"><?php echo date('d-m-Y',strtotime($dt));?></td>
        </tr>
        <tr>
            <td style="width:10%; font-size:22px; padding-left:5px;">Name</td>
            <td colspan="3" style="width:20%; padding-left:5px;"><b><?php echo $nm;?></b> </td>
        </tr>
        </table>
    </td>
</tr>
<tr style="height:50px;">
    <td colspan="5">
        <table border="1" width="100%" style="border-collapse:collapse; border:0px solid #000000;">
        <tr>
            <td style="text-align:right; width:20%; font-size:22px;"><b>Payment Mode :</b></td>
            <td style="text-align:left; width:30%; font-size:22px;"><?php echo $mtd;?></td>
            <td style="text-align:right; width:20%; font-size:22px;"><b>Amount :</b></td>
            <td style="text-align:left; width:30%; font-size:22px;"><?echo $amm;?></td>
        </tr>
		<tr>
            <td style="text-align:right;font-size:22px;"><b>Ref.No. :</b></td>
            <td style="text-align:left;font-size:22px;"><?php echo $mtddtl;?></td>
            <td style="text-align:right;font-size:22px;"><b>Narration :</b></td>
            <td style="text-align:left;font-size:22px;"><?php echo $nrtn;?></td>
        </tr>
		

        </table>
    </td>
</tr>
<tr>
    <td colspan="5">
        <table width="100%" style="border: 0px solid #000000;">
        <tr>
            <td style="text-align:center; width:80%;"></td>
            <td style="text-align:center; width:20%; padding-bottom:5px;"><br />_____________________ <br />Authorized Signature</td>
        </tr>
        </table>
    </td>
</tr>
</table>
   
</body>
</html>