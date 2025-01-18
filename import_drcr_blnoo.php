<?php 
$reqlevel = 3; 
include("config.php");
set_time_limit(0);
/*
$result = mysqli_query($conn,"SELECT * FROM main_recv where dt>='2021-02-27' order by dt,sl  ");
while ($R = mysqli_fetch_array ($result))
{
$blno=$R['blno'];
$als=$R['als'];
$ssn=$R['ssn'];
$rec_dt=$R['dt'];
$ym=date('Ym', strtotime($rec_dt));
$log=0;
$count6=5;
$vid1=0;
$query51="select * from ".$DBprefix."drcr where als='$als' and ssn='$ssn' and blnon!='' and dt>='2020-10-01' order by dt,sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
$vnos=$rows['blnon'];
}

$bill=explode($als,$vnos);
$bill1=explode($ssn,$bill[1]);
$vnos=$bill1[0];

if($start_no>$vnos)
{
$vnos=$start_no;
}
$vid1=$vnos;
if((strlen($vnos))>6)
{
$vid1=substr($vnos,6,15);
}
$vid1=rand(100,1000);
echo $vid1."<br>";

//$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);


while($count6>0){
$vid1=$vid1+1;
echo $blnon=$als.$ym.$vid1.$ssn;
echo "<br>";
$query5="select * from ".$DBprefix."drcr where blnon='$blnon'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);
}

$qr=mysqli_query($conn,"update main_drcr set blnon='$blnon',iu='1' where blno='$blno' and blno!=''") or die(mysqli_error($conn));
$log++;

echo $rec_dt." : : update main_drcr set blnon='$blnon' where blno='$blno' and blno!=''<br>";
}

*/
/*
$als='HDMBO/';
$ssn='/21-22';
$count6=5;
$query51="select * from ".$DBprefix."drcr where als='HDMBO/' and ssn='/21-22' and blnon!='' order by sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
echo $vnos=$rows['blnon'];
}
$bill=explode($als,$vnos);
$bill1=explode($ssn,$bill[1]);
$vnos=$bill1[0];
if($start_no>$vnos)
{
$vnos=$start_no;
}
$vid1=$vnos;

//$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);
if((strlen($vnos))>6)
{
$vid1=substr($vnos,6,15);
}

while($count6>0){
$vid1=$vid1+1;
$blnon=$als.$ym.$vid1.$ssn;
$query5="select * from ".$DBprefix."drcr where blnon='$blnon'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);
}
*/

$query512="select * from ".$DBprefix."drcr where  blnon='' and typ='77'";
$result512 = mysqli_query($conn,$query512)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result512))
{
$blno=$rows['blno'];

$result = mysqli_query($conn,"SELECT * FROM main_recv where blno='$blno' ");
while ($R = mysqli_fetch_array ($result))
{
$blno=$R['blno'];
$als=$R['als'];
$ssn=$R['ssn'];
$rec_dt=$R['dt'];
$ym=date('Ym', strtotime($rec_dt));
$log=0;
$count6=5;
$vid1=0;
$query51="select * from ".$DBprefix."drcr where als='$als' and ssn='$ssn' and blnon!=''  order by dt,sl desc limit 0,1";
$result51 = mysqli_query($conn,$query51)or die(mysqli_error($conn));
while($rows=mysqli_fetch_array($result51))
{
$vnos=$rows['blnon'];
}

$bill=explode($als,$vnos);
$bill1=explode($ssn,$bill[1]);
$vnos=$bill1[0];

if($start_no>$vnos)
{
$vnos=$start_no;
}
$vid1=$vnos;
if((strlen($vnos))>6)
{
$vid1=substr($vnos,6,15);
}
$vid1=rand(100,1000);
echo $vid1."<br>";

//$vnoc=str_pad($vid1, 5, '0', STR_PAD_LEFT);


while($count6>0){
$vid1=$vid1+1;
echo $blnon=$als.$ym.$vid1.$ssn;
echo "<br>";
$query5="select * from ".$DBprefix."drcr where blnon='$blnon'";
$result5 = mysqli_query($conn,$query5) or die(mysqli_error($conn));
$count6=mysqli_num_rows($result5);
}

$qr=mysqli_query($conn,"update main_drcr set blnon='$blnon',iu='1' where blno='$blno' and blno!=''") or die(mysqli_error($conn));
$log++;

echo $rec_dt." : : update main_drcr set blnon='$blnon' where blno='$blno' and blno!=''<br>";
}
}
?>