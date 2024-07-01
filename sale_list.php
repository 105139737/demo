<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
include("function.php");
$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$pr_nm=$_REQUEST['prnm'];
$tp1=$_REQUEST['tp1'];
$gst_no=$_REQUEST['gstin'];
$godown=$_REQUEST['godown'];
$stat=$_REQUEST['stat'];
$brncd=$_REQUEST['brncd'];
$cat=$_REQUEST['cat'];
$scat=$_REQUEST['scat'];
$sale_per=$_REQUEST['sale_per'];
$delv=$_REQUEST['delv'];
$refsl=$_REQUEST['refsl'];
$ddt=$_REQUEST['ddt'];
$einv_stat=$_REQUEST['einv_stat'];
$custType=$_REQUEST['custType'];
$blno=$_REQUEST['blno'];
$diff=dates_diff($fdt,$tdt);
$cust_array=[0,831,833,841,18774,33243,33818,37578,828,835,842,844,847,898,26442,33244,33245,33246,33817,33819,33820,37039,37192,37579,37729,40287,41358,43605,44750];

if($salereport-1<$diff && $blno=='' && ($snm=='' or array_search($snm,$cust_array))){
?>
<script language="javascript">
alert("You have to excel export if you want to see data of more than "+<?php echo $salereport; ?>+" day");
</script>
<?php
die('<b><center><font color="green" size="5">You have to excel export if you want to see data of more than '.$salereport.' day </font></center></b>');

}

if($blno!=""){$blno_scarch=" and blno like '%$blno%'";}else{$blno_scarch="";}
if($sale_per==""){$sale_per1="";}else{$sale_per1=" and sale_per='$sale_per'";}
if($delv==""){$delv1="";}else{$delv1=" and dstat='$delv'";}
if($scat==""){$scat1="";}else{$scat1=" and scat='$scat'";}
if($cat==""){$cat1="";}else{$cat1=" and cat='$cat'";}
if($einv_stat==""){$einv_stat1="";}else{$einv_stat1=" and einv_stat='$einv_stat'";}

if($einv_stat=="Null"){$einv_stat1=" and einv_stat is null";}

if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($godown==""){$godown1="";}else{$godown1=" and bcd='$godown'";}
if($gst_no=="1"){$gst_no1=" and gstin!=''";}if($gst_no=="2"){$gst_no1=" and gstin=''";}
if($snm!=""){$snm1=" and ".$custType."='$snm'";}else{$snm1="";}
if($pr_nm!=""){$pr_nm1=" and sl='$pr_nm'";}else{$pr_nm1="";}
if($tp1!=""){$tp11=" and cust_typ='$tp1'";}else{$tp11="";}
if($stat!=""){$cstat1=" and cstat='$stat'";}else{$cstat1="";}
if($refsl!=""){$refsl1=" and refsl='$refsl'";}else{$refsl1="";}

$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));
if($fdt!="" and $tdt!=""){$todts=" and dt between '$fdt' and '$tdt'";}else{$todts="";}



	$mdays=0;
	$get_days= mysqli_query($conn,"select * from main_edit_days where sl>0")or die(mysqli_error($conn));
	while ($get_days_row = mysqli_fetch_array($get_days))
	{
		$mdays=$get_days_row['days'];
	}


$bqr="";
 $dd = "SELECT sl FROM main_product WHERE  sl>0 $cat1 $scat1 $pr_nm1";
$ddc = mysqli_query($conn,$dd) or die (mysqli_error($conn) );
while($DX=mysqli_fetch_array($ddc))
{
$prod_sl=$DX['sl'];	
if($bqr=="")
{
$bqr.=" and ( prsl='$prod_sl'";
}
else
{
$bqr.=" or prsl='$prod_sl'";
}
}
$bqr.=")";
//echo $bqr;
$dis1=0;

?>

 <table  width="100%" class="advancedtable"  >
