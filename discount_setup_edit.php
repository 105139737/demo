<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";

$sl=base64_decode($_REQUEST['sl']);

$data= mysqli_query($conn,"select * from main_discount where  sl='$sl'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	$custid1=$row['custid'];
	$days=$row['days'];
	$prefnd=$row['prefnd'];
	$x=$row['sl'];
}
$query2="select * from main_cust WHERE sl='$custid1' order by nm";
$result2=mysqli_query($conn,$query2);
while($rw2=mysqli_fetch_array($result2))
{
	$custid=$rw2['nm'];
}

?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php
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

#jQueryDatePicker1
{
   border: 1px #C0C0C0 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}

</style> 
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<script>

function check1()
{
	if(document.form1.custid.value=='')
	{
	alert("Please Select Customer !");
	document.form1.custid.focus();
	return false;
	}
	
	if(document.form1.days.value=='')
	{
	alert("Please Enter Dayes !");
	document.form1.days.focus();
	return false;
	}
	
	if(document.form1.prefnd.value=='')
	{
	alert("Please Enter Refundable !");
	document.form1.prefnd.focus();
	return false;
	}
	else
	{
	 document.forms["form1"].submit();
	}
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
	Discount
		<small>Entry</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
		<li class="active">Discount</li>
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

<form method="post" action="discount_setup_edits.php" id="form1" onSubmit="return check1()" name="form1">
<input type="hidden" id="sl" name="sl" value="<?php echo $sl;?>">
<center>
<div class="box box-success" >
<table border="0"  width="800px"  align="center" class="table table-hover table-striped table-bordered">
<tr>
<td align="left">Customer:
	<input type="text" name="custid_" id="custid_" value="<?php echo $custid;?>" class="datalist form-control" list="datalist" onkeyup="datalist(this.value,'custid')">
	<input type="hidden" name="custid" id="custid">
</td>
<td align="left" >Dayes:
<input type="text" name="days" id=="days" value="<?php echo $days;?>" class="form-control" size="20" onkeypress="return check(event)" placeholder="Enter Dayes">
</td>
<td align="left">% Refundable:
<input type="text" name="prefnd" id="prefnd" value="<?php echo $prefnd;?>" class="form-control" size="20" onkeypress="return check(event)" placeholder="Enter % Refundable">
</td>
</tr>
 <tr>

</tr>
<tr >
<td colspan="6" align="right"  style="padding-right: 8px;">
<input type="submit" value="Update" class="btn btn-primary" name="B1">
<input type="reset" class="btn btn-primary" value="Reset" name="B2">
</td>
</tr>
</table>
</div>

</form><!-- /.box-body -->

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
<script src="jquery-json-to-datalist.js"></script>
<script>
datalist('<?php echo $custid;?>','custid')

function datalist(str,fld)
{
	if(str.length>2)
	{
		$('.datalist').jsonToDatalist({ jsonPath:'gen_cust_json.php?str='+encodeURIComponent(str)+'&fld='+fld });
	}
}
</script>
</body>
</html>