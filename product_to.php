<?php 
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";

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
font-weight: 900;
color:#000;
border:1px solid #37880a;
}

input:focus{
background-color:Aqua;
}

a{
cursor:pointer;
}
</style>
<script>
 function get_scat()
{
	var cat=document.getElementById('cat').value;
	$('#div_scat').load('get_sub_cat_ft.php?cat='+cat).fadeIn('fast');
}

function product()
{
var scat=document.getElementById('scat').value;
var cat=document.getElementById('cat').value;
$("#prod_div").load("get_product_ft.php?cat="+cat+"&scat="+scat).fadeIn('fast');	
}

 function tget_scat()
{
	var cat=document.getElementById('tcat').value;
	$('#tdiv_scat').load('get_sub_cat_tt.php?cat='+cat).fadeIn('fast');
}

function tproduct()
{
var scat=document.getElementById('tscat').value;
var cat=document.getElementById('tcat').value;
$("#tprod_div").load("get_product_tt.php?cat="+cat+"&scat="+scat).fadeIn('fast');	
}
 function get_list()
{
	var cat=document.getElementById('cat').value;
	var scat=document.getElementById('scat').value;
	var fpcd=document.getElementById('fpcd').value;

	$('#div_list').load('product_to_list.php?cat='+cat+'&scat='+scat+'&fpcd='+fpcd).fadeIn('fast');
}
function del(sl)
{
$('#div_list').load('product_to_del.php?sl='+sl).fadeIn('fast');	
}

</script>
</head>
<body onload="get_list()">
	<aside class="right-side">
		<section class="content-header">
			<h1 align="center">Product Tag</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Product Tag</li>
			</ol>
		</section>
		
		<section class="content">
<form method="post" action="product_tos.php" id="form1" target="_blank" name="form1">
<div class="box box-success">
<table class="table table-hover table-striped table-bordered">
<tr>
<td align="left" width="33%">
    <b>Brand :</b><br>
	<select name="cat" id="cat" class="form-control" onchange="get_scat();get_list()">
	<Option value="">--- Select ---</option>
	<?php 
	$get=mysqli_query($conn,"Select * from main_catg order by cnm");
	while($row=mysqli_fetch_array($get))
	{
		$csl=$row['sl'];
		$cnm=$row['cnm'];
		?>
		<option value="<?php echo $csl;?>"><?php echo $cnm;?></option>
		<?php 
	}
	?>
	</select>
</td>
<td align="left"  width="33%">
    <b>Category:</b><br>
<div id="div_scat">
	<select name="scat" class="form-control" size="1" id="scat" tabindex="8" >
	<Option value="">--- Select ---</option>
	<?php 
	$data1=mysqli_query($conn,"Select * from main_scat order by nm");
	while($row1=mysqli_fetch_array($data1))
	{
		$sc_sl=$row1['sl'];
		$sc_nm=$row1['nm'];
		?>
		<Option value="<?php  echo $sc_sl;?>"><?php  echo $sc_nm;?></option>
		<?php 
	}
	?>
	</select>
	</div>
</td>  

<td align="left" width="33%"><b>From Product:</b><br>
<div id="prod_div">
<select id="fpcd" name="fpcd" class="form-control" >
<option value="">---Select---</option>

</select>
</div>
</td>
</tr>
<tr>
<td align="left" width="20%">
    <b>Brand :</b><br>
	<select name="tcat" id="tcat" class="form-control" onchange="tget_scat()">
	<Option value="">--- Select ---</option>
	<?php 
	$get=mysqli_query($conn,"Select * from main_catg order by cnm");
	while($row=mysqli_fetch_array($get))
	{
		$csl=$row['sl'];
		$cnm=$row['cnm'];
		?>
		<option value="<?php echo $csl;?>"><?php echo $cnm;?></option>
		<?php 
	}
	?>
	</select>
</td>
<td align="left"  width="20%">
    <b>Category:</b><br>
<div id="tdiv_scat">
	<select name="tscat" class="form-control" size="1" id="tscat" tabindex="8" >
	<Option value="">--- Select ---</option>
	<?php 
	$data1=mysqli_query($conn,"Select * from main_scat order by nm");
	while($row1=mysqli_fetch_array($data1))
	{
		$sc_sl=$row1['sl'];
		$sc_nm=$row1['nm'];
		?>
		<Option value="<?php  echo $sc_sl;?>"><?php  echo $sc_nm;?></option>
		<?php 
	}
	?>
	</select>
	</div>
</td>  

<td align="left" width="20%"><b>To Product:</b><br>
<div id="tprod_div">
<select id="tpcd" name="tpcd" class="form-control" >
<option value="">---Select---</option>

</select>
</div>
</td>

</tr>
<tr>
<td align="right" colspan="3">
<input type="submit" value=" Submit "  class="btn btn-success">
</td>
</tr>
</table>
</div>

</form><!-- /.box-body -->

<div id="div_list" class="box box-success"></div>

                                <div class="box-footer clearfix no-border">

                                </div>

							</div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

    </body>
</html>
     <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
  <script src="prism.js" type="text/javascript" charset="utf-8"></script>

<script>

 $('#cat').chosen({
no_results_text: "Oops, nothing found!",
});	
 $('#scat').chosen({
no_results_text: "Oops, nothing found!",
});
 $('#fpcd').chosen({
no_results_text: "Oops, nothing found!",
});
$('#tcat').chosen({
no_results_text: "Oops, nothing found!",
});	
 $('#tscat').chosen({
no_results_text: "Oops, nothing found!",
});
 $('#tpcd').chosen({
no_results_text: "Oops, nothing found!",
});

</script>