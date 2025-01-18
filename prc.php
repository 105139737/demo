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
        $query = "SELECT * FROM main_catg where cnm like '$a' limit 0,18";
   $result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$cnm=$R['cnm'];
$tnm=$R['tnm'];
$cnt=$cnt+1;
			echo "<rs id=\"".$cnm."\" info=\"".$tnm."\" title=\"$tnm\">".$tnm."</rs>";
		}
  while($cnt<18){
    echo "<rs id=\"0\" info=\"".$cnm."\" title=\"$tnm\">N/A</rs>";
    $cnt=$cnt+1;
  }
		echo "</results>";

?>
