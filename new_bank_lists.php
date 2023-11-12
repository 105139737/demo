<?php
$reqlevel = 3;
include("membersonly.inc.php");

$frmnm='';
date_default_timezone_set('Asia/Kolkata');
$dt = date('d-M-Y');

$cy=date('Y');
$all=rawurldecode($_REQUEST[all]);
$brncd=$_REQUEST[brncd];
$al="%".$all."%";
if($all!="")
{
	$all1=" and ac LIKE '$al' or ifsc LIKE '$al' or branch LIKE '$al'";
}
else
{
	$all1="";	
}

if($brncd!="")
{
	$brncd1=" and brncd='$brncd'";
}
else
{
	$brncd1="";	
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


?>
<div align="left">
<input type="text" name="ps" id="ps" value="<?=$ps;?>" size="7" onblur="pagnt1(this.value)">
</div>

<table class="table table-hover table-striped table-bordered">	
<tr>
<th>Sl</th>
<th>Branch</th>
<th>Bank Name</th>
<th>A/C No.</th>
<th>IFSC Code</th>
<th>Bank Branch</th>
<th>Action</th>
</tr>
<?
$sl=$start;
$sln=0;
$datatt=mysqli_query($conn,"select * from main_bank where sl>0")or die(mysqli_error($conn));
$rcntttl=mysqli_num_rows($datatt);
$datar=mysqli_query($conn,"select * from main_bank where  sl>0".$all1.$brncd1)or die(mysqli_error($conn));
$rcnt=mysqli_num_rows($datar);
$data=mysqli_query($conn,"select * from main_bank where  sl>0 $all1 $brncd1 order by sl desc limit $start,$ps ")or die(mysqli_error($conn));
while($row=mysqli_fetch_array($data))
{
	$x=$row['sl'];
	$brncd=$row['brncd'];
	$bnm1=$row['bnm'];
	$ac=$row['ac'];
  $ifsc=$row['ifsc'];
	$branch=$row['branch'];
  $actnum=$row['stat'];
	
	$sln++;   
	$sl++; 
	$sll=base64_encode($x);



	   if($actnum==1)
	   {
		   $stat="<input type=\"button\" title=\"Click Here To Activate\" class=\"btn btn-block btn-danger btn-xs\" value=\"Deactivate\" onclick=\"act('".$x."','0')\" name=\"B2\">";
	   }
	   else
	   {
			$stat="<input type=\"button\" value=\"Active\" title=\"Click Here To Dectivate\" class=\"btn btn-block btn-success btn-xs\" onclick=\"act('".$x."','1')\" name=\"B1\">";
	   }


$bnm="";
$query="Select * from main_branch where sl='$brncd'";
$result = mysqli_query($conn,$query);
while ($R = mysqli_fetch_array ($result))
{
$bnm=$R['bnm'];
}	
?>
<tr>
<td align="center"><? echo $sl;?></td>
<td align="left"><? echo $bnm;?></td>
<td align="left"><? echo $bnm1;?></td>
<td align="left"><? echo $ac;?></td>
<td align="left"><? echo $ifsc;?></td>
<td align="left"><? echo $branch;?></td>
<?
if($user_current_level<0)
{
	?>
	<td align="center" style="cursor:pointer;">
	<a href="new_bank_edt.php?sl=<?=$sll;?>"><i class="fa fa-pencil-square-o" title="Click to Update"></i></a>
	<br><? echo $stat;?>
	</td>
	<?
}
else
{
	?>
	<td align="center">You need to be<br> an admin for <br>this page</td>
	<?
}
?>		
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
							