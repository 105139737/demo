<?php 
$reqlevel = 3;
include("membersonly.inc.php");
include "function.php";
$sl=$_REQUEST['sl'];
$pno=$_REQUEST['pno'] ?? "";
$cid=$_REQUEST['cid'] ?? "";
$dldgr=$_REQUEST['dldgr']??"";
$brncd=$_REQUEST['brncd'] ?? "";if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
$blno_ref=$_REQUEST['blno_ref']??"";
$blno_ref1="";
$T=0;
if($blno_ref!="")	
{
$blno_ref1=" and blno!='$blno_ref'";
}
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
$query100 = "SELECT * FROM main_recv_reg_temp where eby='$user_currently_loged' and cid='$cid' and brncd='$brncd' order by sl";
$result100 = mysqli_query($conn,$query100) or die(mysqli_error($conn));
while ($R100 = mysqli_fetch_array ($result100))
{
$blno=$R100['blno'];

$blano2.=" and  cbill!='$blno'";	

}
$blano2.=")";
?>
<select id="blno"  name="blno"   tabindex="1" class="sc1" style="width:98%;" onchange="gtcrvl1()">

<?php 
$data11= mysqli_query($conn,"select * from  main_drcr where brncd='$brncd' and cid='$cid' and paid='0'  and retn_stat!='1' $blano2  group by  cbill order by sl,dt")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$blno=$row1['cbill'];
$dt=$row1['dt'];
$dt=date('d-m-Y', strtotime($dt));
$invto="";
$sfno="";
$data2= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$invto=$row2['invto'];
$sfno=$row2['sfno'];
}
$nm="";
$query="select * from main_cust  WHERE sl='$invto'";
$result=mysqli_query($conn,$query);
while($rw=mysqli_fetch_array($result))
{
$nm=$rw['nm'];
}
/*
$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cbill='$blno'".$cid1.$brncd1.$dld.$blno_ref1);
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cbill='$blno'".$cid1.$brncd1.$cld.$blno_ref1);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=$t1-$t2;
*/
?>
<option value="<?php  echo $blno?>"><?php echo reformat($blno)?> <?php  echo $nm;?> <?php  echo $sfno;?> Due Am. : <?php echo round($T??0,2)?>/- (Date : <?php  echo $dt;?>) </option>
<?php 


?>

<?php }
if($dldgr!=7)
{
?>
<option value="ADVANCE-PAYMENT">ADVANCE PAYMENT</option>
<?php }?>
</select>
<script type="text/javascript">
   $('#blno').chosen({
  no_results_text: "Oops, nothing found!",
  
  });
  
  gtcrvl1();
</script>