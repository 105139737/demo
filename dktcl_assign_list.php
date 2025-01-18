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
<title>Assign Call List</title>
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
	$('#show').load('dktcl_assign_lists.php?src='+src+'&fdt='+fdt+'&tdt='+tdt).fadeIn('fast');
}

 function pagnt(pno){
	var ps=document.getElementById('ps').value;
	var fdt=document.getElementById('fdt').value;
	var tdt=document.getElementById('tdt').value;
	var src=encodeURIComponent(document.getElementById('src').value);
	
	$('#show').load('dktcl_assign_lists.php?pno='+pno+'&ps='+ps+'&src='+src+'&fdt='+fdt+'&tdt='+tdt).fadeIn('fast');
	$('#pgn').val=pno;
    }
	function pagnt1(pno){
	pno=document.getElementById('pgn').value;
	pagnt(pno);
	}

	
 function assigncls(sl)
{
	$('#show').load('call_close.php?sl='+sl).fadeIn('fast');
}
	
 function astntcncls(sl)
{
	$('#cnt').load('close_technician.php?sl='+sl).fadeIn("slow");
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

function showrt()
{
		var pcd=document.getElementById('pcd').value;
		var wtyp=document.getElementById('wtyp').value;
		var tid=document.getElementById('tid').value;
		$.get('rtt.php?pcd='+pcd+'&wty='+wtyp+'&tid='+tid, function(data) {
			    var str= data;
				var stra = str.split("@")
				var fstr1 = stra.shift()
				var fstr2 = stra.shift()  
			   $('#rt').val(fstr1);
			   $('#qnty2').val(fstr2);
		 }); 
}
function chkval()
{
		var qnty=document.getElementById('qnty').value;
		var qnty2=document.getElementById('qnty2').value;
		var rt=document.getElementById('rt').value;
		if(qnty>qnty2)
		{
			
			document.getElementById('qnty').focus();
		}
		else
		{
			rtt=rt*qnty;
			document.getElementById('amm').value=rtt;
		}
}
function add()
	{
		pnm=document.getElementById('pcd').value;
		tid=document.getElementById('tid').value;
		qnty=document.getElementById('qnty').value;
		qnty2=document.getElementById('qnty2').value;
		rt=document.getElementById('rt').value;
		wtyp=document.getElementById('wtyp').value;
		amm=document.getElementById('amm').value;
		$('#wb_Text13').load("tech_paadtmppr_close.php?pnm="+pnm+"&qnty="+qnty+"&tid="+tid+"&qnty2="+qnty2+"&rt="+rt+"&wtyp="+wtyp+"&amm="+amm).fadeIn('fast');
		$('#pnm').trigger('chosen:open');
		document.getElementById('qnty').value='';
		document.getElementById('qnty2').value='';
		document.getElementById('rt').value='';
		document.getElementById('amm').value='';
		document.getElementById('wtyp').value='';
	}

function deltpr(tsl)
	{
		
		
	$('#wb_Text13').load("tech_padeltpr_close.php?tsl="+tsl).fadeIn('fast');
	}
		function tmppr1()
	{
		
		$('#wb_Text13').load("tech_patmppr_close.php").fadeIn('fast');
			
		
	}
</script>
</head>
<body onload="showlist()">
<aside class="right-side">
	<section class="content-header">
		<h1 align="center"></h1>
		<ol class="breadcrumb">
			<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Assign Call List</li>
		</ol>
	</section>
	
<section class="content">


<div class="row">
	<div class="col-md-12">
		<div class="box box-myclass box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Assign Call List</h3>
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
			<div id="show" style="overflow-y:scroll;"></div>
			</div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div>

</section><!-- /.content -->
</aside><!-- /.right-side -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" style="width:900px;">
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