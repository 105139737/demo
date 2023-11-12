<?php
$reqlevel = 0;
include("membersonly.inc.php");
$fy=date('Y');
$fm=date('m');
if($fm<4)
{$fy--;
}
$fdt=$fy."-04-01";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cupon Entry</title>
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

<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css">
.ui-datepicker
{
   font-family: Arial;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}

td{
	border:1px solid #37880a;
	padding: 0px 0px;
	font-size:14px;

	}
	th{
color: #FFFFFF;
border:1px solid #37880a;
	padding: 0px 0px;
	}
	
input:focus{

background-color:Aqua;
}
</style>
<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
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
   $("#tdt").datepicker(jQueryDatePicker2Opts);
   });
   </script>

<script>
 function mnu()
 {
 $('#pmnu').load('mnu.php').fadeIn("slow");
  $('#tmnu').load('mnu2.php').fadeIn("slow");
 }
 </script>



<script>
 function mnu()
 {
 $('#pmnu').load('mnu.php').fadeIn("slow");
  $('#tmnu').load('mnu2.php').fadeIn("slow");
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

<script type="text/javascript" src="account.js" ></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<?
$query31 = "SELECT * FROM main_drcr";
$result31 = mysqli_query($conn,$query31);
$cnt = mysqli_num_rows($result31);
$vno=str_pad($cnt,10,"0",STR_PAD_LEFT);
?>
<body>
<form name="Form1" method="post" action="tbal_form_xls.php" id="Form1">
<p>&nbsp;</p>

          <table width="90%" border="1" class="advancedtable">
          <thead>
          <tr style="height: 30px;">
          <th colspan="4" align="center">
          Trail Balance
          </th>
		  </tr>
          </thead>
          <tbody>
  <tr class="odd">
    <td align="right" width="20%"><font color="red">*</font>From :</td>
    <td align="left" width="30%">
	<input type="text" name="fdt" id="fdt" value="<? echo $fdt;?>" readonly>
	</td>
	<td align="right" width="20%"><font color="red">*</font>To :</td>
    <td align="left" width="30%">
	<input type="text" name="tdt" id="tdt" value="<? echo date('Y-m-d'); ?>" readonly>
	</td>   
  </tr>
  
   <tr class="odd">
    <td align="right" width="20%"><font color="red">*</font>Ledger Head :</td>
    <td align="left" width="30%">
	 <select id="ledg" name="ledg" onchange="ldgdtls()" style="width:280px">
							<option value="">-- Select --</option>
							<?php 
							$get = mysqli_query($conn,"SELECT * FROM  main_ledg ") or die(mysqli_error($conn));
							while($row = mysqli_fetch_array($get))
							{
							?>
								<option value="<?=$row['sl']?>" <?=$row['sl'] == $rowpages['pcd'] ? 'selected' : '' ?>><?=$row['nm']?></option>
							<?php 
							} 
							?>
						</select>
	</td>   
	 <input type="hidden" name="proj" id="proj" value="1" >
	<td align="right" width="20%"></td>
    <td align="left" width="30%">
	

	</td>   
  </tr>
  </tbody>
</table>

<div id="list">
</div>
</form>
</body>


<div id="underlay" style="z-index:200;">
</div>
</html>
