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
 var uid=document.getElementById('uid').value;
$('#show').load('roll_assign_list.php?uid='+uid).fadeIn('fast');
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
			<h1 align="center">Setup<small>Roll Assign</small></h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Setup</li><li class="active">Roll Assign</li>
			</ol>
		</section>


<section class="content">
	<div class="box box-myclass box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Roll Assign</h3>
		</div>

<div class="box-body">
<div  class="box box-success">

<form name="form1" id="form1" method="post" action="roll_assigns.php">
<table border="0" class="table table-hover table-striped table-bordered" >
<tr>
<td>
<b>USER:</b>
<select class="form-control" id="uid" name="uid" required onchange="show()">
<option value="">---Select---</option>
<?php
$sql1 = mysqli_query($conn,"select * from main_signup where sl>0") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($sql1))
{
$sls = $row['sl'];
$username = $row['username'];
$name = $row['name'];
?>
<option value="<?php echo $username;?>"><?php echo $username;?> - <?=$name?></option>	
<?
}
?>
</select>
</td>

<td>
<br><input type="submit" class="btn btn-success" value="Submit" name="B1" >
</td>
</tr>
</table>				
<div id="show">			

</div>
</form>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>  
$('#nm').chosen({no_results_text: "Oops, nothing found!",});
</script>

</div>
</div>

</div>
</div>


</section>
</aside>

</body>
</html>
