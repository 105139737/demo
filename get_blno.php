<?php 
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_REQUEST['sl'];
$pno=$_REQUEST['pno'] ?? "";
$cid=$_REQUEST['cid'] ?? "";
$tp=$_REQUEST['tp'] ?? "";
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
if($cid!="")
{
$cid1=" and cid='$cid' ";
}
else 
{
$cid1="";
}
$dld=" and dldgr='$sl'";
$cld=" and cldgr='$sl'";

$blano2="";
$blano2=" and  (cbill!=''";	
$query100 = "SELECT * FROM main_credit where eby='$user_currently_loged' and cid='$cid' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$blno=$R100['blno'];

$blano2.=" and  cbill!='$blno'";	

}
$blano2.=")";
?>
<select id="blno"  name="blno"   tabindex="2" class="form-control"  onchange="recallRamm()" >
<!--<option value="Opening">Opening</option>-->
<?php  
if($tp==1)
{
?>
<option value="">----Select----</option>
<?php 
}
$data11= mysqli_query($conn,"select * from  main_drcr where brncd='$brncd' and cid='$cid' and cbill!='' and paid='0' $blano2 group by  cbill order by dt,sl")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$blno=$row1['cbill'];
$dt=$row1['dt'];
$dt=date('d-m-Y', strtotime($dt));
$invto="";
$bill_no="";
$data2= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$invto=$row2['invto'];
$sfno=$row2['sfno'];
$bill_no=$row2['bill_no'];
}
$nm="";
$query="select * from main_cust  WHERE sl='$invto'";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$nm=$rw['nm'];
}
$query3="select * from main_cust  WHERE sl='$cid'";
$result3=mysqli_query($conn,$query3);
while($rw=mysqli_fetch_array($result3))
{
$typ=$rw['typ'];
}
$log=0;
$T=1;
if($typ==2)
{
$T=0;
$t1=0;
$t2=0;/*
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cbill='$blno'".$cid1.$brncd1.$dld);
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cbill='$blno'".$cid1.$brncd1.$cld);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}*/
$T=0;
$result416 = mysqli_query($conn,"SELECT  (SUM(IF(dldgr='$sl', amm, 0)) - SUM(IF(cldgr='$sl', amm, 0))) AS amm FROM main_drcr where stat='1' and cbill='$blno'".$cid1.$brncd1)or die(mysqli_error($conn));
while ($R16 = mysqli_fetch_array ($result416))
{
  $T=round($R16['amm'],2);
}
//$T=$t1-$t2;
$log=1;
}
if($T>0)
{
?>
<option value="<?php  echo $blno?>"><?php  echo $bill_no?> <?php  echo $blno?> <?php  echo $nm;?> <?php  echo $sfno;?> Due Am. : <?php  if($log==0){echo '>1';}else{echo round($T,2);}?>/- (Date : <?php  echo $dt;?>) </option>
<?php 
}
else
{
//$qr=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$blno'") or die(mysqli_error($conn));	
}
?>

<?php }?>

<?php 
$data11= mysqli_query($conn,"select * from  main_addon where brncd='$brncd' and cid='$cid'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$blno=$row1['blno'];
$dt=$row1['dt'];
$dt=date('d-m-Y', strtotime($dt));
$T=1;
if($typ==2)
{
$T=0;
$t1=0;
$t2=0;
/*
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cbill='$blno'".$cid1.$brncd1.$dld);
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cbill='$blno'".$cid1.$brncd1.$cld);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}*/
$result416 = mysqli_query($conn,"SELECT  (SUM(IF(dldgr='$sl', amm, 0)) - SUM(IF(cldgr='$sl', amm, 0))) AS amm FROM main_drcr where stat='1' and cbill='$blno'".$cid1.$brncd1)or die(mysqli_error($conn));
while ($R16 = mysqli_fetch_array ($result416))
{
  $T=round($R16['amm'],2);
}
//$T=$t1-$t2;
}
if($T>0)
{
?>
<option value="<?php  echo $blno?>"><?php  echo $blno?> (Date : <?php  echo $dt;?>)</option>
<?php 
}
else
{
//$qr=mysqli_query($conn,"update main_drcr set paid='1' where cbill='$blno'") or die(mysqli_error($conn));	
}
?>

<?php }?>
</select>
<script type="text/javascript">
   $('#blno').chosen({
  no_results_text: "Oops, nothing found!",
  
  });
  gtcrvl1();
</script>