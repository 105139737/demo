<?php 
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('y-m-d');
$edtm=date('y-m-d H:i:s a');
$als=$_POST['als'];
$tp=$_POST['tp'];
$adrs=$_POST['adrs'];
$ssn=$_POST['ssn'];
$ssl=$_POST['ssl'];
$brand=$_POST['brand'];
$brncd=$_POST['brncd'];
$start_no=$_POST['start_no'];
$inv_typ=$_POST['inv_typ'];
$err="";
$val="";
for($i=0;$i<count($brand);$i++)
{
	
	if($val=="")
	{
	 $val=$brand[$i];	
	}
	else
	{
	 $val=$val.','.$brand[$i];	
	}
}

if($als=="" or $tp=="" or $adrs=="" or $ssn=="" or $inv_typ=="")
{
$err="Please Fill All The Field.";	
}

$s=mysqli_query($conn,"select * from main_billtype where als='$als' and tp='$tp' and brncd='$brncd' and inv_typ='$inv_typ' and sl!='$ssl' and ssn='$ssn'") or die (mysqli_error($conn));
$c=mysqli_num_rows($s);
if($c>0)
{
$err="Data Already Exist.";		
}


$query51="select * from main_billtype_log order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51) or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{	
$vnos=$rows['btid'];
}	
$vid1=substr($vnos,2,7);	
$count6=5;
while($count6>0)
{
	$vid1=$vid1+1;
	$vnoc=str_pad($vid1, 7, '0', STR_PAD_LEFT);
	$vcno="BT".$vnoc;
	$query5="select * from main_billtype_log where btid='$vcno'";
	$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
	$count6=mysqli_num_rows($result5);
}

$get=mysqli_query($conn,"select * from main_billtype where sl='$ssl'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
	$als1=$row['als'];
	$tp1=$row['tp'];
	$adrs1=$row['adrs'];
	$ssn1=$row['ssn'];
	$brand1=$row['brand'];
	$brncd1=$row['brncd'];
	$start_no1=$row['start_no'];
	$inv_typ1=$row['inv_typ'];
$sql=mysqli_query($conn,"insert into main_billtype_log(als,tp,adrs,ssn,brand,brncd,start_no,inv_typ,table_sl,btid,edt,edtm,eby) values('$als1','$tp1','$adrs1','$ssn1','$brand1','$brncd1','$start_no1','$inv_typ1','$ssl','$vcno','$edt','$edtm','$user_currently_log')") or die (mysqli_error($conn));
}
	
if($err=="")
{
$get1=mysqli_query($conn,"select * from main_billing where bill_typ='$ssl'") or die(mysqli_error($conn));
$countt=mysqli_num_rows($get1);
	
if($countt==0)
{	
$sql=mysqli_query($conn,"update main_billtype set als='$als',tp='$tp',adrs='$adrs',ssn='$ssn',brncd='$brncd',brand='$val',start_no='$start_no',inv_typ='$inv_typ' where sl='$ssl'") or die (mysqli_error($conn));
}
else if($countt>0)
{
$sql=mysqli_query($conn,"update main_billtype set tp='$tp',adrs='$adrs',brncd='$brncd',brand='$val',start_no='$start_no',inv_typ='$inv_typ' where sl='$ssl'") or die (mysqli_error($conn));
}


?>
<script>
alert('Update Successfully.');
document.location="billtyp_ntry.php";
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