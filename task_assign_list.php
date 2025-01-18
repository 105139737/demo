<?php 
$reqlevel = 3;
include("membersonly.inc.php");


$frmnm='';
$dt = date('d-M-Y');
$chk_dt = date('Y-m-d');
$chk_dt=date('Y-m-d', strtotime($chk_dt. ' - 7 days'));
$cy=date('Y');
$spid=rawurldecode($_REQUEST['spid'] ?? "");
$custm=$_REQUEST['custm'] ?? "";
$day=$_REQUEST['day'] ?? "";
if($spid!="")
{
$all1=" and spid='$spid'";
}
else
{
$all1="";	
}
if($day!="")
{
$day1=" and day='$day'";
}
else
{
$day1="";	
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


$sl=$start;
$sln=0;
$cstnm1="";

//echo "select * from  main_task where sl>0 $cstnm1 $all1 order by sl limit $start,$ps ";

$datatt= mysqli_query($conn,"select * from  main_task where sl>0 and dt>='$chk_dt' $cstnm1 $day1 $all1")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from main_task where sl>0 and dt>='$chk_dt' $cstnm1 $all1 $day1")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data= mysqli_query($conn,"select * from  main_task where sl>0 and dt>='$chk_dt' $cstnm1 $all1 $day1 order by dt limit $start,$ps ")or die(mysqli_error($conn));
$ccnt=mysqli_num_rows($datar);
if($ccnt>0)
{
?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?php  echo $ps;?>" size="7" onblur="pagnt1(this.value)">
</div>
<table  class="table table-hover table-striped table-bordered"  >

<tr>
<!-- <th width="5%">Action</font></th>-->
<th width="5%">Sl</font></th>
<th style="text-align:left">Sales Person</font></th>
<th style="text-align:left">Day</font></th>
<th style="text-align:left">Customer</font></th>
<th style="text-align:center">Date</font></th>
<th style="text-align:center">Action</font></th>
</tr>
<?php 


while ($row = mysqli_fetch_array($data))
{
$x=$row['sl'];
$spid=$row['spid'];
$cust=$row['cust'];
$day=$row['day'];
$dt=$row['dt'];

$sln++;
$sl++; 

$spid2="";
$data1 = mysqli_query($conn,"Select * from main_sale_per where spid='$spid'");
while ($row1 = mysqli_fetch_array($data1))
	{
	$sl=$row1['sl'];
	$spid2=$row1['spid'];
	}
	
	$cnt=0;
	$csl="";
	$cnm="";

	$data13 = mysqli_query($conn,"Select * from main_cust where FIND_IN_SET(sl, '$cust')");
	while ($row13 = mysqli_fetch_array($data13))
	{
		
	$cnt++;	
	$cust_sl=$row13['sl'];
	$color="";
	if($custm==$cust_sl){$color="red";}
	$cnm="<font color='$color'>".$row13['nm']."</font>";
	if($csl=="")
	{
	 $csl=$cnt.") ".$cnm;	
	}
	else
	{
	$csl=$csl." <br/> ".$cnt.") ".$cnm;
	}
	
	}
	


?>
	<tr>
	<td align="center"><?php  echo $sln;?></td>
	<td align="left"><?php  echo $spid2;?></td>
	<td align="left"><?php  echo $day;?></td>
    <td align="left"><?php  echo $csl; ?></td>
    <td align="center"><?php  echo date('d-m-Y',strtotime($dt));?></td>
	<td  align="center" style="cursor:pointer" onclick="edit('<?php  echo $x;?>')"><i class="fa fa-pencil-square-o"></i></td>
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
<?php 
}
else
{
	?>
	<center><font color="red" size="4"><b>No Data Available...</b></font></center>
	<?php 
}
?>