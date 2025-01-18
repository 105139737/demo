<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sl=base64_decode($_REQUEST['sl']);
$data=mysqli_query($conn,"select * from main_sale_per where sl='$sl'")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
	$spid=$row['spid'];
	$nam=$row['nm'];
	$mob=$row['mob'];
	$addr=$row['addr'];
	$typ=$row['typ'];
	$brncd=$row['brncd'];
}
?>
<html>
<head>
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
select.sc {
	width: 430px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #666666;
	border: 1px solid #d8d8d8;
	padding-top: 2px;
	padding-right: 0px;
	padding-bottom: 2px;
	padding-left: 7px;
	padding: 7px;
}
</style>
<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css">
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

<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>

<script>
function isNumber(evt) 
 {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if(iKeyCode < 48 || iKeyCode > 57)
		{
            return false;
        }
        return true;
 }    
   $(document).ready(function()
{
	var jQueryDatePicker1Opts =
	{
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		showButtonPanel: false,
		showAnim: 'show'
	};
	$("#gstdt").datepicker(jQueryDatePicker1Opts);
});
 function check1()
{
	if(document.getElementById('spid').value=='')
	{
		alert("Please Enter ID !");
		document.form1.cnm.focus();
		return false;
	}
	if(document.getElementById('mob').value=='')
	{
		alert("Please Enter Mobile No. !");
		document.form1.mob.focus();
		return false;
	}

	else
	{
		document.forms["form1"].submit();
	}
}
</script>
</head>
<body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                Sales Person
                        <small>Update</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Sales Person</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">
<form method="post" action="sale_per_edts.php" id="form1" name="form1" onsubmit="return check1()">
<input type="hidden" id="sl" name="sl" value="<?php  echo $sl;?>">

<div class="box box-success">
<table width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td style="text-align:right; padding-top:15px;">ID:</td>
<td>
<input type="text" id="spid" name="spid" value="<?php  echo $spid;?>" readonly onkeyup="this.value=this.value.toUpperCase();" class="form-control" placeholder="Please Enter ID">
</td>
<td style="text-align:right; padding-top:15px;">Name :</td>
<td>
<input type="text" id="nm" name="nm" value="<?php  echo $nam;?>" class="form-control" placeholder="Please Enter Name">
</td>
</tr>
<tr>
<td style="text-align:right; padding-top:15px;">Mobile No. :</td>
<td>
<input type="text" class="form-control" value="<?php  echo $mob;?>" id="mob" name="mob" onkeypress="return isNumber(event)" maxlength="10" placeholder="Please Enter Mobile No.">
</td>


<td style="text-align:right; padding-top:15px;">Address:</td>
<td colspan="3">
<input type="text" class="form-control" id="addr" name="addr" value="<?php  echo $addr;?>" placeholder="Please Enter Address">
</td>
</tr>
<tr>
<td style="text-align:right; padding-top:15px;">Type:</td>
<td >
<select class="form-control" id="typ" name="typ">
<option value="">----Select----</option>
<option value="4" <?php  if($typ=='4'){echo 'selected';}?>>Salesman</option>
<option value="8" <?php  if($typ=='8'){echo 'selected';}?>>Shop</option>
</select>
</td>

<td align="right" style="padding-top:15px;">Branch : </td>
<td>
<select name="brncd" class="form-control"  tabindex="1"   size="1" id="brncd" required>
<?php 
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---ALL---</option>
<?php 
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$bsl=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<?php  echo $bsl;?>"<?php  if($bsl==$brncd){echo 'selected';}?>><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
</td>
</tr>
<tr>
<td colspan="4" style="text-align:right; padding-right:8px;">
<input type="submit" class="btn btn-success" id="Button1" name="Button1" value="Update">
</td>
</tr>
</table>
	 
</div>
</form><!-- /.box-body -->
<div class="box-footer clearfix no-border"></div>
</div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->


    </body>
</html>