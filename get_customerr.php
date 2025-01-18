<?php 
include("membersonly.inc.php");
$bcd=$_REQUEST['bcd'];
?>

<select name="snm" class="form-control czn"  id="snm"> 
<option value="">---All---</option>
<?php 
$query09="Select * from  main_cust WHERE brncd='$bcd' group by cont";
$result09 = mysqli_query($conn,$query09);
while ($R09 = mysqli_fetch_array ($result09))
{
//$sid=$R09['sl'];
$nm1=$R09['nm'];
$cont1=$R09['cont'];
?>
<option value="<?php  echo $cont1;?>"><?php  echo $nm1;?> - <?php  echo $cont1;?></option>
<?php 
}
?>
</select>
	 <link rel="stylesheet" href="chosen.css">
 
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<script>$('.czn').chosen({no_results_text: "Oops, nothing found!",});</script>