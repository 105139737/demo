<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
$fdt=date('Y-m-d');
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
#sfdtl
{
	border : none;
	border-radius: 3px;
	background-image: url(images/bg1.png);
	width : 195px;
	
	display : none;
	color: #fff;
	position : absolute;
	left : 6%;
	top : 46%;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
	z-index:1000;
}
</style> 
<script>
 function get_list()
{
	 var all= document.getElementById('all').value;
	 var tp1= document.getElementById('tp1').value;
	 var brncd1= document.getElementById('brncd1').value;
	 var inv_typ1= document.getElementById('inv_typ1').value;
	 var brand1= document.getElementById('brand1').value;
	 var stat= document.getElementById('stat').value;

	$('#div_list').load('billtyp_list.php?all='+encodeURIComponent(all)+'&tp1='+tp1+'&brand1='+brand1+'&brncd1='+brncd1+'&inv_typ1='+inv_typ1+'&stat='+stat).fadeIn('fast');
}


</script>
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
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
dateFormat: 'yy-mm-dd',
changeMonth: true,
changeYear: true,
showButtonPanel: false,
showAnim: 'show'
};
$("#fdt").datepicker(jQueryDatePicker2Opts);
$("#fdt").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
});
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
function act(sl,val)
{
 $('#div_list').load('billtyp_update.php?sl='+sl+'&val='+val).fadeIn('fast');
}
</script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>      
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                   Bill Type
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Bill Type</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
							
<body onload="get_list()">
<div class="box box-success">
<form method="post" action="billtyp_ntrys.php" id="form1" name="form1">                    
<table border="0" class="table table-hover table-striped table-bordered">
<tr>

<td align="left" >
<b>Branch : </b>
<select name="brncd" class="form-control" tabindex="1"  size="1" id="brncd" >
<?
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---Select---</option>
<?
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>

</td>
<td  align="left"  >
<b>Bill Address :</b>
<textarea class="form-control" name="adrs"  id="adrs"  tabindex="1"  placeholder="Enter Address...."></textarea>
</td>
</tr>
<tr>
<td  align="left">
<b>Type :</b>
<select name="tp" id="tp" class="form-control"  tabindex="1"  >
<option value="">---Select---</option>		
<option value="1">Retail</option>		
<option value="2">Wholesale</option>		
</select>
</td>
<td>
<label><b>Brand : </b></label><br>
<select name="brand[]" id="brand" class="form-control" tabindex="1" multiple >
<?
$dsql=mysqli_query($conn,"select * from main_catg order by sl") or die (mysqli_error($conn));
while($erow=mysqli_fetch_array($dsql))
{
$bsl=$erow['sl'];
$cnm=$erow['cnm'];
?>
<option value="<?php echo $bsl;?>"><?php echo $cnm;?></option>
<?
}
?>
</select>
</td>
</tr>
<tr>
<td  align="left" width="50%">
<b>Alise :</b>
<input type="text" class="form-control" name="als" id="als"  tabindex="1"   placeholder="Enter Alise....">
</td>
<td  align="left" width="50%">
<b>Session :</b>
<input type="text" class="form-control" name="ssn"  tabindex="1"   id="ssn" placeholder="Enter Session....">
</td>
</tr>
<tr>
<td  align="left" width="50%">
<b>Starting No. :</b>
<input type="text" class="form-control" name="start_no" id="start_no" value="1" onkeypress="return check(event)"  tabindex="1"   placeholder="Enter Starting No. ....">
</td>
<td  align="left" width="50%">
<b>Invoice Type :</b>
<select name="inv_typ" id="inv_typ" class="form-control"  tabindex="1" required >
<option value="0">Invoice</option>		
<option value="1">Return</option>		
<option value="2">Service</option>
<option value="33">Income</option>		
<option value="44">Expense</option>		
<option value="J01">Journal</option>		
<option value="CN01">Contra</option>		
<option value="77">Customer Received</option>		
<option value="88">Supplier Payment</option>		
<option value="C01">Debit Note</option>			
<option value="CC01">Customer Credit Note</option>			
</select>
</td>
</tr>


<tr>
<td align="right" colspan="4" width="30%">
<input type="button" class="btn btn-warning" value="Auto Setup" onclick="autosetup()">
<input type="submit" class="btn btn-success" value="Submit"  tabindex="1"  name="B1" >
</td>
</tr>
</table>
</div>
</form>
<div class="box box-success" >
<table border="0" class="table table-hover table-striped table-bordered">
<tr>
<td  align="left">
<b>Type :</b>
<select name="tp1" id="tp1" class="form-control"  tabindex="1"  >
<option value="">---ALL---</option>		
<option value="1">Retail</option>		
<option value="2">Wholesale</option>		
</select>
</td>
<td>
<b>Brand : </b><br>
<select name="brand1" id="brand1" class="form-control"  tabindex="1"  >
<option value="">---ALL---</option>
<?
$dsql=mysqli_query($conn,"select * from main_catg order by sl") or die (mysqli_error($conn));
while($erow=mysqli_fetch_array($dsql))
{
$bsl=$erow['sl'];
$cnm=$erow['cnm'];
?>
<option value="<?php echo $bsl;?>"><?php echo $cnm;?></option>
<?
}
?>
</select>
</td>
<td align="left" >
<b>Branch : </b>
<select name="brncd1" class="form-control"  tabindex="1"   size="1" id="brncd1" >
<?
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---ALL---</option>
<?
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $sl;?>"><? echo $bnm;?></option>
<?
}
?>
</select>
</td>

<td align="left">
<b>Status : </b>
<select name="stat" id="stat" class="form-control">
<option value="0">Active</option>
<option value="1">Deactive</option>
</select>
</td>

<td  align="left">
<b>Invoice Type :</b>
<select name="inv_typ1" id="inv_typ1" class="form-control"  tabindex="1">
<option value="">---All---</option>		
<option value="0">Invoice</option>		
<option value="1">Return</option>
<option value="2">Service</option>		
<option value="33">Income</option>		
<option value="44">Expense</option>	
<option value="J01">Journal</option>		
<option value="CN01">Contra</option>		
<option value="77">Customer Received</option>		
<option value="88">Supplier Payment</option>		
<option value="C01">Debit Note</option>		
<option value="CC01">Customer Credit Note</option>			
</select>
</td>
<td  align="left" >
<b>Search :</b>
<input type="text" class="form-control"  tabindex="1"  name="all" id="all" placeholder="Search Here....">
</td>

<td align="left" >
<br>
<input type="button" class="btn btn-info" value="Show" name="B1" onclick="get_list()" >
</td>
</tr>
</table>
<div id="div_list"></div>
</div>	

     <div class="modal fade" id="myModal2" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Auto Setup</h4>
			</div>
			<div class="modal-body" id="mcntt2">
			  
			</div>
		  </div>
		  
		</div>
	  </div>
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>
 function autosetup()
{
	$('#mcntt2').load('autosetup_billtyp.php').fadeIn("fast");
	$('#myModal2').modal('show');
}

$('#brand').chosen({
no_results_text: "Oops, nothing found!",
});
$('#brand1').chosen({
no_results_text: "Oops, nothing found!",
});
</script> 
</body>