<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";

date_default_timezone_set('Asia/Kolkata');
$fdt=date('01-m-Y');
$tdt=date('d-m-Y');
?>
<html>
<head>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php 
            include "left_bar.php";
            ?>
		


   <link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003;
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
	$("#fdt").datepicker(jQueryDatePicker2Opts);
	$("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	$("#tdt").datepicker(jQueryDatePicker2Opts);
	$("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	

   });
   
  </script>
      <script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
   
<script type="text/javascript"> 
 function showlist()
{
	var mobid=encodeURIComponent(document.getElementById('mobid').value);
	$('#show').load('call_inquirys.php?mobid='+mobid).fadeIn('fast');
}
</script>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Call Inquiry
                     
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Call Inquiry</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
		
<div class="box box-success">
<table id="data-table" class="table table-striped table-bordered nowrap">
<tr>
<td style="text-align:right;"><label>Search :</label></td>
<td><input class="form-control" type="text" name="mobid" id="mobid" placeholder="Enter Mobile No / Call ID"></td>
<td style="text-align:left;">
<input type="button" value="Search" class="btn bg-navy" onclick="showlist()">
</td>
</tr>
</table>
</div>
   
<div class="box-body">
			<div id="show"></div>
			</div><!-- /.box-body -->

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"> Assign to Technician</h4>
			</div>
			<div class="modal-body">
				<div id="cnt"></div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->








</div>
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                            </div>
							
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

     

    </body>

</html>