<?php  
$reqlevel = 3; 
include("membersonly.inc.php");
include("function.php");
$odamm1=0;
$gst_no1="";
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
 $sl=0;
$diff=dates_diff($fdt,$tdt);
if($salereport-1<$diff){
?>
<script language="javascript">
alert("You have to excel export if you want to see data of more than "+<?php  echo $salereport; ?>+" day");
</script>
<?php 
die('<b><center><font color="green" size="5">You have to excel export if you want to see data of more than '.$salereport.' day </font></center></b>');

}

if($sale_per==""){$sale_per1="";}else{$sale_per1=" and sale_per='$sale_per'";}
if($delv==""){$delv1="";}else{$delv1=" and dstat='$delv'";}
if($scat==""){$scat1="";}else{$scat1=" and scat='$scat'";}
if($cat==""){$cat1="";}else{$cat1=" and cat='$cat'";}

if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($godown==""){$godown1="";}else{$godown1=" and bcd='$godown'";}
if($gst_no=="1"){$gst_no1=" and gstin!=''";}if($gst_no=="2"){$gst_no1=" and gstin=''";}
if($snm!=""){$snm1=" and cid='$snm'";}else{$snm1="";}
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
set_time_limit(0);
?>

 <table  width="100%" class="advancedtable"  >
<tr bgcolor="000">
<td colspan="27"><font size="5" color="#fff">Sale Details</font></td>
</tr>		
			<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Sl</b></td>
			<td  align="center" ><b>Sl No. Status</b></td>
			<td  align="center" ><b>Bill Status</b></td>
			<td  align="center" ><b>Upload</b></td>
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
			<td  align="center" ><b>Net Payable</b></td>
			</tr>
			 <?php 
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

$data1= mysqli_query($conn,"select * from  main_billing where sl>0".$todts.$snm1.$brncd1.$gst_no1.$tp11.$cstat1.$sale_per1.$delv1.$refsl1." order by dt,sl")or die(mysqli_error($conn));
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
$dstat=$row1['bfl'];
$vno=$row1['vno'];
$odamm=$row1['damm'];
$dono=$row1['sfno'];
$bfl_upload=$row1['bfl_upload'];
$bfl_bst=$row1['bfl_bst'];
$pay_dt=$row1['dt'];
$last_edit_date = date('Y-m-d', strtotime($pay_dt. ' + '.$mdays.' days')); 


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
$isfin=$rowd['isfin'];
}
$invnm="";
$datad1= mysqli_query($conn,"select * from main_cust where sl='$invto'")or die(mysqli_error($conn));
while ($rowd = mysqli_fetch_array($datad1))
{
$invnm="(".$rowd['nm'].")";
$mob1=$rowd['cont'];
}
$tslrt=0;
$igst=0;
$cgst=0;
$sgst=0;
$total_am=0;
$disa_am=0;
$tpcs=0;

