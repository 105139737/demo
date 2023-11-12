<?php
$reqlevel = 3;
include("membersonly.inc.php");
$edt=date('Y-m-d');
$edtm=date('d-m-Y H:i:s a');
$m=date('m', strtotime($edt));
$y=date('y', strtotime($edt));
$dt=$_POST['dt'];
if($m>=4)
{	
$ssn=$y.($y+1);	
}
elseif($m<=3)
{
$ssn=($y+1).$y;	
}


$m=date('m', strtotime($dt));

$y=date('Y', strtotime($dt));;
if($m>=4)
{
$ssn_ssn=$y.'-'.($y+1);	

}
elseif($m<=3)
{
$ssn_ssn=($y-1).'-'.$y;	
}

$refid='TVN'.$ssn;
$get1=mysqli_query($conn,"select * from main_pvno where pvno like '$refid%' order by sl desc limit 0,1") or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($get1))
{$vid1=$row1['pvno'];  }
$vid1=substr($vid1,7,6);
$count1=1;
while($count1>0)
{
$vid1=$vid1+1;
$pvno=$refid.str_pad($vid1, 6, '0', STR_PAD_LEFT);
$query11=mysqli_query($conn,"select * from main_pvno where pvno='$pvno'");
$count1=mysqli_num_rows($query11);		
}

$result=mysqli_query($conn,"insert into main_pvno(pvno,type,edt,edtm,eby )values('$pvno','3','$edt','$edtm','$eby')");	




$err1="";
$scnt=0;
$fcnt=0;
$data= mysqli_query($conn,"select * from main_oldcn_jv_tmp where eby='$eby' ")or die(mysqli_error());
$rcnt=mysqli_num_rows($data);
if($rcnt==0){$err1="SORRY!";}

if($err1=="")
{
while ($row1 = mysqli_fetch_array($data))
{
$err="";	
$sl=$row1['sl'];
$brnch=$row1['brncd'];
$dt=$row1['dt'];
$dldgr=$row1['dldgr'];
$cldgr=$row1['cldgr'];
$amm=$row1['amm'];
$nrtn=$row1['nrtn'];
$cnum=$row1['cnum'];
$cbill=$row1['cbill'];
$truckno=$row1['truckno'];
$snum=$row1['snum'];
$invc=$row1['invc'];

	
if($dldgr==''){$err="PLEASE FILL ALL FEILD...";	}
if($cldgr==''){$err="PLEASE FILL ALL FEILD...";	}

$result1 = mysqli_query($conn,"SELECT * FROM main_cn where cn_num='$cnum' and brnch='$brnch' and ssn='$ssn_ssn'") or die(mysqli_error($conn));
$cnt=mysqli_num_rows($result1);
if($cnt>0)
{
while($row25=mysqli_fetch_array($result1))
{
$sid=$row25['refno'];
}	
}
else
{
$refid='CN'.$ssn;
$get1=mysqli_query($conn,"select * from main_cn where refno like '$refid%' order by sl desc limit 0,1") or die(mysqli_error($conn));
while($row1=mysqli_fetch_array($get1))
{$vid1=$row1['refno'];  }
$vid1=substr($vid1,6,5);
$count1=1;
while($count1>0)
{
$vid1=$vid1+1;
$sid=$refid.str_pad($vid1, 5, '0', STR_PAD_LEFT);
$query11=mysqli_query($conn,"select * from main_cn where refno='$sid'");
$count1=mysqli_num_rows($query11);		
}	
mysqli_query($conn,"insert into main_cn(ssn,refno,cn_num,brnch,cn_dt,snum,invc,truckno,typ,edt,edtm,eby,stat )values('$ssn_ssn','$sid','$cnum','$brnch','$dt','$snum','$invc','$trksl','1','$edt','$edtm','$eby','3')") or die(mysqli_error($conn));		
}


$trksl="";
$get21=mysqli_query($conn,"select * from main_truck where trck_no='$truckno'") or die(mysqli_error($conn));
$trkcnt=mysqli_num_rows($get21);
if($trkcnt>0)
{
while($row25=mysqli_fetch_array($get21))
{
$trksl=$row25['sl'];
}
}
else
{
mysqli_query($conn,"insert into main_truck(trck_no,edt,edtm,eby )values('$truckno','$edt','$edtm','$user_currently_loged')") or die(mysqli_error($conn));
$gettrksln=mysqli_query($conn,"select * from main_truck where sl>0 order by sl desc limit 0,1");
while($rtrk=mysqli_fetch_array($gettrksln))
{$trksl=$rtrk['sl'];  }
}
if($err=='')
{
if($amm>0)
{
$query2 = "INSERT INTO main_drcr(pvno,cbill,dt,brncd,dldgr,cldgr,amm,nrtn,typ,edtm,eby,cnum,truckno) VALUES ('$pvno','$sid','$dt','$brnch','$dldgr','$cldgr','$amm','$nrtn','9','$edtm','$user_currently_loged','$cnum','$trksl')";
$result2 = mysqli_query($conn,$query2)or die (mysqli_error());
$scnt++;
}
}else
{
$fcnt++;	
}

}

mysqli_query($conn,"DELETE FROM main_oldcn_jv_tmp WHERE eby='$eby'") or die(mysqli_error($conn));

?>
<script language="javascript">
alert('<?php echo $scnt;?> SUBMIT SUCCESSFULL & <?php echo $fcnt?> NOT SUCCESSFULL !!');
document.location="old_cn_ntry.php";
</script>
<?php }
else
{
?>
<script language="javascript">
alert('Please Add Some CN');
document.location="old_cn_ntry.php";
</script>
<?php	
}
?>
