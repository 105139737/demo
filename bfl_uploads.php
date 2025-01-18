<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include('SimpleImage.php');
include "Bajaj_API_Calling.php";
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$edtm=date('d-m-Y h:i:s a');

$blno=$_POST['blno'];
//$pic_path=$path."/".$picsl.".pdf";
//move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $pic_path);
$file = base64_encode(file_get_contents($_FILES['blno_file']['tmp_name'], true));
$data1= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$dt=$row1['dt'];
$dono=$row1['vat'];
$bill_no=$row1['bill_no'].".pdf";
}
$err="";
if($bill_no!=$_FILES['blno_file']['name'])
{
 $err="Please Check PDF File ";   
}

if($blno==''){ $err="Please INV No. ";  }

if($err=='')
{
$response=array();
$response1=array();
$response3=array();
$response4=array();


$response['id']="";
$response1['name']=$_FILES['blno_file']['name'];
$response1['fileType']="pdf";
$response1['body']=$file;
$response1['docType']="Invoice";
$response4[]=$response1;
$response['files']=$response4;
$response['opportunityName']=$dono;
$response['invoiceNumber']=$blno;
$response['invoiceDate']=$dt;
$response['txt1']="";
$response['txt2']="";
$response['txt3']="";
$response3[]=$response;

$myJSON = json_encode($response3);
$make_call1 = callAPIB('POST', "https://prodapitm.bajajfinserv.in/POSISDDocsUploadWS/SubmitDocument", json_encode($response3),true);
/*
$res=array();
$res1=array();
$res['responseCode']="0";
$res['responseMessage']="SUCCESS";
$res1['status']=$res;
$make_call1 = json_encode($res1);
*/
//echo $make_call1;
$make_call1 = json_decode($make_call1,true);

$err=$make_call1['status']['responseMessage'];

if($make_call1['status']['responseMessage']=='SUCCESS')
{
$data1= mysqli_query($conn,"update main_billing set bfl_upload='1' where blno='$blno'")or die(mysqli_error($conn));    
}
	
}		
?>
<script language="javascript">
alert('<?php  echo $err;?>');
history.go(-1);
</script>