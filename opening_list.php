<?php 
$reqlevel = 3; 
include("membersonly.inc.php");
include "function.php";
$tqty=0;

$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$brncd=$_REQUEST['brncd'];
$catsl=$_REQUEST['cat'];
$scatsl=$_REQUEST['scat'];
$prnm=$_REQUEST['prnm'];
$godown=$_REQUEST['godown'];
$vstat=$_REQUEST['vstat'];
$ptyp=$_REQUEST['ptyp'];
$blno=$_REQUEST['blno'];
$stk_dt=$_REQUEST['stk_dt'];

$stk_dt=date('Y-m-d',strtotime($stk_dt));
if($blno==""){$blno1="";}else{$blno1=" and blno='$blno'";}
if($vstat==""){$vstat1="";}else{$vstat1=" and vstat='$vstat'";}
if($ptyp==""){$ptyp1="";}else{$ptyp1=" and app='$ptyp'";}

if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
if($catsl==""){$catsl1="";}else{$catsl1=" and cat='$catsl'";}
if($scatsl==""){$scatsl1="";}else{$scatsl1=" and scat='$scatsl'";}
if($prnm==""){$prnm1="";}else{$prnm1=" and sl='$prnm'";}
if($godown==""){$godown1="";}else{$godown1=" and bcd='$godown'";}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
if($snm!=""){$snm1=" and sid='$snm'";}else{$snm1="";}

if($blno=='')
{
$bqr="";
 $dd = "SELECT sl FROM main_product WHERE  sl>0 $catsl1 $scatsl1 $prnm1";
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
}
//echo $bqr;

?>
<table  class="advancedtable" width="100%" >
	<tr bgcolor="#e8ecf6">
	<td  align="center" ><b>Action</b></td>
	<td  align="center" ><b>Sl</b></td>
	<td  align="center" ><b>Date</b></td>
	<td  align="center" ><b>Invoice</b></td>
	<td  align="center" ><b>Godown</b></td>
	<td  align="center" ><b>GSTIN</b></td>
	<td  align="center" ><b>Model Name</b></td>
	<td  align="center" ><b>HSN</b></td>
	<td  align="center" ><b>Serial No.</b></td>
	<td  align="center" ><b>Action</b></td>
	<td  align="center" ><b>Quantity</b></td>
	<td  align="center" ><b>Unit</b></td>
	<td  align="center" ><b>Rate</b></td>
	</tr>
	<?php 
	$sln=0;
	$tota1=0;
	$fttl1=0;
	$wgamm1=0;
$log=0;
$ttcgst_am=0;
$ttsgst_am=0;
$ttigst_am=0;
$ttgst=0;
$amm1=0;
$Ttamm2=0;
$ADls=0;
	$dis11=0;
	$ldisa11=0;
if($user_current_level<0)
{
$data1= mysqli_query($conn,"select * from main_opening where sl>0".$todt.$snm1.$brncd1.$ptyp1.$vstat1.$blno1." order by dt,sl")or die(mysqli_error($conn));
}
else
{
$data1= mysqli_query($conn,"select * from main_opening where sl>0 ".$todt.$snm1.$brncd1.$ptyp1.$vstat1.$blno1." order by dt,sl")or die(mysqli_error($conn));
}
while ($row1 = mysqli_fetch_array($data1))
{
$asd=0;
$log=1;
$tota=0;
$wgamm=0;
$pptotal=0;
$prctotal=0;
$ppt1=0;
$amm1=0;
$dis1=0;
$ldisa1=0;
$ttqty=0;
$blno=$row1['blno'];
$edt=$row1['dt'];
$dt=$row1['dt'];
$pbill=$row1['inv'];
$sid=$row1['sid'];
$lfr=$row1['lfr'];
$lcd=$row1['lcd'];
$vatamm=$row1['vatamm'];
$sdis=$row1['sdis'];
$tamm=$row1['tamm'];
$roff=$row1['roff'];
$remk=$row1['remk'];
$adl=$row1['adl'];
$adlv=$row1['adlv'];
$tamm2=$row1['tamm'];
$addr_gst=$row1['addr'];

$edt=date('d-m-Y', strtotime($edt));
$sln++;
$spn="";
$nm="";
$mob1="";
$addr="";




$tcgst_am=0;
$tsgst_am=0;
$tigst_am=0;
$tgst=0;
$data= mysqli_query($conn,"select * from  main_openingdtl where sl>0 and blno='$blno'  $bqr $godown1 order by prsl,betno")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$cat=$row['cat'];
$dtl_sl=$row['sl'];
$scat=$row['scat'];	
$pcd=$row['prsl'];
$qty=$row['qty'];
$prc=$row['prc'];
$ttl=$row['ttl'];
$total=$row['total'];
$mrp=$row['mrp'];
$blno1=$row['blno'];
$pck=$row['pck'];
$unit=$row['unit'];
$amm=$row['amm'];

$disp=$row['disp'];
$dis=$row['disa'];
$ldis=$row['ldis'];
$ldisa=$row['ldisa'];


$cgst_rt=$row['cgst_rt'];
$cgst_am=$row['cgst_am'];
$sgst_rt=$row['sgst_rt'];
$sgst_am=$row['sgst_am'];
$igst_rt=$row['igst_rt'];
$igst_am=$row['igst_am'];
$net_am=$row['net_am'];
$betno=$row['betno'];
$rate=$row['rate'];
$bcdd=$row['bcd'];
$rqty=$row['rqty'];
$color="";
$query6="select * from main_openingdtl where prsl='$pcd' and bcd='$bcdd' and betno='$betno' and blno='$blno1'";
$result5=mysqli_query($conn,$query6);
$dup=mysqli_num_rows($result5);
if($dup>1)
{
$color="#ffb3b3";
}
$query6="select * from main_openingdtl where prsl='$pcd' and bcd='$bcdd' and betno='$betno' and dt>='$fdt'";
$result5=mysqli_query($conn,$query6);
$dup=mysqli_num_rows($result5);
if($dup>1)
{
$color="#ccffff";
}
$gnm="";
$query="Select * from main_godown where sl='$bcdd'";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$gnm=$R['gnm'];
}