<tr bgcolor="000">
<td colspan="27"><font size="5" color="#fff">Sale Details</font></td>
</tr>		
			<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>Edit</b></td>
			<td  align="center" ><b>Return</b></td>
			<td  align="center" ><b>Delivered</b></td>
			<td  align="center"><b>Status</b></td>
			<td  align="center"><b>Date</b></td>
			<td  align="center" ><b>Invoice</b></td>
			<td  align="center" ><b>Customer Name</b></td>
			<td  align="center" ><b>Mobile</b></td>
			<td  align="center" ><b>Type</b></td>
			<td  align="center" ><b>GSTIN</b></td>
			<td  align="center" ><b>Product Name</b></td>
			<td  align="center" ><b>HSN</b></td>
			<td  align="center" ><b>Serial No.</b></td>
			<td  align="center" ><b>Quantity</b></td>
			<td  align="center" ><b>S.Rate</b></td>
			<td  align="center" ><b>Total</b></td>
			<td  align="center" ><b>Disc.%</b></td>
			<td  align="center" ><b>Disc.Am</b></td>
			<td  align="center" ><b>Taxable Amt.</b></td>
			<td  align="center" ><b>CGST%</b></td>
			<td  align="center" ><b>CGST </b></td>
			<td  align="center" ><b>SGST%</b></td>
			<td  align="center" ><b>SGST </b></td>
			<td  align="center" ><b>IGST%</b></td>
			<td  align="center" ><b>IGST </b></td>
			<td  align="center" ><b>Rate(After GST)</b></td>
			<td  align="center" ><b>Dis am.</b></td>
			<td  align="center" ><b>TCS</b></td>
			<td  align="center" ><b>Net Payable</b></td>
			</tr>
			 <?
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
$wgamm1=0;
$igst1=0;
$cgst1=0;
$sgst1=0;
$ttpcs=0;

$data1= mysqli_query($conn,"select * from  main_billing where sl>0".$blno_scarch.$einv_stat1.$todts.$snm1.$brncd1.$gst_no1.$tp11.$cstat1.$sale_per1.$delv1.$refsl1." order by dt,sl")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$blno_sl=$row1['sl'];
$blno=$row1['blno'];
$dt=$row1['dt'];
$edt1=$row1['edt'];
$vat=$row1['vat'];
$vatamm=$row1['vatamm'];
$car=$row1['car'];
$sid=$row1['cid'];
$invto=$row1['invto'];
$pdts=$row1['pdts'];
$dis=$row1['dis'];
$paid=$row1['paid'];
$gstin=$row1['gstin'];
$cust_typ=$row1['cust_typ'];
$cstat=$row1['cstat'];
$dstat=$row1['dstat'];
$vno=$row1['vno'];
$odamm=$row1['damm'];
$tcs=$row1['tcsam'];
$pay_dt=$row1['dt'];
$AckNo=$row1['AckNo'];
$ship=$row1['ship'];
$colorStatus=$row1['colorStatus'];
$ship_addr=$row1['ship_addr'];
$ship_mob=$row1['ship_mob'];
$backg="";
if($colorStatus==1){$backg="#ffff00";}
$last_edit_date = date('Y-m-d', strtotime($pay_dt. ' + '.$mdays.' days')); 

$edit_count=get_permission($dt,$bill_edt);

$cdt=date('Y-m-d');


$cust_typp=get_typ($cust_typ);
if($car==""){$car=0;}
if($dis==""){$dis=0;}
$dt=date('d-m-Y', strtotime($dt));
$sln++;
$qtyt=0;
$asd=0;
$tamm=0;
$tpoint=0;
$wgamm=0;

