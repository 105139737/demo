<?php
$reqlevel = 3;
include("membersonly.inc.php");
$fdt1=$_REQUEST['fdt'];
$tdt1=$_REQUEST['tdt'];
$ldgr=$_REQUEST['dldgr'];
$brsdt=$_REQUEST['brsdt'];

if($fdt1=="" or $tdt1=="" or $ldgr=="")
{
	echo "<div align='center'><b>PLEASE SELECT SEARCH OPTION</b></div>";
}
else {
if($fdt1=="" && $tdt1=="")
{
$todt="";
}
else
{
$fdt=date('Y-m-d',strtotime($fdt1));
$tdt=date('Y-m-d',strtotime($tdt1));
$todt=" and dt between '$fdt' and '$tdt'";
}

if($ldgr=="")
{
$lqr="";
}
else
{
$lqr=" and (dldgr='$ldgr' or cldgr='$ldgr')";
}
$brs_dtt="";
if($brsdt=="YES")
{
$brs_dtt=" and brs_dt>'2000-01-01'";
}
elseif($brsdt=="NO")
{
$brs_dtt=" and brs_dt<'2000-01-01'";
}
$opdr=0;
$opcr=0;
$data1= mysqli_query($conn,"SELECT sum(amm) as tdr FROM main_drcr where dldgr='$ldgr' and dt<'$fdt' and brs_dt>'2000-01-01'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$opdr=$row1['tdr'];
}

$data11= mysqli_query($conn,"SELECT sum(amm) as tcr FROM main_drcr where cldgr='$ldgr' and dt<'$fdt' and brs_dt>'2000-01-01'")or die(mysqli_error($conn));
while ($row11 = mysqli_fetch_array($data11))
{
$opcr=$row11['tcr'];
}
$bal=$opdr-$opcr;
if($bal>0)
{
$bal1=$bal." Dr";	
}
elseif($bal<0)
{
$bal1=$bal*(-1)." Cr";		
}

$data2= mysqli_query($conn,"SELECT sum(amm) as tdr FROM main_drcr where dldgr='$ldgr' and dt<'$fdt' ")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$opdr_ac=$row1['tdr'];
}

$data3= mysqli_query($conn,"SELECT sum(amm) as tcr FROM main_drcr where cldgr='$ldgr' and dt<'$fdt'")or die(mysqli_error($conn));
while ($row11 = mysqli_fetch_array($data3))
{
$opcr_ac=$row11['tcr'];
}
$bal_ac=$opdr_ac-$opcr_ac;
if($bal_ac>0)
{
$bal_ac1=$bal_ac." Dr";	
}
elseif($bal_ac<0)
{
$bal_ac1=$bal_ac*(-1)." Cr";		
}
$bal_op1=$bal_ac1;
?>
<table width="100%" border="1" class="table table-hover table-striped table-bordered">
<thead>
<tr style="height: 30px;">
<th align="center">Sl.</th>
<th align="center">Date</th>
<th align="center">Vouchar No.</th>
<th align="center">Check No.</th>
<th align="center">Ref.No.</th>
<th align="center">Particular</th>
<th align="center" >Narration</th>

<th align="center">Dr.</th>
<th align="center">Cr.</th>
<th align="center">Sys Balance</th>
<th align="center">Bank Stmnt Balance</th>

<th align="center" width="10%">BRS Date</th>
</tr>
<tr>
<td align="right" style="font-size:125%" colspan="7"><b>OPENING</b></td>
<td align="left"><b><?php echo $opdr;?></b></td>
<td align="left"><b><?php echo $opcr;?></b></td>
<td align="left"><b><?php echo $bal_ac1;?></b></td>
<td align="left"><b><?php echo $bal1;?></b></td>

<td align="center" width="10%" style="font-size:125%"><span id="total_bal_ac11"></span></b></td>
</tr>
</thead>
<tr style="display:none;">
<td align="right" style="font-size:125%" colspan="7"><b>TOTAL :</b></td>
<td align="left" style="font-size:125%"><b><span id="total_dr1"></span></b></td>
<td align="left" style="font-size:125%"><b><span id="total_cr1"></span></b></td>
<td align="left" style="font-size:125%"><b><span id="total_bal_ac1"></span></b></td>
<td align="left" style="font-size:125%"><b><span id="total_bal1"></span></b></td>

<td align="center" width="10%" style="font-size:125%"></b></td>
</tr>
<tbody>
<?
$cc="0";
//echo "SELECT *,sum(amm) as amm FROM main_drcr where sl>0 and blnon!=''".$brs_dtt.$todt.$lqr." group by blnon order by dt,sl";
$data= mysqli_query($conn,"SELECT *,sum(amm) as amm FROM main_drcr where sl>0 and blnon!=''".$brs_dtt.$todt.$lqr." group by blnon order by dt,sl")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$cc++;	
$sl1= $row['sl'];
$dt= $row['dt'];
$pno= $row['pno'];
$vno= $row['vno'];
$blnon= $row['blnon'];
$cldgr= $row['cldgr'];
$dldgr= $row['dldgr'];
$mtd= $row['mtd'];
$mtddtl= $row['mtddtl'];
$amm= round($row['amm'],2);
$nrtn= $row['nrtn'];
$eby= $row['eby'];
$edt= $row['edt'];
$cid= $row['cid'];
$cbill= $row['cbill'];
$brs_dt= $row['brs_dt'];
$sid= $row['sid'];




