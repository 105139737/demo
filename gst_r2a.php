<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sa=date('d-m-Y');
$saa="01-".date('m-Y');
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

 var fdt= document.getElementById('fdt').value;
 var tdt= document.getElementById('tdt').value;
  var snm= document.getElementById('snm').value;
 $('#data8').load('gst_r2a_list.php?fdt='+fdt+'&tdt='+tdt+'&snm='+snm).fadeIn('fast');

}
	function xls()
{
 var fdt= document.getElementById('fdt').value;
 var tdt= document.getElementById('tdt').value;
  var snm= document.getElementById('snm').value;
//document.location='gst_b2b_xls.php?fdt='+fdt+'&tdt='+tdt+'&snm='+snm;
document.location='gst_r2a_csv.php?fdt='+fdt+'&tdt='+tdt+'&snm='+snm;
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
              GSTR-1 R2A Report
                      
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> GSTR-1 R2A </li>
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
<td align="left" width="" >
<b> Form Date:</b><br>

<input type="text" id="fdt" name="fdt" size="13" value="<?echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > </td>

<td align="left" width=""  >
<b> To Date:</b>
<br>
<input type="text" id="tdt" name="tdt" size="13" value="<?echo $sa;?>" class="form-control" placeholder="Please Enter To Date">
</td>
<td align="left"  width="25%" >
<b>Company:</b>
<br>

<select name="snm" class="form-control"  id="snm"   >
<option value="">---All---</option>
<?

$data5= mysqli_query($conn,"select * from main_suppl  order by spn")or die(mysqli_error($conn));
while ($row5 = mysqli_fetch_array($data5))
{
$sl=$row5['sl'];
$spn1=$row5['spn'];
$mob1=$row5['mob1'];
$gstin=$row5['gstin'];

?>
<option value="<? echo $sl;?>"><? echo $spn1;?> - <? echo $mob1;?> (<? echo $gstin;?>)</option>
<?
}
?>
</select>
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