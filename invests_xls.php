<?php 
$reqlevel = 1;
include("membersonly.inc.php");

$jobLink=CreateNewJob('jobs/invests_xls.php',$user_currently_loged,'Invest',$conn);
    ?>
    <script language="javascript">
    alert('Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...');
    window.history.go(-1);
    </script>
    <?php
    die('<b><center><font color="green" size="5">Your request has been accepted. You will get you dwonload link in your home page in a few moments. Thank you...</font></center></b>');
   


$brand=$_REQUEST['brand'];

if($brand==""){$brand1="";}else{$brand1=" and cat='$brand'"; $brand2=" and brand='$brand'"; $find_in_cat=" and find_in_set('$brand',brand)>0";}

$dt=$_REQUEST['dt'];

set_time_limit(0);
date_default_timezone_set('Asia/Kolkata');

$dt=date('Y-m-d', strtotime($dt));

$brand1=array();
$data13 = mysqli_query($conn,"Select * from main_supplier_tag where sl>0 $find_in_cat");
while ($row13 = mysqli_fetch_array($data13))
{
$brand1[]=$row13['brand'];
}
$brand1=implode(',',$brand1);
?>
<div style="overflow-x:auto;">
<table width="50%" border="1"  class="table table-bordered">
<tr>
<th>BRAND</th>
<th>STOCK AS ON (DATE) BILL VALUE</th>
<th>MARKET OS</th>
<th>CO DUE</th>
<th>INVEST</th>
</tr>


<?php 
$data13 = mysqli_query($conn,"Select * from main_catg where sl>0 and FIND_IN_SET(sl, '$brand1')>0 ");
while ($row13 = mysqli_fetch_array($data13))
{
$sl3=$row13['sl'];
$cnm=$row13['cnm'];
$value=0;

$pcd=array();
$data = mysqli_query($conn,"Select * from main_product where cat='$sl3'");
while ($row = mysqli_fetch_array($data))
{

$pcd1=$row['sl'];
$close_stk=0;
$query4="Select sum(opst+stin-stout) as stck1 from main_stock where dt<='$dt' and pcd='$pcd1'";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$close_stk=$R4['stck1'];
}

$rate=0;
$query="Select avg(rate) as rate from main_stock where dt<='$dt' and pcd='$pcd1' and  (opst>0 or stin>0)";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$rate=$R['rate'];
}
$value+=round($close_stk*$rate,2);

}

$cid=array('');
$query1="select sl from main_cust WHERE sl>0 and brand='$sl3' and typ='2' order by sl";
$result2=mysqli_query($conn,$query1);
while($rw=mysqli_fetch_array($result2))
{
$cid[]=$rw['sl'];
}
$cid=implode(',',$cid);
$bal=0;
$damm=0;
$data12= mysqli_query($conn,"SELECT sum(amm) as amm FROM main_drcr where sl>0 and dldgr='4' and dt<='$dt' and  FIND_IN_SET(cid, '$cid')>0");
while ($row12= mysqli_fetch_array($data12))
{	
$damm=$row12['amm'];
}
$camm=0;
$data124= mysqli_query($conn,"SELECT sum(amm) as amm FROM main_drcr where sl>0 and cldgr='4' and dt<='$dt' and  FIND_IN_SET(cid, '$cid')>0");
while ($row12= mysqli_fetch_array($data124))
{	
$camm=$row12['amm'];
}
$bal=$damm-$camm;
$supsl="";
$data7 = mysqli_query($conn,"Select * from main_supplier_tag where sl>0 and FIND_IN_SET('$sl3', brand)>0");
while ($row = mysqli_fetch_array($data7))
{
$supsl=$row['sup'];
}

$data5= mysqli_query($conn,"SELECT sum(amm) as t1 FROM main_drcr where  dldgr='12' and sid='$supsl' and dt<='$dt'".$brncd1);
while ($row = mysqli_fetch_array($data5))
{
$t1 = $row['t1'];
}
$data1= mysqli_query($conn,"SELECT sum(amm) as t2 FROM main_drcr where cldgr='12' and sid='$supsl' and dt<='$dt' ".$brncd1);
while ($row1 = mysqli_fetch_array($data1))
{
$t2 = $row1['t2'];
}
$T=round($t2-$t1,2);
$D=($value+round($bal,2))-$T;
?>
<tr>
<td><b><?php echo $cnm;?></b></td>
<td align="right" title="<?php echo $close_stk;?> @ <?php echo $rate;?>"><b><?php echo $value;?></b></td>
<td><b><?php echo round($bal,2);?></b></td>
<td><b><?php echo $T;?></b></td>
<td><b><?php echo $D;?></b></td>
</tr>
<?php 
}?>
</table>
</div>