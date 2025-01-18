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
        $query = "SELECT * FROM main_ledg where nm like '$a' limit 0,10";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$sl=$R['sl'];
$nm=$R['nm'];
$gcd=$R['gcd'];


			echo "<rs id=\"".$sl."\" info=\"\" title=\"\" extr_vl=\"\">".$nm."</rs>";
		}
		echo "</results>";

?>
