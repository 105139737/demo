<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$sman=rawurldecode($_REQUEST['sman']);
?>
<select name="day" class="form-control" size="1" id="day">
<option value="">----Day----</option>   
<?php 
if($sman!="")
{
$data1 = mysqli_query($conn,"Select * from main_task where spid='$sman' group by day order by sl desc ");

	while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$day=$row1['day'];
?>
<Option value="<?php  echo $day;?>"><?php echo ucfirst($day);?></option>
	<?php }}
	else{
		?>
<option value="sunday">Sunday</option>       
<option value="monday">Monday</option>       
<option value="tuesday">Tuesday</option>       
<option value="wednesday">Wednesday</option>       
<option value="thursday">Thursday</option>       
<option value="friday">Friday</option>       
<option value="saturday">Saturday</option> 
		<?php 
	}
	?>
</select>
