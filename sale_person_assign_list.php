<?php
$reqlevel = 3;
include("membersonly.inc.php");


$spid=$_REQUEST['spid'];

if($spid!="")
{
	$all1=" and username = '$spid'";
}
else
{
$all1="";	
}


$pno=rawurldecode($_REQUEST[pno]);

//echo $src;
$ps=rawurldecode($_REQUEST[ps]);
if($ps=="")
{
$ps=10;
}
if($pno==""){$pno=1;}
$start=($pno-1)*$ps;




$sl=$start;
$sln=0;

$datatt= mysqli_query($conn,"select * from  ".$DBprefix."signup where sl>0 and userlevel='4'")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar= mysqli_query($conn,"select * from ".$DBprefix."signup where sl>0 and userlevel='4' $all1")or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data= mysqli_query($conn,"select * from  ".$DBprefix."signup where sl>0 and userlevel='4' $all1 order by username limit $start,$ps ")or die(mysqli_error($conn));
$rcntt=mysqli_num_rows($data);
if($rcntt>0)
{
?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?=$ps;?>" size="7" onblur="pagnt1(this.value)">
</div>
  <table  class="table table-hover table-striped table-bordered"  >
		
		<tr>
		<th width="10%">Action</font></th>
		<th width="5%">Sl</font></th>
    <th width="30%">Main Sales Person</font></th>
    <th width="50%">Sales Person Assign</font></th>
		</tr>
<?

while ($row = mysqli_fetch_array($data))
{
$x=$row['sl'];
$username=$row['username'];
$assign_spid=$row['assign_spid'];

$arrayName=explode(",",$assign_spid);

$sln++;
$sl++; 




?>
		<tr>
		<td align="center"><a href="sale_person_assign.php?sl=<?php echo $username;?>">
		<i class="fa fa-pencil-square-o"></i></a>
		</td>
		<td align="center"><? echo $sln;?></td>
		<td align="left"><? echo $username;?></td>
    <td align="left"><?php 
    $id=0;  
foreach($arrayName as $spid2) { 

$get=mysqli_query($conn,"select * from ".$DBprefix."sale_per where spid='$spid2'") or die(mysqli_error($conn));
while($row=mysqli_fetch_array($get))
{
  $id++;
  echo $id.') '.$spid1=$row['spid'].'<br>';
  //echo $id.') '.$spidnm=$row['nm'].'<br>';
}
}
    ?></td>

		</tr>	 
<?
}
?>
</table>
<?
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
<div align="center"><input type="text" size="10" id="pgn" name="pgn" value="<? echo $pno;?>"><input Type="button" value="Go" onclick="pagnt1('')"></div>
<div class="pagination pagination-centered">
                            <ul class="pagination pagination-sm inline">
							<li <? if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('1')"><i class="icon-circle-arrow-left"></i>First</a></li>
                            <li <? if($pno==1){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $prev;?>')"><i class="icon-circle-arrow-left"></i>Previous</a></li>
                            <?
                            
                            if($tp<=5)
                            {
                              $n=1;  
                              while($n<=$tp)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
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
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }     
                                }
                                elseif($pno>$tp-3)
                                {
                                    $n=$tp-5;
                                    while($n<=5)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }   
                                }
                                else
                                {
                                $n=$pno-2; 
                                 while($n<=$pno+2)
                              {
                                ?>
                             <li <? if($pno==$n){ echo "class=\"active\"";}?>><a onclick="pagnt('<?echo $n;?>')"><?echo $n;?></a></li>   
                                <?
                                $n+=1;
                              }     
                                }
                               
                                
                                
                            }
                            ?>
                            <li <? if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $next;?>')">Next<i class="icon-circle-arrow-right"></i></a></li>
                            <li <? if($pno==$tp){ echo "class=\"disabled\"";}?>><a onclick="pagnt('<?echo $tp;?>')">Last<i class="icon-circle-arrow-right"></i></a></li>
                            </ul>
                            </div>
<?
}

else
{
	?>
	<center><font size="4" color="red"><b>No Data Available...</b></font></center>
	<?
}
?>							