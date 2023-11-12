<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
include "function.php";

$cy=date('Y');
?> 
<html>
<head>
<div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<style type="text/css"> 
th{
text-align:center;

border:1px solid #37880a;
}

input:focus{

background-color:Aqua;
}
a{
cursor:pointer;
}
</style> 
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

$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
$("#dt").datepicker(jQueryDatePicker2Opts);

});
	function isNumber(evt) 
 {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if(iKeyCode < 46 || iKeyCode > 57)
		{
            return false;
        }
        return true;
 }
 </script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

<script type="text/javascript" src="prdcedt.js"></script>
<script>	
function get_scat()  
{
var cat= document.getElementById('cat').value;
$("#scatdiv").load("get_scat_adj.php?cat="+cat).fadeIn('fast');
}

function get_prod()
{
var scat=document.getElementById('scat').value;
var cat=document.getElementById('cat').value;
$("#prod_div").load("get_product_adj.php?cat="+cat+"&scat="+scat).fadeIn('fast');	
}

</script>
</head>
 <body>
            <!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <h1 align="center">Stock Adjustment</h1>
                <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Stock Adjustment</li>
                </ol>
                </section>
				<!-- Main content -->
<section class="content">
<form method="post" action="stk_adjusts.php" id="form1" target="_blank" onSubmit="return check1()" name="form1">
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td width="30%">
<b>Brand :</b><br>
<select name="cat" class="form-control" size="1" id="cat" tabindex="1" onchange="get_scat();get_prod()">
<Option value="">---All---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_catg order by cnm");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$cnm=$row1['cnm'];
echo "<option value='".$sl."'>".$cnm."</option>";
}
?>
</select>
</td> 

<td width="30%">
<b>Category :</b><br>
<div id="scatdiv">
<select name="scat" class="form-control" size="1" id="scat" tabindex="1" onchange="get_prod()">
<Option value="">---All---</option>
<?
$data2 = mysqli_query($conn,"Select * from main_scat order by nm");
while ($row2 = mysqli_fetch_array($data2))
{
$ssl=$row2['sl'];
$snm=$row2['nm'];
echo "<option value='".$ssl."'>".$snm."</option>";
}
?>
</select>
</div>
</td> 
<td width="30%">
<b>Model:</b><br>
<div id="prod_div">
<select name="prnm" class="form-control"  id="prnm" >
<option value="">---All---</option>

</select>
</div>
</td>
</tr>
<tr>
<td>
<b>SL No.:</b><br>
<input type="text" name="betno" id="betno" class="form-control">
</td>
<td>
<b>SELLABLE / RETURNABLE TO CO :</b><br>
<input type="text" name="srCo" id="betno" class="form-control">
</td>
<td>
<b>CURRENT STATUS :</b><br>
<input type="text" name="cstat" id="cstat" class="form-control">
</td>
</tr>
<tr>
<td>
<b>CO APPROVAL MAIL DATE:</b><br>
<input type="text" name="comaildt" id="comaildt" class="form-control">
</td>
<td>
<b>RETURN FROM CUST :</b><br>
<input type="text" name="rcust" id="rcust" class="form-control">
</td>
<td>
<b>RETURN DATE :</b><br>
<input type="text" name="rdt" id="rdt" class="form-control">
</td>
</tr>
<tr>
<td>
<b>GODOWN :</b><br>
<select name="godown" class="form-control" size="1" id="godown" >
<option value="">---Select---</option>
<?

$query="Select * from main_godown where stat=1 order by gnm";

$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$gnm=$R['gnm'];
?>
<option value="<? echo $sl;?>"><? echo $gnm;?></option>
<?
}
?>
</select>
</td>
<td>
<b>PROBLEM :</b><br>
<input type="text" name="problem" id="problem" class="form-control">
</td>
<td>
<b>CALL NO :</b><br>
<input type="text" name="callNo" id="callNo" class="form-control">
</td>
</tr>
<tr>
<td>
<b>PDI DONE YES OR NO :</b><br>
<select name="pidDone" class="form-control" size="1" id="pidDone" >
<option value="">---Select---</option>
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</td>
<td>
<b>PROBLEM SOLVED YES / NO:</b><br>
<select name="pidDone" class="form-control" size="1" id="pidDone" >
<option value="">---Select---</option>
<option value="Yes">Yes</option>
<option value="No">No</option>
</select>
</td>
<td>
<b>SOLD TO :</b><br>
<input type="text" name="betno" id="betno" class="form-control">
</td>
</tr>
<tr>
<td>
<b>SOLD DATE :</b><br>
<input type="text" name="betno" id="betno" class="form-control">
</td>
<td>
<b>SELLING PRICE :</b><br>
<input type="text" name="betno" id="betno" class="form-control">
</td>
<td>
<b>RETURN TO CO DATE :</b><br>
<input type="text" name="betno" id="betno" class="form-control">
</td>
</tr>

<tr>
<td colspan="4" align="right" style="padding-right:80px">
<input type="submit" value=" Submit " class="btn btn-success">
<input type="reset" value=" Reset " class="btn btn-warning">
</td>
</tr>
</table>
</div>
</form><!-- /.box-body -->
<div class="box-footer clearfix no-border"></div>
                       
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
$('#prnm').chosen({
no_results_text: "Oops, nothing found!",
});
$('#scat').chosen({
no_results_text: "Oops, nothing found!",
});
 $('#cat').chosen({
no_results_text: "Oops, nothing found!",
});
 $('#brncd').chosen({
no_results_text: "Oops, nothing found!",
});
 
</script>
 </body>
</html>