<?php 
$reqlevel=1;
include("membersonly.inc.php");
include "header.php";

$sl=$_REQUEST['sl']??"";
$msl=$_REQUEST['msl']??"";
$nm2="";
$data=mysqli_query($conn,"select * from main_approll where sl='$sl'")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data)) 
{
$username1=$row['username'];
$msl=$row['msl'];

$data1=mysqli_query($conn,"select * from main_appmenu where nm='$nm2'")or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($data1))
{
$nm2=$row1['nm'];
}

}

/*
$data2=mysqli_query($conn,"select * from main_signup where sl='$sl'")or die(mysqli_error($conn));
while($row2=mysqli_fetch_array($data2))
{
$username1=$row2['username'];
}
*/
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
<form name="form1" id="form1" method="post" action="menu_assign_edits.php">
	<input type="hidden" id="sl" name="sl" value="<?php  echo $sl?>">
<table  width="800px"  align="center" class="table table-hover table-striped table-bordered">
<tr>





<td style="text-align:right;"><font face="times new roman" color="black">*</font><b>Username:</b></td> 
<td>
	<select class="form-control" name="username" id="username" onchange="show()">
	
	<?php 
		$select=mysqli_query($conn,"SELECT * FROM main_signup ORDER BY sl") or die(mysqli_error($conn));
		while($r1=mysqli_fetch_array($select))   
		{
			$sl=$r1['sl'];
			$username=$r1['username'];
			?>
			<option value="<?php  echo $username;?>" <?php  if ($username==$username1) {echo 'Selected';}?>><?php  echo $username;?></option>
			<?php 
		}
	?>
	</select>
</td>
<td></td>
<td style="text-align:right;"><font face="times new roman" color="black">*</font><b>Menu Name:</b></td> 
<td>
	<select  name="nm[]" id="nm" class="form-control" multiple>
	
	<?php 
	$get1=mysqli_query($conn,"select * from main_appmenu where sl>0 and FIND_IN_SET(sl, '$msl')>0 order by sl") or die(mysqli_error($conn));
	while(($row1 = mysqli_fetch_array($get1))) 
	{
		$sl=$row1['sl'];
		$nm=$row1['nm'];
		?>
		<option value="<?php  echo $sl;?>" selected><?php  echo $nm;?></option>
		<?php 
	}
	$get11=mysqli_query($conn,"select * from main_appmenu where sl>0 and FIND_IN_SET(sl, '$msl')=0 order by sl") or die(mysqli_error($conn));
	while($row11=mysqli_fetch_array($get11))
	{
		$sl=$row11['sl'];
		$nm=$row11['nm'];
		?>
		<option value="<?php  echo $sl;?>"><?php  echo $nm;?></option>
		<?php 
	} 
	?>
	</select>
</td>
</tr>
<tr>
	<td align="right" colspan="6">
	<input type="submit" class="btn btn-info" id="Button1" value="Update" >
	<input type="reset"  class="btn btn-warning" id="Button11" value="Reset" >
	</td>
</tr>

</table>
</form>
<div id="sgh">
</div>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>  
$('#nm').chosen({no_results_text: "Oops, nothing found!",});
</script>
</div>
</div>


</section>
</aside>

</body>
</html>