<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$xx=$_REQUEST['xx'];
$cldgr=$_REQUEST['cldgr'];

?>
 <select  name="cldgr" id="cldgr" class="form-control" onchange="gtcrvl1(),sia(this.value),show_div(this.value)">
<option value="">-- Select --</option>
<?php  
$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd!='3' and gcd!='5' and sl!='$xx' order by nm") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?php  echo $row['sl']?>" <?php  echo $row['sl'] == $cldgr ? 'selected' : '' ?>><?php  echo $row['nm']?></option>
<?php  
} 
?>
</select>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
$('#cldgr').chosen({
  no_results_text: "Oops, nothing found!",
  });
 </script>