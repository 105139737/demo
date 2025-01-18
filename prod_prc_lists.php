<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$all=rawurldecode($_REQUEST['all']??"");
$al="%".$all."%";
if($all!="")
{
	/*brand	cat		modelno	prc*/
	$all1=" and  modelno LIKE '$al'";
}
else
{
	$all1="";	
}


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

<table class="table table-hover table-striped table-bordered">	
<tr>
<th>Sl</th>
<th>Brand</th>
<th>Category</th>
<th>Model Name</th>
<th>Price</th>
<th>Discount(%)</th>
<th>Discount Amount</th>


</tr>
<?php 
$sl=$start;
$sln=0;
$datatt=mysqli_query($conn,"select * from main_product_prc where sl>0 group by psl order by sl desc")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar=mysqli_query($conn,"select * from main_product_prc where  sl>0".$all1." group by psl order by sl desc")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data=mysqli_query($conn,"select * from main_product_prc where  sl>0 $all1 group by psl order by sl desc  limit $start,$ps ")or die(mysqli_error($conn));
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
	$sln++;   
	$sl++; 

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

?>
<tr title="<?php  echo $psl;?>">
<td align="center"><?php  echo $sl;?></td>
<td align="left"><?php  echo $brand_nm;?></td>
<td align="left"><?php  echo $cat_nm;?></td>
<td align="left"><?php  echo $modelno;?></td>
<td align="right"><?php  echo $prc;?></td>
<td align="right"><?php  echo $dis;?></td>
<td align="right"><?php  echo $disam;?></td>

</tr>	 
<?php 
}
?>
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
							