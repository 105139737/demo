<?php  
$reqlevel = 3; 
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
$nm=rawurldecode($_REQUEST['nm']);
$addr=rawurldecode($_REQUEST['addr']);
$email=rawurldecode($_REQUEST['email']);
$mob=rawurldecode($_REQUEST['mob1']);
$ctyp=rawurldecode($_REQUEST['ctyp']);
$gstin_no=rawurldecode($_REQUEST['gstin_no']);
$cust_typ=rawurldecode($_REQUEST['cust_typ']);
$gstdt1=rawurldecode($_REQUEST['gstdt']);
$brand=rawurldecode($_REQUEST['brand']);
$s_per=rawurldecode($_REQUEST['s_per']);
$pin=rawurldecode($_REQUEST['pin']);
$town=rawurldecode($_REQUEST['town']);
$distn=rawurldecode($_REQUEST['distn']);

$pan=substr($gstin_no,2,10);	
$state=substr($gstin_no,0,2);	
if($dob!='')
{
$dob=date('Y-m-d', strtotime($dob));
}
if($doa!='')
{
$doa=date('Y-m-d', strtotime($doa));
}
$err="";

if($nm=='')
{
	$err="Please Enter Name .....";
}

if($mob=='')
{
	$err="Please Enter Mobile No. .....";
}



$queryx="select * from ".$DBprefix."cust where cont='$mob' and nm='$nm'";
$resultx = mysqli_query($conn,$queryx);
$cntx=mysqli_num_rows($resultx);
if($cntx>0)
{
    $err="Data Already Exist";
}
if($gstin_no!='')
{
if(!preg_match("/[0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9A-Za-z]{1}[Zz1-9A-Ja-j]{1}[0-9a-zA-Z]{1}/", $gstin_no))
{
    $err = "Invalid GST number ";
  
} 
if($gstdt1=='')
{
 $err = "Please Enter GSTIN Applicable Date. ";	
}
}



if($err=="")
{
if($gstdt1!='')
{
$gstdt=date('Y-m-d', strtotime($gstdt1));
}
else
{
$gstdt="0000-00-00";	
}
$query6 = "INSERT INTO ".$DBprefix."cust (typ,nm,addr,cont,mail,edt,edtm,eby,gstin,pan,fst,gstdt,sale_per,brand,pin,town,distn) VALUES ('$cust_typ','$nm','$addr','$mob','$email','$dt','$dttm','$user_currently_loged','$gstin_no','$pan','$state','$gstdt','$s_per','$brand','$pin','$town','$distn')";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));

$query111 = "SELECT * FROM ".$DBprefix."cust order by sl";
$result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$sl=$R111['sl'];
}		
?>
<Script language="JavaScript">
$('#compose-modal').modal('hide');
$('#custnm').append('<option value="<?php  echo $sl;?>"><?php  echo $nm;?> <?php if($mob!=""){?>( <?php  echo $mob;?> )<?php }?></option>');
$('#custnm').trigger('chosen:updated');
document.getElementById('custnm').value='<?php  echo $sl;?>';
$('#custnm').trigger('chosen:updated');
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