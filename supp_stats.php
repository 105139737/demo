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
if($val==1)
{
$file="Date Wise Supplier Statement (".$fdt." To ".$tdt.".xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file"); 	
}
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

if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
if($sid!="")
{
if($val=="1")
{
?>

<table  class="advancedtable" width="70%"  border="2">
<tr>
<td  align="center" colspan="13" ><b>
<b>Supplier Statement</b><br>
<font style="font-size:18px;font-family:Century"><b><?=$spn;?></b></font><br/>
<font style="font-size:13px;font-family:Century"><b><?=$addr;?></b></font><br/>
<font style="font-size:18px;font-family:Century"><b>PARTY : <?=$comp_nm;?> - <?=$branchnm;?></b></font><br/>
<font style="font-size:13px;font-family:Century"><?=$comp_addr;?><br>
Phone : <?=$cont;?>
</font><br/>
<font style="font-size:14px;"><b>Statement From : <?=date('d-m-Y', strtotime($fdt));?></b> To <b><?=date('d-m-Y', strtotime($tdt));?></b></font>
</b></td>
</tr>
</table>

<?
}
?>
<div class="box box-success"> 
<table <?if($val=='1'){?>width="70%"<? }else{?> width="100%" <?} ?>  class="advancedtable" <?if($val=='1'){?> border="1" <? } ?> >
<tr>

<td valign="top">
<table <?if($val=='1'){?> border="1" <? } ?> width="100%" class="advancedtable">
<tr bgcolor="#e8ecf6">
<td  align="center"><b>SL</b></td>
<td  align="center"><b>BILLING DATE</b></td>
<td align="center"><b>RECEIVED DATE</b></td>
<td align="center"><b>BILL NO</b></td>
<td align="center"><b>BILL AMOUNT</b></td>
</tr>
<?
$sln=0;
$Tbill_amm=0;
$query100 = "SELECT * FROM ".$DBprefix."purchase where sid='$sid' $todt $brncd1 order by sl";
$result100 = mysqli_query($conn,$query100);

while ($R100 = mysqli_fetch_array ($result100))
{
$sln++;
$tsl=$R100['sl'];
$bill_dt=date('d-m-Y',strtotime($R100['dt']));
$recv_dt=$R100['nrtn'];
$bill_no=$R100['inv'];
$bill_amm=$R100['tmm2'];
?>
<tr>
<td  align="left"><b><?=$sln;?></b></td>
<td  align="left"><b><?=$bill_dt;?></b></td>
<td align="left"><b></b><?=$recv_dt;?></td>
<td align="left"><b><?=$bill_no;?></b></td>
<td align="right"><b><?=round($bill_amm,2);?></b></td>
</tr>
<?
$Tbill_amm=$Tbill_amm+$bill_amm;
}
?>
</table>

<table <?if($val=='1'){?>width="70%"<? }else{?> width="100%" <?} ?>  class="advancedtable" <?if($val=='1'){?> border="1" <? } ?> >
<tr>

<td valign="top">
<table <?if($val=='1'){?> border="1" <? } ?> width="100%" class="advancedtable">
<tr bgcolor="#e8ecf6">
<td  align="center"><b>SL</b></td>
<td  align="center"><b>BILLING DATE</b></td>
<td align="center"><b>RECEIVED DATE</b></td>
<td align="center"><b>BILL NO</b></td>
<td align="center"><b>BILL AMOUNT</b></td>
</tr>
<?
$sln=0;
$query100 = "SELECT * FROM main_ser_purchase where sid='$sid' $todt $brncd1 order by sl";
$result100 = mysqli_query($conn,$query100);
while ($R100 = mysqli_fetch_array ($result100))
{
$sln++;
$tsl=$R100['sl'];
$bill_dt=date('d-m-Y',strtotime($R100['dt']));
$recv_dt=$R100['nrtn'];
$bill_no=$R100['inv'];
$bill_amm=$R100['tmm2'];
?>
<tr>
<td  align="left"><b><?=$sln;?></b></td>
<td  align="left"><b><?=$bill_dt;?></b></td>
<td align="left"><b></b><?=$recv_dt;?></td>
<td align="left"><b><?=$bill_no;?></b></td>
<td align="right"><b><?=round($bill_amm,2);?></b></td>
</tr>
<?
$Tbill_amm=$Tbill_amm+$bill_amm;
}
?>
<tr>
<td colspan="4" align="right"><font color="red" size="4"><b>Total : </b></font></td> 
<td align="right"><font color="red" size="4"><b><?=round($Tbill_amm,2);?></b></font></td>
</tr>

</table>
</td>

<td valign="top">
<table <?if($val=='1'){?> border="1" <? } ?> width="100%" class="advancedtable">
<tr bgcolor="#e8ecf6">
<td  align="center"><b>SL</b></td>
<td  align="center"><b>CHEQUE NO.</b></td>
<td align="center"><b>DATE</b></td>
<td align="center"><b>PAYMENT AMOUNT</b></td>
</tr>
<?
$sln1=0;
$Tpay_amm=0;
$query101 = "SELECT * FROM ".$DBprefix."drcr where sid='$sid' and (typ!='C01' or typ='88') $todt $brnch1  order by sl";
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
<td  align="left"><b><?=$sln1;?></b></td>
<td  align="left"><b><?=$chq_no;?></b></td>
<td align="left"><b><?=$dt;?></b></td>
<td align="right"><b><?=round($pay_amm,2);?></b></td>
</tr>
<?
$Tpay_amm=$Tpay_amm+$pay_amm;
}
?>
<tr>
<td colspan="3" align="right"><font color="red" size="4"><b>Total : </b></font></td> 
<td align="right"><font color="red" size="4"><b><?=round($Tpay_amm,2);?></b></font></td>
</tr>
<?
}
else
{
?>
<tr>
<td  align="center" colspan="4"><font color="red"><b>No Record Available....</b></font></td>
</tr>
<?	
}
?>
</table>
</td>

