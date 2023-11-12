<?php
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add On Entry</title>
<link href="advancedtable.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
<style type="text/css">
#sfdtl
{
	border : none;
	border-radius: 15px;
	background-image: url(images/bg1.png);
	width : 850px;
	
	display : none;
	color: #000;
	position : absolute;
	left : 350px;
	top : 250px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 13px;
}
#underlay{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background-color:#000;
    -moz-opacity:0.5;
    opacity:.50;
    filter:alpha(opacity=50);
}
</style>
<script>
function isNumber(evt) 
 {
	var iKeyCode = (evt.which) ? evt.which : evt.keyCode
	if(iKeyCode < 46 || iKeyCode > 57)
	{
	return false;
	}
	return true;
 }
$(document).ready(function()
{
	var jQueryDatePicker2Opts =   
	{      
	dateFormat: 'dd-mm-yy',      
	changeMonth: true,      
	changeYear: true,      
	showButtonPanel: false,      
	showAnim: 'show'   };      
	$("#dt").datepicker(jQueryDatePicker2Opts);   
	$("#dt").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});   
});

function title1()
{
var brncd=document.getElementById('brncd').value;
$("#title").load("brncd_name.php?brncd="+brncd).fadeIn('fast');	
}

</script>
<style type="text/css"> 
a
{
   color: black;
   outline: none;
   text-decoration: none;
}

</style>
<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css"> 

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
input.sc {
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
<link rel="stylesheet" href="dark-hive/jquery.ui.all.css" type="text/css">
<script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>        
<script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>        
<script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>   
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>   
<style type="text/css">
.ui-datepicker
{   
font-family: Arial;   
font-size: 13px;   
z-index: 1003 !important;   
display: none;
}
</style>
</head>
<body onload="title1()">
 <aside class="right-side">
  <section class="content-header">
                    <h1 align="center">
                 Add On
                        <small>Entry</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active"> Add On</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="add_ons.php" id="Form1">
<input type="hidden" name="dldgr" id="dldgr" value="4">
<input type="hidden" name="cldgr" id="cldgr" value="-4">

<div class="box box-success">
<table class="table table-hover table-striped table-bordered">
<tr>
<td align="right" width="10%"><font color="red">*</font><b>Branch:</b></td>
<td align="left" width="20%">
<select name="brncd" class="form-control" size="1" id="brncd" onchange="title1()">
<?
if($user_current_level<0)
{
$query="Select * from main_branch";
}
else
{
$query="Select * from main_branch where sl='$branch_code'";
}
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$slb=$R['sl'];
$bnm=$R['bnm'];

?>
<option value="<? echo $slb;?>" <?if($slb==$brncd){echo 'selected';}?>><? echo $bnm;?></option>
<?
}
?>
</select>
</td>
<td align="right" width="10%"><font color="red">*</font><b>Date :</b></td>
<td align="left" width="25%">
<input type="text" name="dt" id="dt" value="<?php echo date('d-m-Y');?>" class="form-control" required>
</td>
<td align="right" width="10%"><font color="red">*</font><b>Customer :</b></td>
<td width="25%">
<select name="cid" class="form-control" id="cid">
<option value="">---All---</option>
<?
$query="Select * from  main_cust order by nm";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sid=$R['sl'];
$nm=$R['nm'];
$cont=$R['cont'];
$addr=$R['addr'];
?>
<option value="<? echo $sid;?>"><? echo $nm;?> - <? echo $cont;?> - <? echo $addr;?></option>
<?
}
?>
</select>
</td>
</tr>

<tr>
<td align="right"><font color="red">*</font><b>Amount :</b></td>
<td align="left">
<input type="text" name="amm" id="amm" class="form-control" onkeypress="return isNumber(event)" required>
</td>	

<td align="right" ><b>Narration :</b></td>
<td align="left" colspan="3">
<input type="text" name="nrtn" id="nrtn" size="40" class="form-control">
</td>   
</tr>
   
<tr>
<td colspan="6" align="right"><input type="submit" class="btn btn-success" value="Submit"></td>
</tr>

</table>
</div>




<!-- Modal Box Start-->
<div class="modal" id="myModal">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-times"></i>
				</button>
				<h4>Opening Balance Edit</h4>
			</div>
			<div class="page" id="cnt" style="overflow: auto;"></div>
			<div id="ammd"></div>
		</div>
	</div>
</div>
<!-- Modal Box End -->

</form>
 </section><!-- /.content -->
 </aside><!-- /.right-side -->
 
 
</body>
<link rel="stylesheet" href="chosen.css"> 
<script src="chosen.jquery.js" type="text/javascript"></script>  
<script src="prism.js" type="text/javascript" charset="utf-8"></script>		
<script type="text/javascript"> 
   $('#cid').chosen({  no_results_text: "Oops, nothing found!",    });   
   $('#brncd').chosen({  no_results_text: "Oops, nothing found!",    });  
</script> 
</div>
</html>