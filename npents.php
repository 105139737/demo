<?php 



/**

 * @author Nirmal Biswas

 * @copyright 2013

 */

$reqlevel = 3;$_REQUEST['cat'] ?? ""

include("membersonly.inc.php");

$dt=date('Y-m-d');

$dttm=date('d-m-Y H:i:s');



$aa='1';

$b=rawurldecode($_REQUEST[cat]);

$c=rawurldecode($_REQUEST[pnm]);

$d=rawurldecode($_REQUEST[Combobox1]);

$ops=rawurldecode($_REQUEST[ops]);

$reo=rawurldecode($_REQUEST[reo]);

$tech=rawurldecode($_REQUEST[tech]);

$co=rawurldecode($_REQUEST[co]);

$ret=rawurldecode($_REQUEST[ret]);

$betno=rawurldecode($_REQUEST[betno]);

$expdt=rawurldecode($_REQUEST[expdt]);





if($expdt!="")

{

$expdt=date('Y-m-d', strtotime($expdt));

}

else{

	$expdt="";

}



if($c==""){

	$err="You Cant Left The Field Blank";

}



    $query3 = "SELECT * FROM ".$DBprefix."product where pname='$c'";

   $result3 = mysqli_query($conn,$query3);

   while($row1=mysqli_fetch_array($result3))

   {

	   $psl=$row1[sl];

   }

$c1=mysqli_query($conn,"SELECT * FROM ".$DBprefix."stock where pcd='$psl' and betno='$betno'");

$count=mysqli_num_rows($c1);

if($count>0)

{

$err="Product And Batch No. Already Exists..";	

}

if($err=="")

{



$queryw = "SELECT * FROM ".$DBprefix."unit where sl='$d'";

   $resultw = mysqli_query($conn,$queryw);

while ($Rw = mysqli_fetch_array ($resultw))

{

$tunt=$Rw['tunt'];

}

$log=0;

  $query1 = "SELECT * FROM ".$DBprefix."product where pname='$c'";

   $result1 = mysqli_query($conn,$query1);

    while($row=mysqli_fetch_array($result1))

   {

	$vnoc=$row['sl'];  

$log=1;	

   }

   if($log==0)

   {

         $countvnoc=5;



while($countvnoc>0){

$vidc=$vidc+1;

$vnoc=str_pad($vidc, 7, '0', STR_PAD_LEFT);



$vnoc="P".$vnoc;

$query51="select * from ".$DBprefix."product where sl='$vnoc'";

$result51 = mysqli_query($conn,$query51);

$countvnoc=mysqli_num_rows($result51);



}

   }

$reo1=$reo*$tunt;

$ret1=$ret/$tunt;

$ops1=$ops*$tunt;



 



 if($log==0)

   {

$query2 = "INSERT INTO ".$DBprefix."product (sl,mdby,csl,pname,pkgunt,reo,co,ret) VALUES ('$vnoc','$a','$tech','$c','$d','$reo1','$co','$ret1')";

$result2 = mysqli_query($conn,$query2);	

   }









$query21 = "INSERT INTO ".$DBprefix."stock (pcd,bcd,dt,opst,nrtn,eby,dtm,betno,expdt,ret,lef,stat) VALUES ('$vnoc','$branch_code','$dt','$ops1','Open Stock','$user_currently_loged','$dttm','$betno','$expdt','$ret1','$ops1','1')";

$result21 = mysqli_query($conn,$query21)or die(mysqli_error($conn));



 

    }

    else

    {

echo $err;

    }

?>