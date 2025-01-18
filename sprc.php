<?php 
include 'config.php';
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
$input =$_REQUEST['input'];
$a="%".$input."%";
	$len = strlen($input);
		header("Content-Type: text/xml");

		echo "<?php xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
        $query = "SELECT * FROM ".$DBprefix."suppl where (tp='Debtors' or tp='Both') and (nm like '$a'||sid like '$a'||mob1 like '$a'||mob2 like '$a'||spn like '$a')";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$cid=$R['sid'];
$b=$R['nm'];
$c=$R['mob1'];
$d=$R['addr'];





			echo "<rs id=\"".$cid."\" info=\"".$c."\" title=\"$d\" extr_vl=\"Mobile\">".$b."</rs>";
		}
		echo "</results>";

?>