$datad= mysqli_query($conn,"select * from main_cust where sl='$sid'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad))
{
$nm=$rowd['nm'];
$mob1=$rowd['cont'];
$billing_addr=$rowd['addr'];
}
$invnm="";
$datad1= mysqli_query($conn,"select * from main_cust where sl='$invto'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad1))
{
$invnm="(".$rowd['nm'].")";
$mob1=$rowd['cont'];
$billing_addr=$rowd['addr'];
}
$cid_ship=$sid;
if($invto!="")
{
	$cid_ship=$invto;
}
$tslrt=0;
$igst=0;
$cgst=0;
$sgst=0;
$total_am=0;
$disa_am=0;
$tpcs=0;
$data= mysqli_query($conn,"select * from  main_billdtls where sl>0 and blno='$blno'".$bqr.$godown1)or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$cat=$row['cat'];
$scat=$row['scat'];	
$pcd=$row['prsl'];
$prc=$row['prc'];
$afgst=$row['rate'];
$blno1=$row['blno'];
$unit=$row['unit'];
$kg=$row['kg'];
$grm=$row['grm'];
$pcs=$row['pcs'];
$cgst_rt=$row['cgst_rt'];
$cgst_am=$row['cgst_am'];
$sgst_rt=$row['sgst_rt'];
$sgst_am=$row['sgst_am'];
$igst_rt=$row['igst_rt'];
$igst_am=$row['igst_am'];
$total=$row['total'];
/*
$ttl=$row['ttl'];
$net_am=round($row['net_am']);
*/
$disp=$row['disp'];
$disa=$row['disa'];
$betno=$row['betno'];





if($disp==0)
{
if($disa>0)
{
    $disp=round(($disa*100)/$total,2);
}
}



$igst=$igst+$igst_am;
$cgst=$cgst+$cgst_am;
$sgst=$sgst+$sgst_am;
$pgst=$cgst_am+$sgst_am+$igst_am;

$gst=$cgst_rt+$sgst_rt+$igst_rt;
$gst_rate=round($prc/($gst+100),4);
$rate=round($gst_rate*100,2);
$total=round($rate*$pcs,2);
$disa=round(($total*$disp)/100,2);
$ttl=round($total-$disa,2);

$net_am=round($ttl+$pgst,0);

$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$cat'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
	$sun=$roww['sun'];
	$mun=$roww['mun'];
	$bun=$roww['bun'];
	$smvlu=$roww['smvlu'];
	$mdvlu=$roww['mdvlu'];
	$bgvlu=$roww['bgvlu'];
}
if($unit=='sun'){$unit_nm=$sun;}
if($unit=='mun'){$unit_nm=$mun;}
if($unit=='bun'){$unit_nm=$bun;}


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
$hsn=$row1['hsn'];
}
$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
$hsn=$row['hsn'];
}


	if($blno==$blno1)
	{
		$asd++;
	}
	if($asd>1)
	{
		$backg="";
	}
		 ?>
		<tr   id="trid<?php echo $blno_sl;?>" style="background-color:<?php echo $backg;?>">
		<?if($asd==1){?>
		<td  align="center"  ><?=$sln;?></td>

		<?php if($cdt<=$last_edit_date){ ?>

		<td>
		<?php if($cstat!=1){ ?>
		<a href="#" onclick="edit('<?=$blno;?>')"><i class="fa fa-pencil-square-o"></i></a>
		<? }?>
		</td>

		<?php 
		}
		else 
		{
		?>
		<td></td>
		<?php
		} 
		?>

		<td>
			<?php if($cstat!=1){ ?>
		<a href="bill_typ_return.php?blno=<?=$blno;?>" target="_blank" title="Click Here To Return"><b><font color="red" size="3">Return</b></font></a>
		<? }?><br>
		<?php if($AckNo!=''){?><a onclick="window.open('eupload.php?blno=<?=$blno;?>&cid=<?=$cid_ship?>&ship=<?=$ship?>','_blank');document.getElementById('trid<?php echo $blno_sl;?>').style.backgroundColor='#FFFFFF';"><font color="#8000ff">EUploaded</font></a><?php }else{?>
		<a onclick="window.open('eupload.php?blno=<?=$blno;?>&cid=<?=$cid_ship?>&ship=<?=$ship?>','_blank');document.getElementById('trid<?php echo $blno_sl;?>').style.backgroundColor='#FFFFFF';">EUpload</a><?php }?>
		</td>
		<td>
		<?php if($dstat==0){ ?>
		<span id="delivered<?php echo $blno_sl;?>">
		<a style="cursor:pointer" onclick="delvr('<?php echo $blno;?>','<?php echo $blno_sl;?>')" title="Click For Delivery"><font color="#8000ff" size="3"><b>Undelivered</b></font></a>
		</span>
		<? } else{?>
		<font color="green" size="3"><b>Delivered</b></font>
		<? }?><br>
		<a onclick="window.open('einv_json.php?blno=<?=$blno;?>','_blank'); document.getElementById('trid<?php echo $blno_sl;?>').style.backgroundColor='#ffff00';">E-Export</a>
		</td>
		<?php 
		if($edit_count>0)
		{
		if($cstat==1){
		?>
		<td  align="center" ><a href="javascript:revert('<?=$blno;?>')"><font color="red"><b>Revert</b></font></a></td>
		<?
		}
		else
		{
		?>
		<td  align="center" ><a href="#" onclick="cancelc('<?php echo $blno;?>')" title="Click to Cancel"><font color="red" size="3"><i class="fa fa-times"></i>Cancel</font></a></td>
		<?}} 
		else
		{ ?>
		<td  align="center" ><?php if($cstat==1){ echo "Canceled";}else{ echo "OK";}?></td>
		<? }?>
		
		<td  align="center" ><a href="eway_bill_json.php?blno=<?php echo $blno;?>" target="_blank"><?=$dt;?></a></td>
		<td  align="center" data-toggle="tooltip" data-placement="top" title="<?php echo $billing_addr ? $billing_addr : "" ;?>">
			<a href="#" onclick="view('<?=$blno;?>')"  >
			<?=$blno;?></a></td>
		<td  align="left" ><a href="#" onclick="view1('<?=$blno;?>')" title="Print"><?=$nm;?> <b><?=$invnm;?></b></a><br>
		<input type="text" id="vno" name="vno" value="<?php echo $vno;?>" placeholder="Vehicle Number" onblur="update_vno(this.value,'<?php echo $blno_sl;?>')">
		</td>
		<td  align="left" ><?=$mob1;?>

		<br><font size="2"> <b><a href="coupon_print.php?blno=<?=rawurlencode($blno);?>&typ=1" target="_blank"><font color="red"><u>Coupon Print</u></font></a></b></font>

		</td>
		<td  align="center" ><?php echo $cust_typp;?></td>
		<td  align="center" ><?=$gstin;?></td>
		<?}
		else
		{
		?>
		<td  align="center"  ></td>
		<td  align="center" ></td>
		<td  align="center" ></td>
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		
<?
}
?>

			<td  align="left" title="<?=$pcd;?>" ><a <? /*onclick="document.location='swip_bno.php?b1=<?=$blno;?>&b2=<?=$blno;?>'"*/ ?>><?=$pnm;?></a></td>
			<td  align="center" ><?=$hsn;?></td>
			<td  align="center" ><?=$betno;?></td>
			<td  align="center" ><?=$pcs;?> <?=$unit_nm?></td>
			<td  align="right" ><?=number_format($rate,2);?></td>
			<td  align="right" ><?=number_format($total,2);?></td>
			<td  align="center" ><?=$disp;?></td>
			<td  align="right" ><?=number_format($disa,2);?></td>
			<td  align="right" ><?=number_format($ttl,2);?></td>
			<td  align="center" ><?=$cgst_rt;?></td>
			<td  align="center" ><?=number_format($cgst_am,2);?></td>
			<td  align="center" ><?=$sgst_rt;?></td>
			<td  align="center" ><?=number_format($sgst_am,2);?></td>
			<td  align="center" ><?=$igst_rt;?></td>
			<td  align="center" ><?=number_format($igst_am,2);?></td>
			<td  align="center" ><?=number_format($afgst,2);?></td>
			<td  align="left" ></td> 
			<td  align="left" ></td> 
			<td  align="right" ><?=number_format($net_am,2);?></td>
			</tr>	 

	<?


