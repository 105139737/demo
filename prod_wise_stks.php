<?php 
$reqlevel = 3;
include("membersonly.inc.php");
date_default_timezone_set('Asia/Kolkata');

 
$cy=date('Y');
$pnm=$_REQUEST['pnm'];
$catsl=$_REQUEST['cat'];
$scatsl=$_REQUEST['scat'];
$dt=$_REQUEST['dt'];
$flt=$_REQUEST['flt'];
$brncd=$_REQUEST['brncd'];if($brncd==""){$brncd1="";}else{$brncd1=" and bcd='$brncd'";}
$cat1="";
if($catsl!=""){$cat1=" and cat='$catsl'";}
$scat1="";
if($scatsl!=""){$scat1=" and scat='$scatsl'";}
if($pnm!=""){$all1=" and sl='$pnm'";}else{$all1="";	}
$dt=date('Y-m-d', strtotime($dt));	

$pno=rawurldecode($_REQUEST['pno'] ?? "");

//echo $src;
$ps=rawurldecode($_REQUEST['ps'] ?? "");
if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;

?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?php  echo $ps;?>" size="7" onblur="pagnt1(this.value)">
</div> 
<table  class="table table-hover table-striped table-bordered"  >
<tr>
<td align="left"><b>Sl</b></td>
<td align="left"><b>Brand</b></td>
<td align="left"><b>Category</b></td>
<td align="left"><b>HSN</b></td>
<td align="left"><b>Model Name</b></td>
<td align="left"><b>Current Stock</b></td>
<td align="left"><b>Rate</b></td>
<td align="left"><b>Value</b></td>
<td align="left"><b> Rate (With GST)</b></td>
<td align="left"><b>Value</b></td>

</tr>
<?php 
$stk_val=0;
$stk_val_gst=0;
$Tot_stk_val=0;
$Tot_stk_val_gst=0;

$sl=$start;
$sln=0;
$cntc=0;
$datatt=mysqli_query($conn,"select * from main_product where sl>0 and typ='0' $cat1  $scat1  $all1 order by pnm")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar=mysqli_query($conn,"select * from main_product where sl>0 and typ='0' $cat1  $scat1  $all1  order by pnm")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data=mysqli_query($conn,"select * from main_product where sl>0 and typ='0' $cat1  $scat1  $all1 order by pnm limit $start,$ps ")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
$sl++;
$pcd=$row['sl'];
$unit=$row['unit'];
$nm=$row['pnm'];
$cat=$row['cat'];
$scat=$row['scat'];
$hsn=$row['hsn'];
$cnm="";				
$data12= mysqli_query($conn,"select * from main_catg where sl='$cat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data12))
{
$cnm=$row1['cnm'];
}
$scat_nm="";				
$data2= mysqli_query($conn,"select * from main_scat where sl='$scat'")or die(mysqli_error($conn));
while ($row1 = mysqli_fetch_array($data2))
{
$scat_nm=$row1['nm'];
}
$get=mysqli_query($conn,"select * from ".$DBprefix."unit where cat='$pcd'") or die(mysqli_error($conn));
while($roww=mysqli_fetch_array($get))
{
$sun=$roww['sun'];
}
$stk_rate=0;
$rate=0;

$sln++;
$stck=0;
$stock_close="";
$query4="Select sum(opst+stin-stout) as stck1 from ".$DBprefix."stock where pcd='$pcd' and dt<='$dt'".$brncd1."  group by pcd  ";
$result4 = mysqli_query($conn,$query4);
while ($R4 = mysqli_fetch_array ($result4))
{
$stck=$R4['stck1'];
}
$crate=0;
$data13 = mysqli_query($conn,"SELECT ((sum((opst+stin-stout)*rate))/sum(opst+stin-stout)) as prate,((sum((opst+stin-stout)*stk_rate))/sum(opst+stin-stout)) as stk_rate FROM main_stock WHERE pcd='$pcd' and dt<='$dt' $brncd1  group by pcd ");
while ($row1 = mysqli_fetch_array($data13))
{
$stk_rate=$row1['prate'];
$rate=$row1['stk_rate'];
}


$stkf=$stck;
if($stkf==""){$stkf=0;}
$stock_close=$stkf." ".$sun;
$stk_val=$rate*$stkf;
$stk_val_gst=$stk_rate*$stkf;

if($flt==1){
if($stock_close>0){
	$cntc++;
?>
<tr title="<?php  echo $pcd;?>, Stocksl :<?php  echo $ssl;?>">
<td  align="center" ><?php  echo $cntc;?></td>
<td  align="left" ><?php  echo $cnm;?></td>
<td  align="left"><?php  echo $scat_nm;?></td>
<td  align="left"><?php  echo $hsn;?></td>
<td  align="left"><?php  echo $nm;?></td>
<td  align="left" ><?php  echo $stock_close;?></td>
<td  align="left" ><?php echo round($rate,2);?></td>
<td  align="left" ><?php echo round($stk_val,2);?></td>
<td  align="left" ><?php echo round($stk_rate,2);?></td>
<td  align="left" ><?php echo round($stk_val_gst,2);?></td>

</tr>	 
<?php 
} 
}else{
	$cntc++;
	?>
	<tr title="<?php  echo $pcd;?>, Stocksl :<?php  echo $ssl;?>">
<td  align="center" ><?php  echo $cntc;?></td>
<td  align="left" ><?php  echo $cnm;?></td>
<td  align="left"><?php  echo $scat_nm;?></td>
<td  align="left"><?php  echo $hsn;?></td>
<td  align="left"><?php  echo $nm;?></td>
<td  align="left" ><?php  echo $stock_close;?></td>
<td  align="left" ><?php echo round($rate,2);?></td>
<td  align="left" ><?php echo round($stk_val,2);?></td>
<td  align="left" ><?php echo round($stk_rate,2);?></td>
<td  align="left" ><?php echo round($stk_val_gst,2);?></td>

</tr>
	<?php 
}
$stkf=0;
$Tot_stk_val+=$stk_val;
$Tot_stk_val_gst+=$stk_val_gst;
}
?>
<tr>
<td align="right" colspan="7"><font color="red" size="3"><b>Total : </b></font></td>
<td><font color="red" size="3"><b><?php echo round($Tot_stk_val,2);?></b></font></td>
<td><font color="red" size="3"><b></b></font></td>
<td><font color="red" size="3"><b><?php echo round($Tot_stk_val_gst,2);?></b></font></td>

