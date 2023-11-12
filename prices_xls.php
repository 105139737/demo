<?php
include("config.php");
$all=rawurldecode($_REQUEST['searchtext']);
$al="%".$all."%";
if($all!="")
{
	/*brand	cat		modelno	prc*/
	$all1=" and t.modelno LIKE '$al'";
}
else
{
	$all1="";	
}
 $tp = base64_decode($_REQUEST['tp']);
 $cat = base64_decode($_REQUEST['cat']);
$cat=str_replace("@","'",$cat);
$edtm=date("d-m-Y-h-i-s-a");
if($cat==""){$cat1="";}else{$cat1=" and ($cat)";}

$file="Price_".$edtm."_.xls";
header("Content-type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=$file");  
?>
<table border="1">
  <thead>
    <tr>    
      <th scope="col">Model Name</th>
      <?php if($tp==2){?>
      <th scope="col">DLR-NLC</th>
      <th scope="col">Dis%</th>      
      <th scope="col">DisAm</th>      
      <th scope="col">Inv-Price</th>
      <?php }if($tp==1){?>
      <th scope="col">Offer-Price</th>
      <th scope="col">OFFERLESS%</th>
      <th scope="col">Last-Price</th>
      <?php }?>
      <?php if($tp==''){?>
      <th scope="col">DLR-NLC</th>
      <th scope="col">Dis%</th>     
      <th scope="col">DisAm</th>   
      <th scope="col">Inv-Price</th>
      <th scope="col">Offer-Price</th>
      <th scope="col">OFFERLESS%</th>
      <th scope="col">Last-Price</th>
      <?php }?>
    </tr>
  </thead>
  <tbody>
    <?php 
    $sl=0;
    $sln=0;


  $data=mysqli_query($conn,"SELECT t.sl,t.brand,t.cat,t.modelno,t.dis,t.disam,t.prc,t.psl,t.offprc,t.lprc,t.offless
  FROM main_product_prc t
  INNER JOIN (
      SELECT MAX(sl) sl
      FROM main_product_prc
      GROUP BY psl
  ) b ON t.sl = b.sl WHERE t.sl>0 and t.status='0' $cat1 $all1 ")or die(mysqli_error($conn));

  while($row=mysqli_fetch_array($data))
    {
      $x=$row['sl'];
      $brand=$row['brand'];
      $cat=$row['cat'];
      $modelno=$row['modelno'];
      $dis=$row['dis'];
      $disam=$row['disam'];
      $prc=$row['prc'];
      $psl=$row['psl'];
      $offprc=$row['offprc'];
      $offless=$row['offless'];
      $lprc=$row['lprc'];
      $sln++;   
      $sl++; 
    if($offprc=="" or $offprc==null){$offprc=0;}
    if($lprc=="" or $lprc==null){$lprc=0;}
    $brand_nm="";
    $data1 = mysqli_query($conn,"Select * from main_catg where sl='$brand'");
    while ($row1 = mysqli_fetch_array($data1))
    {
    $brand_nm=$row1['cnm'];
    }
    $cat_nm="";
    $data1 = mysqli_query($conn,"Select * from main_scat where sl='$cat'");
    while ($row1 = mysqli_fetch_array($data1))
    {
    $cat_nm=$row1['nm'];
    }
    if($disam>0 and $dis==0)
    {
    $dis=round((($disam*100)/$prc),4);
    }

    $invprc=$prc-($prc*$dis)/100;
    ?>
    <tr>      
      <td data-label="Model Name"><? echo $modelno;?></td>
      <?php if($tp==2){?>
      <td data-label="DLR-NLC"><? echo round($prc,0);?></td>
      <td data-label="Dis%"><? echo round($dis,2);?></td>
      <td data-label="Dis%"><? echo round($disam,2);?></td>
      <td data-label="Inv-Price"><? echo round($invprc,0);?></td>
      <?php }if($tp==1){?>
      <td data-label="Offer-Price"><? echo round($offprc,2);?></td>
      <td data-label="Offer-Price"><? echo round($offless,2);?></td>
      <td data-label="Last-Price"><? echo round($lprc,2);?></td>
      <?php }?>
      <?php if($tp==''){?>
        <td data-label="DLR-NLC"><? echo round($prc,0);?></td>
      <td data-label="Dis%"><? echo round($dis,2);?></td>
      <td data-label="Dis%"><? echo round($disam,2);?></td>
      <td data-label="Inv-Price"><? echo round($invprc,0);?></td>
      <td data-label="Offer-Price"><? echo round($offprc,0);?></td>
      <td data-label="Offer-Price"><? echo round($offless,0);?></td>
      <td data-label="Last-Price"><? echo round($lprc,0);?></td>
        <?php }?>
    </tr>
    <?php
}
?>
  </tbody>
</table>

