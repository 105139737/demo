<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$saa=date('d-m-Y');
$sa=date('d-m-Y');

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

function show1()
{

var fdt=document.getElementById('fdt').value;
var tdt=document.getElementById('tdt').value;

$('#data8').load('gst_3bs.php?fdt='+fdt+'&typ=0'+'&tdt='+tdt).fadeIn('fast');
}
function xls()
{
var fdt=document.getElementById('fdt').value;
var tdt=document.getElementById('tdt').value;
document.location='gst_3bs.php?fdt='+fdt+'&tdt='+tdt+'&typ=1';
}
 function jsn()

{
	var fdt=document.getElementById('fdt').value;
var tdt=document.getElementById('tdt').value;
	document.location='gst_3bs_json.php?tdt='+tdt+'&fdt='+fdt+'&typ=1';
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
 <body >
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
              GSTR 3B Report
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> GSTR-3B </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">			
	<form method="post" action="#" name="form1" onsubmit="return check1()" id="form1">
                              
<div class="box box-success" >
<?

?>
<table border="0" width="860px"  class="table table-hover table-striped table-bordered">
<thead>
<tr  >

<td align="left" width="25%">
<b>Form : </b>
<input type="text" id="fdt" name="fdt" value="<?echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > 
</td>

<td align="left" width="25%" >
<b>To : </b>
<input type="text" id="tdt" name="tdt" value="<?echo $sa;?>"class="form-control" placeholder="Please Enter To Date">
</td>


<td align=""><br>

<input type="button" class="btn btn-primary" value="Show" onclick="show1()">
<input type="button" class="btn btn-info" value="Excel Export" onclick="xls()">
</td>
</tr>
</thead>



</table>
<div id="data8" style="overflow-x:auto;">
</div>
	 
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
$('#snm').chosen({no_results_text: "Oops, nothing found!",});

</script>
    </body>
</html>