$data_recv= mysqli_query($conn,"select * from  main_billdtls where sl>0 and blno='$blno' and betno=''")or die(mysqli_error($conn));
$sl_count=mysqli_num_rows($data_recv);

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
		 ?>
		<tr title="<?php  echo $pcd." S Sl".$sl;?>">
		<?php if($asd==1){?>
		<td  align="center"><?php  echo $sln;?>
	<br>
	<a href="#" onclick="edit('<?php  echo $blno;?>')"><i class="fa fa-pencil-square-o"></i></a>
	
	</td>

	<td align="center">
		<?php 
		if($sl_count==0){
		if($dstat==0){ ?>
		<a  onclick="delvr('<?php  echo $blno;?>')" title="Click For OK" class="btn btn-success btn-xs"><b>Pending</b></a>
		<?php  } else{?>
		<font color="green" size="3"><b>OK</b></font>
		<?php  }}else{?><font color="red" size="3"><b>Plz Check Sl. No.</b></font><?php }
		
		?>
		</td>
		<td align="center">
		<?php 
		if($sl_count==0 and $dstat==1){
		if($bfl_bst==0){ ?>
		<a  onclick="bfl_bst('<?php  echo $blno;?>')" title="Click For Verified" class="btn btn-success btn-xs"><b>Verify</b></a>
		<?php  } else{?>
		<font color="green" size="3"><b>Verified</b></font>
		<?php  }}else{?><font color="red" size="3"><b>Plz Check Sl. No. Status</b></font><?php }?>
		</td>
		<td  align="center" >
		    <?php 
			//and $user_current_level<0
			if($dono!='' and ($sid=='828' or $sid=='835' or $sid=='842' or $sid=='33244' or $sid=='33817' or $sid=='37579') and $bfl_upload=='0' and $bfl_bst=='1') {?>
		    <a  onclick="upload_bfl('<?php  echo $blno;?>')" title="Click For Upload" class="btn btn-info btn-xs"><b>Upload</b></a>
		    <?php  }
		    if($dono==''){echo "<font color='red'>Ref / SF No. Not Available</font>";}
		    if($bfl_bst=='0'){echo "<font color='red'>Plz Check Bill Status</font>";}
		    if($bfl_upload=='1'){echo "<font color='green'><b>Upload Done</b></font>";}
		    ?>
		    </td>
		<td  align="center" ><?php  echo $dt;?></td>
		<td  align="center" ><a href="#" onclick="view('<?php  echo $blno;?>')" title="Print"><?php  echo $blno;?></a></td>
		<td  align="left" ><a href="#" onclick="view1('<?php  echo $blno;?>')" title="Print"><?php  echo $nm;?> <b><?php  echo $invnm;?></b></a><br>
		
		</td>
		<td  align="left" ><?php  echo $mob1;?></td>
		<td  align="center" ><?php  echo $cust_typp;?></td>
		<td  align="center" ><?php  echo $gstin;?></td>
		<?php }
		else
		{
		?>
        <td  align="left" ></td> 
        <td  align="left" ></td> 
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		<td  align="left" ></td> 
		
<?php 
}
?>

			<td  align="left" title="<?php  echo $pcd;?>" ><a <?php  /*onclick="document.location='swip_bno.php?b1=<?php  echo $blno;?>&b2=<?php  echo $blno;?>'"*/ ?>><?php  echo $pnm;?></a></td>
			<td  align="center" ><?php  echo $hsn;?></td>
			<td  align="center" ><?php  echo $betno;?></td>
			<td  align="center" ><?php  echo $pcs;?> <?php  echo $unit_nm?></td>
			<td  align="right" ><?php echo number_format($rate,2);?></td>
			<td  align="right" ><?php echo number_format($total,2);?></td>
			<td  align="center" ><?php  echo $disp;?></td>
			<td  align="right" ><?php echo number_format($disa,2);?></td>
			<td  align="right" ><?php echo number_format($ttl,2);?></td>
			<td  align="center" ><?php  echo $cgst_rt;?></td>
			<td  align="center" ><?php echo number_format($cgst_am,2);?></td>
			<td  align="center" ><?php  echo $sgst_rt;?></td>
			<td  align="center" ><?php echo number_format($sgst_am,2);?></td>
			<td  align="center" ><?php  echo $igst_rt;?></td>
			<td  align="center" ><?php echo number_format($igst_am,2);?></td>
			<td  align="center" ><?php echo number_format($afgst,2);?></td>
			<td  align="left" ></td> 
			<td  align="right" ><?php echo number_format($net_am,2);?></td>
			</tr>	 

	<?php 


$tamm=$ttl+$tamm;
$wgamm=$net_am+$wgamm;
$total_am+=$total;
$disa_am+=$disa;
$tpcs+=$pcs;
}
	if($total_am>0)
	{
	$wgamm=$wgamm-$odamm;
	?>
	<tr bgcolor="#e8ecf6">
	<td colspan="13" align="right"><b>Total </b></td>

	<td align="center"><b></td>
	<td></td>
	<td  align="right" ><b><?php echo number_format($total_am,2);?></b></td>
	<td  align="right" ><b></b></td>
	<td  align="right" ><b><?php echo number_format($disa_am,2);?></b></td>
	<td  align="right" ><b><?php echo number_format($tamm,2);?></b></td>
	<td align="right" colspan="2"><b><?php echo number_format($cgst,2);?></b></td>
	<td align="right" colspan="2"><b><?php echo number_format($sgst,2);?></b></td>
	<td align="right" colspan="2"><b><?php echo number_format($igst,2);?></b></td>
	<td  align="right" ><b></b></td>
	<td  align="right" ><font color="red"><?php echo $odamm; ?></font></td> 
	<td  align="right" ><b><?php echo number_format($wgamm,2);?></b></td>
	
	</tr>
	<?php 


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
		}?>
		<tr>
	<td colspan="13" align="right"><b>Total</b></td>
	
	<td align="center"><b><?php  echo $ttpcs;?></b></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td align="right"><b><?php echo sprintf('%0.2f',$tamm1);?></b></td>
	<td align="right" colspan="2"><b><?php echo number_format($cgst1,2);?></b></td>
	<td align="right" colspan="2"><b><?php echo number_format($sgst1,2);?></b></td>
	<td align="right" colspan="2"><b><?php echo number_format($igst1,2);?></b></td>
	<td  align="right" ><b></b></td>
	<td  align="right" ><b><?php echo number_format($odamm1,2);?></b></td>
	<td align="right"><b><?php echo number_format($wgamm1,2);?></b></td>
</tr>
</table>

