<?php
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');
$edt=date('y-m-d');
$edtm=date('y-m-d H:i:s a');
//call_id	tech_id	cnm	cmob	addr	brand	model	serial_no	call_type	remark	parts	edt	edtm	eby	stat
$cnm=$_POST['cnm'];
$brand=$_POST['brand'];
$cmob=$_POST['cmob'];
$addr=$_POST['addr'];
$cdt=date('Y-m-d',strtotime($_POST['cdt']));
$model=$_POST['model'];
$serial_no=$_POST['serial_no'];
$call_type=$_POST['call_type'];
$remark=$_POST['remark'];
if($cnm=="" or $brand=="" or $model=="")
{
	?>
	<script>
	alert('Please Fill All The Field');
	history.go(-1);
	</script>
	<?
}
else
{
	$s=mysqli_query($conn,"select * from main_call where (cnm='$cnm' and brand='$brand' and model='$model') or cmob='$cmob'") or die (mysqli_error($conn));
	$c=mysqli_num_rows($s);
	if($c==0)
	{
		$get=mysqli_query($conn,"select * from main_call order by call_id") or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($get))
		{
			$vnos=$row['call_id'];
		}
		$vid1=substr($vnos,2,4);
		$rcnt=5;

		while($rcnt>0)
		{
			$vid1=$vid1+1;
			$vnoc=str_pad($vid1, 6, '0', STR_PAD_LEFT);

			$vcno="MOB".$vnoc;
			$get1=mysqli_query($conn,"select * from main_call where call_id='$vcno'") or die(mysqli_error($conn));
			$rcnt=mysqli_num_rows($get1);
		}
		$call_id=$vcno;
		
		$sql1=mysqli_query($conn,"insert into main_call(call_id,tech_id,cnm,cmob,addr,brand,model,serial_no,call_type,remark,cdt,edt,edtm,eby,stat) values('$call_id','$tech_id','$cnm','$cmob','$addr','$brand','$model','$serial_no','$call_type','$remark','$cdt','$edt','$edtm','$user_currently_loged','1')") or die (mysqli_error($conn));
		$sql2=mysqli_query($conn,"insert into main_call_dtls(callid,stat,remark,edt,edtm,eby) values('$call_id','1','$remark','$edt','$edtm','$user_currently_loged')") or die (mysqli_error($conn));

		?>
		<script>
		alert('Submitted Successfully. Thank You');
		document.location="docket_call.php";
		</script>
		<?
	}
	else
	{
		?>
		<script>
		alert('Data Already Exists');
		history.go(-1);
		</script>
		<?
	}
}