if($net_am<=0)
{
$net_am=$ttl;	
}

$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$pcd'") or die(mysqli_error($conn));
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



$pnm="";
$query6="select * from  ".$DBprefix."product where sl='$pcd'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$pnm=$row['pnm'];
$hsn=$row['hsn'];
$product_code=$row['pcd'];
$cat=$row['cat'];
$scat=$row['scat'];
}
$get=mysqli_query($conn,"update main_openingdtl set cat='$cat',scat='$scat'  where sl='$dtl_sl'") or die(mysqli_error($conn));

$stk_qty=0;
if($rqty>0 and $stk_dt>2018-01-01)
{
	
	$query4="Select sum(opst+stin-stout) as stck1 from main_stock where pcd='$pcd' and bcd='$bcdd'  and dt<='$stk_dt'";
   $result4 = mysqli_query($conn,$query4);
   while ($R4 = mysqli_fetch_array ($result4))
   {
   $stk_qty=$R4['stck1'];
   }	
}

if($blno1==$blno)	
{
	$asd++;
}	




	?>
	<tr bgcolor="<?php  echo $color;?>" title="<?php  echo $pcd;?>">
	<?php 
	if($log==1)
	{
	?>
	<td  align="center"  ><!--<a href="#" onclick="edit('<?php //=$blno;?>')"><i class="fa fa-pencil-square-o"></i></a>-->
	<a href="#" onclick="if(confirm('Are you sure to delete....')){dlt('<?php  echo $blno;?>')}"><i class="fa fa-trash-o" style="color:red;"></i></a>
	</td>
	<td  align="center" ><?php  echo $sln;?></td>
	<td  align="center" ><?php  echo $edt;?></td>
	<td  align="center" ><?php  echo $blno;?></td>
	<td  align="left" ><font color="red"><b><?php  echo $gnm;?></b></font></td>
	<td  align="center" ><?php  echo $gstinn;?></td>
	<?php 
	}
	else
	{
	?>
	<td  align="center" ></td>
	<td  align="center" ></td>
	<td  align="center" ></td>
	<td  align="center" ></td>
	<td  align="left" ><font color="red"><b><?php  echo $gnm;?></b></font></td>
	<td  align="center" ></td>
	<?php 				
	}
	?>
	<td  align="left" ><b><?php  echo $product_code;?> ---- <?php  echo $pnm;?> --- <font color="red">Current Stock :  <?php  echo $stk_qty;?></font></b></td>
	<td  align="center" ><?php  echo $hsn;?></td>
	<td  align="center" ><?php  echo $betno;?></td>
	<td  align="center" ><a onclick="del_dtl('<?php  echo $dtl_sl?>')"><font color="blue"><b>Delete</b></font></a></td>
	<td  align="center" ><?php  echo $qty;?></td>
	<td  align="left" ><?php  echo $unit_nm;?></td>

	<td  align="right" ><?php echo round($rate,2);?></td>
	
	</tr>	 
			 
<?php 
$tota=$total+$tota;
$ttqty+=$qty;
$wgamm=$net_am+$wgamm;
$fttl=$wgamm;
$tcgst_am+=$cgst_am;
$tsgst_am+=$sgst_am;
$tigst_am+=$igst_am;
$tgst+=$cgst_am+$sgst_am+$igst_am;
$dis1=$dis+$dis1;
$ldisa1=$ldisa+$ldisa1;
$amm1=$amm+$amm1;
$tqty+=$qty;
$log=0;
}
if($ttqty>0)
{
$tota1=$tota1+$tota;
$fttl1=$fttl1+$fttl;
$wgamm1=$wgamm1+$wgamm;
$ttcgst_am+=$tcgst_am;
$ttsgst_am+=$tsgst_am;
$ttigst_am+=$tigst_am;
$ttgst+=$tcgst_am+$tsgst_am+$tigst_am;	
$dis11=$dis11+$dis1;
$dis111=$dis111+$ldisa1;
	$amm2=$amm1+$amm2;
	$wgamm=$wgamm+$roff;
	if($tamm2>0)
	{
		
	}
	else
	{
		$tamm2=$wgamm;
	}
	
	if($adl=="+")
	{
		$with_adl_tamm2=$tamm2+$adlv;
	}
	if($adl=="-")
	{
		$with_adl_tamm2=$tamm2-$adlv;
	}
	if($adl=="")
	{
		$with_adl_tamm2=$tamm2;
	}
	
	
?>
	<tr bgcolor="#e8ecf6">
	<td colspan="10" align="right"><b>Total :</b></td>

	<td  align="center" ></td>
	<td  align="center" ></td>
	<td  align="center" ></td>
	</tr>
<?php 
$Ttamm2+=$with_adl_tamm2;
$ADls+=$adl.$adlv;

}
}?>
<tr>
<td colspan="10" align="right"><b>Grand Total :</b></td>

<td align="center"><?php  echo $tqty;?></td>

<td  align="right" ><font color="red"><b></b></font></td>
<td  align="right" ><font color="red"><b></b></font></td>
</tr>
	  </table>
	  <input type="button" class="btn btn-success" value="Clear Stock" onclick="adj()">
<input type="button" class="btn btn-warning" value="New Stock In " onclick="stk_in()">