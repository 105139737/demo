<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$fdt=date('01-m-Y');
$tdt=date('d-m-Y');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<div class="wrapper row-offcanvas row-offcanvas-left">
	<?php 
	include "left_bar.php";
	?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Done Call List</title>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<style type="text/css"> 
a
{
   color: black;
   outline: none;
   text-decoration: none;
}
</style>
<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<script type="text/javascript"> 
 function showlist()
{
	var fdt=document.getElementById('fdt').value;
	var tdt=document.getElementById('tdt').value;
	var src=encodeURIComponent(document.getElementById('src').value);
	$('#show').load('dktcl_done_lists.php?src='+src+'&fdt='+fdt+'&tdt='+tdt).fadeIn('fast');
}

 function pagnt(pno){
	var ps=document.getElementById('ps').value;
	var src=encodeURIComponent(document.getElementById('src').value);
	var fdt=document.getElementById('fdt').value;
	var tdt=document.getElementById('tdt').value;
	
	$('#show').load('dktcl_done_lists.php?pno='+pno+'&ps='+ps+'&src='+src+'&fdt='+fdt+'&tdt='+tdt).fadeIn('fast');
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
	$("#tdt").datepicker(jQueryDatePicker2Opts);
	$("#fdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	$("#tdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
});
</script>
</head>
<body onload="showlist()">
<aside class="right-side">
	<section class="content-header">
		<h1 align="center"></h1>
		<ol class="breadcrumb">
			<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Done Call List</li>
		</ol>
	</section>
	
<section class="content">


<div class="row">
	<div class="col-md-12">
		<div class="box box-myclass box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Done Call List</h3>
				<div class="box-tools pull-right"></div><!-- /.box-tools -->
            </div><!-- /.box-header -->

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
        </div><!-- /.box -->
    </div><!-- /.col -->
</div>

</section><!-- /.content -->
</aside><!-- /.right-side -->

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

</body>
</div>
</html>