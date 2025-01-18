<?php 

/**
 * @author Nirmal Biswas
 * @copyright 2013
 */
include('config.php');
    $id = $_REQUEST['cid'];
	$query = "SELECT * from ".$DBprefix."cust where cid='$id'";
	$result = mysqli_query($conn,$query);
    $count=mysqli_num_rows($result);
    if($count==0){
        echo "Wrong Customer ID";
    }
    else
    {
         while($row = mysqli_fetch_array($result)){
                $a=$row['nm'];
                $b=$row['addr'];
                $c=$row['mob1'];
                }
    echo $a."@".$b."@".$c;
    }
    

?>