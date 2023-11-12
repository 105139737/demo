<?
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
?>
<html>
<head>
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
                New Bank
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">New Bank</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">
<form method="post" action="new_banks.php" id="form1" name="form1" onsubmit="return check1()">
<div class="box box-success">
<table width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td align="right">Branch : </td>
<td>
<select name="brncd" class="form-control"  tabindex="1"   size="1" id="brncd" required>
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
<td></td>
<td></td>
</tr>
<tr>
<td style="text-align:right; padding-top:15px;">Bank Name:</td>
<td>
<input type="text" id="bnm" name="bnm" value="" class="form-control" placeholder="Please Enter Bank Name">
</td>
<td style="text-align:right; padding-top:15px;">A/C No. :</td>
<td>
<input type="text" id="ac" name="ac" value="" class="form-control" placeholder="Please Enter A/C No.">
</td>
</tr>
<tr>
<td style="text-align:right; padding-top:15px;">IFSC Code :</td>
<td>
<input type="text" class="form-control" id="ifsc" name="ifsc" placeholder="Please Enter IFSC Code">
</td>


<td style="text-align:right; padding-top:15px;">Bank Branch:</td>
<td colspan="3">
<input type="text" class="form-control" id="branch" name="branch" value="" placeholder="Please Enter Bank Branch">
</td>
</tr>
<tr>
<td colspan="4" style="text-align:right; padding-right:8px;">
<input type="submit" class="btn btn-success" id="Button1" name="Button1" value="Submit">
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