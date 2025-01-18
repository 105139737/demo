<?php 
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$als=$_POST['als'];
$tp=$_POST['tp'];
$adrs=$_POST['adrs'];
$ssn=$_POST['ssn'];
 $brand=$_POST['brand']??null;
$brncd=$_POST['brncd'];
$start_no=$_POST['start_no'];
$inv_typ=$_POST['inv_typ'];
$err="";

$val="";
if(!empty($brand) and count($brand)>0)
{
for($i=0;$i<count($brand)??0;$i++)
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
}

if($als=="" or $tp=="" or $adrs=="" or $ssn=="" or $inv_typ=="")
{
$err="'Please Fill All The Field'";	
}

$dsql=mysqli_query($conn,"select * from main_billtype where als='$als' and ssn='$ssn' and brncd='$brncd' and tp='$tp' and inv_typ='$inv_typ'") or die (mysqli_error($conn));
	$drcnt=mysqli_num_rows($dsql);
	if($drcnt>0)
	{
	$err="Data Already Exists";		
	}

if($err=='')
{
$sql=mysqli_query($conn,"insert into main_billtype(als,tp,adrs,ssn,brand,brncd,start_no,inv_typ) values('$als','$tp','$adrs','$ssn','$val','$brncd','$start_no','$inv_typ')") or die (mysqli_error($conn));
?>
<script>
alert('Submitted Successfully');
document.location="billtyp_ntry.php";
</script>
<?php 
}
else
{
?>
<script>
alert("<?php  echo $err;?>");
history.go(-1);
</script>
<?php 
}
?>