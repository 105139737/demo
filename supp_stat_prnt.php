<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$brncd=$_REQUEST['brncd'];
$sid=$_REQUEST['sid'];
$proj=$_REQUEST['proj'];
$val=$_REQUEST['val'];
if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($brncd==""){$brnch1="";}else{$brnch1=" and brncd='$brncd'";}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
$SS="SELECT * FROM ".$DBprefix."suppl where sl='$sid'";
$PP = mysqli_query($conn,$SS);
while ($MP = mysqli_fetch_array($PP))
{
$spn=$MP['spn'];
$addr=$MP['addr'];
$mob1=$MP['mob1'];
}
$querys="Select * from ".$DBprefix."branch where sl='$brncd'";
$results = mysqli_query($conn,$querys);
while ($Rs = mysqli_fetch_array ($results))
{
$branchnm=$Rs['bnm'];
}
if($val==1)
{
$file="Date Wise Supplier Statement (".$fdt." To ".$tdt.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 	
}


if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
if($sid!="")
{

?>
<script type="text/javascript">
prnt();
function prnt(){
    if(confirm('Are You Sure?')){
    
    window.print();
   }
   
}
</script>
<style>
.advancedtable tbody tr td
{
border:1px solid #000;
padding: 2px 2px;
}
.advancedtable thead tr th
{
border:1px solid #000;
padding: 0px 0px;
}
.advancedtable
{
border-collapse: collapse;
}
</style>
<center>
<table width="100%"  >
<tr>
<td  align="center" ><b>
<b>Supplier Statement</b><br>
<font style="font-size:18px;font-family:Century"><b><?php  echo $spn;?></b></font><br/>
<font style="font-size:13px;font-family:Century"><b><?php  echo $addr;?></b></font><br/>
<font style="font-size:18px;font-family:Century"><b>PARTY : <?php  echo $comp_nm;?> - <?php  echo $branchnm;?></b></font><br/>
<font style="font-size:13px;font-family:Century"><?php  echo $comp_addr;?><br>
Phone : <?php  echo $cont;?>
</font><br/>
<font style="font-size:14px;"><b>Statement From : <?php echo date('d-m-Y', strtotime($fdt));?></b> To <b><?php echo date('d-m-Y', strtotime($tdt));?></b></font>
</b>
</td>
</tr>
</table>
</center>

<table width="100%" border="1" class="advancedtable">
<tr>

<td valign="top">
<table width="100%" class="advancedtable">
<tr bgcolor="#e8ecf6">
<td  align="center"><b>SL</b></td>
<td  align="center"><b>BILLING DATE</b></td>
<td align="center"><b>RECEIVED DATE</b></td>
<td align="center"><b>BILL NO</b></td>
<td align="center"><b>BILL AMOUNT</b></td>
</tr>
<?php 
$sln=0;
$Tbill_amm=0;
$query100 = "SELECT * FROM ".$DBprefix."purchase where sid='$sid' $brncd1 order by sl";
$result100 = mysqli_query($conn,$query100);
if(mysqli_num_rows($result100)>0)
{
while ($R100 = mysqli_fetch_array ($result100))
{
$sln++;
$tsl=$R100['sl'];
$bill_dt=date('d-m-Y',strtotime($R100['dt']));
$recv_dt=$R100['nrtn'];
$bill_no=$R100['inv'];
$bill_amm=$R100['sttl'];
?>
<tr>
<td  align="left"><b><?php  echo $sln;?></b></td>
<td  align="left"><b><?php  echo $bill_dt;?></b></td>
<td align="left"><b></b><?php  echo $recv_dt;?></td>
<td align="left"><b><?php  echo $bill_no;?></b></td>
<td align="right"><b><?php echo round($bill_amm,2);?></b></td>
</tr>
<?php 
$Tbill_amm=$Tbill_amm+$bill_amm;
}
?>
<tr>
<td colspan="4" align="right"><font color="red" size="4"><b>Total : </b></font></td> 
<td align="right"><font color="red" size="4"><b><?php echo round($Tbill_amm,2);?></b></font></td>
</tr>
<?php 
}
else
{
?>
<tr>
<td  align="center" colspan="4"><font color="red"><b>No Record Available....</b></font></td>
</tr>
<?php 	
}
?>
</table>
</td>

<td valign="top">
<table width="100%" class="advancedtable">
<tr bgcolor="#e8ecf6">
<td  align="center"><b>SL</b></td>
<td  align="center"><b>CHEQUE NO.</b></td>
<td align="center"><b>DATE</b></td>
<td align="center"><b>PAYMENT AMOUNT</b></td>
</tr>
<?php 
$sln1=0;
$Tpay_amm=0;
$query101 = "SELECT * FROM ".$DBprefix."drcr where sid='$sid' and (typ!='C01' or typ='88') $brnch1 order by sl";
$result101 = mysqli_query($conn,$query101);
if(mysqli_num_rows($result101)>0)
{
while ($R101 = mysqli_fetch_array ($result101))
{
$sln1++;
$tsl=$R101['sl'];
$chq_no=$R101['mtddtl'];
$dt=date('d-m-Y',strtotime($R101['dt']));
$pay_amm=$R101['amm'];
?>

<tr>
<td  align="left"><b><?php  echo $sln1;?></b></td>
<td  align="left"><b><?php  echo $chq_no;?></b></td>
<td align="left"><b><?php  echo $dt;?></b></td>
<td align="right"><b><?php echo round($pay_amm,2);?></b></td>
</tr>
<?php 
$Tpay_amm=$Tpay_amm+$pay_amm;
}
?>
<tr>
<td colspan="3" align="right"><font color="red" size="4"><b>Total : </b></font></td> 
<td align="right"><font color="red" size="4"><b><?php echo round($Tpay_amm,2);?></b></font></td>
</tr>
<?php 
}
else
{
?>
<tr>
<td  align="center" colspan="4"><font color="red"><b>No Record Available....</b></font></td>
</tr>
<?php 	
}
?>
</table>
</td>

<td valign="top"> 
<table width="100%" class="advancedtable">
<tr bgcolor="#e8ecf6">
<td  align="center"><b>SL</b></td>
<td  align="center"><b>CLAIM DATE MONTH</b></td>
<td align="center"><b>CLAIM AMOUNT</b></td>
<td align="center"><b>NARRATION</b></td>
</tr>
<?php 
$sln2=0;
$Tclaim_amm=0;
$query102 = "SELECT * FROM ".$DBprefix."drcr where sid='$sid' and typ='C01' $brnch1 order by sl";
$result102 = mysqli_query($conn,$query102);
if(mysqli_num_rows($result102)>0)
{
while ($R102 = mysqli_fetch_array ($result102))
{
$sln2++;
$tsl=$R102['sl'];
$chq_no=$R102['mtddtl'];
$claim_dt=date('d-m-Y',strtotime($R102['dt']));
$claim_amm=$R102['amm'];
$nrtn=$R102['nrtn'];
?>
<tr class="even">
<td  align="left"><b><?php  echo $sln2;?></b></td>
<td  align="left"><b><?php  echo $claim_dt;?></b></td>
<td align="right"><b><?php echo round($claim_amm,2);?></b></td>
<td align="left"><b><?php  echo $nrtn;?></b></td>
</tr>
<?php 
$Tclaim_amm=$Tclaim_amm+$claim_amm;
}
?>
<tr>
<td colspan="2" align="right"><font color="red" size="4"><b>Total : </b></font></td> 
<td align="right"><font color="red" size="4"><b><?php echo round($Tclaim_amm,2);?></b></font></td>
<td></td>
</tr>
<?php 
}
else
{
?>
<tr>
<td  align="center" colspan="4"><font color="red"><b>No Record Available....</b></font></td>
</tr>
<?php 	
}
?>
</table>
</td>

</tr>


<?php 


if($Tpay_amm>0 || $Tpay_amm>0)
{
$Grandpay=$Tclaim_amm+$Tpay_amm;
}
$CREDIT=$Tbill_amm-$Grandpay;

?>
<tr>
<td colspan="3" align="right" >
<table width="30%" class="advancedtable">
<tr bgcolor="#ffc000">
<td  align="center"><b>GRAND TOTAL PAY</b></td>
<td align="right"><font color="red" size="4"><b><?php echo round($Grandpay,2);?></b></font></td>
</tr>
<tr bgcolor="#ffff00">
<td  align="center"><b> TOTAL CREDIT</b></td>
<td align="right"><font color="red" size="4"><b><?php echo round($CREDIT,2);?></b></font></td>
</tr>

</table>
</td>
</tr>

</table>


<?php 
}
else
{
	?>
<table width="100%" class="advancedtable">
<tr class="even">
<td  align="center"><font color="red" size="4"><b>Please Select Any Supplier...!!</b></font></td>
</tr>
</table>	
	<?php 
}