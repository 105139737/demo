<?php 
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');
$cy=date('Y');
$all=rawurldecode($_REQUEST['all']);
$al="%".$all."%";
if($all!="")
{
	$all1=" and bnm LIKE '$al' or als LIKE '$al' or addr LIKE '$al' or bcnt LIKE '$al'";
}
else
{
$all1="";	
}

$pno=$_REQUEST['pno'] ?? ""??"";

//echo $src;
$ps=$_REQUEST['ps'] ?? ""??"";
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
<th >Action</th>
<th >Sl</th>
<th >Name</th>
<th >Address</th>
<th >Contact No</th>
<th >Customer Tag Check</th>
</tr>
<?php 
$sl=$start;
$sln=0;
$datatt= mysqli_query($conn,"select * from main_branch where sl>0")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from main_branch where  sl>0 $all1")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data= mysqli_query($conn,"select * from main_branch where  sl>0 $all1 order by bnm limit $start,$ps ")or die(mysqli_error($conn));
 
while ($row = mysqli_fetch_array($data))
{
$bnm=$row['bnm'];
$als=$row['als'];
$addr=$row['addr'];
$bcnt=$row['bcnt'];
$vat=$row['vat'];
$x=$row['sl'];
$ctag=$row['ctag'];
$sln++;   
$sl++; 
$sll=base64_encode($x);
?>
<tr  >
<?php 	if($user_current_level<0)
{?>
<td  align="center" style="cursor:pointer" onclick="edit('<?php  echo $sll;?>')" >
<i class="fa fa-pencil-square-o"></i>
</td>
<?php }
else
{
?>
<td  align="center"   >
You need to be<br> an admin for <br>this page
</td>
<?php 
}
?>
<td align="center"><?php  echo $sln;?></td>
<td align="left"><?php  echo $bnm;?></td>
<td align="left"><?php  echo $addr;?></td>
<td align="center"><?php  echo $bcnt;?></td>		
<td align="center">
<select name="ctag" id="ctag"  onchange="ctagupdate('<?php  echo $x;?>',this.value)" style="width:100%">
<option value="1"<?php  if($ctag=='1'){echo 'selected';}?>>Yes</option>
<option value="0"<?php  if($ctag=='0'){echo 'selected';}?>>No</option>
</select>
</td>		

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
							