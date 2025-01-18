<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$dttm=date('d-m-Y H:i:s');
$edt=date('Y-m-d');



$sun=rawurldecode($_REQUEST['sun']);
$smvlu=rawurldecode($_REQUEST['smvlu']);
$mun=rawurldecode($_REQUEST['mun']);
$mdvlu=floatval(rawurldecode($_REQUEST['mdvlu']));
$bun=rawurldecode($_REQUEST['bun']);
$bgvlu=floatval(rawurldecode($_REQUEST['bgvlu']));

$sret=rawurldecode($_REQUEST['sret']);
$mret=rawurldecode($_REQUEST['mret']);
$bret=rawurldecode($_REQUEST['bret']);

$cat=rawurldecode($_REQUEST['cat']);
$scat=rawurldecode($_REQUEST['scat']);
echo $pnm=rawurldecode($_REQUEST['pnm']);
$ret=rawurldecode($_REQUEST['ret']);
$hsn=rawurldecode($_REQUEST['hsn']);


$igst=rawurldecode($_REQUEST['igst']);
$cgst=($igst/2);
$sgst=$cgst;
$fdt='2017-07-01';
$tdt="2030-12-31";
$unit=rawurldecode($_REQUEST['unit']??"");

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
$query2 = "INSERT INTO ".$DBprefix."product (cat,scat,pnm,smvlu,mdvlu,bgvlu,hsn,mrp) 
VALUES ('$cat','$scat','$pnm','$sret','$mret','$bret','$hsn','$ret')";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error($conn));	
$data= mysqli_query($conn,"select * from  ".$DBprefix."product order by sl desc LIMIT 1")or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($data))
{
$pcd=$row['sl'];
}

$ins=mysqli_query($conn,"INSERT INTO main_unit (sun,mun,bun,smvlu,mdvlu,bgvlu,cat)
VALUE ('$sun','$mun','$bun','$smvlu','$mdvlu','$bgvlu','$pcd')") or die(mysqli_error($conn));
 
$result=mysqli_query($conn,"INSERT INTO main_gst(cgst,sgst,igst,cat,fdt,tdt) VALUES ('$cgst','$sgst','$igst','$pcd','$fdt','$tdt')") or die(mysqli_error($conn));

$query111 = "SELECT * FROM ".$DBprefix."product order by sl";
$result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$sl=$R111['sl'];
}

?>
<script language="javascript">
$('#modals').modal('hide');
$('#prnm').append('<option value="<?php  echo $sl;?>"><?php  echo $pnm;?> <?php if($pnm!=""){?>( <?php  echo $pnm;?> )<?php }?></option>');
$('#prnm').trigger('chosen:updated');
document.getElementById('prnm').value='<?php  echo $sl;?>';
$('#prnm').trigger('chosen:updated');
get_gstval();
</script>
<?php   
    
    }
    else
    {
    ?>
<script language="javascript">
alert('<?php  echo $err;?>');
</script>
<?php 
    }
?>