<?php  
$reqlevel = 3; 
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
echo $snm=rawurldecode($_REQUEST['snm']);
echo $pnm=rawurldecode($_REQUEST['pnm']);
echo $addr=rawurldecode($_REQUEST['addr']);
echo $email=rawurldecode($_REQUEST['email']);
echo $mob1=rawurldecode($_REQUEST['mob1']);
echo $mob2=rawurldecode($_REQUEST['mob2']);
echo $gstin=rawurldecode($_REQUEST['gstin_no']);


$err="";

if($snm=='' ||$pnm=='' || $mob1=='')
{
	$err="Please Fill All The Fields.....";
}

$queryx="select * from ".$DBprefix."suppl where spn='$snm' and nm='$pnm' and mob1='$mob1'";
$resultx = mysqli_query($conn,$queryx);
$cntx=mysqli_num_rows($resultx);
if($cntx>0){
    $err="Data Already Exist";
}

if($err=="")
{
$pan=substr($gstin_no,2,10);	
$fst=substr($gstin_no,0,2);	
$query6 = "INSERT INTO ".$DBprefix."suppl (spn,nm,addr,mob1,mob2,email,stat,edt,edtm,eby)
 VALUES ('$snm','$pnm','$addr','$mob1','$mob2','$email','1','$dt','$dttm','$user_currently_loged')";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));

$query111 = "SELECT * FROM ".$DBprefix."suppl order by sl";
   $result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$sl=$R111['sl'];
}

$query66 = "INSERT INTO ".$DBprefix."suppl_gst (spn,addr,edt,edtm,eby,gstin,pan,st)
 VALUES ('$sl','$addr','$dt','$dttm','$user_currently_loged','$gstin','$pan','$fst')";
$result66 = mysqli_query($conn,$query66)or die (mysqli_error($conn));		
		
	?>
	<Script language="JavaScript">

	$('#compose-modal').modal('hide');
	
	$('#sup').append('<option value="<?php  echo $sl;?>"><?php  echo $snm;?> <?php if($pnm!=""){?>( <?php  echo $pnm;?> )<?php }?></option>');
		$('#custnm').trigger('chosen:updated');
	   document.getElementById('sup').value='<?php  echo $sl;?>';
	    $('#sup').trigger('chosen:updated');
		
	gtid();
	</script>
	<?php 

}
else
{
?>
<Script language="JavaScript">
alert('<?php  echo $err;?>');
</script>
<?php 
}
?>