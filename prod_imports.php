<?
$reqlevel = 1;
include("membersonly.inc.php");
$edt=date('y-m-d');
$edtm=date('y-m-d H:i:s a'); 
   
	if(isset($_FILES["file"]))
	{
		if($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else
		{
			if (file_exists($_FILES["file"]["name"]))
			{
				unlink($_FILES["file"]["name"]);
			}
			$storagename = "discussdesk.xlsx";
			
			move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
			$uploadedStatus = 1;
		}
	}
	else
	{
		echo "No file selected <br />";
	}


set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';
// This is the file path to be uploaded.
$inputFileName = 'discussdesk.xlsx';

try 
{
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
}
catch(Exception $e)
{
die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

 

$data = $objPHPExcel->getActiveSheet()->toArray(true,true,true,true);
$arrayCount = count($data);  // Here get total count of row in that Excel sheet

for($i=2;$i<=$arrayCount;$i++)
{
$dis=0;	
$disam=0;

$modelno = trim($data[$i]["A"]);
$prc = trim($data[$i]["B"]);
$dis = trim($data[$i]["C"]);
$disam = trim($data[$i]["D"]);
$offprc = trim($data[$i]["F"]);
$offless = trim($data[$i]["G"]);
$lprc = trim($data[$i]["H"]);
if($dis==""){$dis=0;}
if($disam==""){$disam=0;}
if($offprc==""){$offprc=0;}
if($offless==""){$offless=0;}
if($lprc==""){$lprc=0;}
$modelno=str_replace("'",'"',$modelno);
$sql = mysqli_query($conn,"INSERT INTO main_product_prc_temp(modelno,prc,dis,disam,offprc,offless,lprc,edt,edtm,eby) VALUES ('$modelno','$prc','$dis','$disam','$offprc','$offless','$lprc','$edt','$edtm','$user_currently_loged')") or die(mysqli_error($conn));
$msg = 'Data added Successfully...Thank You! ';

}
//$Path = 'pic/xx.xlsx';
  
    
  
?>
<script>
alert('<?=$msg;?>');
document.location="prod_import.php";
</script>