<?PHP
$reqlevel=1;
include("membersonly.inc.php");
include "header.php";

?>
<html>
<head>
<link rel="stylesheet" href="cupertino/jquery.ui.all.css" type="text/css">
<style type="text/css"> 
.hdng
{
	font-weight:bold;
	font-family:times new roman; 
}
</style>
<script>
function show()
{
var username=document.getElementById('username').value;	
$('#sgh').load('menu_assign_list.php?username='+username).fadeIn('fast');
}
</script>
</head>
<div class="wrapper row-offcanvas row-offcanvas-left">
	<?php
	include "left_bar.php";
	?>
<body onload="show()">
	<aside class="right-side">
		<section class="content-header">
			<h1 align="center">Setup<small>Menu</small></h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Setup</li><li class="active">Menu</li>
			</ol>
		</section>


<section class="content">
	<div class="box box-myclass box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Menu Setup</h3>
		</div>

<div class="box-body">

<form name="form1" id="form1" method="post" action="menu_assigns.php">
<table  width="800px"  align="center" class="table table-hover table-striped table-bordered">
<tr>
<td style="text-align:right;" width="10%"><font face="times new roman" color="black">*</font><b>Username:</b></td> 
<td width="40%">
	<select class="form-control" name="username" id="username" onchange="show()">
	<option value="">---Select---</option>
	<?php
		$select=mysqli_query($conn,"SELECT * FROM main_signup ORDER BY sl") or die(mysqli_error($conn));;
		while($r1=mysqli_fetch_array($select))   
		{
			$sl=$r1['sl'];
			$username=$r1['username'];
			$name=$r1['name'];
			?>
			<option value="<?=$username;?>"><?=$username;?> - ( <?=$name?> )</option><?php
		}
	?>
	</select>
</td>
<td style="text-align:right;" width="10%"><font face="times new roman" color="black">*</font><b>Menu Name:</b></td> 
<td width="40%" >
	<select  name="nm[]" id="nm" class="form-control" multiple>
	<option value=""></option>
	<?php
		$select=mysqli_query($conn,"SELECT * FROM main_appmenu ORDER BY sl") or die(mysqli_error($conn));;
		while($r1=mysqli_fetch_array($select))   
		{
			$sl=$r1['sl'];
			$nm=$r1['nm'];
			?><option value="<?=$sl;?>"><?=$nm;?></option><?php
		}
	?>
	</select>
</td>

</tr>
<tr>

<td align="right" colspan="6"><br/>
<input type="submit" class="btn btn-success" value="Submit">
</td>
</tr>


</table>
</form>
<div  class="box-header with-border" ><h3 class="box-title">List</h3>
</div>

<div id="sgh">
</div>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>  
$('#nm').chosen({no_results_text: "Oops, nothing found!",});
$('#username').chosen({no_results_text: "Oops, nothing found!",});
</script>

</div>

</div>
</div>


</section>
</aside>

</body>
</html>
