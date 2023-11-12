<?php
$reqlevel = 1;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s');
include("Numbers/Words.php");

$pnm=$_REQUEST['pnm'];
$qnty=$_REQUEST['qnty'];
$prate=$_REQUEST['prate'];
$betno=$_REQUEST['betno'];
$iwa=$_REQUEST['iwa'];
$owa=$_REQUEST['owa'];


if($pnm=='' or $qnty==''or $prate=='' or $iwa=='' or $iwa=='0' or $owa=='' or $owa=='0' )
{
	$err="Please Fill All Fields....";
}
else
{
	
	$q45=mysqli_query($conn,"select * from main_partemp where pcd='$pnm' and betno='$betno' and eby='$user_currently_loged'")or die(mysqli_error($conn));
	$cnt45=mysqli_num_rows($q45);
	if($cnt45>0)
	
	{
		  $err="Duplicate Entry..... ";
	}
	else
	{
		
        
   $result = mysqli_query($conn,"SELECT * FROM main_parts where sl='$pnm'")or die(mysqli_error($conn));
while ($R56 = mysqli_fetch_array ($result))
{
$ppnm=$R56['pnm'];
$pbnm=$R56['bnm'];
$pcat=$R56['cat'];
}

$lttl=$qnty*$prate;


$result21 = mysqli_query($conn,"INSERT INTO main_partemp (pcd,pnm,qnty,prate,ttl,eby,edt,edtm,betno,iwa,owa)
 VALUES ('$pnm','$ppnm','$qnty','$prate','$lttl','$user_currently_loged','$edt','$edtm','$betno','$iwa','$owa')")or die(mysqli_error($conn));
//echo $query21;   


}

}
if($err!="")
{
	?>
	 <script>
	 alert('<?=$err;?>');
	  </script>
	<?
}

?>
 <script>

tmppr1();
$('#pnm').trigger('chosen:open');
</script>

<?
mysqli_close();
?>