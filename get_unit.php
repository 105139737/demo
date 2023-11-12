<?
$reqlevel = 1;
include("membersonly.inc.php");
$scat=$_REQUEST[scat];
$data1 = mysqli_query($conn,"Select * from main_scat where sl='$scat'");
while ($row1 = mysqli_fetch_array($data1))
{
$unit=$row1['unit'];
}
?>
<select id="unit" name="unit" class="sc" tabindex="11" style="padding:3px" onchange="get_box()">
<option value="">---Select---</option>
<?if($unit=='1'){?><option value="1">KG</option><?}?>
<?if($unit=='2'){?><option value="2">Box</option><?}?>
<?if($unit=='3'){?><option value="3">Pcs</option><?}?>
</select>