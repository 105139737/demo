<?php
$reqlevel = 3;
include("membersonly.inc.php");
$sl=$_POST['sl'];

$fdt=$_REQUEST['fdt'];
$tdt=$_REQUEST['tdt'];
$snm=rawurldecode($_REQUEST['snm']);
$catsl=$_REQUEST['cat'];
$scatsl=$_REQUEST['scat'];
$prnm=$_REQUEST['prnm'];
$godown=$_REQUEST['godown'];
$vstat=$_REQUEST['vstat'];
$pstat=$_REQUEST['pstat'];

if($pstat==""){$pstat1="";}else{$pstat1=" and pstat='$pstat'";}
if($catsl==""){$catsl1="";}else{$catsl1=" and cat='$catsl'";}
if($scatsl==""){$scatsl1="";}else{$scatsl1=" and scat='$scatsl'";}
if($prnm==""){$prnm1="";}else{$prnm1=" and prsl='$prnm'";}
if($godown==""){$godown1="";}else{$godown1=" and bcd='$godown'";}
$fdt=date('Y-m-d', strtotime($fdt));
$tdt=date('Y-m-d', strtotime($tdt));

if($fdt!="" and $tdt!=""){$todt=" and dt between '$fdt' and '$tdt'";}else{$todt="";}
if($snm!=""){$snm1=" and sup='$snm'";}else{$snm1="";}

 if($sl!='')
 {
 $sl=implode(',',$sl);
 }
 $edtm=date('d-m-Y h:i:s a');
 $edt=date('Y-m-d');
$dt=date("Y-m-d");
$sql1 = mysqli_query($conn,"select * from main_purchasedet where sl>0 and find_in_set(sl,'$sl')>0 order by sl") or die(mysqli_error($conn));
while($row = mysqli_fetch_array($sql1))
{
    $sl=$row['sl'];
    $cat=$row['cat'];
    $scat=$row['scat'];	
    $pcd=$row['prsl'];
    $qty=$row['qty'];
    $rate=$row['rate'];
    $sup=$row['sup'];
    $pdt=$row['dt'];
    $blno=$row['blno'];

$pnm=$_POST['pnm'.$sl];
$dp=$_POST['dp'.$sl];
$dnlc=$_POST['dnlc'.$sl];
$pldnlc=$_POST['pldnlc'.$sl];
$dpdisp=$_POST['dpdisp'.$sl];
$dpdisam=$_POST['dpdisam'.$sl];
$invprc=$_POST['invprc'.$sl];
$rprft=$_POST['rprft'.$sl];
$retoff=$_POST['retoff'.$sl];
$offprc=$_POST['offprc'.$sl];
$offless=$_POST['offless'.$sl];
$lprc=$_POST['lprc'.$sl];

$query = "Update main_purchasedet set pstat='1' where prsl='$pcd' and sup='$sup' and rate='$rate' $catsl $scatsl1 $prnm1 $godown1 $todt $snm1 $pstat1";
$result = mysqli_query($conn,$query)or die (mysqli_error($conn));

$result=mysqli_query($conn,"insert into main_priceupload(dt,pdt,blno,sup,cat,scat,pcd,pnm,rate,dp,dnlc,pldnlc,dpdisp,dpdisam,invprc,rprft,retoff,offprc,offless,lprc,edtm,eby )values
('$dt','$pdt','$blno','$sup','$cat','$scat','$pcd','$pnm','$rate','$dp','$dnlc','$pldnlc','$dpdisp','$dpdisam','$invprc','$rprft','$retoff','$offprc','$offless','$lprc','$edtm','$user_currently_loged')");		

mysqli_query($conn,"INSERT INTO main_product_prc (brand,cat,modelno,prc,dis,disam,offprc,offless,lprc,edt,edtm,eby,psl) VALUES 
('$cat','$scat','$pnm','$pldnlc','$dpdisp','0','$offprc','$offless','$lprc','$edt','$edtm','$user_currently_loged','$pcd')") or die(mysqli_error($conn));
//type rakhte hobe 
}

?>
<script>
alert('Upload Successfully. Thank You...');
document.location="priceUpload.php";
</script>