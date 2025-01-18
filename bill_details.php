<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";
$cid=$_REQUEST['cid'];
$dt=$_REQUEST['dt'];
$sa=date('d-m-Y');
$saa="01-".date('m-Y');
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;
color:red;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
<script>
function gpro()
{
	var cat= document.getElementById('cat').value;
	var bnm= document.getElementById('bnm').value;
	$('#gpro').load('get_pro.php?bnm='+bnm+'&cat='+cat).fadeIn('fast');
}
function show1()
{
location.reload();
}
function view(blno)
{

window.open('bill_new_gst.php?blno='+encodeURIComponent(blno), '_blank');
window.focus();
}

function cancelc(billno)
{
	
if(confirm("Are you sure to cancel !!"))
{
$('#can88').load('cancel_sale_invc.php?billno='+encodeURIComponent(billno)).fadeIn('fast');
}

}
function delvr(billno)
{
	
if(confirm("Are you sure to Deliver ??"))
{
$('#can99').load('deliver_sale_invc.php?billno='+encodeURIComponent(billno)).fadeIn('fast');
}

}

function edit(blno)
{
window.open('billing_edit.php?blno='+blno, '_blank');
window.focus();
}
/*function dlt(blno)
{
$('#data8').load('sale_dlt.php?blno='+blno).fadeIn('fast');
}*/


function get_scat(brnd)  
{
$("#catdiv").load("get_sub_cat.php?cat="+brnd).fadeIn('fast');
}
function get_igst()  
{
scat=document.getElementById('scat').value;
$("#igdiv").load("get_igst.php?scat="+scat).fadeIn('fast');
}
function get_hsn(scat)  
{
$("#hsndiv").load("get_hsn.php?scat="+scat).fadeIn('fast');
}
function revert(blno)
{
$('#can88').load('sale_revert.php?blno='+blno).fadeIn('fast');	
}
</script>
   <link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
</style>
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function()
{
var jQueryDatePicker2Opts =
{
dateFormat: 'dd-mm-yy',
changeMonth: true,
changeYear: true,
showButtonPanel: false,
showAnim: 'show'
};	

$("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

$("#fdt").datepicker(jQueryDatePicker2Opts);
$("#tdt").datepicker(jQueryDatePicker2Opts);
});
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>


	</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
               Sale Details
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Sale</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">			
<form method="post" action="sale_xls.php" name="form1"  id="form1">
<div class="box box-success" >

<div id="data8" style="overflow-x:auto;">
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

$data1= mysqli_query($conn,"select * from  main_billing where sl>0 and cid='$cid' and dt='$dt' order by dt,sl")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
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
}
$tslrt=0;
$igst=0;
$cgst=0;
$sgst=0;
$total_am=0;
$disa_am=0;
$tpcs=0;
$data= mysqli_query($conn,"select * from  main_billdtls where sl>0 and blno='$blno'")or die(mysqli_error($conn));
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
		<td  align="center"  ><?php  echo $sln;?></td>
		<td>
		<?php  if($cstat!=1){ ?>
		<a href="#" onclick="edit('<?php  echo $blno;?>')"><i class="fa fa-pencil-square-o"></i></a>
		<?php  }?>
		</td>
		<td>
			<?php  if($cstat!=1){ ?>
		<a href="bill_typ_return.php?blno=<?php  echo $blno;?>" title="Click Here To Return"><b><font color="red" size="3">Return</b></font></a>
		<?php  }?>
	
		</td>
		<td>
		<?php  if($dstat==0){ ?>
		<a href="#" onclick="delvr('<?php  echo $blno;?>')" title="Click For Delivery"><font color="#8000ff" size="3"><b>Undelivered</b></font></a>
		<?php  } else{?>
		<font color="green" size="3"><b>Delivered</b></font>
		<?php  }?>
		</td>
		<?php  
		if($user_current_level<0)
		{
		if($cstat==1){
		?>
		<td  align="center" ><a href="javascript:revert('<?php  echo $blno;?>')" target="_balnk"><font color="red"><b>Revert</b></font></a></td>
		<?php 
		}
		else
		{
		?>
		<td  align="center" ><a href="#" onclick="cancelc('<?php  echo $blno;?>')" title="Click to Cancel"><font color="red" size="3"><i class="fa fa-times"></i>Cancel</font></a></td>
		<?php }} 
		else
		{ ?>
		<td  align="center" ><?php  if($cstat==1){ echo "Canceled";}else{ echo "OK";}?></td>
		<?php  }?>
		
		<td  align="center" ><?php  echo $dt;?></td>
		<td  align="center" ><a href="#" onclick="view('<?php  echo $blno;?>')" title="Print"><?php  echo $blno;?></a></td>
		<td  align="left" ><?php  echo $nm;?> <b><?php  echo $invnm;?></b></td>
		<td  align="center" ><?php  echo $cust_typp;?></td>
		<td  align="center" ><?php  echo $gstin;?></td>
		<?php }
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
	<td align="right"><b><?php echo number_format($wgamm1,2);?></b></td>
</tr>
</table>

</div>
<div id="can88"></div>
<div id="can99"></div>
	 
                                </div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>

	
$('#pnm').chosen({no_results_text: "Oops, nothing found!",});
$('#snm').chosen({no_results_text: "Oops, nothing found!",});
$('#cat').chosen({no_results_text: "Oops, nothing found!",});
$('#bnm').chosen({no_results_text: "Oops, nothing found!",});
$('#prnm').chosen({no_results_text: "Oops, nothing found!",});
$('#sale_per').chosen({no_results_text: "Oops, nothing found!",});
$('#scat').chosen({no_results_text: "Oops, nothing found!",});
  
function getv()
{
var cat= document.getElementById('cat').value;
var bnm= document.getElementById('bnm').value;
$('#vv').load('get_v.php?cat='+cat+'&bnm='+bnm).fadeIn('fast');
}
</script>
    </body>
</html>