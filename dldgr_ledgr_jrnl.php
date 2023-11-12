<?php
$reqlevel = 3;
include("membersonly.inc.php");
$xx=$_REQUEST['xx'];
$dldgr=$_REQUEST['dldgr'];
?>
 <select  name="dldgr" id="dldgr" class="form-control" onchange="gtdrvl(),sia1(this.value),show_div1(this.value)">
<option value="">-- Select --</option>
<?php 
$get = mysqli_query($conn,"SELECT * FROM main_ledg where gcd!='3' and gcd!='4' and gcd!='5' and sl!='$xx' order by nm") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($get))
{
?>
<option value="<?=$row['sl']?>" <?=$row['sl'] == $dldgr ? 'selected' : '' ?>><?=$row['nm']?></option>
<?php 
} 
?>
</select>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
$('#dldgr').chosen({
  no_results_text: "Oops, nothing found!",
  });
 </script>