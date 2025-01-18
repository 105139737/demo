<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$cust_sle=$_REQUEST['cust_sle'];
$dt=$_REQUEST['dt'];

$data13 = mysqli_query($conn,"Select * from main_cust where FIND_IN_SET(sl, '$cust_sle')");
	while ($row13 = mysqli_fetch_array($data13))
	{
	$customer_name=$row13['nm'];
	}
?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;
color:#000;
border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
#sfdtl
{
	border : none;
	border-radius: 3px;
	background-image: url(images/bg1.png);
	width : 195px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 6%;
	top : 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
}
</style> 
<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css"> 
#jQueryDatePicker1
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
</style>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<script type="text/javascript"> 
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
   $("#fdt").datepicker(jQueryDatePicker1Opts);
   $("#tdt").datepicker(jQueryDatePicker1Opts);
});

function show()
{
var spid= document.getElementById('spid').value;
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
$('#sgh').load('task_assign_list_all.php?spid='+encodeURIComponent(spid)+'&fdt='+fdt+'&tdt='+tdt).fadeIn('fast');
}
function pagnt(pno){
var ps=document.getElementById('ps').value;
var spid=document.getElementById('spid').value;
var fdt= document.getElementById('fdt').value;
var tdt= document.getElementById('tdt').value;
$('#sgh').load("task_assign_list_all.php?ps="+ps+"&pno="+pno+"&spid="+encodeURIComponent(spid)+'&fdt='+fdt+'&tdt='+tdt).fadeIn('fast');
$('#pgn').val=pno;
}
function pagnt1(pno){
pno=document.getElementById('pgn').value;
pagnt(pno);
}


</script>


            <!-- Right side column. Contains the navbar and content of the page -->
           
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Details Report
                        <small>Report</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">  Details Report </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body onload="show()">
<p><font size="4"><b>Customer Name: <?php echo $customer_name;?></b></font></p>
<p><font size="4"><b>Date: <?php echo date('d-m-Y',strtotime($dt));?></b></font></p>
<table  class="table table-hover table-striped table-bordered"  >

<tr>

<th width="25%">Payment</font></th>
<th width="25%" >Due</font></th>
<th width="25%" >Order</font></th>
<th width="25%" >Bill</font></th>


</tr>
<?php 
$totpayment=0;

$samaun=mysqli_query($conn,"select sum(tamm) as tamm from main_recv_app where cid='$cust_sle' and dt='$dt'") or die (mysqli_error($conn));
while($rsamaun=mysqli_fetch_array($samaun))
{
	$totpayment=$rsamaun['tamm'];
}
if($totpayment==null)
{
	$totpayment=0;
}

$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1'  and cid='$cust_sle' and dldgr='4' and dt<='$dt'");
while ($row = mysqli_fetch_array($data))
{
 $t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1'  and cid='$cust_sle'  and cldgr='4' and dt<='$dt'");
while ($row16 = mysqli_fetch_array($data1))
{
$t2 = $row16['t2'];
}
$T=$t1-$t2;
$totorder=0;
$zas=mysqli_query($conn,"select count(sl) as totorder from main_order where cid='$cust_sle' and dt='$dt'") or die (mysqli_error($conn));

while($ffs=mysqli_fetch_array($zas))
{
	$totorder=$ffs['totorder'];
}
$zas_bill=mysqli_query($conn,"select count(sl) as totorder from main_billing where cid='$cust_sle' and dt='$dt'") or die (mysqli_error($conn));
while($ffst=mysqli_fetch_array($zas_bill))
{
	$tot_bill=$ffst['totorder'];
}

?>
<tr>

<th width="25%"><?php echo $totpayment;?></font></th>
<th width="25%" ><?php echo $T;?></font></th>
<th width="25%" ><a href="order_details.php?cid=<?php echo $cust_sle?>&dt=<?php echo $dt;?>"><?php echo $totorder;?></font></a></th>
<th width="25%" ><a href="bill_details.php?cid=<?php echo $cust_sle?>&dt=<?php echo $dt;?>"><?php echo $tot_bill;?></font></a></th>


</tr>
</table>
<div class="box box-success" id="sgh">
</div>	
</body>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>
$('#spid').chosen({no_results_text: "Oops, nothing found!",});	
$('#cust').chosen({no_results_text: "Oops, nothing found!",});	
$('#custm').chosen({no_results_text: "Oops, nothing found!",});	
</script>
</script>