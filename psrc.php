<?php 
$reqlevel = 3;
include("membersonly.inc.php");
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
$cnt=0;
		echo "<?php xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
        $query = "SELECT m.nm as mby, c.nm as pct, c.sl as csl, c.ccd as mcd FROM ".$DBprefix."mdby m INNER JOIN ".$DBprefix."catg c ON c.ccd=m.sl where c.nm like '$a'";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$cid=$R['csl'];
$b=$R['pct'];
$c=$R['mby'];
$mcd=$R['mcd'];
$cnt=$cnt+1;
			echo "<rs id=\"".$cid."\" info=\"".$mcd."\" title=\"$d\">".$c." ".$b."</rs>";
		}
  
		echo "</results>";

?>
