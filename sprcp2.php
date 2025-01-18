<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$dt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');
/*
note:
this is just a static test version using a hard-coded countries array.
normally you would be populating the array out of a database

the returned xml has the following structure
<results>
	<rs>foo</rs>
	<rs>bar</rs>
</results>
*/
?>
<table width="100%">

<?php 
$a=$_REQUEST[prnm];
   $query = "SELECT * FROM ".$DBprefix."product where pname like '%$a%' limit 0,6";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$pcd=$R['sl'];
$b=$R['pname'];
$c=$R['pkgunt'];

$query1="Select * from ".$DBprefix."unit where sl='$c'";
   $result1 = mysqli_query($conn,$query1);
while ($R1 = mysqli_fetch_array ($result1))
{
$puntsl=$R1['sl'];
$punt=$R1['pkgunt'];
$upkg=$R1['untpkg'];
$ptu=$R1['tunt'];
}
$query2="Select * from ".$DBprefix."stock where pcd='$pcd' and bcd='$branch_code' and dt='$dt'";
$result2 = mysqli_query($conn,$query2);
$count=mysqli_num_rows($result2);
if($count==0){
 $query3="Select * from ".$DBprefix."stock where pcd='$pcd' and bcd='$branch_code' and clst='0'";
$result3 = mysqli_query($conn,$query3);
  while ($R3 = mysqli_fetch_array ($result3))
{
$sl=$R3['sl'];
$opst=$R3['opst'];
$stin=$R3['stin'];
$stout=$R3['stout'];
}

$nopst=$opst+$stin-$stout;

$query211 = "UPDATE ".$DBprefix."stock set clst='$nopst' where sl='$sl'";
$result211 = mysqli_query($conn,$query211);
}
$opst1=0;
$stin1=0;
$stout1=0;
$stck=0;
$stkf=0;
 $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and bcd='$branch_code' group by pcd";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
 $q="Select * from ".$DBprefix."stock where bcd='$branch_code' and pcd='$pcd'";
$r1 = mysqli_query($conn,$q);
  while($r = mysqli_fetch_array($r1))
{
$expdt=$r['expdt'];
$betno=$r['betno'];
$ret=$r['ret'];
}

$stku=$punt.",".$upkg;

if($stck!=0 and $ptu!=0)
{
$stkf=$stck/$ptu;
}
$stkub=floor($stkf)." ".$punt;
if($stck!=0 and $ptu!=0)
{
$stkus=$stck%$ptu." ".$upkg;
}
$stcku="Stock : ".$stkub.", ".$stkus.",Rate/".$upkg.":".$ret;

?>
<tr>

<td style="cursor:pointer" onclick="get('<?php  echo $b?>','<?php  echo $pcd;?>','<?php  echo $ret?>','<?php  echo $upkg?>','<?php  echo $punt;?>','<?php  echo $ptu;?>','<?php  echo $expdt;?>','<?php  echo $betno;?>','<?php  echo $puntsl;?>')">
<a href="#" >
<font size="3"> <?php  echo $b;?> </font>
<br><?php  echo $stcku;?>
<br><?php  echo $bet;?>
</a>
<hr>
</td>

</tr>
<?php 

}

?>
<tr>
<td onclick="clr()" align="center" style="cursor:pointer">
<font size="3" ><a><b>Close</b></a></font>
</td>
</tr>
</table>