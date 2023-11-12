<?php
include('config.php');
    $id = $_REQUEST['cid'];
	$query = "SELECT * from ".$DBprefix."suppl where sl='$id'";
	$result = mysqli_query($conn,$query);
          while($row = mysqli_fetch_array($result))
		 {
                $nm=$row['nm'];
                $addr=$row['addr'];
                $mob1=$row['mob1'];
                $email=$row['email'];
                }
$query1 = "SELECT * from ".$DBprefix."suppl_gst where spn='$id'";
$result1 = mysqli_query($conn,$query1);
while($row1 = mysqli_fetch_array($result1))
{
$st=$row1['st'];
}

    echo $nm."@@".$addr."@@".$mob1."@@".$email."@@".$st;


    



?>