<?php 
$reqlevel = 1;
include("config.php");

?>
<html>
<head>
</head>
<body>
<div class="box box-success" >
<table border="1" width="860px">
<tr>
<td align="center"><b>Sl.</b></td>
<td align="center"><b>From Time</b></td>
<td align="center"><b>To Time</b></td>
<td align="center"><b>Date</b></td>
<td align="center"><b>Date and Time</b></td>
</tr>
<?php 
$cnt=0;
$get=mysqli_query($conn,"select * from ch order by sl desc limit 20") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	$cnt++;
	$sl=$row['sl'];
	$ftm=$row['ftm'];
	$ttm=$row['ttm'];
	$dt=$row['dt'];
	$dtm=$row['dtm'];
	?>
	<tr>
	<td align="center"><?php  echo $cnt;?></td>
	<td align="center"><?php  echo $ftm;?></td>
	<td align="center"><?php  echo $ttm;?></td>
	<td align="center"><?php  echo $dt;?></td>
	<td align="center"><?php  echo $dtm;?></td>
	</tr>
	<?php 
}
?>
</table>
</div>
    </body>
</html>