<?php
ini_set("memory_limit", "-1");
set_time_limit(0);
require("../config.php");
$data2= mysqli_query($conn,"select * from  main_aa_jobs where status='Processing'")or die(mysqli_error($conn));
$count=mysqli_num_rows($data2);
if($count==0){
$data1= mysqli_query($conn,"select * from  main_aa_jobs where status!='Done'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data1))
{
$id=$row1['id'];
$link=$row1['link'].'&file_name='.$id;
date_default_timezone_set('Asia/Kolkata');
$jobstart=date('Y-m-d h:i:s');
$query1 = "UPDATE main_aa_jobs Set status='Processing',jobstart='$jobstart' where id='$id'";
$result1 = mysqli_query($conn,$query1);

$opts = array('http' =>
    array(
        'method'  => 'GET',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => ''
    ),
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);
$context  = stream_context_create($opts);
$filename = file_get_contents($link, false, $context);
$filename="jobs/jobs_report/".$id.".xls";
date_default_timezone_set('Asia/Kolkata');
$comp_date=date('Y-m-d h:i:s');
$query = "UPDATE main_aa_jobs Set comp_date='$comp_date',status='Done',file='$filename' where id='$id'";
$result = mysqli_query($conn,$query);


die();
}
}
mysqli_close($conn);
