<?php
$reqlevel = 3;
include("membersonly.inc.php");
$dttm=date('d-m-Y H:i:s');
$edt=date('Y-m-d');



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
$cgst=($igst/2);
$sgst=$cgst;
$fdt=$edt;
$tdt="2030-12-31";
$unit=$_POST['unit'];

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
$c4=mysqli_query($conn,"SELECT * FROM ".$DBprefix."product where pnm='$pnm'");
$count4=mysqli_num_rows($c4);
if($count4>0)
{
$err="Product Name Already Exists...";	
}
if($err=="")
{
$query2 = "INSERT INTO ".$DBprefix."product (cat,scat,pnm,smvlu,mdvlu,bgvlu,hsn,mrp,typ) 
VALUES ('$cat','$scat','$pnm','$sret','$mret','$bret','$hsn','$ret','1')";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));	
$data= mysqli_query($conn,"select * from  ".$DBprefix."product order by sl desc LIMIT 1")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['sl'];
}

$ins=mysqli_query($conn,"INSERT INTO main_unit (sun,mun,bun,smvlu,mdvlu,bgvlu,cat)
VALUE ('$sun','$mun','$bun','$smvlu','$mdvlu','$bgvlu','$pcd')") or die(mysqli_error($conn));
 
$result=mysqli_query($conn,"INSERT INTO main_gst(cgst,sgst,igst,cat,fdt,tdt) VALUES ('$cgst','$sgst','$igst','$pcd','$fdt','$tdt')") or die(mysqli_error($conn));


?>
<script language="javascript">
alert('Service Entry Completed. Thank You.....');
document.location="servc.php";
</script>
<?  
    
    }
    else
    {
    ?>
<script language="javascript">
alert('<? echo $err;?>');
window.history.go(-1);
</script>
<?
    }
?>