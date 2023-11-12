<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";


date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');

?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?
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

</style> 


<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

   
   <link rel="stylesheet" href="dark-hive/jquery.ui.all.css" type="text/css">



<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}

</style>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete1.css" />

<script type="text/javascript" src="jquery.autocomplete1.js"></script>
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
   $("#expdt").datepicker(jQueryDatePicker2Opts);
	  $("#expdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	  
	    $("#mfg").datepicker(jQueryDatePicker2Opts);
	  $("#mfg").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	  

   });


</script>
   <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

<script>

function check1()
{
if(document.form1.prnm.value=='')
{
alert("Please Select Product Name !");
document.form1.prnm.focus();
return false;
}
if(document.form1.unit.value=='')
{
alert("Please Select Unit !");
document.form1.unit.focus();
return false;
}
if(document.form1.qnty.value=='')
{
alert("Please Enter Quantity !");
document.form1.qnty.focus();
return false;
}
else
{
 document.forms["form1"].submit();
}
}





/*
function gett()
{
prnm=document.getElementById('prnm').value;
$("#g_unt").load("get_unto.php?prnm="+prnm).fadeIn('fast');
show();
}

*/
 function get_cat()  
 {
cat=document.getElementById('cat').value;
scat=document.getElementById('scat').value;
//$("#scat_div").load("get_cat_pur.php?cat="+cat).fadeIn('fast');
$("#prod_div").load("get_product_bill.php?cat="+cat+"&scat="+scat).fadeIn('fast');
}
 function get_prod()
 {
cat=document.getElementById('cat').value;
scat=document.getElementById('scat').value;	 
$("#prod_div").load("get_product_bill.php?cat="+cat+"&scat="+scat).fadeIn('fast');	
}

function gtt_unt()
 {
		prnm=document.getElementById('prnm').value;
	 $("#g_unt").load("get_unt_opn.php?prnm="+prnm).fadeIn('fast');
 }





function show()
 {
 var prnm= document.getElementById('prnm').value;
 $('#sgh').load('openung_list.php?prnm='+prnm).fadeIn('fast');
 }


function edit(sl)
{
document.location='opening_edit.php?sl='+sl;
}


function check(evt)
{
evt =(evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;						// ONLY NUMBER FOR NUMBER FIELD
if(charCode > 31 && (charCode < 48 || charCode > 57))
{
return false;
}
 return true;	
}
</script>
<body onload="show()">

            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">

                <!-- Content Header (Page header) -->

                <section class="content-header">

                    <h1 align="center">

                    Opening Stock 

                        <small>Entry</small>

                    </h1>

                    <ol class="breadcrumb">

                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>

                        <li class="active">Opening Stock</li>

                    </ol>

                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Main row -->
            <!-- Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->

                            <!-- Chat box -->
                     <!-- /.box (chat box) -->
                            <!-- TO DO List -->

<form method="post" action="openings.php" id="form1" onSubmit="return check1()" name="form1">
<center>
<div class="box box-success" >
<table border="0"  width="800px"  align="center" class="table table-hover table-striped table-bordered">
<tr>


<td align="left" width="33%"><b>Company :</b><br>
<select id="cat" name="cat" class="form-control" onchange="get_cat()">
<option value="">---Select---</option>
<?

$data1 = mysqli_query($conn,"Select * from main_catg order by cnm");

		while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$cnm=$row1['cnm'];
?>
<option value="<?=$sl;?>"><?=$cnm;?></option>
	<?}?>
</select>
</td>




<td align="left" width="33%"><b>Category:</b><br>

<div id="scat_div">
<select id="scat" name="scat" class="form-control"  onchange="get_prod()">
<option value="">---Select---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_scat order by nm");

		while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$nm=$row1['nm'];
?>
<Option value="<?=$sl;?>"><?=$nm;?></option>
	<?}?>
</select>
</div>
</td>
<td align="left" width="34%"><b>Product:</b><br>
<div id="prod_div">
<select id="prnm" name="prnm" class="form-control" onchange="gtt_unt();show()">
<option value="">---Select---</option>
<?
$data1 = mysqli_query($conn,"Select * from main_product order by pnm");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$pnm=$row1['pnm'];
?>
<Option value="<?=$sl;?>"><?=$pnm;?></option>
<?}?>
</select>
</div>
</td>
</tr><tr>

<td align="left" width="33%"><b>Unit :</b><br>
<div id="g_unt">
<select id="unit" name="unit" class="form-control" >
<option value="">---Select---</option>
</select>
</div>
</td>


<td align="left" width="33%"><b>Quantity :</b><br>
<input type="text" name="qnty" id="qnty" class="form-control" value="" size="20"  onkeypress="return check()" placeholder="Enter Quantity">
</td>



<td align="left" width="33%"><b>Rate :</b><br>
<input type="text" name="pret" id="pret" class="form-control" value="" size="20" placeholder="Enter Rate">
</td>
</tr>



<tr>
<td colspan="3" align ="right">
<input type="submit" value="Submit" class="btn btn-primary" name="B1">
</td>
</tr>


</table>
                                </div>

								</form><!-- /.box-body -->
<div class="box box-success" >
<table border="0" width="860px" class="table table-hover table-striped table-bordered">

</tbody>
</table>
</div>	
<div id="sgh"></div>
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

	
		  $('#prnm').chosen({
  no_results_text: "Oops, nothing found!",

  });	
		  $('#cat').chosen({
  no_results_text: "Oops, nothing found!",

  });		  $('#scat').chosen({
  no_results_text: "Oops, nothing found!",

  });
  $('#unit').chosen({
  no_results_text: "Oops, nothing found!",

  });

  
</script>

</body>
</html>