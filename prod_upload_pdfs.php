<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include('SimpleImage.php');
date_default_timezone_set('Asia/Kolkata');
$edt=date('Y-m-d');
$edtm=date('d-m-Y h:i:s a');

$path="product_price_pdf";

 $cat=$_POST['cat'];
 $typ=$_POST['typ'];
$title=$_POST['ttl'];
$sl=$_POST['sl'] ?? "";
/*
foreach ($cat as $cats) 
{
  $catall=$catall.','.$cats;
}
$catalls = ltrim($catall, ',');
*/
if($title=="" or $cat=="" or $typ=="" )
{
	?>
	<script>
	alert('Please Fill All The Field');
	history.go(-1);
	</script>
	<?php 
}
else
{
	if($sl=="")
	{
		$dsql=mysqli_query($conn,"select * from main_prod_prc_pdf where title='$title'") or die (mysqli_error($conn));
		$drcnt=mysqli_num_rows($dsql);
		if($drcnt==0)
		{
	
			
			$get=mysqli_query($conn,"select * from main_prod_prc_pdf order by sl") or die(mysqli_error($conn));
			while($row=mysqli_fetch_array($get))
			{
				$pic_sl=$row['sl'];
			}
			$picsl=$pic_sl+1;
			if(!is_dir($path)){mkdir($path);}
			$targetFolder=$path;
			
			$pic_path=$path."/".$picsl.".pdf";
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $pic_path);
			
$sql=mysqli_query($conn,"insert into main_prod_prc_pdf(title,path,edt,edtm,eby,cat,typ	) values('$title','$pic_path','$edt','$edtm','$user_currently_loged','$cat','$typ')") or die (mysqli_error($conn));

			?>
			<script>
			alert('Submitted Successfully. Thank You');
			document.location="prod_upload_pdf.php";
			</script>
			<?php 
		}
		else
		{
			?>
			<script>
			alert('Data Already Exists');
			history.go(-1);
			</script>
			<?php 
		}
	}
	else
	{
		$dsql=mysqli_query($conn,"select * from main_prod_prc_pdf where title='$title' and sl!='$sl'") or die (mysqli_error($conn));
		$drcnt=mysqli_num_rows($dsql);
		if($drcnt==0)
		{
			$pic_path=$path."/".$sl.".pdf";
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $pic_path);
			
			
			$sql=mysqli_query($conn,"update main_prod_prc_pdf set title='$title',cat='$cat',typ='$typ' where sl='$sl'") or die(mysqli_error($conn));
			?>
			<script>
			alert('Update Successfully. Thank You');
			document.location="prod_upload_pdf.php";
			</script>
			<?php  
		}
		else
		{
			?>
			<script>
			alert('Data Already Exists');
			history.go(-1);
			</script>
			<?php 
		}
	}
}
?>