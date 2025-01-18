<?php 
$reqlevel = 1;
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
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header ("Pragma: no-cache"); // HTTP/1.0
$input =$_REQUEST['inputp'];
$a="%".$input."%";
	$len = strlen($input);
    
		header("Content-Type: text/xml");

		echo "<?php xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
        $query = "SELECT * FROM ".$DBprefix."product where pname like '$a' limit 0,10";
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
 $query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and bcd='$branch_code' group by pcd";
$result4 = mysqli_query($conn,$query4);
  while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}

$stku=$punt.",".$upkg;

$stkf=$stck/$ptu;

$stkub=floor($stkf)." ".$punt;
$stkus=$stck%$ptu." ".$upkg;
$stcku="Stock : ".$stkub.", ".$stkus;
			echo "<rs  id=\"".$pcd."\" info=\"".$stcku."\" title=\"$branch_name\" extr_vl=\"".$stku."\">".$b."</rs>";
		}
		echo "</results>";

?>

