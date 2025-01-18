<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$cdt=date('d-m-Y');
?>
<html>
<head>
	<div class="wrapper row-offcanvas row-offcanvas-left">
	<?php 
	include "left_bar.php";
	?>
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">
 $(document).ready(function()
{
	$("#expdt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
});
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
   
   $("#cdt").datepicker(jQueryDatePicker2Opts);
   });



function gtid()
{
    sid=document.getElementById('cnm').value;
    if(sid=='Add')
	{
		$('#cnt1').load('adcstnm.php?typ=Debtors').fadeIn("fast");
		$('#compose-modal').modal('show');
	}
	else
	{
		$.get('cname.php?cid='+sid, function(data) {
        
		var str= data;
		var stra = str.split("@")
		var fstr1 = stra.shift()
		var addr = stra.shift()  
		var mob = stra.shift() 
		var mail = stra.shift() 
		
		$('#addr').val(addr);
		$('#cmob').val(mob);
		$('#mail').val(mail);
		}); 
	}
}

 function check(evt)
{
	evt =(evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode > 31 && (charCode < 48 || charCode > 57))
	{
		return false;
	}
	return true;	
}

function addspnm()
{
	var nm=encodeURIComponent(document.getElementById('nm').value);
	var addr1=encodeURIComponent(document.getElementById('addr1').value);
	var email=encodeURIComponent(document.getElementById('email').value);
	var mob1=encodeURIComponent(document.getElementById('mob1').value);
	var dob=encodeURIComponent(document.getElementById('dob').value);
	var doa=encodeURIComponent(document.getElementById('doa').value);
	
	$('#adpnm').load("sentrysadd.php?nm="+nm+"&addr="+addr1+"&email="+email+"&mob1="+mob1+"&dob="+dob+"&doa="+doa).fadeIn('fast');
}
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
			<h1 align="center">Docket Call<small>Entry</small></h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Docket Call</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
                   

<form name="f" method="post" action="docket_calls.php">
<div class="box box-success">
<table border="0" class="table table-hover table-striped table-bordered">
<tr>
<td width="15%" align="right" style="padding-top:17px"><b>Customer :</b></td>
<td width="35%" align="left">
	<select name="cnm" id="cnm" class="form-control" size="1" onchange="gtid()">
	<Option value="">---Select---</option>
	<option value="Add">---Add New Customer---</option>
	<?php 
		$data=mysqli_query($conn,"Select * from main_cust order by nm");
		while($row=mysqli_fetch_array($data))
		{
			$cust_sl=$row['sl'];
			$cust_nm=$row['nm'];
			$cust_cont=$row['cont'];
			echo "<option value='".$cust_sl."'>".$cust_nm." ( ".$cust_cont." ) </option>";
		}
	?>
	</select>
</td>
<td width="15%" align="right" style="padding-top:17px"><b>Mobile :</b></td>
<td width="35%" align="left">
<input type="text" class="form-control" id="cmob" name="cmob" onkeypress="return check(event)" size="50" placeholder="Enter Mobile No" maxlength="10">
</td>
</tr>
<tr>
<td align="right" style="padding-top:17px"><b>Address :</b></td>
<td align="left">
<input type="text" class="form-control" id="addr" name="addr" value="" size="50" placeholder="Enter Address">
</td>
<td align="right" style="padding-top:17px"><b>Date :</b></td>
<td align="left">
<input type="text" class="form-control" id="cdt" name="cdt" value="<?php  echo $cdt;?>" size="50" readonly>
</td>
</tr>
<tr>
<td align="right" style="padding-top:17px"><b>Brand :</b></td>
<td align="left">
	<select name="brand" id="brand" class="form-control" size="1">
	<Option value="">---Select---</option>
	<?php 
		$data1=mysqli_query($conn,"Select * from main_brand order by brand");
		while($row1=mysqli_fetch_array($data1))
		{
			$brand_sl=$row1['sl'];
			$brand_nm=$row1['brand'];
			echo "<option value='".$brand_sl."'>".$brand_nm."</option>";
		}
	?>
	</select>
</td>
<td align="right" style="padding-top:17px"><b>Model :</b></td>
<td align="left">
<input type="text" class="form-control" id="model" name="model" value="" size="50" placeholder="Enter Model">
</td>
</tr>
<tr>
<td align="right" style="padding-top:17px"><b>Serial Number:</b></td>
<td align="left">
<input type="text" class="form-control" id="serial_no" name="serial_no" value="" size="50" placeholder="Enter Model">
</td>
<td align="right" style="padding-top:17px"><b>Call Type :</b></td>
<td align="left">
	<select name="call_type" id="call_type" class="form-control" size="1">
	<Option value="">---Select---</option>
	<?php 
		$data2=mysqli_query($conn,"Select * from main_call_typ order by call_typ");
		while($row2=mysqli_fetch_array($data2))
		{
			$call_typ_sl=$row2['sl'];
			$call_typ_nm=$row2['call_typ'];
			echo "<option value='".$call_typ_sl."'>".$call_typ_nm."</option>";
		}
	?>
	</select>
</td>
</tr>
<tr>
<td align="right" style="padding-top:17px"><b>Remark :</b></td>
<td align="left" colspan="3">
<textarea name="remark" id="remark" class="form-control" placeholder="Enter Remark"></textarea>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:center;">
<input type="submit" class="btn btn-primary" id="Button1" name="" value="Submit" >
</td>
</tr>
</table>
</div>
</form>
	 
                                </div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
      <div id="adpnm"></div>            
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true"  >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" id="cnt1">
			</div>
        </div>
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
	$('#cnm').chosen({no_results_text: "Oops, nothing found!",});
</script>

    </body>
</html>