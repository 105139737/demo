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

	var fdt=document.getElementById('fdt').value;
	var tdt=document.getElementById('tdt').value;
	var src=encodeURIComponent(document.getElementById('src').value);
	$('#show').load('dktcl_pnding_lists.php?src='+src+'&fdt='+fdt+'&tdt='+tdt).fadeIn('fast');
}

 function pagnt(pno){
	var ps=document.getElementById('ps').value;
	var src=encodeURIComponent(document.getElementById('src').value);
	var fdt=document.getElementById('fdt').value;
	var tdt=document.getElementById('tdt').value;
	
	$('#show').load('dktcl_pnding_lists.php?pno='+pno+'&ps='+ps+'&src='+src+'&fdt='+fdt+'&tdt='+tdt).fadeIn('fast');
	$('#pgn').val=pno;
    }
	function pagnt1(pno){
	pno=document.getElementById('pgn').value;
	pagnt(pno);
	}

 function astntcn(sl)
{
	$('#cnt').load('assign_technician.php?sl='+sl).fadeIn("slow");
	$('#myModal').modal('show');
	$('#dnm').html('Modify Details');
}

 
</script>

<script>
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

	function add()
	{
		pnm=document.getElementById('pnm').value;
		qnty=document.getElementById('qnty').value;
		$('#wb_Text13').load("tech_paadtmppr.php?pnm="+pnm+"&qnty="+qnty).fadeIn('fast');
		$('#pnm').trigger('chosen:open');
		document.getElementById('qnty').value='';
	}

function deltpr(tsl)
	{
		
		
	$('#wb_Text13').load("tech_padeltpr.php?tsl="+tsl).fadeIn('fast');
	}
		function tmppr1()
	{
		
		$('#wb_Text13').load("tech_patmppr.php").fadeIn('fast');
			
		
	}

	function check1()
	{
	if(document.form1.dt.value=='')
		{
			alert("Please Select Date !!");
			document.form1.dt.focus();
			return false;
		}
			if(document.form1.rmk.value=='')
		{
			alert("Please Enter Remark !!");
			document.form1.rmk.focus();
			return false;
		}
else
	{
   document.forms["form1"].submit();
	}}


 </script>

<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body onload="showlist()">
 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                 Pending Application
                     
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Pending Application</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                   

                   

                    <!-- Main row -->
                    
                        <!-- Left col -->
                       
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        
                           

                            <!-- Chat box -->
					
                     <!-- /.box (chat box) -->

     
                              
							
								
<div class="box box-success">
<table id="data-table" class="table table-striped table-bordered nowrap">
<tr>
<td style="text-align:right;"><b>From:</b></td>
<td style="text-align:left;">
<input type="text" name="fdt" class="form-control" id="fdt" value="<?php  echo $fdt;?>" readonly>
</td>
<td style="text-align:right;"><b>To:</b></td>
<td style="text-align:left;">
<input type="text" name="tdt" class="form-control" id="tdt" value="<?php  echo $tdt;?>" readonly>
</td>
<td style="text-align:right;"><label>Search :</label></td>
<td>
<input class="form-control" type="text" name="src" id="src" placeholder="Enter Search">
</td>
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
   

        <!-- add new calendar event modal -->

     

<div id="adpnm"></div>
	<!-- Light Box -->
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog"  style="width:700px;;">
		<div class="modal-content">
		
			<div class="modal-body" id="cnt1">
			
			
			</div>
        </div>
    </div>
</div>
<!-- End -->





    </body>

</html>