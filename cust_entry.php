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
<link rel="stylesheet" href="chosen.css">
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
	if(document.getElementById('cnm').value=='')
	{
		alert("Please Enter Customer Name !");
		document.form1.cnm.focus();
		return false;
	}
	else if(document.getElementById('brncd').value=='')
	{
		alert("Please Select Branch Name !");
		document.form1.brncd.focus();
		return false;
	}
	else
	{
		document.forms["form1"].submit();
	}
}
function gstinn()
{
var gstin=document.getElementById('gstin').value;
$.get('gst_pan.php?gstin='+gstin, function(data) {

var str= data;
var stra = str.split("@")
var pan = stra.shift()
var st = stra.shift()
if(gstin!='')
{
$('#pan').val(pan);
$('#fst').val(st);
}
else
{
$('#pan').val('');
$('#fst').val('1');
}
//$("#myselect").val(3);
}); 
} 
shortcut.add("alt+s", function() {
if (confirm("Are Sure To Submit ?")) 
{
document.forms["form1"].submit();
}
});
</script>
</head>
<body>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 align="center">
                Customer
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Customer</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
 


<form method="post" action="cust_entrys.php" id="form1" name="form1" onsubmit="return check1()">
<div class="box box-success">
<table width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td width="50%">
<b>Customer Name :</b>
<input type="text" id="cnm" name="cnm" value="" class="form-control" placeholder="Please Enter Customer Name">
</td>

<td align="left"  width="50%">
<b>Printing Name :</b>
<input type="text" id="nmp" name="nmp" value="" class="form-control" placeholder="Please Enter Printing Name">
</td>	

</tr>
<tr>
<td>
<b>Mobile No. :</b>
<input type="text" class="form-control" id="mob" name="mob" value="" onkeypress="return isNumber(event)" maxlength="10" placeholder="Please Enter Mobile No.">
</td>
<td>
<b>Pin :</b>
<input type="text" class="form-control" id="pin" name="pin" value="" placeholder="Please Enter Pin" onkeypress="return isNumber(event)" maxlength="6">
</td>
</tr>
<tr>
<td>
<b>Town/ City :</b>
<input type="text" class="form-control" id="town" name="town" value="" placeholder="Please Enter Town/ City">
</td>
<td>
<b>Distance :</b>
<input type="text" class="form-control" id="distn" name="distn" value="" placeholder="Please Enter Distance">
</td>
</tr>

<tr>
<td align="left">
<b>Brand : </b>
<select id="brand"  name="brand" class="form-control" >
<option value="" >---Select---</option>

	<?
	$sq="SELECT * FROM main_catg WHERE sl>0 ORDER BY sl";
	$res = mysqli_query($conn,$sq) or die(mysqli_error($conn));
	while($ro=mysqli_fetch_array($res))
	{
	?>
    <option value="<?=$ro['sl'];?>"><?=$ro['cnm'];?></option>
	<?}?>
</select>
</td>

<td>
<b>E-Mail ID :</b>
<input type="text" class="form-control" id="email" name="email" value="" placeholder="Please Enter E-Mail">
</td>
</tr>

<tr>
<td>
<b>GSTIN :</b>
<input type="text" class="form-control" id="gstin" name="gstin" onblur="gstinn()"  value="" placeholder="Please Enter GSTIN">
</td>
<td>
<b>PAN No :</b>
<input type="text" class="form-control" id="pan" name="pan" value="" placeholder="Please Enter PAN No">
</td>
</tr>
<tr>
<td>
<b>GSTIN Applicable Date : </b>
<input type="text" class="form-control" id="gstdt" name="gstdt" placeholder="Enter GSTIN Applicable Date">
</td>
<td width="30%">
<b>Aadhaar No.:</b>
<input type="text" id="vat_no" name="vat_no" value="" class="form-control" placeholder="Please Enter Vat No." onkeypress="return isNumber(event)">
</td>       
</tr>
<tr>
<td align="left">
<b>State : </b>
<select id="fst"  name="fst" class="form-control" >
	<?
	$sql="SELECT * FROM main_state WHERE sl>0 ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result))
	{
	?>
    <option value="<?=$row['sl'];?>"<?if($row['sl']=='1'){echo 'selected';}?>><?=$row['sn'];?> - <?=$row['cd'];?></option>
	<?}?>
</select>

</td>
<td >
<b>Address :</b>
<input type="text" class="form-control" id="addr" name="addr" value="" placeholder="Please Enter Address">
</td>
</tr>
<tr>
<td>
<b>Sales Person : </b>
<select name="sale_per" id="sale_per" class="form-control">
<option value="">---Select---</option>
<?
$dsql=mysqli_query($conn,"select main_sale_per.spid,main_sale_per.nm from main_sale_per INNER JOIN main_signup ON main_sale_per.spid=main_signup.username where main_signup.actnum='0'") or die (mysqli_error($conn));
while($erow=mysqli_fetch_array($dsql))
{
$spid=$erow['spid'];
$nm=$erow['nm'];
?>
<option value="<?php echo $spid;?>"><?php echo $nm;?> - <?php echo $spid;?></option>
<?
}
?>
</select>


</td>
<td >
<b>Type : </b>
<select id="ctyp" name="ctyp" class="span2 form-control">
<?
$p=mysqli_query($conn,"select * from main_cus_typ order by sl desc") or die (mysqli_error($conn));
while($rw2=mysqli_fetch_array($p))
{
?>
<option value="<?=$rw2['sl'];?>" ><?=$rw2['tp'];?></option>
<?
}
?>
</select>
</td>       
</tr>
<tr>
<td>
<b>Branch:</b><br>
<select name="brncd" class="form-control" size="1" id="brncd"   >
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
<td >
<b>Credit Limit :</b>
<input type="text" class="form-control" id="credit_limit" name="credit_limit" value="" placeholder="Please Enter Credit Limit">
</td>      
</tr>
<tr>
<td>
<b>GTM Code : </b>
<input type="text" class="form-control" id="gtm" name="gtm" placeholder="Enter GTM Code">
</td>
<td >
<b>Is Finance : </b>
<select id="isfin" name="isfin" class="span2 form-control">

<option value="0" >No</option>
<option value="1" >Yes</option>

</select>
</td>       
</tr>
<tr>
<td colspan="2" style="text-align:right; padding-right:8px;">
<input type="submit" class="btn btn-success" id="Button1" name="Button1" value="Submit (alt+s)">
</td>
</tr>
</table>
	 
                                </div>
								</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                       
							</div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->


    </body>
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>
$('#sale_per').chosen({
no_results_text: "Oops, nothing found!",
});
</script>
</html>