</tr>
</table>
<?php 
$tp=$rcnt/$ps;
if(($rcnt%$ps)>0)
{
    $tp=floor($tp)+1;
}
if($pno==1)
{
    $prev=1;
}
else
{
$prev=$pno-1;    
}
if($pno==$tp)
{
 $next=$tp;   
}
else
{
$next=$pno+1;
}
$flt="";
if($rcnt!=$rcntttl)
{
    $flt="(filtered from ".$rcntttl." total entries)";
}
echo "Showing ".($start+1)." to ".($sl)." of ".$rcnt." entries".$flt;
?>
<div align="center"><input type="text" size="10" id="pgn" name="pgn" value="<?php  echo $pno;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>
<div class="pagination pagination-centered">
                            <ul class="pagination pagination-sm inline">
							<li <?php  if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('1')"><i class="icon-circle-arrow-left"></i>First</a></li>
                            <li <?php  if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $prev;?>')"><i class="icon-circle-arrow-left"></i>Previous</a></li>
                            <?php 
                            
                            if($tp<=5)
                            {
                              $n=1;  
                              while($n<=$tp)
                              {
                                ?>
                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
                                <?php 
                                $n+=1;
                              }  
                            }
                            else
                            {
                                if($pno<4)
                                {
                                  $n=1;
                                  while($n<=5)
                              {
                                ?>
                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
                                <?php 
                                $n+=1;
                              }     
                                }
                                elseif($pno>$tp-3)
                                {
                                    $n=$tp-5;
                                    while($n<=5)
                              {
                                ?>
                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
                                <?php 
                                $n+=1;
                              }   
                                }
                                else
                                {
                                $n=$pno-2; 
                                 while($n<=$pno+2)
                              {
                                ?>
                             <li <?php  if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?php echo $n;?>')"><?php echo $n;?></a></li>   
                                <?php 
                                $n+=1;
                              }     
                                }
                               
                                
                                
                            }
                            ?>
                            <li <?php  if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $next;?>')">Next<i class="icon-circle-arrow-right"></i></a></li>
                            <li <?php  if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?php echo $tp;?>')">Last<i class="icon-circle-arrow-right"></i></a></li>
                            </ul>
                            </div>
							