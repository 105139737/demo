<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "header.php";
$sl=$_REQUEST['sl'];
$dsql=mysqli_query($conn,"select * from main_ssn where sl='$sl'" )or die(mysqli_error($conn));
while($drow=mysqli_fetch_array($dsql))
{
$fdt=$drow['fdt'];
$tdt=$drow['tdt'];
$fdt=date('d-m-Y',strtotime($fdt));	
$tdt=date('d-m-Y',strtotime($tdt));	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <div class="wrapper row-offcanvas row-offcanvas-left">
            <?
            include "left_bar.php";
            ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	color: #fff;
	position : absolute;
	left : 350px;
	top : 250px;
	font-family: Verdana, Geneva, sans-serif;
	font-size: 10px;
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
<link rel="stylesheet" href="wb.validation.css" type="text/css">
<script type="text/javascript" src="wb.validation.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function()
{
   var jQueryDatePicker1Opts =
   {
      dateFormat: 'dd-M-yy',
      changeMonth: true,
      changeYear: true,
      showButtonPanel: false,
      showAnim: 'show'
   };
   $("#fdt").datepicker(jQueryDatePicker1Opts);
   $("#tdt").datepicker(jQueryDatePicker1Opts);
});
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body>
 <aside class="right-side">
  <section class="content-header">
                    <h1 align="center">Session<small>Edit</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Acounts</a></li>
                        <li class="active">Session</li>
                    </ol>
                </section>
				   <section class="content">
<form name="Form1" method="post" action="ssn_list_edits.php" id="Form1">
<input type="hidden" name="sl" id="sl" value="<?=$sl?>">
<div class="box box-success">
<table  width="860px" class="table table-hover table-striped table-bordered">    
<tr>
<td  ><font size="4"><b>From :</b></font></td>
<td align="left">
<input type="text" name="fdt" class="form-control" id="fdt" value="<?=$fdt?>">
</td> 	
<td  ><font size="4"><b>To :</b></font></td>
<td align="left" >
<input type="text" name="tdt" class="form-control" id="tdt" value="<?=$tdt?>">
</td> 	
</tr>
  <tr style="display:none;">
    <td align="right" width="20%"></td>
    <td align="left"  colspan="3">	
	</td>
  </tr>
  <tr >
    <td colspan="4" align="right"><input type="submit" value="Update" class="btn btn btn-success"></td>
  </tr>
</table>
</div>
</form>
</html>
