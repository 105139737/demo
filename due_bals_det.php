<?
$reqlevel = 3; 
include("membersonly.inc.php");
$blno=rawurldecode($_REQUEST['blno']);
$dt=rawurldecode($_REQUEST['dt']);
if($dt!="" ){$dt=date('Y-m-d', strtotime($dt));$date=" and dt<='$dt'";}else{$date="";}
?>
<div class="box box-success" >
<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<tr>
<td align="center" colspan="9"><font color="red" size="4"><b>BILL NUMBER : <?=$blno;?></b></font></td>
</tr>
<tr>
<td align="center"><b>Voucher No.</b></td>
<td align="center"><b>Date</b></td>
<td align="center"><b>Ledger Name</b></td>
<td align="center"><b>Payment Method</b></td>
<td align="center"><b>Reference No. </b></td>
<td align="center"><b>Remark</b></td>
<td align="right"><b>Debit</b></td>
<td align="right" ><b>Credit</b></td>
<td align="right" ><b>Balance</b></td>
</tr>
<?
 $tdebt=0;
 $tcredt=0;
 
 $pag=0;
$query1="select *,sum(amm) as amm  from ".$DBprefix."drcr where cbill='$blno'  $brncd1  $date group by  cbill,dldgr,edtm,vno order by dt,sl";
$result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$dsl=$R1['sl'];
$bno=$R1['cbill'];
$vno=$R1['vno'];
$pmd=$R1['mtd'];
$amm=round($R1['amm'],2);
$rd=$R1['dt'];
$cldgr=$R1['cldgr'];
$dldgr=$R1['dldgr'];
$ref=$R1['mtddtl'];
$brncd=$R1['brncd'];
$nrtn=$R1['nrtn'];
$pno=$R1['pno'];
$blnon=$R1['blnon'];
$blno_pay=$R1['blno'];
$link="";
if($blno_pay!='')
{
$link="recv_reg_oth_edt.php?blno=".$blno_pay;
}
if($blnon==""){
$blnon=$bno;

$data13= mysqli_query($conn,"SELECT * FROM main_billing where blno='$bno'");
$counnnt=mysqli_num_rows($data13);
if($counnnt>0)
{
$link="billing_edit.php?blno=".$bno;
}
}

$bb="";
$bb1="";
if($amm<0)
{
	$amm=($amm*(-1));
}

if($dldgr==4){
    $damm=$amm;
    $camm="";
    $nbal=round($nbal+$amm,2);
    if($nbal<0)
   {
    $nbalf=$nbal*-1;
    $nbalf.=" Cr";
   } 
   else
   {
    $nbalf=$nbal;
    $nbalf.=" Dr";
   }
}
if($cldgr==4){
    $camm=$amm;
    $damm="";
    $nbal=$nbal-$amm;
    if($nbal<0)
   {
    $nbalf=$nbal*-1;
    $nbalf.=" Cr";
   } 
   else
   {
    $nbalf=$nbal;
    $nbalf.=" Dr";
   }
}

if($nrtn=='S-GST' or $nrtn=='C-GST' or $nrtn=='I-GST')
{
$nrtn='Sale';
}
$mtd="";
$data3= mysqli_query($conn,"SELECT * FROM ac_paymtd where sl='$pmd'");
while ($row3 = mysqli_fetch_array($data3))
{
$mtd= $row3['mtd'];
}
$data2= mysqli_query($conn,"SELECT * FROM main_ledg where sl='$dldgr'");
while ($row2 = mysqli_fetch_array($data2))
{
$dldgr_nm= $row2['nm'];
}
?>
<tr bgcolor="<?=$colo;?>">
<td align="center" ><a href="<?=$link;?>" target="_blank"><font size="2" color="red" ><? echo $blnon;?></font></a></td>
<td align="center" ><font size="2" ><? echo $rd;?></font></td>
<td align="left" ><font size="2" ><?=$dldgr_nm;?></font></td>
<td align="left" ><font size="2" ><?=$mtd;?></font></td>
<td align="left" ><font size="2" ><?=$ref;?></font></td>
<td align="left" ><font size="2" ><?=$nrtn;?></font></td>
<td align="right" ><font size="2" ><?=round($damm,2);?></font></td>
<td align="right"><font size="2" ><?=round($camm,2);?></font></td>
<td align="right" title="<?=$dsl;?>" ><font size="2" ><span style="color:<? if($nbal<0){echo "#0034ff";}else{echo "#FF0000";}?>;font-family:Arial;font-size:15px;"><? echo $nbalf;?></span></font></td>
</tr>
<?$pcs1=$pcs+$pcs1;
if($cldgr!=-1 and $dldgr!=-1)
{
$tdebt=$tdebt+$damm;
$tcredt=$tcredt+$camm;
}
}
?>




</table>
</div>