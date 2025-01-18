<?php 
$reqlevel=3;
include("membersonly.inc.php");
include "header.php";
include "function.php";
$dt=$_REQUEST['dt'];
$cid=$_REQUEST['cid'];
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
	var cat=document.getElementById('cat').value;
	var bnm=document.getElementById('bnm').value;
	$('#gpro').load('get_pro.php?bnm='+bnm+'&cat='+cat).fadeIn('fast');
}

function show1()
{
	location.reload();
}

function view(blno)
{
	window.open('bill_typ.php?blno='+encodeURIComponent(blno)+'&rv=1', '_blank');
	window.focus();
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
function del(blno)
{
	
if(confirm("Are you sure to cancel !!"))
{	
$('#data8').load('order_del.php?blno='+blno).fadeIn('fast');
}
	
}
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
                    <h1 align="center">Order to Invoice</h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Order to Invoice</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">	
<div id="data8">		
<table width="100%" class="advancedtable">
<tr bgcolor="000">
<td colspan="26"><font size="5" color="#fff">Order Details</font></td>
</tr>		
<tr bgcolor="#e8ecf6">
<td align="center"><b>Sl</b></td>
<td align="center"><b>Action</b></td>
<td align="center"><b>Status</b></td>
<td align="center"><b>Date</b></td>
<td align="center"><b>Sales Person</b></td>
<td align="center"><b>Order No</b></td>
<td align="center"><b>Customer Name</b></td>
<td align="center"><b>Branch</b></td>
<td align="center"><b>Godown</b></td>
<td align="center"><b>Model Name</b></td>
<td align="center"><b>HSN Code</b></td>
<td align="center"><b>Quantity</b></td>
</tr>
<?php 
$sln=0;
//echo "SELECT * FROM main_order where sl>0 $cid1 $salper1 $brncd1 $todts $stat1 ORDER BY sl";
$data1=mysqli_query($conn,"SELECT * FROM main_order where sl>0 and cid='$cid' and dt='$dt' ORDER BY sl")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($data1))
{
	$sln++;
	$sl=$row1['sl'];
	$blno=$row1['blno'];
	$gst=$row1['gst'];
	$cid=$row1['cid'];
	$sale_per=$row1['sale_per'];
	$cstat=$row1['cstat'];
	$dt=$row1['dt'];
	$bcd=$row1['bcd'];
if($cstat=='0'){$cstat1="Pending";}elseif($cstat=='1'){$cstat1="Done";}elseif($cstat=='2'){$cstat1="Canceled";}
	$dt=date('d-m-Y',strtotime($dt));

	$asd=0;
	$qttl=0;
	$cust_nm="";
	$datad1= mysqli_query($conn,"select * from main_cust where sl='$cid'")or die(mysqli_error($conn));
	while ($rowd = mysqli_fetch_array($datad1))
	{
		$cust_nm=$rowd['nm'];
	}
	$bnm="";
	$data12=mysqli_query($conn,"select * from main_branch where sl='$bcd'")or die(mysqli_error($conn));
	while ($row1=mysqli_fetch_array($data12))
	{
	$bnm=$row1['bnm'];
	}
	$pcss=0;
	$data=mysqli_query($conn,"SELECT * FROM main_orderdtls WHERE sl>0 AND blno='$blno'")or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($data))
	{
		$cat=$row['cat'];
		$scat=$row['scat'];	
		$pcd=$row['prsl'];
		$blno1=$row['blno'];
		$unit=$row['unit'];
		$pcs=$row['pcs'];
		$godown=$row['bcd'];

		$pcss=$pcss+$pcs;

		$get=mysqli_query($conn,"select * from main_unit where cat='$pcd'") or die(mysqli_error($conn));
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
	}
	$gnm="";
	$query6="select * from  main_godown where sl='$godown'";
	$result5 = mysqli_query($conn,$query6);
	while($row=mysqli_fetch_array($result5))
	{
	$gnm=$row['gnm'];
	}

	if($blno==$blno1){$asd++;}	
?>
<tr>
<?php 
if($asd==1)
{
	?>
	<td align="center"><?php  echo $sln;?></td>
	<td align="center">
	<?php 
	if($cstat==0)
	{
	?>
	<a href="javascript:del('<?php  echo $blno;?>');"><font color="red"><b>Cancel</b></font></a>
	<?php 
	}
	else
	{
		echo 'NA';
	}
	?>
	</td>
	<td align="center"><?php  echo $cstat1;?></td>
	<td align="center"><?php  echo $dt;?></td>
	<td align="center"><?php  echo $sale_per;?></td>
	<?php 
	if($cstat==0)
	{
	?>
	<td align="center"><a href="#" onclick="view('<?php  echo $blno;?>')" ><?php  echo $blno;?></a></td>
	<?php 
	}
	else
	{
	?>
	<td align="center"><?php  echo $blno;?></td>	
	<?php 
	}
	?>
	
	<td align="left"><?php  echo $nm;?><b><?php  echo $cust_nm;?></b></td>
	<td align="center"><?php  echo $bnm;?></td>
	<?php 
}
else
{
	?>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<?php 
}
?>
<td align="center"><?php  echo $gnm;?></td>
<td align="left" title="<?php  echo $pcd;?>"><?php  echo $pnm;?></td>
<td align="center"><?php  echo $hsn;?></td>
<td align="center"><?php  echo "$pcs $unit_nm";?></td>
</tr>
<?php 
}
if($pcss!=0)
{
	?>
	<tr bgcolor="#e8ecf6">
	<td colspan="9" align="right"><b>Total</b></td>
	<td></td>
	<td></td>

	<td align="center"><b><?php  echo $pcss;?></b></td>
	</tr>
	<?php 
}
	$tpcss=$tpcss+$pcss;
}
?>
<tr>
<td colspan="9" align="right"><b>Grand Total</b></td>
<td></td>
<td></td>

<td align="center"><b><?php  echo $tpcss;?></b></td>
</tr>
</table>
</div>
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
$('#cid').chosen({no_results_text: "Oops, nothing found!",});
$('#salper').chosen({no_results_text: "Oops, nothing found!",});
  
function getv()
{
	var cat= document.getElementById('cat').value;
	var bnm= document.getElementById('bnm').value;
	$('#vv').load('get_v.php?cat='+cat+'&bnm='+bnm).fadeIn('fast');
}
</script>
    </body>
</html>