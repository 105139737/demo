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
$('#sgh').load('menu_setup_list.php').fadeIn('fast');
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

<form name="form1" id="form1" method="post" action="menu_setups.php">
<table  width="800px"  align="center" class="table table-hover table-striped table-bordered">
<tr>
<td align="right"><font face="times new roman" color="black"><b>Menu Name :</b></font></td>
<td><input type="text" id="nm" name="nm" class="form-control" placeholder="Enter Menu Name"></td>
</tr>

<tr>

<td align="right" colspan="8"><br/>
<input type="submit" class="btn btn-success" value="Submit">
</td>
</tr>


</table>
</form>
<div  class="box-header with-border" ><h3 class="box-title">List</h3>
</div>

<div id="sgh">
</div>
</div>

</div>
</div>


</section>
</aside>

</body>
</html>
