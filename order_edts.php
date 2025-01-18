<?php 
$reqlevel = 1;
include("membersonly.inc.php");

include "header.php";
date_default_timezone_set('Asia/Kolkata');
$cdt=date('Y-m-d');
$dttm=date('d-m-Y H:i:s a');

$cid=$_POST['cid']??"";
$brncd=$_POST['brncd']??"";
$dt=$_POST['dt']??"";
$sale_per=$_POST['sale_per']??"";
$blno=$_POST['blno']??"";
$vstat=$_POST['vstat']??"";

$dt=date('Y-m-d',strtotime($dt));
$err="";
if($cid=="")
{
	$err="Please Enter Ledger Name...";
}

$query1 = "SELECT * FROM main_edt_orderdtls where blno='$blno' ";
$result1 = mysqli_query($conn,$query1)or die(mysqli_error($conn));
$count_row = mysqli_num_rows ($result1);

if($count_row==0)
{
$err="Please Add Some Product First";
}

if($err=="")
{
$dlttt=mysqli_query($conn,"delete from main_orderdtls where blno='$blno'")or die (mysqli_error()); 
$dlttt=mysqli_query($conn,"delete from main_stock where sbill='$blno' and nrtn='Order'")or die (mysqli_error()); 

$query211 = "update main_order set cid='$cid',dt='$dt',bcd='$brncd',sale_per='$sale_per',vstat='$vstat' where blno='$blno'";
$result211 = mysqli_query($conn,$query211)or die(mysqli_error($conn)); 


$query214 = "insert into main_orderdtls (cid,bcd,cat,scat,prsl,imei,unit,usl,betno,uval,kg,grm,pcs,srt,adp,prc,total,disp,disa,ttl,tamm,fst,tst,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,blno,refno,bill_typ,retno,rate,stk_rate,rdt,dt,cust,eby,rqty )
select '$cid',bcd,cat,scat,prsl,imei,unit,usl,betno,uval,kg,grm,pcs,srt,adp,prc,total,disp,disa,ttl,tamm,fst,tst,cgst_rt,cgst_am,sgst_rt,sgst_am,igst_rt,igst_am,net_am,blno,refno,bill_typ,retno,rate,stk_rate,rdt,dt,cust,eby,rqty  from main_edt_orderdtls where blno='$blno' order by sl";
$result214 = mysqli_query($conn,$query214)or die (mysqli_error()); 

$result100 = mysqli_query($conn,"SELECT * FROM main_edt_orderdtls where blno='$blno' order by sl");
while ($R100 = mysqli_fetch_array ($result100))
{	
$tsl=$R100['sl'];
$cat=$R100['cat'];
$scat=$R100['scat'];
$prsl=$R100['prsl'];
$pnm=$R100['pnm'];
$pcs=$R100['pcs'];
$eby=$R100['eby'];
$bcd=$R100['bcd'];


$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$prsl'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
$usl=$roww['sl'];
$sun=$roww['sun'];
$mun=$roww['mun'];
$bun=$roww['bun'];
$smvlu=$roww['smvlu'];
$mdvlu=$roww['mdvlu'];
$bgvlu=$roww['bgvlu'];
}

$unit='sun';


if($unit=='sun'){$stock_in=(float)$pcs*(float)$smvlu;$rate1=(float)$rate/(float)$smvlu;$uval=$smvlu;$stk_rate=(float)$stk_rate1/(float)$smvlu;}
if($unit=='mun'){$stock_in=(float)$pcs*(float)$mdvlu;$rate1=(float)$rate/(float)$mdvlu;$uval=$mdvlu;$stk_rate=(float)$stk_rate1/(float)$smvlu;}
if($unit=='bun'){$stock_in=(float)$pcs*(float)$bgvlu;$rate1=(float)$rate/(float)$bgvlu;$uval=$bgvlu;$stk_rate=(float)$stk_rate1/(float)$smvlu;}



$query21 = "INSERT INTO ".$DBprefix."stock (unit,pcd,bcd,dt,stout,nrtn,eby,dtm,stat,ret,refno,sbill,usl,uval,betno,rate,stk_rate) VALUES 
('$unit','$prsl','$bcd','$dt','$stock_in','Order','$eby','$edtm','1','$ret','$refno','$blno','$usl','$uval','$betno','$rate1','$stk_rate')";
$result21 = mysqli_query($conn,$query21)or die (mysqli_error($conn));

}

$dlttt=mysqli_query($conn,"delete from main_edt_orderdtls where blno='$blno'")or die (mysqli_error()); 

$err="Data Update Successfully....";
?>
<Script language="JavaScript">
alert("<?php  echo $err;?>");
document.location="order_invoice.php";
</script>
<?php 
}
else
{
?>
<Script language="JavaScript">
alert("<?php  echo $err;?>");
window.history.go(-1);
</script>
<?php 
}
?>
