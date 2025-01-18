<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$year=date('Y'); 
$sa=date('d-m-Y');
$saa="01-".date('m-Y');
?>
<!-- AdminLTE dashboard demo (This is only for demo purposes) --> 
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


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        GST HSN
                        <small>Report</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                   

                   

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                    
     <div class="col-md-12">
          <div class="box box-success">
            <table width="100%" class="table table-hover table-striped table-bordered"  >
		
		  <tr class="odd">
            
<td  align="left" >
<b>Report Type :</b>
<select id="typ" data-placeholder="Choose Report Type" name="typ" class="form-control" tabindex="2"  >
<option value="1">Sales</option>

</select>
</td>
<td align="left" width="" >
<b> Form Date:</b><br>

<input type="text" id="fdt" name="fdt" size="13" value="<?php echo $saa;?>" class="form-control" placeholder="Please Enter From Date" > </td>

<td align="left" width=""  >
<b> To Date:</b>
<br>
<input type="text" id="tdt" name="tdt" size="13" value="<?php echo $sa;?>" class="form-control" placeholder="Please Enter To Date">
</td>

			<td align="center"> 
<input type="button"  value="Show" onclick="showhsn()" class="btn btn-primary" >
<input type="button"  value="Export To Excel" onclick="showhsnx()" class="btn btn-warning" >

</td>
			</tr>
			<tr>
				<td align="center" colspan="5"> </td>
				<td align="center" colspan="2"> 
</td>
			</tr>
			</table>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	<div class="box box-success" id="show1" >

  </div>	  
		  
		  
		  
        </div>
                            
                                                
                           

                
                      
                    </div><!-- /.row (main row) -->
<section class="col-lg-12 connectedSortable"> 
                </section><!-- /.content -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->
	<script>

function showhsn()
{
var typ=document.getElementById('typ').value;
var fdt=document.getElementById('fdt').value;
var tdt=document.getElementById('tdt').value;
$('#show1').load('hsnwstr1.php?typ='+typ+'&fdt='+fdt+'&tdt='+tdt).fadeIn('fast');
}
function showhsnx()
{
var typ=document.getElementById('typ').value;
var fdt=document.getElementById('fdt').value;
var tdt=document.getElementById('tdt').value;
//document.location='hsnwstr1_xl.php?typ='+typ+'&mnth='+mnth+'&yr='+yr;
document.location='hsnwstr1_csv.php?typ='+typ+'&fdt='+fdt+'&tdt='+tdt;
}
</script>	
		
	
     

    </body>
</html>