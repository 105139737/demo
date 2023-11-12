<?PHP
$reqlevel=1;
include("membersonly.inc.php");
include "header.php";

$sl=$_REQUEST['sl']; 

$data=mysqli_query($conn,"select * from main_appmenu where sl='$sl'")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
$nm=$row['nm'];
}
?>
<html>
<head>
<style> 


</style>


<script>
</script>
</head>
<div class="wrapper row-offcanvas row-offcanvas-left">
	<?php
	include "left_bar.php";
	?>
<body onload="show()">
	<aside class="right-side">
		<section class="content-header">
			<h1 align="center">Edit<small>Department Edit</small></h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Edit</li><li class="active">Department Edit</li>
			</ol>
		</section>


<section class="content">
	<div class="box box-myclass box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Department Edit</h3>
		</div>

		<div class="box-body">
<form name="form1" id="form1" method="post" action="menu_setup_edits.php">
	<input type="hidden" id="sl" name="sl" value="<?=$sl?>">
<table  width="800px"  align="center" class="table table-hover table-striped table-bordered">
<tr>
<td align="right"><font face="times new roman" color="black"><b>Menu Name :</b></font></td>
<td><input type="text" id="nm" name="nm" value="<?=$nm?>"" class="form-control" placeholder="Enter Menu Name"></td>
</tr>
<tr>
	<td align="right" colspan="6">
	<input type="submit" class="btn btn-info" id="Button1" value="Update" >
	<input type="reset"  class="btn btn-warning" id="Button11" value="Reset" >
	</td>
</tr>

</table>
</form>

</div>
</div>


</section>
</aside>

</body>
</html>