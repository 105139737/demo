<?php
$reqlevel = 1;
include("membersonly.inc.php");
$pid=$_REQUEST['prnm'];
$qnt=$_REQUEST['qty'];
$fbcd=$_REQUEST['fbcd'];
$tbcd=$_REQUEST['tbcd'];
$refno=$_REQUEST['sih'];
$unit=$_REQUEST['unit'];
$usl=$_REQUEST['usl'];
$remk=rawurldecode($_REQUEST['remk']);
$betno=$_REQUEST['betno'];
$err="";
if($pid=='' or $qnt=='' or $qnt=='0' or $fbcd=='')
{
	$err="Please Fill All Fields....";
}
if($betno!="")
{
$betno1=" and betno='$betno'";	
}
$query6="Select * from main_product where sl='$pid'";
$result6 = mysqli_query($conn,$query6);
while ($R6 = mysqli_fetch_array ($result6))
{
$prnm=$R6['pnm'];
}
$tot=0;
$queryq = "SELECT sum(qty) as qty1 FROM ".$DBprefix."trntemp where fbcd='$fbcd' and prsl='$pid' $betno1";
$resultq = mysqli_query($conn,$queryq);
while ($Rq = mysqli_fetch_array ($resultq))
{
$qty1=$Rq['qty1'];
}
$tot=$qty1+$qnt;
$stck=0;
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pid' and bcd='$fbcd' $betno1";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
if($tot>$stck)
{
//$err="Please Check  Quantity....";	
}
	
$query7="Select * from main_trntemp where prsl='$pid' and eby='$user_currently_loged'";
$result7 = mysqli_query($conn,$query7);
$rowcount=mysqli_num_rows($result7);
if($rowcount>0)
{
//$err="Product Already Exists....";		
}
if($err=="")
{	
	$tpcd="";

	$res=mysqli_query($conn,"select * from  main_product_to where fpcd='$pid'");
	while($row=mysqli_fetch_array($res))
	{
	$tpcd=$row['tpcd'];
	}
	


$query21 = "INSERT INTO ".$DBprefix."trntemp (prsl,prnm,qty,eby,remk,fbcd,tbcd,refno,unit,usl,betno) VALUES ('$pid','$prnm','$qnt','$user_currently_loged','$remk','$fbcd','$tbcd','$refno','$unit','$usl','$betno')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn)); 
if($tpcd=='')
{
?>
<script>
temp();
reset();
$('#prnm_chosen .chosen-drop').click(function(e) {
  e.stopPropagation();
});
$("#prnm").trigger("chosen:open");
document.getElementById('prnm_chosen').className+=' chosen-with-drop chosen-container-active'
document.getElementById("prnm3").focus();
$('#prnm3').focus();
$('#prnm3').val('');
</script>
<?
}
else
{
?>
<script>
$('#prnm').append("<option value='"+<?php echo $tpcd;?>+"'>Auto Adding</option>");
document.getElementById('prnm').value="<?php echo $tpcd;?>";
$('#prnm').trigger("chosen:updated");
godown();
add();
</script>
<?php
}
}
else
{
?>
<script>
alert('<?=$err;?>');
temp();

</script>
<?php
}
?>