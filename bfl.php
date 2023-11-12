<?php
include("config.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s');
$curl = curl_init();
$dealId=$_REQUEST['dealId'];
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://prodapitm.bajajfinserv.in/POSReinventDOVSWS/DODetails?dealId=".$dealId."&partner=15802",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Ocp-Apim-Subscription-Key: 3a4e5289e5a44c46ab3dd81ac735d313"
  ),
));

$response = curl_exec($curl);
//$af="ResponseMessage";
//$response = json_decode($response);
// $added= mysqli_query($conn,"ALTER TABLE main_bfl ADD ".$k." VARCHAR(300) NOT NULL AFTER ".$af);
//print_r($arr['DoDetails']);
curl_close($curl);
//echo ($response);

$arr = json_decode($response, true);
if($arr['ResponseMessage']=='success')
{
$fld="ResponseCode,ResponseMessage,edt,edtm,eby";
$ResponseCode=$arr['ResponseCode'];
$ResponseMessage=$arr['ResponseMessage'];
$val="'$ResponseCode','$ResponseMessage','$edt','$edtm','$user_currently_loged'";

foreach ($arr['DoDetails'] as $k=>$v){
   // echo $k; // etc..

    $fld.=",".$k;    
    $val.=",'$v'";
}
$DealID=$arr['DoDetails']['DealID'];
$query = "SELECT * FROM main_bfl where DealID='$DealID'";
$result = mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
if($count>0){
$err="Data Already Exists...";
}
if($err=='')
{
$query2 = "INSERT INTO main_bfl ($fld) VALUES ($val)";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error());
}
$nm=$arr['DoDetails']['CustomerName'];
$mob=$arr['DoDetails']['CustomerPhoneNo'];
$addr="CITY :".$arr['DoDetails']['CITY'].", ".$arr['DoDetails']['AddressLine1'].", ".$arr['DoDetails']['AddressLine1'].", ".$arr['DoDetails']['AddressLine2'].", ".$arr['DoDetails']['AddressLine3'].", Area : ".$arr['DoDetails']['Area'].", Landmark : ".$arr['DoDetails']['Landmark'];
$email=$arr['DoDetails']['CustomerEmailID'];
$gstin_no=$arr['DoDetails']['customerGSTIN'];
$pan=$arr['DoDetails']['CustomerPAN'];
$state_nm=$arr['DoDetails']['STATE'];
$state='';
$sql="SELECT * FROM main_state WHERE sn='$state'";
$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
while($row=mysqli_fetch_array($result))
{
$state=$row['sl'];
}
$pin=$arr['DoDetails']['PinCode'];
$town=$arr['DoDetails']['CITY'];
$queryx="select * from ".$DBprefix."cust where cont='$mob' and nm='$nm'";
$resultx = mysqli_query($conn,$queryx);
$cntx=mysqli_num_rows($resultx);
if($cntx==0)
{
$query6 = "INSERT INTO ".$DBprefix."cust (typ,nm,addr,cont,mail,edt,edtm,eby,gstin,pan,fst,gstdt,brand,sale_per,nmp,pin,town,distn,brncd) VALUES
('1','$nm','$addr','$mob','$email','$edt','$edtm','$user_currently_loged','$gstin_no','$pan','$state','$edt','$brand','$s_per','$nmp','$pin','$town','$distn','$branch_code')";
$result6 = mysqli_query($conn,$query6)or die (mysqli_error($conn));    
}
$query111 = "SELECT * FROM ".$DBprefix."cust where cont='$mob' and nm='$nm'";
$result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$sl=$R111['sl'];
}

?>
<table>
 <tr>
     <td>
    <b> MAKE :  <?=$arr['DoDetails']['MAKE'];?> || ModelNo : <?=$arr['DoDetails']['ModelNo'];?> ||  InvoiceAmount : <?=$arr['DoDetails']['InvoiceAmount'];?></b>
     </td>
</tr>
</table>
<Script language="JavaScript">
document.getElementById('sfno').value='<?=$arr['DoDetails']['DealID'];?>';
document.getElementById('dpay').value='<?=$arr['DoDetails']['AdvanceEMI'];?>';
document.getElementById('finam').value='<?=$arr['DoDetails']['NetLoanAmount'];?>';
document.getElementById('emiam').value='<?=$arr['DoDetails']['TotalEMI'];?>';


$('#invto').append('<option value="<?=$sl;?>"><?=$nm;?> <?if($mob!=""){?>( <?=$mob;?> )<?}?></option>');
$('#invto').trigger('chosen:updated');
document.getElementById('invto').value='<?=$sl;?>';
$('#invto').trigger('chosen:updated');
//adnew();
</script>
<?
}
else
{
echo "<center><font size='3' color='red'><b>".$arr['ResponseMessage']."</b></font></center>";
}
?>

