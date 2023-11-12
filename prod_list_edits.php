<?php
$reqlevel = 1;
include("membersonly.inc.php");

$dttm=date('d-m-Y H:i:s');
$edt=date('Y-m-d');

$sl=$_POST['sl'];
$gsl=$_POST['gsl'];


$sun=$_POST['sun'];
$smvlu=$_POST['smvlu'];
$mun=$_POST['mun'];
$mdvlu=floatval($_POST['mdvlu']);
$bun=$_POST['bun'];
$bgvlu=floatval($_POST['bgvlu']);

$sret=$_POST['sret'];
$mret=$_POST['mret'];
$bret=$_POST['bret'];

$cat=$_POST['cat'];
$scat=$_POST['scat'];
$pnm=$_POST['pnm'];
$ret=$_POST['ret'];
$hsn=$_POST['hsn'];
$igst=$_POST['igst'];
$ean=$_POST['ean'];

$cgst=($igst/2);
$sgst=$cgst;
$fdt=date('Y-m-d',strtotime($_POST['fdt']));
$tdt=date('Y-m-d',strtotime($_POST['tdt']));
$unit=$_POST['unit'];

$sret="0";
$mret="0";
$bret="0";

$err="";
/*
if($mun!='')
{
if(floatval($mdvlu)>0)	
{
	
}
else
{
$err="Please Enter Midle Value";		
}
}
if($bun!='')
{
if(floatval($bgvlu)>0)	
{
	
}
else
{
$err="Please Enter Big Value";		
}
}
*/
if($err=='')
{
$dsql=mysqli_query($conn,"select * from main_product where pnm='$pnm' and sl!='$sl'") or die (mysqli_error($conn));
$drcnt=mysqli_num_rows($dsql);
if($drcnt==0)
{
$sql=mysqli_query($conn,"update main_product set cat='$cat',scat='$scat',pnm='$pnm',smvlu='$sret',mdvlu='$mret',bgvlu='$bret',hsn='$hsn',mrp='$ret',ean='$ean' where sl='$sl'") or die(mysqli_error($conn));	

$result=mysqli_query($conn,"update main_gst set cgst='$cgst',sgst='$sgst',igst='$igst',fdt='$fdt',tdt='$tdt' where sl='$gsl'") or die(mysqli_error($conn));	

mysqli_query($conn,"update main_unit set sun='$sun',mun='$mun',bun='$bun',smvlu='$smvlu',mdvlu='$mdvlu',bgvlu='$bgvlu' where cat='$sl'") or die(mysqli_error($conn));	

	
	?>
	<script>
	alert('Update Successfully. Thank You');
	document.location="prod_list.php";
	</script>
	<?
}
else
{
	?>
	<script>
	alert('Data Already Exists');
	history.go(-1);
	</script>
	<?
}
}
else
{
	?>
	<script>
	alert('<?=$err;?>');
	history.go(-1);
	</script>
	<?	
}
?>