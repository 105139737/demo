<?php  
$reqlevel = 3; 
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');

$cnm=$_POST['cnm'];
$vat_no=$_POST['vat_no'];
$mob=$_POST['mob'];
$email=$_POST['email'];
$addr=$_POST['addr'];
$gstin=$_POST['gstin'];
$gstdt1=$_POST['gstdt'];
$pan=$_POST['pan'];
$ctyp=$_POST['ctyp'];
$fst=$_POST['fst'];
$brand=$_POST['brand'];
$nmp=$_POST['nmp'];
$sale_per=$_POST['sale_per'];

$pin=$_POST['pin'];
$town=$_POST['town'];
$distn=$_POST['distn'];
$brncd=$_POST['brncd'];
$credit_limit=$_POST['credit_limit'];
$gtm=$_POST['gtm'];
$isfin=$_POST['isfin'];
$gstdt="";
$err='';
if($ctyp=='2')
{
	if($brand=='')	
	{
	$err="Brand Cant Be Blanked For Wholesale Customer...!!";		
	}
}

if($cnm=='')
{
	$err="Please Enter Name .....";
}
if($mob=="")
{
$err = "Please Enter Mobile No. ... ";		
}
if($brncd=="")
{
$err = "Please Select Branch. ... ";		
}
	//$dsql=mysqli_query($conn,"select * from main_cust where cont='$mob' and nm='$cnm'") or die (mysqli_error($conn));
	$dsql=mysqli_query($conn,"select * from main_cust where cont='$mob' and nm='$cnm' and brand='$brand' and gstin='$gstin'") or die (mysqli_error($conn));
	$drcnt=mysqli_num_rows($dsql);
	if($drcnt>0)
	{
		$err="Data Already Exists";	
	}


if($gstin!='')
{
if(!preg_match("/[0-9]{2}[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9A-Za-z]{1}[Zz1-9A-Ja-j]{1}[0-9a-zA-Z]{1}/", $gstin))
{
    $err = "Invalid GST number ";
  
} 
if($gstdt1=='')
{
 $err = "Please Enter GSTIN Applicable Date. ";	
}
}


if($err=='')
{
if($gstdt1!='')
{
$gstdt=date('Y-m-d', strtotime($gstdt1));
}
$sql=mysqli_query($conn,"insert into main_cust(typ,nm,vat_no,addr,cont,mail,edt,edtm,eby,gstin,pan,gstdt,fst,brand,nmp,sale_per,pin,town,distn,brncd,credit_limit,gtm,isfin)
values('$ctyp','$cnm','$vat_no','$addr','$mob','$email','$dt','$dttm','$user_currently_loged','$gstin','$pan','$gstdt','$fst','$brand','$nmp','$sale_per','$pin','$town','$distn','$brncd','$credit_limit','$gtm','$isfin')") or die (mysqli_error($conn));


$data19= mysqli_query($conn,"select * from main_cust order by sl desc limit 0,1")or die(mysqli_error($conn));
while ($row19 = mysqli_fetch_array($data19))
{
$csl=$row19['sl'];
}

$dsql=mysqli_query($conn,"select * from main_cust_asgn where spid='$sale_per'") or die (mysqli_error($conn));
$drcnt=mysqli_num_rows($dsql);
if($drcnt>0)
{

$sql=mysqli_query($conn,"update main_cust_asgn set cust=CONCAT(cust,',$csl') where spid='$sale_per'") or die (mysqli_error($conn));
}
else
{
$sql=mysqli_query($conn,"insert into main_cust_asgn(spid,cust,edt,eby) values('$sale_per','$csl','$dt','$user_currently_loged')") or die (mysqli_error($conn));
	
}

?>
<Script language="JavaScript">
alert('Submitted Successfully. Thank You...');
document.location="cust_entry.php";
</script>
<?php 
}
else
{
?>
<script>
alert('<?php  echo $err;?>');
history.go(-1);
</script>
<?php 
}

?>