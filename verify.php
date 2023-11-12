<?php

/**
 * @author Nirmal
 * @copyright 2016
 */
include "config.php";
$username1=$_REQUEST[mob];
$password1=$_REQUEST[pw];
$err="";

$query = "Select * from ".$DBprefix."signup where username='$username1'";
$result = mysqli_query($conn,$query);
if ($row = mysqli_fetch_array($result)){
    
    if ($row["actnum"] == "0"){
    if ($row["numloginfail"] <= 5){
    if (md5($row["password"]) == md5($password1)){
    $last_login=$row["lastlogin"]." from IP ".$row["ip"];
				$datetime = date("d-m-Y G:i ");
				$query1 = "UPDATE ".$DBprefix."signup Set lastlogin = '$datetime' where username='$username1'";
				$result1 = mysqli_query($conn,$query1);
				$query2 = "UPDATE ".$DBprefix."signup Set numloginfail = '0' where username='$username1'";
				$result2 = mysqli_query($conn,$query2);
    
    $err="Registered#".$row['username']."#".$row['name']."#".$row['mob']."#".$row['mailadres']."#".$row['password']."#".$row['userlevel'];
    
    
    }
    else
    {
        $err="NotRegistered";
    }
    }
    else
    {
        $err="NotRegistered";
    }
    }
    else
    {
        $err="NotRegistered";
    }
    }
    else
    {
        $err="NotRegistered";
    }

echo $err;


?>