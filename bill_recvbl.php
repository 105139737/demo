<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$fdt=date('Y-m-d');
$typ=$_REQUEST['typ'];
$tt=$_REQUEST['tt'];

?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?
include "left_bar.php";
?>
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

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

</style> 
<script>

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
$("#dt").datepicker(jQueryDatePicker2Opts);
$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
});

  


function show()
{
var brnch=document.getElementById('brnch').value;
var sper=document.getElementById('sper').value;
var brand=document.getElementById('brand').value;
var party=encodeURI(document.getElementById('party').value);

$('#div_list').load('bill_recvbl_show.php?brnch='+brnch+'&sper='+sper+'&brand='+brand+'&party='+party).fadeIn('fast');
}
function pagnt(pno)
{
var brnch=document.getElementById('brnch').value;
var sper=document.getElementById('sper').value;
var brand=document.getElementById('brand').value;
var party=encodeURI(document.getElementById('party').value);

var ps=document.getElementById('ps').value;
$('#div_list').load('bill_recvbl_show.php?ps='+ps+'&pno='+pno+'&brnch='+brnch+'&sper='+sper+'&brand='+brand+'&party='+party).fadeIn('fast');
$('#pgn').val=pno;
}
function pagnt1(pno){
pno=document.getElementById('pgn').value;
pagnt(pno);
}
function bill_recv_edit(sll)
{
	document.location="bill_recvbl_edit.php?sl="+sll;
}
</script>


   
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Bill Receivable
                        <small>Accounts</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Bill Receivable</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body onload="show()">
<form method="post" action="bill_recvbls.php" id="form1" name="form1">      
<input type="hidden" class="form-control"  tabindex="1"  name="bsl" id="bsl" >              
<input type="hidden" class="form-control"  value="<?php echo $typ;?>" tabindex="1"  name="typ" id="typ" >              
<div class="box box-success" >
<table border="0" class="table table-hover table-striped table-bordered">
<tr>
<td  align="left" width="30%">
<b>Branch :</b>
<select name="brnch" id="brnch" class="form-control"  tabindex="1"  onchange="show()">
<option value="">---ALL---</option>		
<?
$dsql=mysqli_query($conn,"select * from main_branch order by sl") or die (mysqli_error($conn));
while($erow=mysqli_fetch_array($dsql))
{
$bsl=$erow['sl'];
$bnm=$erow['bnm'];
?>
<option value="<?php echo $bsl;?>"><?php echo $bnm;?></option>
<?
}
?>		
</select>
</td>
<td width="30%">
<b>Sales Person : </b>
<select name="sper" id="sper" class="form-control"  tabindex="1"  onchange="show()" >
<option value="">---ALL---</option>
<?
$dsql1=mysqli_query($conn,"select * from main_sale_per order by sl") or die (mysqli_error($conn));
while($erow1=mysqli_fetch_array($dsql1))
{
$spsl=$erow1['sl'];
$spid=$erow1['spid'];
?>
<option value="<?php echo $spid;?>"><?php echo $spid;?></option>
<?
}
?>
</select>
</td>
<td align="left" width="30%">
<b>Date : </b>
<input type="text" name="dt" id="dt" class="form-control">
</td>
</tr>
<tr>
<td  align="left" >
<b>Brand :</b>
<select name="brand" id="brand" class="form-control"  tabindex="1"  onchange="show()" >
<option value="">---ALL---</option>
<?
$dsql2=mysqli_query($conn,"select * from main_catg order by sl") or die (mysqli_error($conn));
while($erow2=mysqli_fetch_array($dsql2))
{
$bsl=$erow2['sl'];
$cnm=$erow2['cnm'];
?>
<option value="<?php echo $cnm;?>"><?php echo $cnm;?></option>
<?
}
?>
</select>
</td>
<td  align="left" >
<b>Party :</b><br>
<select name="party" id="party" class="form-control"  tabindex="1"  onchange="show()" >
<option value="">---ALL---</option>
<?
$dsql1=mysqli_query($conn,"select * from main_cust order by sl") or die (mysqli_error($conn));
while($erowt=mysqli_fetch_array($dsql1))
{
$psl=$erowt['sl'];
$custnm=$erowt['nm'];
?>
<option value="<?php echo base64_encode($psl."@".$custnm);?>"><?php echo $custnm;?></option>
<?
}
?>
</select>
</td>
<td align="left">
<b>Reference No.:</b><br>
<input type="text" name="refno" id="refno" class="form-control">
</td>
</tr>
<tr>
<td align="left">
<b>Pending Amount :</b>
<input type="text" name="pamnt" id="pamnt" class="form-control">
</td>
<td>
<b>Overdue :</b>
<input type="text" name="ovramnt" id="ovramnt" class="form-control">
</td>

<td align="right" colspan="2">
<br>
<input type="submit" class="btn btn-success" value="Submit" name="B1"  >
</td>
</tr>
</table>
<div id="div_list"></div>
</div>	
</form>
                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

     
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>

	
$('#sper').chosen({no_results_text: "Oops, nothing found!",});
$('#brand').chosen({no_results_text: "Oops, nothing found!",});
$('#party').chosen({no_results_text: "Oops, nothing found!",});

  

</script>			
</body>