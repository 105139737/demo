<?
include "config.php";
$val=$_REQUEST[val];
$cc=$_REQUEST[cc];
$sid=$_REQUEST['sid'];
?>
<link rel="stylesheet" href="chosen.css">
<script src="chosen.jquery.js" type="text/javascript"></script>
<script src="prism.js" type="text/javascript" charset="utf-8"></script>
<?
if($val==4)
{
?>
<select id="cust1"  name="cust1"  tabindex="1" style="width:250px" onchange="gtdrvl()" >
<option value="">---Select---</option>
<?
$query6="select * from  main_cust order by nm ";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
?>
<option value="<?=$row['sl'];?>"><?=$row['nm'];?></option>
<?}?>
</select>
<input type="hidden" id="sup" value="">
<script type="text/javascript">
$('#cust1').chosen({
no_results_text: "Oops, nothing found!",
});
</script>
<?}
elseif($val==12)
{
?>
<input type="hidden" id="cust1" value="">
<select id="sup1"  name="sup1"  tabindex="1" style="width:250px"  onchange="gtdrvl()">
<option value="">---Select---</option>
<?
$query6="select * from  main_suppl order by spn ";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
?>
<option value="<?=$row['sl'];?>"<?if($sid==$row['sl']){echo 'selected';}?>><?=$row['spn'];?></option>
<?}?>
</select>
<input type="hidden" id="cust" value="">
<script type="text/javascript">
$('#sup1').chosen({
no_results_text: "Oops, nothing found!",
});
</script>
<?}
else
{
?>
<input type="hidden" id="cust1" value="">
<input type="hidden" id="sup1" value="">
<?	
}
?>