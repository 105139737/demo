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
$('#sgh').load('edit_days_list.php').fadeIn('fast');
}

function sedt(sl,fn,fv,div,tblnm)
{
$("#"+div).load("gisedt_new.php?sl="+sl+"&fn="+fn+"&fv="+encodeURI(fv)+"&div="+div+"&tblnm="+tblnm).fadeIn('fast');
}
function edt1(sl,fn,fv,div,tblnm)
{
$("#"+div).load("gisedts_new.php?sl="+sl+"&fn="+fn+"&fv="+encodeURI(fv)+"&div="+div+"&tblnm="+tblnm).fadeIn('fast');
}
function smsChange(val)
{
	$('#golbal').load('golobaldata.php?val='+val).fadeIn('fast');
}
function linkid()
{
	$('#golbal').load('golobaldata.php?val=A').fadeIn('fast');
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
			<h1 align="center">System<small>Maximum Edit Days</small></h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">System</li><li class="active">Maximum Edit Days</li>
			</ol>
		</section>


<section class="content">
	<div class="box box-myclass box-solid">

<div class="box-body">
<div  class="box-header with-border" ><h3 class="box-title"></h3>
</div>

<div id="sgh">
</div>
<div id="golbal">
</div>
</div>

</div>
</div>


</section>
</aside>

</body>
</html>
