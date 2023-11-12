<?
set_time_limit(0);
$BackupFolder="backup";	if(!is_dir($BackupFolder)){mkdir($BackupFolder);}
$BackupSubFolder="backup/files";	if(!is_dir($BackupSubFolder)){mkdir($BackupSubFolder);}

$database="xyz";

$zipn="$BackupSubFolder/$database.zip";
	$path="cupertino/";
	exec("zip -r $zipn $path");

	
if(function_exists('exec')) {
echo "exec is enabled";
}	
	

/*
$x=1;	
while($x>0)
{
if(!file_exists($zipn))
{
$x=1;
echo "Please Wait While Downloading....<br>";
}
else
{
break;
}

}
*/
?>
<script>
alert("Downloading...");
//document.location='<?php echo $zipn;?>';
</script>
