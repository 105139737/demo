<?php
$reqlevel = 3;
include("membersonly.inc.php");
include "function.php";
$sl=$_REQUEST[sl];
$pno=$_REQUEST[pno];
$cid=$_REQUEST[cid];
$dldgr=$_REQUEST[dldgr];
$nb=$_REQUEST[nb];
$tp=$_REQUEST[tp];
$brncd=$_REQUEST[brncd];if($brncd==""){$brncd1="";}else{$brncd1=" and brncd='$brncd'";}
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
<select id="blno"  name="blno"   tabindex="1" class="sc1" style="width:98%;" onchange="recallRamm();">
<?php 
if($tp==1)
{
?>
<option value="">----Select----</option>
<?php
}

$data11= mysqli_query($conn,"select * from  main_drcr where brncd='$brncd' and cid='$cid' and paid='0' and retn_stat!='1' and dldgr='4' $blano2 group by  cbill order by dt,sl  ")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data11))
{
$blno=$row1['cbill'];
$dt=$row1['dt'];

$invto="";
$data2= mysqli_query($conn,"select * from  main_billing where blno='$blno'")or die(mysqli_error($conn));
while ($row2 = mysqli_fetch_array($data2))
{
$invto=$row2['invto'];
$sfno=$row2['sfno'];
$dt=$row2['dt'];
}
$dt=date('d-m-Y', strtotime($dt));
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
/*
$T=1;
if($typ==2)
{
$T=0;
$t1=0;
$t2=0;
$data= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where stat='1' and cbill='$blno'".$cid1.$brncd1.$dld);
while ($row = mysqli_fetch_array($data))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where  stat='1' and cbill='$blno'".$cid1.$brncd1.$cld);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=round($t1-$t2,0);
}
*/
?>
<option value="<?=$blno?>"><?=reformat($blno)?> <?=$nm;?> <?=$sfno;?> - (Date : <?=$dt;?>) </option>
<?


?>

<?}
if($dldgr!=7)
{
?>
<option value="ADVANCE-PAYMENT">ADVANCE PAYMENT</option>
<?}?>
</select>
<script type="text/javascript">
   $('#blno').chosen({
  no_results_text: "Oops, nothing found!",
  
  });
recallRamm();

</script>