<td valign="top"> 
<table <?if($val=='1'){?> border="1" <? } ?> width="100%" class="advancedtable">
<tr bgcolor="#e8ecf6">
<td  align="center"><b>SL</b></td>
<td  align="center"><b>CLAIM DATE MONTH</b></td>
<td align="center"><b>CLAIM AMOUNT</b></td>
<td align="center"><b>NARRATION</b></td>
</tr>
<?
$sln2=0;
$Tclaim_amm=0;
$query102 = "SELECT * FROM ".$DBprefix."drcr where sid='$sid' and (typ='C01' or typ='C02') $todt $brnch1 order by sl";
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
<td  align="left"><b><?=$sln2;?></b></td>
<td  align="left"><b><?=$claim_dt;?></b></td>
<td align="right"><b></b><?=round($claim_amm,2);?></td>
<td align="left"><b><?=$nrtn;?></b></td>
</tr>
<?
$Tclaim_amm=$Tclaim_amm+$claim_amm;
}
?>
<tr>
<td colspan="2" align="right"><font color="red" size="4"><b>Total : </b></font></td> 
<td align="right"><font color="red" size="4"><b><?=round($Tclaim_amm,2);?></b></font></td>
<td></td>
</tr>
<?
}
else
{
?>
<tr>
<td  align="center" colspan="4"><font color="red"><b>No Record Available....</b></font></td>
</tr>
<?	
}
?>
</table>
</td>

</tr>


<?


if($Tpay_amm>0 || $Tpay_amm>0)
{
$Grandpay=$Tclaim_amm+$Tpay_amm;
}
$CREDIT=$Tbill_amm-$Grandpay;

?>
</td>
</tr>

</table>
<table <?if($val=='1'){?> border="1" <? } ?> width="100%" class="advancedtable">
<tr bgcolor="#ffc000">
<td colspan="12"  align="right"><b>GRAND TOTAL PAY</b></td>
<td align="right" width="10%"><font color="red" size="4"><b><?=round($Grandpay,2);?></b></font></td>
</tr>
<tr bgcolor="#ffff00">
<td colspan="12"  align="right"><b> TOTAL CREDIT</b></td>
<td align="right" ><font color="red" size="4"><b><?=round($CREDIT,2);?></b></font></td>
</tr>

</table>



</div>
<?
}
else
{
	?>
<table <?if($val=='1'){?> border="1" <? } ?> width="100%" class="advancedtable">
<tr class="even">
<td  align="center"><font color="red" size="4"><b>Please Select Any Supplier...!!</b></font></td>
</tr>
</table>	
	<?
}