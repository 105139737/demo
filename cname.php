<?php
$reqlevel = 3;
include("membersonly.inc.php");
    $id = $_REQUEST['cid'];
    $brand = $_REQUEST['brand'];

	
	$pp=0;
	$result = mysqli_query($conn,"SELECT * from ".$DBprefix."cust where sl='$id'");
          while($row = mysqli_fetch_array($result))
		 {
                $sl=$row['sl'];
                $nm=$row['nm'];
                $addr=$row['addr'];
                $cont=$row['cont'];
                $mail=$row['mail'];
                $typ=$row['typ'];
                $fst=$row['fst'];
                $brncd=$row['brncd'];
                $tcs=$row['tcs'];
                $gstin=$row['gstin'];
                $credit_limit=$row['credit_limit'];              
				if($fst==NULL or $fst=="")
				{
				$fstt="1";	
				}
				else
				{
				$fstt=$fst;	
				}
			
			
		 }
	$T=0;
$t1=0;
$t2=0;

$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where dldgr='4' and cid='$id' and brncd='$brncd'")or die (mysqli_error($conn));

		while ($row = mysqli_fetch_array($data))
		{
			$t1 = $row['t1'];
		}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where cldgr='4' and  cid='$id' and brncd='$brncd'")or die (mysqli_error($conn));
	while ($row1 = mysqli_fetch_array($data1))
		{
			$t2 = $row1['t2'];
		}
		$T=$t1-$t2;	
$sale_per="";		
$result = mysqli_query($conn,"SELECT * from main_cust_asgn where sl>0 and typ='0' and FIND_IN_SET('$id', cust)>0 ");
while($row = mysqli_fetch_array($result))
{
$sale_per=$row['spid'];
}		
if($tcs=='1'){$tcss=0.1;}else{$tcss=0;}
    echo $typ."@@".$nm."@@".$addr."@@".$cont."@@".$mail."@@".$pp."@@".$T."@@".$sl."@@".$fstt."@@".$sale_per."@@".$credit_limit."@@".$tcss."@@".$gstin;


    



?>