$tamm=$ttl+$tamm;
$wgamm=$net_am+$wgamm;
$total_am+=$total;
$disa_am+=$disa;
$tpcs+=$pcs;
}
	if($total_am>0)
	{
	$wgamm=($wgamm+$tcs)-$odamm;
	?>
	<tr bgcolor="#e8ecf6">
	<td colspan="14" align="right"><b>Total </b></td>

	<td align="center"><b></td>
	<td></td>
	<td  align="right" ><b><?=number_format($total_am,2);?></b></td>
	<td  align="right" ><b></b></td>
	<td  align="right" ><b><?=number_format($disa_am,2);?></b></td>
	<td  align="right" ><b><?=number_format($tamm,2);?></b></td>
	<td align="right" colspan="2"><b><?=number_format($cgst,2);?></b></td>
	<td align="right" colspan="2"><b><?=number_format($sgst,2);?></b></td>
	<td align="right" colspan="2"><b><?=number_format($igst,2);?></b></td>
	<td  align="right" ><b></b></td>
	<td  align="right" ><font color="red"><?echo $odamm; ?></font></td> 
	<td  align="right" ><font color="red"><?echo $tcs; ?></font></td> 
	<td  align="right" ><b><?=number_format($wgamm,2);?></b></td>
	
	</tr>
	<?


		}
		$dis1=$dis+$dis1;
		$tamm1=$tamm+$tamm1;
		$car1=$car1+$car;
		$paid1=$paid1+$paid;
		$wgamm1=$wgamm1+$wgamm;
		
		$igst1=$igst+$igst1;
		$cgst1=$cgst+$cgst1;
		$sgst1=$sgst+$sgst1;
		$ttpcs=$ttpcs+$tpcs;
		$odamm1+=$odamm;
		$tcs1+=$tcs;
		}?>
		<tr>
	<td colspan="14" align="right"><b>Total</b></td>
	
	<td align="center"><b><?php echo $ttpcs;?></b></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td align="right"><b><?=sprintf('%0.2f',$tamm1);?></b></td>
	<td align="right" colspan="2"><b><?=number_format($cgst1,2);?></b></td>
	<td align="right" colspan="2"><b><?=number_format($sgst1,2);?></b></td>
	<td align="right" colspan="2"><b><?=number_format($igst1,2);?></b></td>
	<td  align="right" ><b></b></td>
	<td  align="right" ><b><?=number_format($odamm1,2);?></b></td>
	<td  align="right" ><b><?=number_format($tcs1,2);?></b></td>
	<td align="right"><b><?=number_format($wgamm1,2);?></b></td>
</tr>
</table>

