<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sl=base64_decode($_REQUEST['sl']);
$data=mysqli_query($conn,"select * from main_bank where sl='$sl'")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
	$brncd=$row['brncd'];
	$bnm1=$row['bnm'];
	$ac=$row['ac'];
	$ifsc=$row['ifsc'];
	$branch=$row['branch'];
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
</script>
</head>
<body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                New Bank
                        <small>Update</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">New Bank</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">
<form method="post" action="new_bank_edts.php" id="form1" name="form1" onsubmit="return check1()">
<input type="hidden" id="sl" name="sl" value="<?php  echo $sl;?>">

<div class="box box-success">
<table width="860px" class="table table-hover table-striped table-bordered">
<tr>

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
<td style="text-align:right; padding-top:15px;">Bank Name:</td>
<td>
<input type="text" id="bnm" name="bnm" value="<?php  echo $bnm1;?>" class="form-control" placeholder="Please Enter Bank Name">
</td>
<td style="text-align:right; padding-top:15px;">A/C No. :</td>
<td>
<input type="text" id="ac" name="ac" value="<?php  echo $ac;?>" class="form-control" placeholder="Please Enter A/C No.">
</td>
</tr>
<tr>
<td style="text-align:right; padding-top:15px;">IFSC Code :</td>
<td>
<input type="text" class="form-control" value="<?php  echo $ifsc;?>" id="ifsc" name="ifsc" placeholder="Please Enter IFSC Code">
</td>


<td style="text-align:right; padding-top:15px;">Bank Branch:</td>
<td colspan="3">
<input type="text" class="form-control" id="branch" name="branch" value="<?php  echo $branch;?>" placeholder="Please Enter Bank Branch">
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