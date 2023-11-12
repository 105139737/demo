<?php
include("membersonly.inc.php");
include("Numbers/Words.php");

$blno=$_REQUEST['blno'];

$query111 = "SELECT * FROM ".$DBprefix."billing where blno='$blno'";
$result111 = mysqli_query($conn,$query111)or die (mysqli_error($conn));
while ($R111 = mysqli_fetch_array ($result111))
{
$invdt=$R111['dt'];
$vno=$R111['vno'];
$fst=$R111['fst'];
$tst=$R111['tst'];
$tmode=$R111['tmod'];
$psup=$R111['psup'];
$tp=$R111['tp'];
$cid=$R111['cid'];
$bgstin=$R111['gstin'];
$invto=$R111['invto'];
$adrs=$R111['adrs'];
$sfno=$R111['sfno'];
$dpay=$R111['dpay'];
$finam=$R111['finam'];
$emiam=$R111['emiam'];
$emi_mnth=$R111['emi_mnth'];
$sale_per=$R111['sale_per'];
$disl=$R111['disl'];
$remk=$R111['remk'];
$damm=$R111['damm'];
$crdtp=$R111['crdtp'];
$mtddtl=$R111['crfno'];
$amm=$R111['paid'];
$mr=$R111['mr'];
$brnc=$R111['bcd'];
}
$invdt=date("d-m-Y", strtotime($invdt));	

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
if($nmp!='')
{
$bto=$nmp;	
}
	$data3= mysqli_query($conn,"SELECT * FROM ac_paymtd where sl='$crdtp'");
		while ($row3=mysqli_fetch_array($data3))
		{
		$mtd= $row3['mtd'];
		}

$nw = new Numbers_Words();
$aiw=$nw->toWords($amm);
$pnm1="";
$cnm1="";
$data= mysqli_query($conn,"select *,sum(pcs) as pcs,sum(cgst_am) as cgst_am,sum(sgst_am) as sgst_am,sum(igst_am) as igst_am from  main_billdtls where sl>0 and blno='$blno' group by prsl,prc,disa")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['prsl'];
$bcd=$row['bcd'];
$pcs=$row['pcs'];
$cat="";
$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm']." << QTY : ".$pcs;
$hsn=$row['hsn'];
$cat=$row['cat'];
}


if($pnm1==""){$pnm1=$pnm;}else{$pnm1.=",<br> ".$pnm;}
$cnm="";

$data12 = mysqli_query($conn,"Select * from main_catg where sl='$cat'");
while ($row12 = mysqli_fetch_array($data12))
	{
	$sl=$row12['sl'];
    $cnm=$row12['cnm'];
    }
    if($cnm1==""){$cnm1=$cnm;}else{$cnm1.=", ".$cnm;}

}
$gbit1=mysqli_query($conn,"select * from main_sale_per where spid='$sale_per'") or die (mysqli_error($conn));
while($GBi1=mysqli_fetch_array($gbit1))
{
$sale_nm=$GBi1['nm'];
$sale_mob=$GBi1['mob'];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title><?php echo $mtd;?> Receipt</title>
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
<?
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
<div style="<?=$csss;?>">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<table align="center" style="border-collapse:collapse; width:920px; border: 1px solid black;">
<tr>
    <td style="text-align:center; background-color:#f2f2f2; padding:5px 0 5px 0; border-bottom:1px solid #000;">
    <b style="font-family:Verdana, Geneva, sans-serif; font-size:25px;"><?=$comp_nm;?></b><br />
   <font style="font-size:16px;"><?=$adrs;?></font><br/>
<font style="font-size:13px;">GSTIN/UIN : <?=$gstin?></font>
    </td>
</tr>
<tr>
    <td align="center">
    <div style="font-family:Verdana, Geneva, sans-serif; background-color:#000; padding:10px; width:600px;"><font size="5" color="#FFFFFF"><b> FREE STANDARD INSTALLATION COUPON</b></font></div>
    
    
    </td>
</tr>
<tr>
    <td >
        <table border="1" width="100%" style="border-collapse:collapse; border:1px solid #000000;">
             <tr>
            <td ><font size="2"><b>Mr/Mrs :</b> </font></td>
            <td ><b><font size="2"><?php echo $bto;?>, <?php echo $baddr;?></font></b> </td>
        </tr>
           <tr>
            <td ><font size="2"><b>Mobile :</b> </font></td>
            <td ><b><font size="2"><?php echo $bmob;?></font></b> </td>
        </tr>
     
     <tr>
            <td ><font size="2"><b>Against Bill No. :</b> </font></td>
            <td ><b><font size="2"><?php echo $blno;?> </font></b> </td>
        </tr>
         <tr>
            <td ><font size="2"><b>Dated :</b> </font></td>
            <td ><b><font size="2"><?php echo $invdt;?> </font></b> </td>
        </tr>
        <tr>
            <td ><font size="2"><b>Brand :</b> </font></td>
            <td ><b><font size="2"><?php echo $cnm1;?> </font></b> </td>
        </tr>
          <tr>
            <td ><font size="2"><b>Model :</b> </font></td>
            <td ><b><font size="2"><?php echo $pnm1;?> </font></b> </td>
        </tr>
     
    
          <tr>
            <td ><font size="2"><b>Note :</b> </font></td>
            <td ><b><font size="2">Please Give The Coupon To Installer</font></b> </td>
        </tr>
		<tr>
            <td ><font size="2"><b>Sales Person :</b> </font></td>
            <td ><b><font size="2"><?php echo $sale_nm;?>, <?php echo $sale_mob;?></font></b> </td>
        </tr>

        </table>
    </td>
</tr>

<tr>
    <td >
        <table width="100%" style="border: 0px solid #000000;">
        <tr>
            <td style="text-align:left; width:80%;"><br />_____________________ <br />Customer Signature</td>
            <td style="text-align:center; width:20%; padding-bottom:5px;"><br><img src="stmp/<?php echo $brnc;?>.png" width="72" height="70"><br />_____________________ <br />Authorized Signature</td>
        </tr>
        </table>
        <b></b>
    </td>
</tr>
</table>
   </div>
   <?php }?>
</body>
</html>