<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$saa="01-".date('m-Y');
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
                   Task Asign  Report
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Task Asign Report </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body onload="show()">
<div class="box box-success " >
<form method="post" action="task_assigns.php" id="form1" onSubmit="return check1()" name="form1">                    
<table border="0" class="table table-hover table-striped table-bordered" >
<tr>
<td align="right" style="padding-top:15px;" width="15%"><b>Sales Person :</b></td>
<td  align="left" width="35%">
<select name="spid" class="form-control" size="1" id="spid" tabindex="8"  required>
<Option value="">---Select---</option>
<?php 
$data1 = mysqli_query($conn,"Select * from main_sale_per order by spid");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$spid=$row1['spid'];
?>
<Option value="<?php  echo $spid;?>"><?php  echo $spid;?></option>
<?php }?>
</select>
</td>

</tr>
<tr>

<td align="right" style="padding-top:15px;" ><b>From Date :</b></td>
<td  align="left">
<input type="text" id="fdt" name="fdt" value="<?php  echo $saa;?>" class="form-control"  readonly  required> 
</td>
<td align="right" style="padding-top:15px;" ><b>To Date :</b></td>
<td  align="left">
<input type="text" id="tdt" name="tdt" class="form-control" value="<?php echo date('d-m-Y');?>"  readonly  required> 
</td>				
</tr>
<tr>
<td align="right" colspan="4">
<input type="button" class="btn btn-success" value="Show" onclick="show()" name="B1" >
</td>
</tr>
</table>
</div>
</form>
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