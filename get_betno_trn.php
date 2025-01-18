<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$pcd=$_REQUEST['prnm'];
$brncd=$_REQUEST['bcd'];
$betno1=rawurldecode($_REQUEST['betnoo']);

if($betno1=='undefined' ){$betno1='';}	
if($pcd=="" or $brncd=="")
{
?>
<input type="text" class="sc" autocomplete="off" id="betno"  name="betno" onblur="spaces(this.value)" value="" tabindex="15" size="15"  >
<?php 	
}
else
{
?>
<input type="text"  list="bgss" id="betno" class="sc1" value="<?php  echo $betno1;?>" autocomplete="off" name="betno" onblur="spaces(this.value)" size="20" tabindex="15">
<datalist id="bgss">
<?php 
$data1 = mysqli_query($conn,"SELECT * FROM main_stock WHERE pcd='$pcd' and bcd='$brncd' and betno!='' group by betno order by sl");
while ($row1 = mysqli_fetch_array($data1))
{
$sl=$row1['sl'];
$betnoo=$row1['betno'];
/*
$stck=0;
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and bcd='$brncd' and betno='$betnoo'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
*/
$stck=1;
if($stck>0)	
{
?>
<option><?php  echo $betnoo?></option>
<?php 
}
	}
	
?>
</datalist>
<?php 
}
?>
<script>


</script>
