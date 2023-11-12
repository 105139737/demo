<?php

/**
 * @author Nirmal Biswas
 * @copyright 2013
 */
$reqlevel = 1;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s');
$dt1 = date('Y-m-d');
$dtm = date('Y-m-d h:i:s a');


$c=$_POST['pnm'];

$betno=$_POST['betno'];
$expdt=$_POST['expdt'];

$sl=$_POST['sl'];

if($expdt!="")
{
$expdt=date('Y-m-d', strtotime($expdt));
}
else{
	$expdt="";
}



//$query3 = "SELECT * FROM ".$DBprefix."product where pname='$c' and co='$co' and pkgunt='$d'";
 //  $result3 = mysqli_query($conn,$query3);
 //$count=mysqli_num_rows($result3);
//if($count>0)
//{
//$err="Product Already Exists..";	
//}
   
//$c1=mysqli_query($conn,"SELECT * FROM ".$DBprefix."stock where pcd='$sl' and betno='$betno'");
//$count=mysqli_num_rows($c1);
//if($count>0)
//{
//$err="Product And Batch No. Already Exists..";	
//}

$datao= mysqli_query($conn,"select * from main_stock where sl='$sl'");
while ($rowo = mysqli_fetch_array($datao))
{	

$oldv=$rowo['expdt'];
$betno_old=$rowo['betno'];

}


$result=mysqli_query($conn,"Update main_stock set expdt='$expdt',betno='$betno' where sl='$sl'")or die (mysqli_error($conn));


$sql = "INSERT INTO main_edt_log (tblnm,tblsl,ufnm,fldnm,oldvl,nvl,rdt,rdtm,rby,edt,edtm,eby)VALUES('main_stock','$sl','sl','expdt','$oldv','$expdt','$dt1','$dtm','$user_currently_loged','$dt1','$dtm','$user_currently_loged')";
$result = mysqli_query($conn,$sql)or die (mysqli_error($conn));

$sql1 = "INSERT INTO main_edt_log (tblnm,tblsl,ufnm,fldnm,oldvl,nvl,rdt,rdtm,rby,edt,edtm,eby)VALUES('main_stock','$sl','sl','betno','$betno_old','$betno','$dt1','$dtm','$user_currently_loged','$dt1','$dtm','$user_currently_loged')";
$result = mysqli_query($conn,$sql1)or die(mysqli_error($conn))or die (mysqli_error($conn));









?>
<script language="javascript">
alert('Batch No./Expiry Date Update Completed. Thank You.....');
document.location="beth_show.php";
</script>
<?  
