<?php 
$reqlevel = 1;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
set_time_limit(0);
$cc=0;
 $query = "SELECT * FROM ".$DBprefix."billing where rstat='1' order by sl";
   $result = mysqli_query($conn,$query);
while ($R111 = mysqli_fetch_array ($result))
{
$blno=$R111['blno'];
$d=$R111['edt'];
$cnm=$R111['cnm'];
$caddr=$R111['caddr'];
$cnt=$R111['cnt'];
$vat=$R111['vat'];
$car=$R111['car'];
$dis=$R111['dis'];
$fid=$R111['fid'];
$sid=$R111['cid'];
$amm=$R111['amm'];
$query6="select * from  main_suppl where sid='$sid'";
$result5 = mysqli_query($conn,$query6);
while($row=mysqli_fetch_array($result5))
{
$ssl=$row['sl'];
}
$gttl=0;
 $query111 = "SELECT (qty*prc) as gttl FROM main_billdtls where blno='$blno' and qty<0 order by sl";
   $result111 = mysqli_query($conn,$query111);
while ($R111 = mysqli_fetch_array ($result111))
{
$gttl+=$R111['gttl'];
}
$cc++;
echo $blno." : ".$gttl." : ".$amm."<br>";
$gttl1=$gttl*(-1);

$up="update main_drcr set amm='$gttl1' where cbill='$blno' and cid='$ssl' and nrtn='Sale Return' and dldgr='-2' and cldgr='4'";
$re=mysqli_query($conn,$up);
}
echo $cc;
?>
