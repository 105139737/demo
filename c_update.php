<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";

$sl=base64_decode($_REQUEST['sl']);

$data= mysqli_query($conn,"select * from main_cust where sl='$sl'")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
	$cnm=$row['nm'];
	$addr=$row['addr'];
	$cont=$row['cont'];
	$mail=$row['mail'];
	$vat_no=$row['vat_no'];
	$gstin=$row['gstin'];
	$pan=$row['pan'];
	$typ=$row['typ'];
	$gstdt=$row['gstdt'];
	$fst=$row['fst'];
	$nmp=$row['nmp'];
	$gstdt1=$row['gstdt'];
	$brand=$row['brand'];
	$sale_per=$row['sale_per'];
	$pin=$row['pin'];
	$town=$row['town'];
	$distn=$row['distn'];
	$brncd=$row['brncd'];
	$credit_limit=$row['credit_limit'];
	$gtm=$row['gtm'];
	$isfin=$row['isfin'];
}
if($gstdt!='0000-00-00')
{
$gstdt=date('d-m-Y', strtotime($gstdt));
}
else
{
	$gstdt='';
}
if($fst==''){$fst=1;}

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

if(document.getElementById('cnm').value=='')
{
alert("Please Enter Customer Name !");
document.form1.cnm.focus();
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
                        <small>Update</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Customer</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
 

<form method="post" action="c_updates.php" id="form1"  name="form1" onsubmit="return check1()">
<input type="hidden" id="sl" name="sl" value="<?php  echo $sl;?>">
<center>
<div class="box box-success" >
<table width="860px" class="table table-hover table-striped table-bordered">
<tr>
<td width="50%">
<b>Customer Name :</b>
<input type="text" id="cnm" name="cnm" value="<?php  echo $cnm;?>" class="form-control" placeholder="Please Enter Customer Name">
</td>

<td align="left"  width="50%">
<b>Printing Name :</b>
<input type="text" id="nmp" name="nmp" value="<?php  echo $nmp;?>" class="form-control" placeholder="Please Enter Printing Name">
</td>	

</tr>
<tr>
<td>
<b>Mobile No. :</b>
<input type="text" class="form-control" id="mob" name="mob" value="<?php  echo $cont;?>" onkeypress="return isNumber(event)" maxlength="10" placeholder="Please Enter Mobile No.">
</td>
<td>
<b>Pin :</b>
<input type="text" class="form-control" id="pin" name="pin" value="<?php  echo $pin;?>" placeholder="Please Enter Pin" onkeypress="return isNumber(event)" maxlength="6">
</td>
</tr>

<tr>
<td>
<b>Town/ City :</b>
<input type="text" class="form-control" id="town" name="town" value="<?php  echo $town;?>" placeholder="Please Enter Town/ City">
</td>
<td>
<b>Distance :</b>
<input type="text" class="form-control" id="distn" name="distn" value="<?php  echo $distn;?>" placeholder="Please Enter Distance">
</td>
</tr>
<tr>
<td align="left">
<b>Brand : </b>
<select id="brand"  name="brand" class="form-control" >
<option value="" >---Select---</option>

	<?php 
	$sq="SELECT * FROM main_catg WHERE sl>0 ORDER BY sl";
	$res = mysqli_query($conn,$sq) or die(mysqli_error($conn));
	while($ro=mysqli_fetch_array($res))
	{
	?>
    <option value="<?php  echo $ro['sl'];?>" <?php if($brand==$ro['sl']){?> selected <?php  } ?>><?php  echo $ro['cnm'];?></option>
	<?php }?>
</select>
</td>

<td>
<b>E-Mail ID :</b>
<input type="text" class="form-control" id="email" name="email" value="<?php  echo $mail;?>" placeholder="Please Enter E-Mail">
</td>

</tr>



<tr>
<td>
<b>GSTIN :</b>
<input type="text" class="form-control" id="gstin" name="gstin" onblur="gstinn()"  value="<?php  echo $gstin;?>" placeholder="Please Enter GSTIN">
</td>
<td>
<b>PAN No :</b>
<input type="text" class="form-control" id="pan" name="pan" value="<?php  echo $pan;?>" placeholder="Please Enter PAN No">
</td>
</tr>
<tr>
<td>
<b>GSTIN Applicable Date : </b>
<input type="text" class="form-control" id="gstdt" name="gstdt" value="<?php  echo $gstdt;?>" placeholder="Enter GSTIN Applicable Date">
</td>
<td width="30%">
<b>Aadhaar No.:</b>
<input type="text" id="vat_no" name="vat_no" value="<?php  echo $vat_no;?>" class="form-control" placeholder="Please Enter Vat No." onkeypress="return isNumber(event)">
</td>       
</tr>
<tr>
<td align="left">
<b>State : </b>
<select id="fst"  name="fst" class="form-control" >
	<?php 
	$sql="SELECT * FROM main_state WHERE sl>0 ORDER BY sn";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	while($row=mysqli_fetch_array($result))
	{
	?>
    <option value="<?php  echo $row['sl'];?>"<?php if($row['sl']==$fst){echo 'selected';}?>><?php  echo $row['sn'];?> - <?php  echo $row['cd'];?></option>
	<?php }?>
</select>

</td>
<td >
<b>Address :</b>
<input type="text" class="form-control" id="addr" name="addr" value="<?php  echo $addr;?>" placeholder="Please Enter Address">
</td>
</tr>
<tr>
<td>
<b>Branch : </b>
<select name="sale_per" id="sale_per" class="form-control" style="display:none">
<option value="">---Select---</option>
<?php 
$dsql=mysqli_query($conn,"select * from main_sale_per order by sl") or die (mysqli_error($conn));
while($erow=mysqli_fetch_array($dsql))
{
$bsl=$erow['sl'];
$spid=$erow['spid'];
?>
<option value="<?php  echo $spid;?>"<?php if($spid==$sale_per){echo 'selected';}?>><?php  echo $spid;?></option>
<?php 
}
?>
</select>
<select name="brncd" class="form-control" size="1" id="brncd"   >
<?php 
if($user_current_level<0)
{
$query="Select * from main_branch";
?>
<option value="">---Select---</option>
<?php 
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
<option value="<?php  echo $sl;?>"<?php if($brncd==$sl){echo 'selected';}?>><?php  echo $bnm;?></option>
<?php 
}
?>
</select>
</td>
<td >
<b>Type : </b>

<select id="ctyp" name="ctyp" class="form-control">
<?php 
$p=mysqli_query($conn,"select * from main_cus_typ order by sl desc") or die (mysqli_error($conn));
while($rw2=mysqli_fetch_array($p))
{
?>
<option value="<?php  echo $rw2['sl'];?>" <?php if($typ==$rw2['sl']){echo 'selected';}?>><?php  echo $rw2['tp'];?></option>
<?php 
}
?>
</select>
</td> 
</tr>
<tr>
<td >
<b>Credit Limit :</b>
<input type="text" class="form-control" id="credit_limit" name="credit_limit" value="<?php  echo $credit_limit;?>" placeholder="Please Enter Credit Limit">
</td>        
<td>
<b>GTM Code : </b>
<input type="text" class="form-control" value="<?php  echo $gtm;?>"  id="gtm" name="gtm" placeholder="Enter GTM Code">
</td>
</tr>
<tr>
<td >
<b>Is Finance : </b>
<select id="isfin" name="isfin" class="span2 form-control">

<option value="0" <?php if($isfin==0){echo 'selected';}?> >No</option>
<option value="1" <?php if($isfin==1){echo 'selected';}?> >Yes</option>

</select>
</td> 
<td >
</td> 

</tr>
<tr>
<td colspan="2" style="text-align:right; padding-right:8px;"><br>
<input type="submit" class="btn btn-success" id="Button1" name="Button1" value="Update (alt+s)">
</td>
</tr>
</table>	 
</div>
</form><!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                
                                </div>
                       
							</div>
							
							<!-- /.box -->

                        <!-- right col -->
                   <!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
   

        <!-- add new calendar event modal -->

     

    </body>
</html>