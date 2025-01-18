<?php 
$blno=$_REQUEST['blno'] ?? "";
if($blno!='')
{
$filenm=str_replace('/','',$blno);
$file_name=$filenm.".pdf";

unlink($file_name);
echo 'true';
}
else
{
    echo 'false';
}
?>