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
$xls=$_REQUEST['xls'];


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
if($xls=='1')
{
	$jobLink=CreateNewJob('jobs/sale_list_profit.php',$user_currently_loged,'Profit on sale',$conn);
    ?>
    <script language="javascript">
    alert('Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...');
    window.history.go(-1);
    </script>
    <?php 
    die('<b><center><font color="green" size="5">Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...</font></center></b>');
   
	$file=date('Ymdhis').".xls";
	header("Content-type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$file");	
}
if($xls=='1')
{
?>
 <table  border="1" >
 <?php  }
 else
 {
 ?>
 <table  width="100%" class="advancedtable"  >
 <?php  }?>
<tr bgcolor="000">
<td colspan="27"><font size="5" color="#fff">Sale Details</font></td>
</tr>		
			<tr bgcolor="#e8ecf6">
			<td  align="center" ><b>Sl</b></td>
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

			<td  align="center" ><b>Net Amount</b></td>
			<td  align="center" ><b>Purchase Rate</b></td>
			<td  align="center" ><b>Total </b></td>
			<td  align="center" ><b>Profit</b></td>
			<td  align="center" ><b>Profit %</b></td>

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
$dstat=$row1['dstat'];
$vno=$row1['vno'];
$pyamm=$row1['payam'];
$odamm=$row1['damm'];
$tcs=$row1['tcsam'];
$pay_dt=$row1['dt'];
$last_edit_date = date('Y-m-d', strtotime($pay_dt. ' + '.$mdays.' days')); 

$edit_count=get_permission($dt,$bill_edt);

$cdt=date('Y-m-d');

$dammprc=$odamm/$pyamm;

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
$net_am=round($row['net_am']);
/*
$ttl=$row['ttl'];
$net_am=round($row['net_am']);
*/
$disp=$row['disp'];
$disa=$row['disa'];
$betno=$row['betno'];


$net_am=$net_am-($dammprc*$net_am);


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

//$net_am=round($ttl+$pgst,0);

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
$close_rt=0;
$ppdt=date('Y-m-d', strtotime($dt));
$query4="Select * from main_purchasedet where prsl='$pcd' and  dt<='$ppdt' order by sl desc limit 1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$close_rt=round($R4['rate'],2);
}

if($close_rt<.000001)
{
$query4="Select rate as stck1 from main_stock where pcd='$pcd' and main_stock.nrtn='Opening' and rate>0 limit 1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$close_rt=round($R4['stck1'],2);
}
}
if($close_rt>0)
{
$total=$pcs*$close_rt;

$profit=$net_am-$total;
$profitp=round((($profit/$total)*100)/$pcs,2);
}
	if($blno==$blno1)
	{
		$asd++;
	}
		 ?>
		<tr title="<?php  echo $pcd." S Sl".$sl;?>">
			<td  align="center"  ><?php  echo $sln;?></td>
		<td  align="center" ><?php  echo $dt;?></td>
		<td  align="center" ><a href="#" onclick="view('<?php  echo $blno;?>')" title="Print"><?php  echo $blno;?></a></td>
		<td  align="left" ><a href="#" onclick="view1('<?php  echo $blno;?>')" title="Print"><?php  echo $nm;?> <b><?php  echo $invnm;?></b></a><br>
		</td>
		<td  align="left" ><?php  echo $mob1;?>
		</td>
		<td  align="center" ><?php  echo $cust_typp;?></td>
		<td  align="center" ><?php  echo $gstin;?></td>
			<td  align="left" title="<?php  echo $pcd;?>" ><?php  echo $pnm;?></td>
			<td  align="center" ><?php  echo $hsn;?></td>
			<td  align="center" ><?php  echo $betno;?></td>
			<td  align="center" ><?php  echo $pcs;?> <?php  echo $unit_nm?></td>
			<td  align="right" ><?php echo number_format($net_am,2);?></td>


			<td  align="right" ><?php echo number_format($close_rt,2);?></td>
			<td  align="right" ><?php echo number_format($total,2);?></td>

			<td  align="right" ><?php echo number_format($profit,2);?></td>
			<td  align="right" ><?php echo number_format($profitp,2);?></td>

			
			</tr>	 

	<?php 

$tnet_am+=$net_am;
$ttotal+=$total;
$tprofit+=$profit;
$tprofitp+=$profitp;

}

?>

<?php 
}

		?>
<tr>
<td colspan="11"  align="right"><b>Total :</b></td>
<td  align="right" ><?php echo number_format($tnet_am,2);?></td>


			<td  align="right" ></td>
			<td  align="right" ><?php echo number_format($ttotal,2);?></td>

			<td  align="right" ><?php echo number_format($tprofit,2);?></td>
			<td  align="right" ></td>
</tr>
</table>