$total_am+=$amm;

if($nrtn=='')
{
$nrtn='NA';
}
$pert="";
$name="";
$refno="";
if($cldgr==$ldgr)
{
$camm=$amm;
$damm='0';

$get = mysqli_query($conn,"SELECT * FROM main_ledg where sl='$dldgr'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
$pert=$row['nm'];
}
if($dldgr==12)
{
$get1=mysqli_query($conn,"SELECT * FROM main_suppl where sl='$sid'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get1))
{
$name=$row['spn'];
}	
}
if($name=="")
{
$name="Withdrawal";	
}
if($brs_dt>2000-01-01)
{
$bal=$bal-$amm;
}

$bal_ac=$bal_ac-$amm;

}

if($dldgr==$ldgr)
{
$damm=$amm;
$camm='0';

$get = mysqli_query($conn,"SELECT * FROM main_ledg where sl='$cldgr'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
$pert=$row['nm'];
}
$refno=$cbill;
if($cldgr==4)
{
$get1=mysqli_query($conn,"SELECT * FROM main_cust where sl='$cid'") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get1))
{
$name=$row['nm'];
}	
}
if($name=="")
{
$name="Deposit";	
}
if($brs_dt>2000-01-01)
{
$bal=$bal+$amm;
}

$bal_ac=$bal_ac+$amm;

}

if($bal>0)
{
$bal1=$bal." Dr";	
}
elseif($bal<0)
{
$bal1=$bal*(-1)." Cr";		
}
if($bal_ac>0)
{
$bal_ac1=$bal_ac." Dr";	
}
elseif($bal_ac<0)
{
$bal_ac1=$bal_ac*(-1)." Cr";		
}

$pert=$pert." : <b>".$name."</b>";

$dt=date('d-m-Y', strtotime($dt));
if($brs_dt=="" or $brs_dt=="0000-00-00"){$brs_dt="";}else{$brs_dt=date('d-m-Y',strtotime($brs_dt));}
?>
<tr class="<?php echo $cls;?>" style="height: 20px;">
<td align="left" valign="top"><b><?php echo $cc;?></b></td>
<td align="left" valign="top"><b><?php echo $dt;?></b></td>
<td align="left" valign="top"><b><?php echo $blnon;?></b></td>
<td align="left" valign="top"><b><?php echo $mtddtl;?></b></td>
<td align="left" valign="top"><b><?php echo $refno;?></b></td>
<td align="left" valign="top"><?php echo $pert;?></td>
<td align="left" valign="top"><?php echo $nrtn;?></td>

<td align="left" valign="top"><b><?php echo $damm;?></b></td>
<td align="left" valign="top"><b><?php echo $camm;?></b><b></td>
<td align="left" valign="top"><b><?php echo $bal_ac1;?></b><b></td>
<td align="left" valign="top"><b><span id="bank_st<?=$cc?>"><?php echo $bal1;?></span></b><b></td>

<td align="left" valign="top">

<input type="text" id="tb<?php echo $cc;?>" name="tb<?php echo $cc;?>"  value="<? echo $brs_dt;?>" class="form-control dat" onblur="sedtt('<?echo $blnon;?>','brs_dt',this.value,'main_drcr','<?=$sl1;?>','<?=$dt;?>','<?=$ldgr;?>')" onchange="sedtt('<?echo $blnon;?>','brs_dt',this.value,'main_drcr','<?=$sl1;?>','<?=$dt;?>','<?=$ldgr;?>')">
<div id="brr<?php echo $sl1;?>"></div>
</td>
</tr>
<?
}
?>
<input type="hidden" value="<?=$cc?>" id="countt" >
<tr>
<td align="right" style="font-size:125%" colspan="7"><b>TOTAL :</b></td>
<td align="left" style="font-size:125%"><b><span id="total_dr"></span></b></td>
<td align="left" style="font-size:125%"><b><span id="total_cr"></span></b></td>
<td align="left" style="font-size:125%"><b><span id=""><?=$bal_ac1;?></span></b></td>
<td align="left" style="font-size:125%"><b><span id="total_bal"></span></b></td>

<td align="center" width="10%"></td>
</tr>
<div id="tdv">
</div>

</tbody>
</table>
<input type="text" hidden id="sys_bal">
<input type="text" hidden id="bank_bal">

<script type="text/javascript" language="javascript">
$(document).ready(function()
{

   var jQueryDatePicker1Opts =
   {
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   $(".dat1").datepicker(jQueryDatePicker1Opts);
});
$(".dat").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
ttl();
$('#total_bal_ac1').html('<?=$bal_ac1;?>')
document.getElementById('sys_bal').value="<?=round($bal_ac,2);?>";

</script>
<?

if($bal1<0)
{
$bal1=$bal1*(-1);
}
if($bal_ac1<0)
{
$bal_ac1=$bal_ac1*(-1);
}

?>
<script>

</script> 							
<?}?>