<?
$reqlevel = 1;
include "config.php";
$sl=rawurldecode($_REQUEST[cnm]);
?>
			<select name="tech1" size="1" class="form-control" id="tech1" tabindex="10" >
<option value="">---Select---</option>
<?
	$sql="SELECT * FROM main_catg WHERE cnm='$sl'";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	
	while($row=mysqli_fetch_array($result))
		{
		
		?>
		<option value="<?echo $row['sl'];?>"><?echo $row['tnm'];?></option>
		<?
		
		}

?>
</select>


