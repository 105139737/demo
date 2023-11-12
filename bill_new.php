<?
$reqlevel = 1;
include("membersonly.inc.php");
include("Numbers/Words.php");
$blno=rawurldecode($_REQUEST[blno]);
		$sln=0;
		$tota=0;
$tq=0;
$tslrt=0;
$tamm1=0;	
$car1=0;	
$vatamm1=0;
$ttpoint=0;
$ttsret=0;
$paid1=0;
$data1= mysqli_query($conn,"select * from  main_billing where sl>0".$todts.$snm1.$brncd1)or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{

$blno=$row1['blno'];
$dt=$row1['dt'];
$edt1=$row1['edt'];
$vat=$row1['vat'];
$vatamm=$row1['vatamm'];
$car=$row1['car'];
$sid=$row1['cid'];
$pdts=$row1['pdts'];
$dis=$row1['dis'];
$paid=$row1['paid'];

if($car==""){$car=0;}
if($dis==""){$dis=0;}
$dt=date('d-m-Y', strtotime($dt));
}
$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$addr=$rowd['addr'];
$mob1=$rowd['cont'];
$vatno=$rowd['vatno'];
}
 $query1 = "SELECT sum(ttl) as gttl FROM ".$DBprefix."billdtls where blno='$blno'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$gttl=$R1['gttl'];
$qttl=$R1['qttl'];
}
if($vat!=0)
{
	$vat1=($gttl*$vat)/100;
	$gttl1=($gttl+$vat1+$car)-$dis;
}
else
{
	$vat=0;
	$gttl1=($gttl+$car)-$dis;
}

$nw = new Numbers_Words();
$aiw=$nw->toWords($gttl1);
?>
<html>
<head>
<style>
.tb
{
border-collapse: collapse;
border: 1px solid black;
border-left: none;
border-right: none;
}

</style>

<style>
.ff{
border-collapse: collapse;
border: 1px solid black;
}
#tdb
{

	border-bottom: 0px solid #FFF;
	border-top: 0px solid #FFF;
}

</style>
<script type="text/javascript">
function blprnt(){
    if(confirm('Are You Sure?')){
    
    window.print();
   }
   
}
</script>
</head>
<body onload="blprnt()">
<table align="center" border="1" style="border-collapse:collapse; width:800px; border: 2px solid black;">
<tr  id="tdb">
<td colspan="2" style="text-align:center;"><center><div style="background-color:#000;width:170px;text-align:center;"><font color="#FFF">Tax Invoice Cum Chalan</font></div></center></td>
</tr>
<tr>
<td style="width:50%;">
<table>
<tr>
<td>
<font style="font-size:22px;font-family:Algerian"><b>NEW LAKESHMI NARAYAN STORE</b></font><br/>
<font size="3" style="font-family: Times New Roman, Georgia, Serif;">
Prop. - Prokash Kumar Saha<br>
1, L.M. Ghosh Road, Akash Deep Market<br>
(Nadia Sweets), P.O. Krishnagar, Dt. Nadia<br>
VAT Reg. No. - 19771136939<br>
CST Reg. No. -
</font>
</td>
</tr>
</table>
</td>
<td style="width:50%;">
<table>
<tr>
<td>
<font style="font-family: Times New Roman, Georgia, Serif;">
Tax Invoice No. :- <b><?=$blno;?></b><br>
Challan No. & Date :- <b><?=$dt;?></b><br>
Buyer's Name :- <?=$nm;?><br>
Address :-<?=$addr;?><br>
Buyer's VAT No. :- <?=$vatno;?> 
</font>
</td>
</tr>
</table>
</td>
</tr>
</table>

<table border="1" class="ff" width="800px" align="center">
<tr>
<td align="center"><b>Sl No.</b></td>
<td align="center" width="12%"><b>Quantity</b></td>
<td align="center"><b>Description of Goods</b></td>
<td align="center"><b>Price per<br>cartoon/<br>basta/pcs.</b></td>
<td align="center"><b>Value<br>Rs.  P.</b></td>
<td align="center"><b>Vat Rate</b></td>
<td align="center"><b>Tax Amount<br>Rs.  P.</b></td>
<td align="center"><b>Total Amount<br>Rs. P.</b></td>
</tr>
<?
$height="700";
$sln=0;
$data= mysqli_query($conn,"select * from  main_billdtls where sl>0 and blno='$blno'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$cat=$row['cat'];
$scat=$row['scat'];	
$pcd=$row['prsl'];
$prc=$row['prc'];
$ttl=$row['ttl'];
$blno1=$row['blno'];
$unit=$row['unit'];
$kg=$row['kg'];
$grm=$row['grm'];
$pcs=$row['pcs'];
$sln++;
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
}
if($unit=='1')
{

$stock_in=$kg."Kg , ".$grm."Gm";
}
if($unit=='2'){$stock_in=$pcs." Pcs";}
if($unit=='3'){$stock_in=$pcs." Pcs";}

$height=$height-21;
?>
<tr id="tdb">
<td align="center"><font size="2"><?=$sln;?></font></td>
<td align="left"><font size="2"><?=$stock_in;?></font></td>
<td align="left"><font size="2"><?=$pnm;?></font></td>
<td align="right"><font size="2"><?=sprintf('%0.2f',$prc);?></font></td>
<td align="right"><font size="2"><?=sprintf('%0.2f',$ttl);?></font></td>
<td align="right"><font size="2"></font></td>
<td align="right"><font size="2"></font></td>
<td align="right"><font size="2"><?=sprintf('%0.2f',$ttl);?></font></td>
</tr>
<?
}
?>
<tr style="height:<?=$height;?>px">
<td align="center"></td>
<td align="left"></td>
<td align="center"></td>
<td align="left"></td>
<td align="center"></td>
<td align="center" valign="bottom"><?=$vat;?> % </td>
<td align="right" valign="bottom"><?=sprintf('%0.2f',$vatamm);?></td>
<td align="right" valign="bottom"><?=sprintf('%0.2f',$gttl1);?></td>
</tr>
<tr>
<td align="right" colspan="7"><font  size="4"><b>Total-</b></font></td>
<td align="right"><font  size="4"><b><?=sprintf('%0.2f',$gttl1);?></b></font></td>
</tr>
</table>
<br><br><br>

<table border="0" width="800px" align="center">
<tr>
<td style="text-align:left; padding-left:10px; width:50%;"><b>Date</b></td>
<td style="text-align:right; padding-right:110px; width:50%;">
<b>Signature</b><br>
</td>
</tr>
<tr>
<td colspan="2" style="text-align:right;">
(Of Selling dealer or his authorised employee)
</td>
</tr>


</table>

</body>
</html>