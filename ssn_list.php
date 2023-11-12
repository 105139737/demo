<?
$reqlevel = 1;
include("membersonly.inc.php");
include "header.php";

?>
<html>
<head>
	<div class="wrapper row-offcanvas row-offcanvas-left">
	<?
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
 function get_list()
{
	var cat=document.getElementById('cat').value;
	var scat=document.getElementById('scat').value;
	var pnm=document.getElementById('pnm').value;
	$('#div_list').load('prod_lists.php?cat='+cat+'&scat='+scat+'&pnm='+encodeURIComponent(pnm)).fadeIn('fast');
} 
</script>
</head>
<body onload="get_list()">
	<aside class="right-side">
		<section class="content-header">
			<h1 align="center">Session View & Edit</h1>
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
				<li class="active">Session List</li>
			</ol>
		</section>
		<section class="content">
<form method="post" action="#" id="form1" onSubmit="return check1()" name="form1">
<div class="box box-success">
<table class="table table-hover table-striped table-bordered">
<tr>
<th style="text-align:center; width: 5%;">Sl No</th>
<th style="text-align:center; width: 45%;">From Date</th>
<th style="text-align:center; width: 45%;">To Date</th>
</tr>
<?
$dsql=mysqli_query($conn,"select * from main_ssn")or die(mysqli_error($conn));
while($drow=mysqli_fetch_array($dsql))
{
$sl++;		
$gsl=$drow['sl'];
$fdt=$drow['fdt'];
$tdt=$drow['tdt'];	
$fdt=date('d-m-Y',strtotime($fdt));
$tdt=date('d-m-Y',strtotime($tdt));

?>
<tr bgcolor="<?=$color;?>">
<td style="text-align:center;">
<?=$sl;?><br>
<a href="ssn_list_edit.php?sl=<?=$gsl;?>" title="Click to Update"><i class="fa fa-pencil-square-o"></i></a> 
</td>
<td style="text-align:left;"><?=$fdt;?></td>
<td style="text-align:left;"><?=$tdt;?></td>
</tr>
<?															
}
?>
</table>
</div>
</form><!-- /.box-body -->
<div class="box-footer clearfix no-border">
</div>
</div>
</section><!-- /.content -->
</aside><!-- /.right-side -->
</body>
</html>